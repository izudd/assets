<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Aset</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }

        h3 {
            margin-bottom: 0;
        }

        .group {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h2>Laporan Aset</h2>
    <p><strong>Tanggal:</strong> {{ now()->format('d/m/Y') }}</p>

    @foreach($assets as $kategori => $subGroups)
    <div class="group">
        @foreach($subGroups as $subkategori => $items)
        <!-- Kategori selalu ditampilkan per sub kategori -->
        <h3>Kategori: {{ $kategori }}</h3>
        <h4>Sub Kategori: {{ $subkategori }}</h4>

        <table>
            <thead>
                <tr>
                    <th>Kode Aset</th>
                    <th>Deskripsi</th>
                    <th>Detail Deskripsi</th>
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
                @foreach($items as $row)
                <tr>
                    <td>{{ $row->kode_aset }}</td>
                    <td>{{ $row->deskripsi }}</td>
                    <td>{{ $row->detail_desk }}</td>
                    <td>{{ $row->lokasi }}</td>
                    <td>{{ $row->unit_pengguna }}</td>
                    <td>{{ $row->qty_sebelum }}</td>
                    <td>{{ $row->qty_sesudah }}</td>
                    <td>{{ $row->qty_sesudah - $row->qty_sebelum }}</td>
                    <td>{{ $row->kondisi }}</td>
                    <td>{{ $row->catatan }}</td>
                    <td>
                        @if($row->dokumentasi && $row->dokumentasi->count())
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-3">
                            @foreach ($asset->dokumentasis as $doc)
                            <div class="border rounded-lg p-2 shadow hover:shadow-md transition">
                                <img src="{{ asset('storage/' . $doc->file_path) }}"
                                    alt="Dokumentasi {{ $asset->kode_aset }}"
                                    class="rounded-lg max-h-48 mx-auto">
                                <p class="text-sm text-center mt-2 text-gray-600">{{ $doc->keterangan }}</p>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-gray-500 italic mt-2">Tidak ada dokumentasi tersedia.</p>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
    @endforeach
</body>

</html>