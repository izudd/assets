<x-app-layout>
    

    <div class="min-h-screen flex bg-slate-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-indigo-700 via-purple-700 to-pink-700 text-white shadow-xl">
            <div class="p-6 border-b border-white/20">
                <h1 class="text-2xl font-extrabold tracking-wide">ASSETS MANAGEMENT</h1>
            </div>

            <nav class="mt-3 py-4 space-y-1">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-6 py-3 bg-white/10 hover:bg-white/20 rounded-r-full transition">
                    <span>🏠</span> <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ Route::has('assets.create') ? route('assets.create') : '#' }}"
                   class="flex items-center gap-3 px-6 py-3 hover:bg-white/20 rounded-r-full transition">
                    <span>➕</span> <span class="font-medium">Input Data Aset</span>
                </a>

                <a href="{{ Route::has('assets.index') ? route('assets.index') : '#' }}"
                   class="flex items-center gap-3 px-6 py-3 hover:bg-white/20 rounded-r-full transition">
                    <span>📦</span> <span class="font-medium">Data Aset</span>
                </a>

                <a href="{{ Route::has('kategoris.index') ? route('kategoris.index') : '#' }}"
                   class="flex items-center gap-3 px-6 py-3 hover:bg-white/20 rounded-r-full transition">
                    <span>🗂️</span> <span class="font-medium">Kategori</span>
                </a>

                <a href="{{ Route::has('units.index') ? route('units.index') : '#' }}"
                   class="flex items-center gap-3 px-6 py-3 hover:bg-white/20 rounded-r-full transition">
                    <span>👥</span> <span class="font-medium">Unit Pengguna</span>
                </a>
            </nav>
        </aside>

        <!-- Main -->
        <main class="flex-1 p-8">
            <!-- Welcome -->
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

                <a href="{{ Route::has('kategoris.index') ? route('kategoris.index') : '#' }}"
                   class="block bg-pink-600 text-white p-6 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition transform">
                    <h3 class="text-xl font-semibold">🗂️ Kategori</h3>
                    <p class="text-white/90 mt-2">Kelola kategori aset agar lebih terorganisir.</p>
                </a>
            </div>
        </main>
    </div>

    <!-- Mini animation helpers -->
    <style>
        @keyframes fade-in { from {opacity:.0; transform: translateY(8px)} to {opacity:1; transform:none} }
        .animate-fade-in { animation: fade-in .6s ease-out both }
        @keyframes pulse-slow { 0%,100%{transform:scale(1)} 50%{transform:scale(1.06)} }
        .animate-pulse-slow { animation: pulse-slow 2.5s infinite }
    </style>
</x-app-layout>
