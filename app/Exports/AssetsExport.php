<?php

namespace App\Exports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class AssetsExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Asset::query();

        if ($this->request->filled('kategori')) {
            $query->where('kategori', $this->request->kategori);
        }
        if ($this->request->filled('kategori_1')) {
            $query->where('kategori_1', $this->request->kategori_1);
        }

        return $query->get([
            'kode_aset', 'kategori', 'kategori_1', 'deskripsi',
            'lokasi', 'unit_pengguna', 'catatan'
        ]);
    }

    public function headings(): array
    {
        return [
            'Kode Aset',
            'Kategori',
            'Sub Kategori',
            'Deskripsi',
            'Lokasi',
            'Unit Pengguna',
            'Catatan',
        ];
    }

    public function view(): View
    {
        // Grouping sama kaya PDF
        $assets = Asset::all()
            ->groupBy('kategori')
            ->map(function ($group) {
                return $group->groupBy('subkategori');
            });

        return view('exports.assets', [
            'assets' => $assets
        ]);
    }
}
