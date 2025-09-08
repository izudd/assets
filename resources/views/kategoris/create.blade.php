<x-app-layout>
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Tambah Kategori</h1>

        <form action="{{ route('kategoris.store') }}" method="POST">
            @csrf
            <label class="block mb-2">Nama Kategori</label>
            <input type="text" name="nama" class="border p-2 w-full mb-4">

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
