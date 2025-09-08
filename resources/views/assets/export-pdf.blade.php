<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Aset</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>📦 Data Aset</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Aset</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Unit Pengguna</th>
                <th>Qty Sebelum</th>
                <th>Qty Sesudah</th>
                <th>Selisih</th>
                <th>Kondisi</th>
                <th>Catatan</th>
                <th>Dokumentasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assets as $asset)
            <tr>
                <td>{{ $asset->kode_aset }}</td>
                <td>{{ $asset->kategori }}</td>
                <td>{{ $asset->deskripsi }}</td>
                <td>{{ $asset->lokasi }}</td>
                <td>{{ $asset->unit_pengguna }}</td>
                <td>{{ $asset->qty_sebelum }}</td>
                <td>{{ $asset->qty_sesudah }}</td>
                <td>{{ $asset->selisih }}</td>
                <td>{{ $asset->kondisi }}</td>
                <td>{{ $asset->catatan }}</td>
                <td>
                        @if ($asset->dokumentasi && count($asset->dokumentasi) > 0)
                            @foreach ($asset->dokumentasi as $doc)
                                <img src="{{ public_path('storage/' . $doc->path) }}" alt="Foto">
                            @endforeach
                        @else
                            <i>Tidak ada</i>
                        @endif
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
