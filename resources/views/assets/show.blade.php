<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-8 px-6">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-md p-6">
            <!-- Header -->
            <div class="flex justify-between items-center border-b pb-4 mb-6">
                <h1 class="text-2xl font-bold text-gray-700">📦 Detail Aset</h1>
                <a href="{{ route('assets.index') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    ← Kembali
                </a>
            </div>

            <!-- Detail Aset -->
            <div class="space-y-4">
                <p><strong>Kode Aset:</strong> {{ $asset->kode_aset }}</p>
                <p><strong>Kategori:</strong> {{ $asset->kategori }}</p>
                <p><strong>Deskripsi:</strong> {{ $asset->deskripsi }}</p>
                <p><strong>Lokasi:</strong> {{ $asset->lokasi }}</p>
                <p><strong>Unit Pengguna:</strong> {{ $asset->unit_pengguna }}</p>
                <p><strong>Kondisi:</strong> {{ $asset->kondisi }}</p>
                <p><strong>Qty Sebelum:</strong> {{ $asset->qty_sebelum }}</p>
                <p><strong>Qty Sesudah:</strong> {{ $asset->qty_sesudah }}</p>
                <p><strong>Selisih:</strong>
                    <span class="{{ $asset->selisih > 0 ? 'text-green-600' : ($asset->selisih < 0 ? 'text-red-600' : 'text-gray-600') }}">
                        {{ $asset->selisih }}
                    </span>
                </p>
                <p><strong>Ditambahkan oleh:</strong> {{ $asset->user->name }}</p>
            </div>

            <!-- Dokumentasi -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">📸 Dokumentasi Aset</h2>

                @if($asset->dokumentasi && $asset->dokumentasi->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($asset->dokumentasi as $dok)
                    <div class="border rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                        <img src="{{ asset('storage/' . $dok->file_path) }}"
                            alt="Dokumentasi {{ $asset->kode_aset }}"
                            class="w-full h-40 object-cover">
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500 italic">Tidak ada dokumentasi tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>