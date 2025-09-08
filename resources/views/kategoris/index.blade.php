<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">📂 Daftar Kategori</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($kategoris as $kategori)
                <a href="{{ route('kategoris.show', $kategori->id) }}"
                   class="p-4 border rounded shadow hover:bg-blue-50 transition">
                    <h2 class="text-lg font-semibold">{{ $kategori->nama }}</h2>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
