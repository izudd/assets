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

        <form action="{{ route('assets.update', $asset->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6 bg-white p-6 rounded-lg shadow">
            @csrf
            @method('PUT')

            @php
            $inputClass = "mt-1 block w-full rounded-xl border-gray-300 shadow-sm p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500";
            $inputErrorClass = "mt-1 block w-full rounded-xl border-red-500 shadow-sm p-2 focus:ring-2 focus:ring-red-500 focus:border-red-500";
            @endphp

            <!-- Grid fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Kode Aset --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kode Aset</label>
                    <input type="text" name="kode_aset" value="{{ old('kode_aset', $asset->kode_aset) }}"
                        class="{{ $errors->has('kode_aset') ? $inputErrorClass : $inputClass }}">
                    @error('kode_aset') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="kategori" id="kategori"
                        class="{{ $errors->has('kategori') ? $inputErrorClass : $inputClass }}" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Peralatan Kantor/Teknik/LAB" {{ old('kategori', $asset->kategori ?? '') == 'Peralatan Kantor/Teknik/LAB' ? 'selected' : '' }}>Peralatan Kantor/Teknik/LAB</option>
                        <option value="Instalasi Distribusi" {{ old('kategori', $asset->kategori ?? '') == 'Instalasi Distribusi' ? 'selected' : '' }}>Instalasi Distribusi</option>
                        <option value="Instalasi Pengolahan Air">Instalasi Pengolahan Air</option>
                        <option value="IT Hardware/Software">IT Hardware/Software</option>
                        <option value="Jaringan Pipa">Jaringan Pipa</option>
                    </select>
                    @error('kategori') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Sub Kategori --}}
                <div>
                    <label for="kategori_1" class="block text-sm font-medium text-gray-700">Sub Kategori</label>
                    <select id="kategori_1" name="kategori_1" class="{{ $inputClass }}">
                        <option value="">-- Pilih Sub Kategori --</option>
                    </select>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <select id="deskripsi" name="deskripsi" class="{{ $inputClass }}">
                        <option value="">-- Pilih Deskripsi --</option>
                    </select>
                </div>

                {{-- Detail Desk --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Detail Deskripsi</label>
                    <textarea name="detail_desk" rows="3"
                        class="{{ $inputClass }}">{{ old('detail_desk', $asset->detail_desk ?? '') }}</textarea>
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $asset->lokasi) }}"
                        class="{{ $errors->has('lokasi') ? $inputErrorClass : $inputClass }}">
                    @error('lokasi') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Unit Pengguna --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Unit Pengguna</label>
                    <input type="text" name="unit_pengguna" value="{{ old('unit_pengguna', $asset->unit_pengguna) }}"
                        class="{{ $errors->has('unit_pengguna') ? $inputErrorClass : $inputClass }}">
                    @error('unit_pengguna') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Qty Sebelum --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Qty Sebelum</label>
                    <input id="qty_sebelum" type="number" name="qty_sebelum"
                        value="{{ old('qty_sebelum', $asset->qty_sebelum) }}"
                        class="{{ $errors->has('qty_sebelum') ? $inputErrorClass : $inputClass }}">
                    @error('qty_sebelum') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Qty Sesudah --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Qty Sesudah</label>
                    <input id="qty_sesudah" type="number" name="qty_sesudah"
                        value="{{ old('qty_sesudah', $asset->qty_sesudah) }}"
                        class="{{ $errors->has('qty_sesudah') ? $inputErrorClass : $inputClass }}">
                    @error('qty_sesudah') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Selisih --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Selisih</label>
                    <input id="selisih" type="number" name="selisih" value="{{ old('selisih', $asset->selisih) }}"
                        readonly class="mt-1 block w-full rounded-xl border-gray-200 bg-gray-100 p-2 shadow-sm">
                </div>

                {{-- Kondisi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kondisi</label>
                    <select name="kondisi" class="{{ $errors->has('kondisi') ? $inputErrorClass : $inputClass }}">
                        @php
                        $ops = ['Baik', 'Rusak Ringan', 'Rusak Berat', 'Tidak Ditemukan'];
                        @endphp
                        @foreach($ops as $op)
                        <option value="{{ $op }}" {{ old('kondisi', $asset->kondisi) === $op ? 'selected' : '' }}>
                            {{ $op }}
                        </option>
                        @endforeach
                    </select>
                    @error('kondisi') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Catatan --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="catatan" rows="2"
                    class="mt-1 block w-full rounded border-gray-300 p-2">{{ old('catatan', $asset->catatan) }}</textarea>
                @error('catatan') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Dokumentasi Lama (cekbox hapus) -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2">📸 Dokumentasi Lama</label>

                @if($asset->dokumentasi && $asset->dokumentasi->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($asset->dokumentasi as $dok)
                    <div class="border rounded overflow-hidden relative">
                        <img src="{{ asset('storage/' . $dok->file_path) }}" alt="dok-{{ $dok->id }}"
                            class="w-full h-40 object-cover">
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
                <p class="text-xs text-gray-500 mt-1">Format JPG/PNG. Maks 2MB per file. (Camera akan terbuka di HP jika
                    didukung)</p>

                {{-- preview selected --}}
                <div id="preview" class="mt-3 grid grid-cols-3 gap-3"></div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('assets.show', $asset->id) }}"
                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan
                    Perubahan</button>
            </div>
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
    <script>
        const subkategoriOptions = {
            "Peralatan Kantor/Teknik/LAB": [
                "Peralatan Teknik",
                "Peralatan Laboratorium",
                "Alat bantu kerja",
                "Alat Lab",
                "Alat Ukur",
                "Peralatan Quality Control",
                "Peralatan Test Bench Meter Air",
                "Peralatan Teknik",
                "Peralatan Kantor"
            ],
            "Instalasi Distribusi": [
                "Pump",
                "Motor",
                "Chemical",
                "Crane",
                "Electrical Panel",
                "Flow Meter",
                "Valve",
                "Trafo & Genset",
                "Pipa",
                "Instrumen",
                "Bangunan"
            ],
            "Instalasi Pengolahan Air": [
                "Intake Screen",
                "Chemical",
                "Pengolahan Lumpur",
                "Utilitas",
                "Pengumpul Sampah",
                "Ventury",
                "Pra-Sedimentasi",
                "Pre Treatment Air Baku",
                "Koagulasi",
                "Flokulasi",
                "Sedimentasi",
                "Filtrasi",
                "Reservoir",
                "Pompa Distribusi",
                "Chemical"
            ],
            "IT Hardware/Software": [
                "Server",
                "Storage",
                "Power",
                "Pendukung",
                "Hardware",
                "Software",
                "Network",
                "Infrastruktur"
            ],
            "Jaringan Pipa": [
                "Reinforcement",
                "Relokasi Pipa",
                "Rehabilitasi Pipa",
                "Relokasi Jembatan Pipa",
                "Rehabilitasi Jembatan Pipa",
                "Complain Handling",
                "Instalasi Chamber",
                "Install Aksesoris",
                "Penggantian aksesoris",
                "Testpit",
                "Pengecatan Panel",
                "Pengecatan Jembatan pipa"
            ]
        };

        const kategoriSelect = document.getElementById("kategori");
        const subkategoriSelect = document.getElementById("kategori_1");

        kategoriSelect.addEventListener("change", function() {
            const selected = this.value;
            subkategoriSelect.innerHTML = '<option value="">-- Pilih Sub Kategori --</option>';

            if (subkategoriOptions[selected]) {
                subkategoriOptions[selected].forEach(sub => {
                    const opt = document.createElement("option");
                    opt.value = sub;
                    opt.textContent = sub;
                    subkategoriSelect.appendChild(opt);
                });
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const subKategori = document.getElementById("kategori_1");
            const deskripsi = document.getElementById("deskripsi");

            const deskripsiOptions = {
                "Intake Screen": ["Screen", "Intake Sump pit", "Mekanik & Instrumen", "Valve"],
                "Pengumpul Sampah": ["Bangunan Pengumpul sampah", "Conveyor"],
                "Ventury": ["Bangunan Ventury", "Aquarator", "Piping System", "Motor Blower", "Online Analyzer"],
                "Pra-Sedimentasi": ["Grit Removal", "Bangunan Pra Sedimentasi", "Traveling Bridge", "Valve Pembuangan Lumpur", "Scrapper", "Hoist Crane", "fine Screen", "Pompa Submersible", "Penstock Motorized", "Perforated screen"],
                "Pre Treatment Air Baku": ["Pompa transfer", "MBBR", "Fine Screen", "Media MBBR", "Pembubuhan Karbon Aktif", "Pompa Air Baku"],
                "Koagulasi": ["Static Mixer", "Agitator", "Rotameter", "Online Analyzer", "Pompa Submersible"],
                "Flokulasi": ["Konvensional", "Accelator", "Pulsator", "Densadeg", "Online Analyzer"],
                "Sedimentasi": ["Bangunan Sedimentasi", "Sludge Scrapper", "Online Analyzer"],
                "Filtrasi": ["Filter Aquazur", "Ultra Filtration", "Reverse Osmosis", "Online Analyzer"],
                "Reservoir": ["Bangunan Reservoir", "Rumah reservoar", "Online Analyzer", "Pompa Sampling", "Penstock"],
                "Pompa Distribusi": ["Pompa Distribusi", "Piping System"],
                "Chemical": ["Koagulan", "Koagulan Aid", "Desinfektan", "Karbon Aktif"],
                "Pengolahan Lumpur": ["Decanter", "Multiple Screw Press"],
                "Utilitas": ["Utilitas"],
                "Reinforcement": ["Janringan Tertanam", "Flowmeter", "Air Valve", "Pembuatan Box Panel", "Data Logger", "PRV", "Chamber", "Wash Out", "Valve"],
                "Relokasi Pipa": ["Jaringan Tertanam", "Air Valve", "Data Logger", "Flowmeter", "PRV", "Chamber", "Wash Out"],
                "Rehabilitasi Pipa": ["Jaringan Tertanam", "Surface box/strapot", "Air Valve", "Pembuatan Box Panel", "Data Logger", "Flowmeter", "PRV", "Chamber", "Wash Out", "Valve"],
                "Relokasi Jembatan Pipa": ["Jembatan Pipa", "Konstruksi Baja", "Valve", "Wash Out", "Stratpot/Surface Box", "Air Valve", "Flowmeter", "Chamber", "Safety Rail", "Box Panel"],
                "Rehabilitasi Jembatan Pipa": ["Jembatan Pipa", "Konstruksi Baja", "Valve", "Wash Out", "Stratpot/Surface Box", "Air Valve", "Flowmeter", "Chamber", "Safety Rail", "Box Panel"],
                "Complain Handling": ["Jaringan Tertanam", "Stratpot/Surface Box", "Air Valve", "Wash Out", "Flowmeter", "PRV", "Chamber"],
                "Instalasi Chamber": ["Jaringan tertanam", "Wash Out", "Air Valve", "Pembuatan Box Panel", "Data Logger", "Flowmeter", "PRV", "Valve"],
                "Install Aksesoris": ["Jaringan tertanam", "Surface box/strapot", "Wash Out", "Air Valve", "Pembuatan Box Panel", "Flowmeter", "PRV", "Chamber"],
                "Penggantian aksesoris": ["Jaringan Tertanam", "Surface box/Strapot", "Wash Out", "Air Valve", "Pembuatan Box Panel", "Flowmeter", "PRV", "Valve", "Tutup Chamber"],
                "Testpit": ["Jaringan Tertanam", "Valve", "Surface box/Strapot", "Wash Out", "Air Valve", "Pembuatan Box Panel", "Flowmeter", "PRV", "Chamber"],
                "Pengecatan Panel": ["Box Pane"],
                "Pengecatan Jembatan Pipa": ["Jembatan Pipa", "Safety Rail", "Konstruksi Baja", "Box Panel"],
                "Pump": ["Pump Kecil", "Pump Besar"],
                "Motor": ["Motor Kecil", "Motor Besar"],
                "Chemical": ["Chlorinator", "Pompa Injeksi", "Pipa Chemical"],
                "Crane": ["Hoist Crane", "Over Head Crane"],
                "Electrical Panel": ["Panel MV", "Panel LV", "Panel Kontrol", "Panel Flow meter", "Penyalur Petir"],
                "Flow Meter": ["Flow Meter", "Display Flow Meter"],
                "Valve": ["Gate Valve", "Butterfly Valve", "Check Valve", "Air Valve", "Ball Valve", "Floating Valve", "Strainer", "Gear Box", "Aktuator Valve", "Motorize Valve"],
                "Trafo & Genset": ["Trafo", "Generator"],
                "Pipa": ["Pipa Distribusi", "Aksesoris Pipa", "Pipa Hydran"],
                "Instrumen": ["Online Analyzer", "Sensor"],
                "Bangunan": ["Gedung Kimia (Tanki)", "Gedung Office & Distribusi", "Pagar", "Pos Jaga", "Chamber", "Gedung Trafo", "Gedung Reservoir", "Gedung Ruang Panel", "Gedung Ruang Pompa", "Gedung Utilitas"],
                "Network": ["Router", "Switch", "WIFI (Acces Point)", "Firewall", "Intrusion Prevention System", "Log Management", "Acces Control", "Modem"],
                "Infrastruktur": ["Kabel Fiber Optik-Udara", "kaber Fiber Optik-Tanam", "Kabel UTP", "Environment Monitoring System", "Gedung/Ruang Data Center", "Gedung/Ruang Server"],
                "Server": ["Server"],
                "Storage": ["Controller Strorage", "Storage"],
                "Power": ["UPS"],
                "Pendukung": ["Rak Server"],
                "Hardware": ["PC", "Notebook", "PDT", "Tablet", "Smartphone", "Router", "Switch", "WIFI (Access Point)", "Firewall", "IPS", "Log Management", "Access Control", "Kabel FO", "Kabel UTP", "Gedung/Ruang Data Center", "Gedung/Ruang Data Server", "Server", "Storage", "UPS", "Controll Storage", "EMS (Environment Monitoring System)"],
                "Software": ["Lisensi", "Hak Intelektual"],
                "Peralatan Kantor": [
                    "Handphone", "Tablet", "Portable Data Terminal", "Personal Computer",
                    "Notebook", "Furniture", "Meja Rapat", "Meja kerja Direksi", "Kursi kerja Direksi",
                    "Televisi", "Mic Wireless", "Media Presentasi", "Peralatan Audio", "Printer",
                    "Kamera Digital", "Infocus", "Wall screen", "Dispenser", "Air Conditioner",
                    "Fire Alarm System", "Pemadam Kebakaran"
                ],

                "Peralatan Laboratorium": [
                    "Aquabidest Maker", "Autostill", "Compresor", "Dispensette pipet", "Exhaust Fan", "Hotplate",
                    "Kompresor", "Lampu Ultra Violet", "Mesin Reverse Osmosis", "Nanopure", "Ultrasonic Cleaner",
                    "Uninterruptible Power Supply", "Vacuum Pump", "Vortex", "Air Purifier", "Analytical Balance",
                    "Aquadestilasi", "Autoclave", "Biological Safety Cabinet", "Blower", "Cabinet Reagent",
                    "Cabinet Storage", "Comparator", "Cooler  ICP - OES", "Frezzer", "Fume Hood", "Gas", "Lemari",
                    "Magnetic Stirer", "Neraca Analitik", "Oven", "Quanti-Tray Sealer", "Referigerator", "Sentrifuse",
                    "Shaker", "SIPS", "Stavol", "Trolley", "Tabung Gas Kecil", "Vessel Gas Liquid", "Anemometer",
                    "Biochemical Oxygen Demand", "Conductivity Meter", "Dissolved Oxygen Meter", "Electronic Burette",
                    "pH Meter", "Thermometer Digital", "Thermocouple Digital", "Titrometer", "Turbiditimeter",
                    "Spectrophotometer", "Autotitrator", "Bio Safety Cabinet", "Buret Digital", "Capilary Elektroforesis",
                    "Chemical Oxygen Demand Reactor", "Chlorine Pocket Colorimeter", "Gas Chromatography",
                    "Graphite Furnace", "Incubator", "ICP - OES", "Laminar Air Flow", "Mercury Analyzer",
                    "Spektrofotometer", "TECTA", "Viscometer", "Water Bath", "Chemical Fume Hood"
                ],

                "Alat bantu kerja": [
                    "Water Sampler", "Drone Autel", "Micropipetter Eppendorf"
                ],

                "Alat Lab": [
                    "Alat Jar test", "Sand Sieve Analysis", "Prototype Sand Filter",
                    "Alat Audit Filter", "Sand Sieve Analysis", "Micropipetter Eppendorf"
                ],

                "Alat Ukur": [
                    "Flow watch & Hondex", "Meter Laser", "Pocket Colorimeter", "ESP LIGHT METER FLUKE 941",
                    "Power Analyzer", "Thermal Imager Fluke PTi120", "Industrial True RMS Multimeter",
                    "FLUKE - 376 AC/DC", "Fluke-1630-2"
                ],

                "Peralatan Quality Control": [
                    "Circometer", "UT Dual (Coating & Thickness)", "Coating Thickness for Metal",
                    "UT Cement Mortar", "Compressor", "Work Bench", "Trolly Cabinet", "Inside Micrometer",
                    "Caliper Digital", "Coating Thickness Gauge"
                ],

                "Peralatan Test Bench Meter Air": [
                    "Bejana Ukur", "Electromagnetik Flow Meter", "Alat Ukur  pengujian Meter", "Meter Air Master"
                ],

                "Peralatan Teknik": [
                    "Pompa", "Gas Detector", "Data Logger", "Alat Uji Akurasi Meter", "GPS", "Mesin Potong Rumput",
                    "Alat Ukur Debit Air", "Genset", "Senter LED", "Roll Meter", "Manometer Manual", "Pompa Listrik",
                    "Toolkit", "Tabung Karbon", "Active", "Bor Listrik", "Meter Dorong", "Lampu Sorot",
                    "Mesin Stamper/Pemadat Tanah", "Gergaji Mesin", "Compressor", "Breaker", "Air Breaker",
                    "Air Grinder", "Cutting Steel"
                ]
            };

            subKategori.addEventListener("change", function() {
                let selected = this.value;
                deskripsi.innerHTML = "<option value=''>-- Pilih Deskripsi --</option>";

                if (deskripsiOptions[selected]) {
                    deskripsiOptions[selected].forEach(item => {
                        let option = document.createElement("option");
                        option.value = item;
                        option.textContent = item;
                        deskripsi.appendChild(option);
                    });
                }
            });
        });
    </script>
</x-app-layout>