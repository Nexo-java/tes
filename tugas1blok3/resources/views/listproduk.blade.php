<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            padding: 40px 20px;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        .header {
            padding: 24px;
            border-bottom: 1px solid #e5e7eb;
            background-color: #2563eb;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            color: white;
            margin-bottom: 16px;
        }

        .btn-tambah {
            display: inline-block;
            background-color: white;
            color: #2563eb;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-tambah:hover {
            background-color: #f9fafb;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f3f4f6;
        }

        th {
            padding: 12px 24px;
            text-align: left;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
        }

        tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: background-color 0.2s;
        }

        tbody tr:hover {
            background-color: #dbeafe;
        }

        td {
            padding: 12px 24px;
            color: #1f2937;
        }

        .action-links a {
            text-decoration: none;
            margin-right: 8px;
        }

        .link-detail {
            color: #2563eb;
        }

        .link-detail:hover {
            text-decoration: underline;
        }

        .link-edit {
            color: #16a34a;
        }

        .link-edit:hover {
            text-decoration: underline;
        }

        .btn-delete {
            background: none;
            border: none;
            color: #dc2626;
            cursor: pointer;
            font-size: 14px;
            margin-left: 8px;
        }

        .btn-delete:hover {
            text-decoration: underline;
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Daftar Produk</h1>
            <a href="{{ route('produk.create') }}" class="btn-tambah">Tambah Produk</a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($produk as $item)
                    <tr>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>Rp {{ $item->harga }}</td>
                        <td>{{ $item->stok }}</td>
                        <td class="action-links">
                            <a href="{{ route('produk.show', $item->id) }}" method="POST"class="link-detail">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
