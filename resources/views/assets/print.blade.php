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
                                @if($row->dokumentasis && $row->dokumentasis->count())
                                <div class="doc-container">
                                    @foreach($row->dokumentasis as $doc)
                                    <div class="doc-item">
                                        <img src="{{ public_path('storage/' . $doc->file_path) }}"
                                             alt="Dokumentasi {{ $row->kode_aset }}">
                                        <p>{{ $doc->keterangan }}</p>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <p style="font-style:italic;">Tidak ada dokumentasi.</p>
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