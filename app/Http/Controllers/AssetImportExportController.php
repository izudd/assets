<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class AssetImportExportController extends Controller
{
    // Export data aset ke Excel
    public function export()
    {
        $path = storage_path('app/public/assets.xlsx');

        $writer = SimpleExcelWriter::create($path);

        Asset::with('user')->get()->each(function ($asset) use ($writer) {
            $writer->addRow([
                'Kode Aset'     => $asset->kode_aset,
                'Kategori'      => $asset->kategori,
                'Deskripsi'     => $asset->deskripsi,
                'Lokasi'        => $asset->lokasi,
                'Unit Pengguna' => $asset->unit_pengguna,
                'qty Sebelum'   => $asset->qty_sebelum,
                'qty Sesudah'   => $asset->qty_sesudah,
                'Selisih'       => $asset->selisih,
                'Kondisi'       => $asset->kondisi,
                'Catatan'       => $asset->catatan,
                'Dibuat Oleh'   => optional($asset->user)->name,
            ]);
        });

        return response()->download($path)->deleteFileAfterSend();
    }

    // Import data aset dari Excel
    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv|max:2048',
    ]);

    $file = $request->file('file');
    $filename = time() . '-' . $file->getClientOriginalName();
    $path = $file->storeAs('imports', $filename);
    $fullPath = Storage::path($path);

    $rows = SimpleExcelReader::create($fullPath)->getRows();

    foreach ($rows as $row) {
        $qtySebelum = (int) ($row['qty_sebelum'] ?? 0);
        $qtySesudah = (int) ($row['qty_sesudah'] ?? 0);
        $selisih = $qtySesudah - $qtySebelum;

        Asset::updateOrCreate(
            ['kode_aset' => $row['kode_aset'] ?? null],
            [
                'kategori' => $row['kategori'] ?? null,
                'deskripsi' => $row['deskripsi'] ?? null,
                'lokasi' => $row['lokasi'] ?? null,
                'unit_pengguna' => $row['unit_pengguna'] ?? null,
                'qty_sebelum' => $qtySebelum,
                'qty_sesudah' => $qtySesudah,
                'selisih' => $selisih,
                'kondisi' => $row['kondisi'] ?? null,
                'catatan' => $row['catatan'] ?? null,
                'user_id' => Auth::id(),
            ]
        );
    }

    Storage::delete($path);
    return redirect()->route('assets.index')->with('success', '✅ Data aset berhasil diimport!');
}
}
