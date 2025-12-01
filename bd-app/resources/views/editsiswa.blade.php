<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit Siswa</h1 >
    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" >
        @csrf
        @method('PUT')
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="{{ $siswa->nama }}" required ><br><br>

        <label for="kelas">Kelas:</label>
        <input type="text" id="kelas" name="kelas" value="{{ $siswa->kelas }}" required><br><br>

        <label for="jurusan">Jurusan:</label>
        <input type="text" id="jurusan" name="jurusan" value="{{ $siswa->jurusan }}" required><br><br>

        <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow">Update</button>

    </form>
</body>
</html>
