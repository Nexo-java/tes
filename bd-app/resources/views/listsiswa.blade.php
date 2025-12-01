<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    @vite('resources/css/app.css') <!-- pastikan Tailwind sudah dikonfigurasi -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 flex justify-center py-10">

    <div class="w-full max-w-4xl bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="p-6 border-b border-gray-200 bg-green-600">
            <h1 class="text-2xl font-bold text-white">Daftar Siswa</h1>
            <a href="{{ route('siswa.create') }}" class="mt-4 inline-block bg-white text-green-600 font-semibold py-2 px-4 rounded-lg shadow">Tambah Siswa</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border-b">Nama</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border-b">Kelas</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border-b">Jurusan</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border-b">Info</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($siswa as $listsiswa)
                    <tr class="hover:bg-green-50 transition">
                        <td class="px-6 py-3 text-gray-800">{{ $listsiswa->nama }}</td>
                        <td class="px-6 py-3 text-gray-800">{{ $listsiswa->kelas }}</td>
                        <td class="px-6 py-3 text-gray-800">{{ $listsiswa->jurusan }}</td>
                        <td class="px-6 py-3 text-gray-800">
                            <a href="{{ route('siswa.show', $listsiswa->id) }}">Detail</a>
                            <a href="{{ route('siswa.edit', $listsiswa->id) }}" class="ml-4 text-blue-600">Edit</a>

                            <form action="{{ route('siswa.destroy', $listsiswa->id) }}" method="POST" onsubmit="return coonfirm('Sure to Delete?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-800">delte</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
