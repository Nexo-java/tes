<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <h1>Input Siswa</h1 >
    <form action="{{ route('siswa.store') }}" method="POST" >
        @csrf
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama siswa..." required ><br><br>

        <label for="kelas">Kelas:</label>
        <input type="text" id="kelas" name="kelas" placeholder="Masukkan kelas siswa..." required><br><br>

        <label for="jurusan">Jurusan:</label>
        <input type="text" id="jurusan" name="jurusan" placeholder="Masukkan jurusan siswa..." required><br><br>

        <button type="submit" class="bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow">Submit</button>

    </form>

</body>
</html>
