<x-app-layout>
    <div class="p-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold mb-6 flex items-center gap-2 text-gray-800">
            📂 <span>Laporan Data Aset</span>
        </h1>

        <!-- Filter Cards -->
        <div class="bg-white shadow-lg rounded-xl p-6 mb-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Kategori -->
                <div class="border rounded-xl shadow p-4 flex justify-between items-center">
                    <span class="font-semibold">Kategori</span>
                    <div class="flex gap-2">
                        <form method="GET" action="{{ route('assets.filter') }}">
                            <select name="kategori" onchange="this.form.submit()"
                                class="border rounded-lg px-3 py-1 text-sm">
                                <option value="">Sort by</option>
                                @foreach($kategoris as $kategori)
                                <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                                    {{ $kategori }}
                                </option>
                                @endforeach
                            </select>
                        </form>
                        <!-- Tombol Preview -->
                        <button type="button"
                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm"
                            onclick="openPreviewModal()">
                            Preview
                        </button>
                    </div>
                </div>

                <!-- Sub Kategori -->
                <div class="border rounded-xl shadow p-4 flex justify-between items-center">
                    <span class="font-semibold">Sub Kategori</span>
                    <div class="flex gap-2">
                        <form method="GET" action="{{ route('assets.filter') }}">
                            <select name="kategori_1" onchange="this.form.submit()"
                                class="border rounded-lg px-3 py-1 text-sm">
                                <option value="">Sort by</option>
                                @foreach($subkategoris as $sub)
                                <option value="{{ $sub }}" {{ request('kategori_1') == $sub ? 'selected' : '' }}>
                                    {{ $sub }}
                                </option>
                                @endforeach
                            </select>
                        </form>
                        <!-- Tombol Preview -->
                        <button type="button"
                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm"
                            onclick="openPreviewModal()">
                            Preview
                        </button>
                    </div>
                </div>

                <!-- Lokasi -->
                <div class="border rounded-xl shadow p-4 flex justify-between items-center">
                    <span class="font-semibold">Lokasi</span>
                    <div class="flex gap-2">
                        <form method="GET" action="{{ route('assets.filter') }}">
                            <select name="lokasi" onchange="this.form.submit()"
                                class="border rounded-lg px-3 py-1 text-sm">
                                <option value="">Sort by</option>
                                @foreach($lokasis as $lok)
                                <option value="{{ $lok }}" {{ request('lokasi') == $lok ? 'selected' : '' }}>
                                    {{ $lok }}
                                </option>
                                @endforeach
                            </select>
                        </form>
                        <!-- Tombol Preview -->
                        <button type="button"
                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm"
                            onclick="openPreviewModal()">
                            Preview
                        </button>
                    </div>
                </div>

                <!-- Unit Pengguna -->
                <div class="border rounded-xl shadow p-4 flex justify-between items-center">
                    <span class="font-semibold">Unit Pengguna</span>
                    <div class="flex gap-2">
                        <form method="GET" action="{{ route('assets.filter') }}">
                            <select name="unit_pengguna" onchange="this.form.submit()"
                                class="border rounded-lg px-3 py-1 text-sm">
                                <option value="">Sort by</option>
                                @foreach($units as $unit)
                                <option value="{{ $unit }}" {{ request('unit_pengguna') == $unit ? 'selected' : '' }}>
                                    {{ $unit }}
                                </option>
                                @endforeach
                            </select>
                        </form>
                        <!-- Tombol Preview -->
                        <button type="button"
                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm"
                            onclick="openPreviewModal()">
                            Preview
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabel Aset -->
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-600 to-purple-600 text-white text-left">
                            <th class="px-4 py-3">Kode Aset</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Sub Kategori</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3">Detail Deskripsi</th>
                            <th class="px-4 py-3">Lokasi</th>
                            <th class="px-4 py-3">Unit Pengguna</th>
                            <th class="px-4 py-3">Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $asset)
                        <tr class="hover:bg-gray-50 odd:bg-gray-100 transition">
                            <td class="px-4 py-3 border-t">{{ $asset->kode_aset }}</td>
                            <td class="px-4 py-3 border-t">{{ $asset->kategori }}</td>
                            <td class="px-4 py-3 border-t">{{ $asset->kategori_1 ?? '-' }}</td>
                            <td class="px-4 py-3 border-t">{{ $asset->deskripsi }}</td>
                            <td class="px-4 py-3 border-t">{{ $asset->detail_desk }}</td>
                            <td class="px-4 py-3 border-t">{{ $asset->lokasi }}</td>
                            <td class="px-4 py-3 border-t">{{ $asset->unit_pengguna }}</td>
                            <td class="px-4 py-3 border-t">{{ $asset->catatan }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-4 py-6 text-center text-gray-500 italic">
                                ❌ Tidak ada data aset untuk filter ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-6">
                {{ $assets->withQueryString()->links() }}
            </div>
        </div>

        <!-- Modal Popup (Preview & Export) -->
        <div id="previewModal"
            class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-300">

            <div id="previewContent"
                class="bg-white rounded-2xl shadow-lg w-96 p-6 transform scale-95 opacity-0 transition-all duration-300">

                <h2 class="text-lg font-semibold mb-4 text-center">📄 Preview & Export</h2>

                <div class="space-y-3">
                    <a href="{{ route('assets.preview-pdf', request()->all()) }}" target="_blank"
                        class="block px-4 py-2 text-center bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                        🖨️ Cetak (Preview PDF)
                    </a>
                    <a href="{{ route('assets.preview-pdf', ['id' => $asset->id, 'download' => 'Pdf']) }}"
                        class="block px-4 py-2 text-center bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        📥 Download PDF
                    </a>
                    <a href="{{ route('assets.export-excel', request()->all()) }}"
                        class="block px-4 py-2 text-center bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                        📊 Download Excel
                    </a>
                </div>

                <!-- Tombol Close -->
                <button onclick="closePreviewModal()"
                    class="mt-5 w-full px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                    ✖ Tutup
                </button>
            </div>
        </div>

        <!-- Script Modal -->
        <script>
            function openPreviewModal() {
                const modal = document.getElementById('previewModal');
                const content = document.getElementById('previewContent');

                modal.classList.remove('hidden');
                setTimeout(() => {
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10); // delay biar animasi jalan
            }

            function closePreviewModal() {
                const modal = document.getElementById('previewModal');
                const content = document.getElementById('previewContent');

                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');

                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300); // sesuai durasi animasi
            }
        </script>

        <script>
            function toggleDropdown(btn) {
                const menu = btn.nextElementSibling;
                menu.classList.toggle("hidden");
                document.addEventListener("click", function handler(e) {
                    if (!btn.contains(e.target) && !menu.contains(e.target)) {
                        menu.classList.add("hidden");
                        document.removeEventListener("click", handler);
                    }
                });
            }
        </script>
</x-app-layout>