<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Detail Data Siswa</h1>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nama Siswa</label>
            <p class="px-3 py-2 bg-gray-50 border rounded">{{ $siswa->nama_siswa }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Kelas</label>
            <p class="px-3 py-2 bg-gray-50 border rounded">{{ $siswa->kelas_siswa }}</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Jenis Kelamin</label>
            <p class="px-3 py-2 bg-gray-50 border rounded">{{ $siswa->jenis_kelamin }}</p>
        </div>        <a href="{{ route('siswa.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
    </div>
</body>
</html>
