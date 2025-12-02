<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Data Siswa</h1>
            <a href="{{ route('siswa.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Tambah Siswa</a>
        </div>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Kelas</th>
                    <th class="border border-gray-300 px-4 py-2">Jenis Kelamin</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswa as $index => $s)
                <tr>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $s->nama_siswa }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $s->kelas_siswa }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $s->jenis_kelamin }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <div class="flex gap-2 justify-center">
                            <a href="{{ route('siswa.show', $s->siswa_id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Show</a>
                            <a href="{{ route('siswa.edit', $s->siswa_id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('siswa.destroy', $s->siswa_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
