<x-app-layout>
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Edit Kategori</h1>

        <form action="{{ route('kategoris.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label class="block mb-2">Nama Kategori</label>
            <input type="text" name="nama" value="{{ $kategori->nama }}" class="border p-2 w-full mb-4">

            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
