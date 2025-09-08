<x-app-layout>

    @section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-100 via-indigo-200 to-purple-200 p-6">
        <div class="max-w-5xl mx-auto bg-white shadow-2xl rounded-2xl p-8 animate-fadeIn">
            <!-- Notif Error -->
            @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <strong>⚠️ Terjadi kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Notif Sukses -->
            @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                ✅ {{ session('success') }}
            </div>
            @endif
            <!-- Judul -->
            <h2 class="text-3xl font-bold text-indigo-700 mb-6 animate-bounce">✨ Input Data Aset ✨</h2>
            <p class="text-gray-600 mb-6">Silakan lengkapi form berikut untuk menambahkan data aset baru.</p>

            <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Grid Form -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kode Aset -->
                    <div class="animate-slideInLeft">
                        <label class="block text-sm font-medium text-gray-700">Kode Aset</label>
                        <input type="text" name="kode_aset" class="mt-1 w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Kategori -->
                    <div class="mb-4">
                        <label for="kategori_id" class="block font-medium">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="w-full border rounded-lg p-2">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>

                        @error('kategori_id')
                        <p class="text-red-600 text-sm mt-1">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="col-span-2 animate-fadeInUp">
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" class="mt-1 w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-indigo-500"></textarea>
                    </div>

                    <!-- Lokasi -->
                    <div class="animate-slideInLeft">
                        <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                        <input type="text" name="lokasi" class="mt-1 w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- Unit Pengguna -->
                    <div class="animate-slideInRight">
                        <label class="block text-sm font-medium text-gray-700">Unit Pengguna</label>
                        <input type="text" name="unit_pengguna" class="mt-1 w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                <!-- Kuantitas -->
                <div class="bg-indigo-50 p-4 rounded-xl shadow-inner animate-fadeInUp">
                    <h3 class="text-lg font-semibold text-indigo-600 mb-3">📊 Kuantitas</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label>Sebelum Check</label>
                            <input type="number" name="qty_sebelum" class="mt-1 w-full rounded-xl border-gray-300 shadow-md">
                        </div>
                        <div>
                            <label>Sesudah Check</label>
                            <input type="number" name="qty_sesudah" class="mt-1 w-full rounded-xl border-gray-300 shadow-md">
                        </div>
                        <div>
                            <label>Selisih</label>
                            <input type="number" name="qty_selisih" class="mt-1 w-full rounded-xl border-gray-300 shadow-md">
                        </div>
                    </div>
                </div>

                <!-- Kondisi -->
                <div class="animate-fadeInLeft">
                    <label class="block text-sm font-medium text-gray-700">Kondisi</label>
                    <select name="kondisi" class="mt-1 w-full rounded-xl border-gray-300 shadow-md">
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                        <option value="Rusak Berat">Tidak Ditemukan</option>
                    </select>
                </div>

                <!-- Catatan -->
                <div class="animate-fadeInRight">
                    <label class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea name="catatan" rows="3" class="mt-1 w-full rounded-xl border-gray-300 shadow-md"></textarea>
                </div>

                <!-- Dokumentasi -->
                <div class="animate-zoomIn">
                    <label class="block text-sm font-medium text-gray-700">📷 Dokumentasi (Max 4 Foto)</label>
                    <input
                        type="file"
                        name="dokumentasi[]"
                        id="dokumentasi"
                        accept="image/*"
                        capture="environment"
                        multiple
                        class="mt-1 w-full text-gray-600"
                        onchange="previewImages(event)">
                    <small class="text-gray-500">Gunakan kamera HP untuk ambil maksimal 4 foto langsung.</small>

                    <!-- Tempat preview foto -->
                    <div id="preview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4"></div>
                </div>

                <script>
                    let selectedFiles = [];

                    function previewImages(event) {
                        const files = Array.from(event.target.files);
                        const preview = document.getElementById("preview");
                        preview.innerHTML = "";

                        // gabungkan file lama + baru
                        selectedFiles = [...selectedFiles, ...files];

                        // batasi max 4
                        if (selectedFiles.length > 4) {
                            alert("Maksimal upload 4 foto!");
                            selectedFiles = selectedFiles.slice(0, 4);
                        }

                        // render ulang preview
                        renderPreview(preview);
                    }

                    function renderPreview(preview) {
                        preview.innerHTML = "";

                        selectedFiles.forEach((file, index) => {
                            const reader = new FileReader();
                            reader.onload = e => {
                                // wrapper
                                const div = document.createElement("div");
                                div.className = "relative";

                                // gambar
                                const img = document.createElement("img");
                                img.src = e.target.result;
                                img.className = "w-full h-32 object-cover rounded-xl shadow-md animate-fadeIn";

                                // tombol hapus
                                const btn = document.createElement("button");
                                btn.innerHTML = "✖";
                                btn.type = "button";
                                btn.className = "absolute top-1 right-1 bg-red-600 text-white rounded-full px-2 py-1 text-xs shadow hover:bg-red-700";
                                btn.onclick = () => {
                                    removeImage(index);
                                };

                                div.appendChild(img);
                                div.appendChild(btn);
                                preview.appendChild(div);
                            };
                            reader.readAsDataURL(file);
                        });

                        syncInput();
                    }

                    function removeImage(index) {
                        selectedFiles.splice(index, 1);
                        const preview = document.getElementById("preview");
                        renderPreview(preview);
                    }

                    function syncInput() {
                        const dataTransfer = new DataTransfer();
                        selectedFiles.forEach(file => dataTransfer.items.add(file));
                        document.getElementById("dokumentasi").files = dataTransfer.files;
                    }
                </script>



                <!-- Tombol Submit -->
                <div class="text-right animate-fadeInUp">
                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-xl shadow-lg hover:bg-indigo-700 hover:scale-105 transition-transform">
                        🚀 Simpan Aset
                    </button>
                </div>
                @csrf
            </form>
        </div>
    </div>
</x-app-layout>