<x-app-layout>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-6">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-8">
        {{-- Judul --}}
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
            Form <span class="text-blue-600">Guest</span>
        </h2>

        {{-- Alert sukses --}}
        @if(session('success'))
            <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('guest.store') }}" class="space-y-5">
            @csrf

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama"
                       class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                       required>
            </div>

            {{-- Role --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <input type="text" name="role" value="guest" readonly
                       class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 shadow-sm text-gray-500 sm:text-sm">
            </div>

            {{-- Lokasi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="lokasi"
                       class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                       required>
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email"
                       class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                       required>
            </div>

            {{-- Tombol --}}
            <button type="submit"
                    class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition">
                Masuk Dashboard
            </button>
        </form>
    </div>
</div>
</x-app-layout>
