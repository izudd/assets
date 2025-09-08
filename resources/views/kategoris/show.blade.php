<x-app-layout>
    <div class="max-w-6xl mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">📁 Kategori: {{ $kategori->nama }}</h1>

        @if($kategori->assets->count())
            <table class="min-w-full border border-gray-300 bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border">Kode Aset</th>
                        <th class="p-2 border">Deskripsi</th>
                        <th class="p-2 border">Lokasi</th>
                        <th class="p-2 border">Unit Pengguna</th>
                        <th class="p-2 border">Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori->assets as $asset)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="p-2 border">{{ $asset->kode_aset }}</td>
                            <td class="p-2 border">{{ $asset->deskripsi }}</td>
                            <td class="p-2 border">{{ $asset->lokasi }}</td>
                            <td class="p-2 border">{{ $asset->unit_pengguna }}</td>
                            <td class="p-2 border">{{ $asset->kondisi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600">Tidak ada aset dalam kategori ini.</p>
        @endif

        <div class="mt-4">
            <a href="{{ route('kategoris.index') }}"
               class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">⬅ Kembali</a>
        </div>
    </div>
</x-app-layout>
