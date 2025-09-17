<x-app-layout>
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">👥 Tim Petugas</h1>

        {{-- Notifikasi sukses --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-200 text-green-800 rounded-lg">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Tabel Verifikator --}}
        <div class="mb-10">
            <h2 class="text-2xl font-semibold mb-3 text-blue-700">📑 Verifikator</h2>
            <table class="w-full border border-gray-300 shadow-lg rounded-lg overflow-hidden">
                <thead class="bg-blue-200">
                    <tr>
                        <th class="p-3 border">Nama</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Lokasi</th>
                        <th class="p-3 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($verifikators as $v)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border">{{ $v->nama }}</td>
                            <td class="p-3 border">{{ $v->email }}</td>
                            <td class="p-3 border">{{ $v->lokasi }}</td>
                            <td class="p-3 border space-x-2 text-center">
                                <form action="{{ route('users.destroy', $v->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                                            onclick="return confirm('Yakin mau hapus verifikator ini?')">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="p-3 text-center text-gray-500">Belum ada Verifikator</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tabel Validator --}}
        <div class="mb-10">
            <h2 class="text-2xl font-semibold mb-3 text-green-700">✅ Validator</h2>
            <table class="w-full border border-gray-300 shadow-lg rounded-lg overflow-hidden">
                <thead class="bg-green-200">
                    <tr>
                        <th class="p-3 border">Nama</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Lokasi</th>
                        <th class="p-3 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($validators as $val)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border">{{ $val->nama }}</td>
                            <td class="p-3 border">{{ $val->email }}</td>
                            <td class="p-3 border">{{ $val->lokasi }}</td>
                            <td class="p-3 border space-x-2 text-center">
                                <form action="{{ route('users.destroy', $val->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                                            onclick="return confirm('Yakin mau hapus validator ini?')">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="p-3 text-center text-gray-500">Belum ada Validator</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Tabel Guest --}}
        <div class="mb-10">
            <h2 class="text-2xl font-semibold mb-3 text-green-700">👥 Guest</h2>
            <table class="w-full border border-gray-300 shadow-lg rounded-lg overflow-hidden">
                <thead class="bg-green-200">
                    <tr>
                        <th class="p-3 border">Nama</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Lokasi</th>
                        <th class="p-3 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guests as $g)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border">{{ $g->nama }}</td>
                            <td class="p-3 border">{{ $g->email }}</td>
                            <td class="p-3 border">{{ $g->lokasi }}</td>
                            <td class="p-3 border space-x-2 text-center">
                                <form action="{{ route('users.destroy', $g->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                                            onclick="return confirm('Yakin mau hapus guest ini?')">🗑️ Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="p-3 text-center text-gray-500">Belum ada Guest</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
