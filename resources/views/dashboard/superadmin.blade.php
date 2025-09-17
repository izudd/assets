<x-app-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 p-8">
        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-700 mb-3 animate__animated animate__fadeInDown">
                🌟 Super Admin Dashboard
            </h1>
            <p class="text-gray-600 text-lg animate__animated animate__fadeIn animate__delay-1s">
                Selamat datang, silakan pilih menu untuk mengelola aplikasi
            </p>
        </div>

        {{-- Tombol Navigasi --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-5xl mb-12">
            {{-- Tombol Tim Petugas --}}
            <a href="{{ route('teams.index') }}"
               class="transform transition duration-300 hover:scale-105 bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center text-center animate__animated animate__zoomIn">
                <div class="text-5xl mb-3">👥</div>
                <h2 class="font-bold text-xl text-indigo-600">Kelola Tim</h2>
                <p class="text-gray-500 text-sm mt-2">Atur Verifikator & Validator</p>
            </a>

            {{-- Tombol Users --}}
            <a href="{{ route('users.index') }}"
               class="transform transition duration-300 hover:scale-105 bg-white shadow-lg rounded-2xl p-6 flex flex-col items-center text-center animate__animated animate__zoomIn animate__delay-1s">
                <div class="text-5xl mb-3">🧑‍💻</div>
                <h2 class="font-bold text-xl text-indigo-600">Kelola User</h2>
                <p class="text-gray-500 text-sm mt-2">Tambah, edit, atau hapus user</p>
            </a>

            {{-- Tombol Masuk Dashboard --}}
            <a href="{{ url('/dashboard') }}"
               class="transform transition duration-300 hover:scale-105 bg-gradient-to-r from-indigo-500 to-blue-500 shadow-lg rounded-2xl p-6 flex flex-col items-center text-center text-white animate__animated animate__zoomIn animate__delay-2s">
                <div class="text-5xl mb-3">📊</div>
                <h2 class="font-bold text-xl">Masuk Dashboard</h2>
                <p class="text-sm mt-2">Lihat data & statistik</p>
            </a>
        </div>

        {{-- Realtime Activity Log --}}
            <div class="p-6 bg-white shadow rounded-xl animate__animated animate__fadeInUp animate__delay-1s">
                <h2 class="text-xl font-bold mb-4">⚡ Realtime Activity Log</h2>
                <div id="activity-log" class="space-y-2 text-sm text-gray-700">
                    <!-- data activity bakal muncul di sini -->
                </div>
            </div>
        </div>
    </div>

    {{-- Animate.css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // chart.js disini ...
    </script>

    {{-- Activity Log --}}
    <script>
        function loadActivity() {
            fetch("{{ route('activity.logs') }}")
                .then(res => res.json())
                .then(data => {
                    let html = '';
                    data.forEach(log => {
                        html += `<div class="p-2 border-b">${log.role} (${log.user_id}) - ${log.activity} at ${log.created_at}</div>`;
                    });
                    document.getElementById('activity-log').innerHTML = html;
                });
        }
        setInterval(loadActivity, 5000); // refresh tiap 5 detik
        loadActivity();
    </script>
</x-app-layout>
