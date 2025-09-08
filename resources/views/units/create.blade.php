<x-app-layout>
    <div class="p-6 max-w-3xl mx-auto">

        <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Unit Pengguna</h1>

        <!-- Alert sukses -->
        @if(session('success'))
            <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-800 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('units.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="nama_unit" class="block text-sm font-medium text-gray-700 mb-1">Nama Unit</label>
                    <input type="text" name="nama_unit" id="nama_unit" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2" required>
                    @error('nama_unit')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="penanggung_jawab" class="block text-sm font-medium text-gray-700 mb-1">Penanggung Jawab</label>
                    <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2" required>
                    @error('penanggung_jawab')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2"></textarea>
                    @error('keterangan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('units.index') }}" class="text-gray-600 hover:underline">← Kembali</a>
                    <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Simpan Unit</button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
