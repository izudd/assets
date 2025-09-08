<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Kategori;


class AssetController extends Controller
{
    // 1. Tampilkan semua data aset
    public function index()
    {
        $assets = Asset::with('user')->latest()->get();
        return view('assets.index', compact('assets'));
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
            'kode_aset' => 'required|unique:assets',
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi' => 'required',
            'unit_pengguna' => 'required',
            'qty_sebelum' => 'required|integer',
            'qty_sesudah' => 'required|integer',
            'kondisi' => 'required',
            'catatan' => 'required',
            'deskripsi' => 'required',
            'dokumentasi.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $selisih = $request->qty_sesudah - $request->qty_sebelum;

        $asset = Asset::create([
            'kode_aset' => $request->kode_aset,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
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
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'unit_pengguna' => 'nullable|string',
            'kondisi' => 'nullable|string',
            'qty_sebelum' => 'nullable|integer',
            'qty_sesudah' => 'nullable|integer',
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

    public function exportPdf()
    {
        $assets = Asset::with('dokumentasi')->get();
        $pdf = Pdf::loadView('assets.export-pdf', compact('assets'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('data-aset.pdf');
    }

    public function show($id)
    {
        $asset = Asset::with(['dokumentasi', 'user'])->findOrFail($id);
        return view('assets.show', compact('asset'));
    }
}
