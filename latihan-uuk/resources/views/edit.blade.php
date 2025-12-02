<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Edit Data Siswa</h1>

        <form action="{{ route('siswa.update', $siswa->siswa_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_siswa" class="block text-gray-700 mb-2">Nama Siswa</label>
                <input type="text" name="nama_siswa" id="nama_siswa" value="{{ $siswa->nama_siswa }}" class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="kelas_siswa" class="block text-gray-700 mb-2">Kelas</label>
                <input type="text" name="kelas_siswa" id="kelas_siswa" value="{{ $siswa->kelas_siswa }}" class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-gray-700 mb-2">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="w-full px-3 py-2 border rounded" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="laki-laki" {{ $siswa->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="perempuan" {{ $siswa->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>            <div class="flex gap-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                <a href="{{ route('siswa.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
