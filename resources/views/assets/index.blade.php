<x-app-layout>
    <div class="bg-gradient-to-br from-blue-50 to-white shadow-lg rounded-2xl p-6">

        {{-- Notifikasi sukses --}}
        @if (session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            class="mb-4 p-3 rounded-lg bg-green-100 border border-green-300 text-green-800 animate__animated animate__fadeInDown">
            {{ session('success') }}
        </div>
        @endif

        {{-- Notifikasi error --}}
        @if ($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-300 text-red-800 animate__animated animate__shakeX">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <h2 class="text-2xl font-bold text-gray-700 flex items-center gap-2 animate-fadeIn">
                📦 Data Aset
            </h2>

            <div class="flex flex-col md:flex-row gap-3">
                <!-- Form Import -->
                <form action="{{ route('assets.import') }}" method="POST" enctype="multipart/form-data"
                    class="flex items-center space-x-2">
                    @csrf
                    <input type="file" name="file" accept=".xlsx,.csv" required
                        class="border p-2 rounded text-sm">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                        ⬆️ Import Excel
                    </button>
                </form>

                <!-- Tambah Aset -->
                <a href="{{ route('assets.create') }}"
                    class="bg-blue-600 text-white px-5 py-2 rounded-xl shadow hover:bg-blue-700 hover:scale-105 transition transform duration-200 ease-in-out text-center">
                    ➕ Tambah Aset
                </a>
            </div>
        </div>
        <!-- Table -->
        <div class="overflow-x-auto animate-fadeIn">
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden text-sm">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="p-3 text-left">Kode Aset</th>
                        <th class="p-3 text-left">Kategori</th>
                        <th class="p-3 text-left">Sub Kategori</th>
                        <th class="p-3 text-left">Deskripsi</th>
                        <th class="p-3 text-left">Detail Deskripsi</th>
                        <th class="p-3 text-left">Lokasi</th>
                        <th class="p-3 text-left">Unit Pengguna</th>
                        <th class="p-3 text-center">Qty Sebelum</th>
                        <th class="p-3 text-center">Qty Sesudah</th>
                        <th class="p-3 text-center">Selisih</th>
                        <th class="p-3 text-center">Kondisi</th>
                        <th class="p-3 text-center">catatan</th>
                        <th class="p-3 text-center">Dokumentasi</th>
                        <th class="p-3 text-center">Input Oleh</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($assets as $asset)
                    <tr class="hover:bg-blue-50 transition duration-150">
                        <td class="p-3">{{ $asset->kode_aset }}</td>
                        <td class="p-3">{{ $asset->kategori }}</td>
                        <td class="p-3">{{ $asset->kategori_1 ?? '-' }}</td>
                        <td class="p-3">{{ $asset->deskripsi }}</td>
                        <td class="p-3">{{ $asset->detail_desk }}</td>
                        <td class="p-3">{{ $asset->lokasi }}</td>
                        <td class="p-3">{{ $asset->unit_pengguna }}</td>
                        <td class="p-3 text-center">{{ $asset->qty_sebelum }}</td>
                        <td class="p-3 text-center">{{ $asset->qty_sesudah }}</td>
                        <td class="p-3 text-center font-semibold 
                        {{ $asset->selisih > 0 ? 'text-green-600' : ($asset->selisih < 0 ? 'text-red-600' : 'text-gray-600') }}">
                            {{ $asset->selisih }}
                        </td>
                        <td class="p-3 text-center">{{ $asset->kondisi }}</td>
                        <td class="p-3 text-center">{{ $asset->catatan ?? '-' }}</td>

                        {{-- 📸 Kolom Dokumentasi Foto --}}
                        <td>
                            @forelse($asset->dokumentasi ?? [] as $doc)
                            <img src="{{ asset('storage/'.$doc->file_path) }}" width="60" class="mr-1" alt="Foto">
                            @empty
                            <span>-</span>
                            @endforelse
                        </td>
                        <td class="p-3 text-center">{{ $asset->user->name }}</td>
                        <td class="p-3 flex justify-center gap-3">
                            <a href="{{ route('assets.show', $asset->id) }}"
                                class="text-blue-600 hover:scale-125 transform transition">🔍</a>
                            <a href="{{ route('assets.edit', $asset->id) }}"
                                class="text-green-600 hover:scale-125 transform transition">✏️</a>
                            <form action="{{ route('assets.destroy', $asset->id) }}" method="POST"
                                onsubmit="return confirm('Hapus data ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:scale-125 transform transition">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    @empty

                    <tr>
                        <td colspan="11" class="text-center p-4 text-gray-500">
                            Belum ada data aset.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="mt-4">
            {{ $assets->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</x-app-layout>