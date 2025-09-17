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

                @php
                $inputClass = "mt-1 w-full rounded-xl border-gray-300 shadow-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500";
                @endphp

                <!-- Grid Form -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Kode Aset -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kode Aset</label>
                        <input type="text" name="kode_aset" class="{{ $inputClass }}">
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="kategori" id="kategori" class="{{ $inputClass }}" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Peralatan Kantor/Teknik/LAB" {{ old('kategori', $asset->kategori ?? '') == 'Peralatan Kantor/Teknik/LAB' ? 'selected' : '' }}>Peralatan Kantor/Teknik/LAB</option>
                            <option value="Instalasi Distribusi" {{ old('kategori', $asset->kategori ?? '') == 'Instalasi Distribusi' ? 'selected' : '' }}>Instalasi Distribusi</option>
                            <option value="Instalasi Pengolahan Air">Instalasi Pengolahan Air</option>
                            <option value="IT Hardware/Software">IT Hardware/Software</option>
                            <option value="Jaringan Pipa">Jaringan Pipa</option>
                        </select>
                    </div>

                    <!-- Sub Kategori -->
                    <div>
                        <label for="kategori_1" class="block text-sm font-medium text-gray-700">Sub Kategori</label>
                        <select id="kategori_1" name="kategori_1" class="{{ $inputClass }}" required>
                            <option value="">-- Pilih Sub Kategori --</option>
                        </select>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <select id="deskripsi" name="deskripsi"
                            class="{{ $inputClass }}">
                            <option value="">-- Pilih Deskripsi --</option>
                        </select>
                    </div>

                    <!-- Detail Desk -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Detail Deskripsi</label>
                        <textarea name="detail_desk" rows="3" class="{{ $inputClass }}">{{ old('detail_desk', $asset->detail_desk ?? '') }}</textarea>
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                        <input type="text" name="lokasi" class="{{ $inputClass }}">
                    </div>

                    <!-- Unit Pengguna -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Unit Pengguna</label>
                        <input type="text" name="unit_pengguna" class="{{ $inputClass }}">
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
                        <option value="Tidak Ditemukan">Tidak Ditemukan</option>
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