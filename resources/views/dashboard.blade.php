<x-app-layout>
    <div x-data="{ open: false }" class="min-h-screen flex bg-slate-100">
        <!-- Sidebar -->
        <aside
            :class="open ? 'translate-x-0' : '-translate-x-full sm:translate-x-0'"
            class="fixed inset-y-0 left-0 w-64 bg-gradient-to-b from-indigo-700 via-purple-700 to-pink-700 
                   text-white shadow-xl transform transition-transform duration-300 ease-in-out z-50">
            <div class="p-6 border-b border-white/20 flex items-center justify-between">
                <h1 class="text-2xl font-extrabold tracking-wide">ASSETS MANAGEMENT</h1>
                <!-- Close button (mobile) -->
                <button @click="open = false" class="sm:hidden text-white text-2xl">&times;</button>
            </div>

            <nav class="mt-3 py-4 space-y-1">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-6 py-3 bg-white/10 hover:bg-white/20 rounded-r-full transition">
                    🏠 <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ Route::has('assets.create') ? route('assets.create') : '#' }}"
                    class="flex items-center gap-3 px-6 py-3 hover:bg-white/20 rounded-r-full transition">
                    ➕ <span class="font-medium">Input Data Aset</span>
                </a>

                <a href="{{ Route::has('assets.index') ? route('assets.index') : '#' }}"
                    class="flex items-center gap-3 px-6 py-3 hover:bg-white/20 rounded-r-full transition">
                    📦 <span class="font-medium">Data Aset</span>
                </a>

                <a href="{{ route('assets.filter') }}"
                    class="flex items-center gap-3 px-6 py-3 hover:bg-white/20 rounded-r-full transition">
                    🗂️ <span class="font-medium">Laporan Aset</span>
                </a>

                <a href="{{ Route::has('units.index') ? route('units.index') : '#' }}"
                    class="flex items-center gap-3 px-6 py-3 hover:bg-white/20 rounded-r-full transition">
                    👥 <span class="font-medium">Unit</span>
                </a>
            </nav>
        </aside>

        <!-- Overlay (mobile only) -->
        <div
            x-show="open"
            @click="open = false"
            class="fixed inset-0 bg-black/50 z-40 sm:hidden"
            x-transition.opacity>
        </div>

        <!-- Main -->
        <main class="flex-1 sm:ml-64">
            <!-- Top Navbar (mobile only) -->
            <div class="bg-white shadow px-4 py-3 flex justify-between items-center sm:hidden">
                <button @click="open = !open" class="text-indigo-600 text-2xl">☰</button>
                <span class="font-bold text-slate-700">Dashboard</span>
            </div>

            <!-- Welcome -->
            <div class="p-8">
                <div class="bg-white rounded-2xl shadow-lg p-7 animate-fade-in">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-indigo-600 text-white grid place-items-center animate-pulse-slow">👋</div>
                        <h2 class="text-2xl md:text-3xl font-bold text-slate-800">
                            Selamat Datang, <span class="text-indigo-600">{{ Auth::user()->name }}</span>
                        </h2>
                    </div>
                    <p class="mt-2 text-slate-600 text-lg">
                        Kelola data aset perusahaan dengan mudah melalui dashboard ini.
                    </p>
                </div>

                <!-- Quick actions -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <a href="{{ Route::has('assets.create') ? route('assets.create') : '#' }}"
                        class="block bg-indigo-600 text-white p-6 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition transform">
                        <h3 class="text-xl font-semibold">➕ Input Data Aset</h3>
                        <p class="text-white/90 mt-2">Tambahkan data aset baru ke sistem inventaris.</p>
                    </a>

                    <a href="{{ Route::has('assets.index') ? route('assets.index') : '#' }}"
                        class="block bg-purple-600 text-white p-6 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition transform">
                        <h3 class="text-xl font-semibold">📦 Data Aset</h3>
                        <p class="text-white/90 mt-2">Lihat, edit, dan kelola semua aset yang ada.</p>
                    </a>

                    <a href="{{ route('assets.filter') }}"
                        class="block bg-pink-600 text-white p-6 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition transform">
                        <h3 class="text-xl font-semibold">🗂️ Laporan Aset </h3>
                        <p class="text-white/90 mt-2">Lihat data laporan aset berdasarkan filter tertentu.</p>
                    </a>

                    <!-- Tim Petugas (baru) -->
                    <a href="{{ route('teams.index') }}" 
                        class="block bg-green-500 text-white p-6 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition transform">
                        <h3 class="text-lg font-bold">👥 Tim Petugas</h3>
                        <p class="text-white/90 mt-2">Kelola Verifikator, Validator, dan Guest.</p>
                    </a>
                </div>
            </div>
        </main>
    </div>

    <!-- Animations -->
    <style>
        @keyframes fade-in {
            from {
                opacity: .0;
                transform: translateY(8px)
            }

            to {
                opacity: 1;
                transform: none
            }
        }

        .animate-fade-in {
            animation: fade-in .6s ease-out both
        }

        @keyframes pulse-slow {

            0%,
            100% {
                transform: scale(1)
            }

            50% {
                transform: scale(1.06)
            }
        }

        .animate-pulse-slow {
            animation: pulse-slow 2.5s infinite
        }
    </style>
</x-app-layout>