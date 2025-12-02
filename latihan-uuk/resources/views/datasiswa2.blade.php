<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table>
    <tr>
        <th>Nama Siswa</th>
        <th>Kelas Siswa</th>
        <th>Jenis Kelamin</th>
        <th>aksi</th>
    </tr>

    <tr>
        @foreach($siswa as $siswa)
        <td>{{ $siswa->nama_siswa }}</td>
        <td>{{ $siswa->kelas_siswa }}</td>
        <td>{{ $siswa->jenis_kelamin }}</td>
        <td>
            <a href="{{ route('siswa.edit', $siswa->siswa_id) }}">Edit</a>
            <form action="{{ route('siswa.destroy', $siswa->siswa_id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
    </tr>


</table>
</body>
</html>
