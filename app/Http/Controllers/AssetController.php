<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Kategori;
use App\Exports\AssetsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Dokumentasi;

class AssetController extends Controller
{
    // 1. Tampilkan semua data aset
    public function index(Request $request)
    {
        $query = Asset::with(['dokumentasi', 'user']);

        // filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // filter sub kategori
        if ($request->filled('kategori_1')) {
            $query->where('kategori_1', $request->kategori_1);
        }

        // paginate hasil query
        $assets = $query->latest()->paginate(10);

        // daftar kategori & sub kategori (distinct + buang null/kosong)
        $kategoris = Asset::whereNotNull('kategori')->distinct()->pluck('kategori');
        $subkategoris = Asset::whereNotNull('kategori_1')->distinct()->pluck('kategori_1');

        return view('assets.index', compact('assets', 'kategoris', 'subkategoris'));
    }

    // 2. Form tambah aset
    public function create()
    {
        $kategoris = Kategori::all();
        return view('assets.create', compact('kategoris'));
    }

    // 3. Simpan aset baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_aset' => 'required|unique:assets,kode_aset',
            'kategori'      => 'required|string|max:255',
            'kategori_1' => 'nullable|string|max:255',
            'lokasi' => 'required',
            'unit_pengguna' => 'required',
            'qty_sebelum' => 'required|integer',
            'qty_sesudah' => 'required|integer',
            'kondisi' => 'required',
            'catatan' => 'nullable|string',
            'deskripsi' => 'required',
            'detail_desk' => 'nullable|string',
            'dokumentasi.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $selisih = $request->qty_sesudah - $request->qty_sebelum;

        $asset = Asset::create([
            'kode_aset' => Asset::generateKode(),
            'kategori' => $request->kategori,
            'kategori_1' => $request->kategori_1,
            'deskripsi' => $request->deskripsi,
            'detail_desk' => $request->detail_desk,
            'lokasi' => $request->lokasi,
            'unit_pengguna' => $request->unit_pengguna,
            'qty_sebelum' => $request->qty_sebelum,
            'qty_sesudah' => $request->qty_sesudah,
            'selisih' => $selisih,
            'kondisi' => $request->kondisi,
            'catatan' => $request->catatan,
            'user_id' => Auth::id(),
        ]);

        // Simpan file dokumentasi jika ada
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('dokumentasi', 'public');
                $asset->dokumentasi()->create([
                    'file_path' => $path,
                    'keterangan' => null,
                ]);
            }
        }

        return redirect()->route('assets.index')->with('success', '✅ Data aset berhasil ditambahkan!');
    }


    // 4. Form edit aset
    public function edit(Asset $asset)
    {
        $kategoris = Kategori::all();
        return view('assets.edit', compact('asset', 'kategoris'));
    }

    // 5. Update aset
    public function update(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'kode_aset' => 'required|string|max:100',
            'kategori' => 'required|string|max:100',
            'kategori_1' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'detail_desk' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'unit_pengguna' => 'nullable|string',
            'kondisi' => 'nullable|string',
            'qty_sebelum' => 'nullable|integer',
            'qty_sesudah' => 'nullable|integer',
            'catatan' => 'nullable|string',
            'dokumentasi.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $qtySebelum = (int) $request->input('qty_sebelum', $asset->qty_sebelum ?? 0);
        $qtySesudah = (int) $request->input('qty_sesudah', $asset->qty_sesudah ?? 0);
        $selisih = $qtySesudah - $qtySebelum;

        $asset->update(array_merge($validated, [
            'qty_sebelum' => $qtySebelum,
            'qty_sesudah' => $qtySesudah,
            'selisih' => $selisih,
        ]));

        // hapus dokumentasi jika ada checkbox
        foreach ($request->input('delete_dokumentasi', []) as $dokId) {
            $dok = $asset->dokumentasi()->find($dokId);
            if ($dok) {
                Storage::disk('public')->delete($dok->file_path);
                $dok->delete();
            }
        }

        // tambah dokumentasi baru
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('dokumentasi', 'public');
                $asset->dokumentasi()->create([
                    'file_path' => $path,
                    'keterangan' => 'Foto tambahan'
                ]);
            }
        }

        return redirect()->route('assets.show', $asset->id)
            ->with('success', 'Data aset berhasil diperbarui beserta dokumentasi.');
    }

    // 6. Hapus aset
    public function destroy(Asset $asset)
    {
        if ($asset->dokumentasi) {
            Storage::disk('public')->delete($asset->dokumentasi);
        }
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Aset berhasil dihapus!');
    }

    public function previewPdf(Request $request)
    {
        $query = Asset::query();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('kategori_1')) {
            $query->where('kategori_1', $request->kategori_1);
        }
        if ($request->filled('lokasi')) {
            $query->where('lokasi', $request->lokasi);
        }
        if ($request->filled('unit_pengguna')) {
            $query->where('unit_pengguna', $request->unit_pengguna);
        }

        $assets = $query->get()->groupBy(['kategori', 'kategori_1']);
        // bisa juga groupBy(['lokasi']) atau ['unit_pengguna']

        $pdf = Pdf::loadView('assets.print', compact('assets'))
            ->setPaper('A4', 'landscape');

        // default → preview
        return $pdf->stream('laporan-aset.pdf');
    }


    // kalau export excel
    public function exportExcel(Request $request)
    {
        return Excel::download(new AssetsExport($request), 'assets.xlsx');
    }
    public function show(Asset $asset)
    {
        $asset->load('dokumentasis'); // biar eager load
        return view('assets.show', compact('asset'));
    }

    public function filter(Request $request)
    {
        $query = Asset::query();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('kategori_1')) {
            $query->where('kategori_1', $request->kategori_1);
        }
        if ($request->filled('lokasi')) {
            $query->where('lokasi', $request->lokasi);
        }
        if ($request->filled('unit_pengguna')) {
            $query->where('unit_pengguna', $request->unit_pengguna);
        }

        $assets = $query->paginate(10);

        // ambil data unik buat dropdown "Sort by"
        $kategoris   = Asset::select('kategori')->distinct()->pluck('kategori');
        $subkategoris = Asset::select('kategori_1')->distinct()->pluck('kategori_1');
        $lokasis     = Asset::select('lokasi')->distinct()->pluck('lokasi');
        $units       = Asset::select('unit_pengguna')->distinct()->pluck('unit_pengguna');

        return view('assets.filter', compact('assets', 'kategoris', 'subkategoris', 'lokasis', 'units'));
    }

    public function exportPdf($id)
{
    // Ambil data asset + dokumentasi
    $asset = Asset::with('dokumentasi')->findOrFail($id);

    // kirim ke view
    $pdf = Pdf::loadView('assets.export-pdf', [
        'asset' => $asset,
    ]);

    return $pdf->download('asset-' . $asset->id . '.pdf');
}

}
