<x-app-layout>
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Daftar Unit Pengguna</h1>

        <a href="{{ route('units.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Tambah Unit</a>

        <table class="w-full mt-4 border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Nama Unit</th>
                    <th class="px-4 py-2">Penanggung Jawab</th>
                    <th class="px-4 py-2">Keterangan</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($units as $unit)
                <tr>
                    <td class="border px-4 py-2">{{ $unit->nama_unit }}</td>
                    <td class="border px-4 py-2">{{ $unit->penanggung_jawab }}</td>
                    <td class="border px-4 py-2">{{ $unit->keterangan }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('units.show', $unit->id) }}" class="text-blue-600">🔍</a>
                        <a href="{{ route('units.edit', $unit->id) }}" class="text-yellow-600">✏️</a>
                        <form action="{{ route('units.destroy', $unit->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="text-red-600">🗑️</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
