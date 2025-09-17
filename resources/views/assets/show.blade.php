<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-8 px-6">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-md p-6">
            <!-- Header -->
            <div class="flex justify-between items-center border-b pb-4 mb-6">
                <h1 class="text-2xl font-bold text-gray-700">📦 Detail Aset</h1>
                <div class="flex gap-2">
                    <a href="{{ route('assets.edit', $asset->id) }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition flex items-center gap-1">
                        ✏️ Edit
                    </a>
                    <a href="{{ route('assets.index') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center gap-1">
                        ← Kembali
                    </a>
                </div>
            </div>

            <!-- Detail Aset -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <p><strong>Kode Aset:</strong> {{ $asset->kode_aset }}</p>
                <p><strong>Kategori:</strong> {{ $asset->kategori }}</p>
                <p><strong>Sub Kategori:</strong> {{ $asset->kategori_1 }}</p>
                <p><strong>Deskripsi:</strong> {{ $asset->deskripsi }}</p>
                <p><strong>Detail Deskripsi:</strong> {{ $asset->detail_desk }}</p>
                <p><strong>Lokasi:</strong> {{ $asset->lokasi }}</p>
                <p><strong>Unit Pengguna:</strong> {{ $asset->unit_pengguna }}</p>
                <p><strong>Kondisi:</strong> {{ $asset->kondisi }}</p>
                <p><strong>Catatan:</strong> {{ $asset->catatan }}</p>
                <p><strong>Qty Sebelum:</strong> {{ $asset->qty_sebelum }}</p>
                <p><strong>Qty Sesudah:</strong> {{ $asset->qty_sesudah }}</p>
                <p><strong>Selisih:</strong>
                    <span
                        class="{{ $asset->selisih > 0 ? 'text-green-600 font-bold' : ($asset->selisih < 0 ? 'text-red-600 font-bold' : 'text-gray-600') }}">
                        {{ $asset->selisih }}
                    </span>
                </p>
                <p><strong>Ditambahkan oleh:</strong> {{ $asset->user->name }}</p>
            </div>

            <!-- Dokumentasi -->
            @if($asset->dokumentasis && $asset->dokumentasis->count())
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
        </div>
    </div>
</x-app-layout>