<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">✏️ Edit Aset</h1>

        {{-- Global success / errors --}}
        @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-red-50 border border-red-200 text-red-700">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('assets.update', $asset->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow">
            @csrf
            @method('PUT')

            <!-- Grid fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Kode Aset --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kode Aset</label>
                    <input type="text" name="kode_aset" value="{{ old('kode_aset', $asset->kode_aset) }}"
                        @class([ 'mt-1 block w-full rounded p-2' , 'border border-gray-300'=> !$errors->has('kode_aset'),
                    'border border-red-500' => $errors->has('kode_aset'),
                    ])>
                    @error('kode_aset') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block">Kategori</label>
                    <select name="kategori_id" class="w-full border rounded p-2" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ $asset->kategori_id == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Deskripsi --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" @class(["mt-1 block w-full rounded border-gray-300 p-2 @error('deskripsi') border-red-500 @enderror"])>{{ old('deskripsi', $asset->deskripsi) }}</textarea>
                    @error('deskripsi') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $asset->lokasi) }}"
                        @class(["mt-1 block w-full rounded border-gray-300 p-2 @error('lokasi') border-red-500 @enderror"])>
                    @error('lokasi') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Unit Pengguna --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Unit Pengguna</label>
                    <input type="text" name="unit_pengguna" value="{{ old('unit_pengguna', $asset->unit_pengguna) }}"
                        @class(["mt-1 block w-full rounded border-gray-300 p-2 @error('unit_pengguna') border-red-500 @enderror"])>
                    @error('unit_pengguna') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Qty Sebelum --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Qty Sebelum</label>
                    <input id="qty_sebelum" type="number" name="qty_sebelum" value="{{ old('qty_sebelum', $asset->qty_sebelum) }}"
                        @class(["mt-1 block w-full rounded border-gray-300 p-2 @error('qty_sebelum') border-red-500 @enderror"])>
                    @error('qty_sebelum') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Qty Sesudah --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Qty Sesudah</label>
                    <input id="qty_sesudah" type="number" name="qty_sesudah" value="{{ old('qty_sesudah', $asset->qty_sesudah) }}"
                        @class(["mt-1 block w-full rounded border-gray-300 p-2 @error('qty_sesudah') border-red-500 @enderror"])>
                    @error('qty_sesudah') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Selisih (readonly auto) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Selisih</label>
                    <input id="selisih" type="number" name="selisih" value="{{ old('selisih', $asset->selisih) }}"
                        readonly class="mt-1 block w-full rounded border-gray-200 bg-gray-100 p-2">
                </div>

                {{-- Kondisi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kondisi</label>
                    <select name="kondisi" @class(["mt-1 block w-full rounded border-gray-300 p-2 @error('kondisi') border-red-500 @enderror"])>
                        @php
                        $ops = ['Baik','Rusak Ringan','Rusak Berat','Tidak Ditemukan'];
                        @endphp
                        @foreach($ops as $op)
                        <option value="{{ $op }}" {{ old('kondisi', $asset->kondisi) === $op ? 'selected' : '' }}>{{ $op }}</option>
                        @endforeach
                    </select>
                    @error('kondisi') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Catatan --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea name="catatan" rows="2" class="mt-1 block w-full rounded border-gray-300 p-2">{{ old('catatan', $asset->catatan) }}</textarea>
                    @error('catatan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Dokumentasi Lama (cekbox hapus) -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2">📸 Dokumentasi Lama</label>

                @if($asset->dokumentasi && $asset->dokumentasi->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($asset->dokumentasi as $dok)
                    <div class="border rounded overflow-hidden relative">
                        <img src="{{ asset('storage/' . $dok->file_path) }}" alt="dok-{{ $dok->id }}" class="w-full h-40 object-cover">
                        <label class="absolute top-2 right-2 bg-white/80 rounded px-2 py-1 text-xs flex items-center gap-2">
                            <input type="checkbox" name="delete_dokumentasi[]" value="{{ $dok->id }}" class="h-4 w-4">
                            <span>Hapus</span>
                        </label>
                        {{-- optional filename caption --}}
                        <div class="p-2 text-xs text-gray-600">
                            {{ \Illuminate\Support\Str::limit(basename($dok->file_path), 30) }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500 italic">Belum ada dokumentasi.</p>
                @endif
            </div>

            <!-- Upload Dokumentasi Baru -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2">📤 Tambah Dokumentasi (foto) — Bisa pilih banyak</label>
                <input id="dokumentasi_input" type="file" name="dokumentasi[]" accept="image/*" capture="environment" multiple
                    class="block w-full text-sm text-gray-700">
                <p class="text-xs text-gray-500 mt-1">Format JPG/PNG. Maks 2MB per file. (Camera akan terbuka di HP jika didukung)</p>

                {{-- preview selected --}}
                <div id="preview" class="mt-3 grid grid-cols-3 gap-3"></div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('assets.show', $asset->id) }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    {{-- Scripts: selisih kalkulasi & preview gambar --}}
    <script>
        // kalkulasi selisih
        (function() {
            const before = document.getElementById('qty_sebelum');
            const after = document.getElementById('qty_sesudah');
            const selisih = document.getElementById('selisih');

            function calc() {
                const b = parseInt(before.value || 0, 10);
                const a = parseInt(after.value || 0, 10);
                selisih.value = a - b;
            }

            if (before) before.addEventListener('input', calc);
            if (after) after.addEventListener('input', calc);
            // init
            calc();
        })();

        // preview multiple images
        (function() {
            const input = document.getElementById('dokumentasi_input');
            const preview = document.getElementById('preview');

            function toDataURL(file, cb) {
                const reader = new FileReader();
                reader.onload = e => cb(e.target.result);
                reader.readAsDataURL(file);
            }

            input && input.addEventListener('change', function(e) {
                preview.innerHTML = '';
                const files = Array.from(e.target.files || []);
                if (files.length === 0) return;

                files.forEach(file => {
                    if (!file.type.startsWith('image/')) return;
                    const wrap = document.createElement('div');
                    wrap.className = 'border rounded overflow-hidden';

                    const img = document.createElement('img');
                    img.className = 'w-full h-28 object-cover';
                    wrap.appendChild(img);

                    const caption = document.createElement('div');
                    caption.className = 'p-1 text-xs text-gray-600';
                    caption.textContent = file.name;
                    wrap.appendChild(caption);

                    preview.appendChild(wrap);

                    toDataURL(file, (dataUrl) => {
                        img.src = dataUrl;
                    });
                });
            });
        })();
    </script>
</x-app-layout>