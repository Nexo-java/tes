<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Data Pasien</h1>
    <a href="{{ route('pasien.create') }}">Tambah Data Pasien</a>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>No Pasien</th>
                <th>Nama Pasien</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
            </tr>
        </thead>

        <tbody></tbody>
            @foreach ($pasien as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->no_pasien }}</td>
                <td>{{ $p->nama_pasien }}</td>
                <td>{{ $p->jenis_kelamin }}</td>
                <td>{{ $p->alamat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
