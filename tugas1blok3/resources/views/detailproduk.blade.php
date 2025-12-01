<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
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
            max-width: 800px;
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
        }

        .content {
            padding: 32px;
        }

        .detail-row {
            display: flex;
            padding: 16px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .label {
            width: 200px;
            font-weight: 600;
            color: #374151;
        }

        .value {
            flex: 1;
            color: #1f2937;
        }

        .actions {
            padding: 24px;
            border-top: 1px solid #e5e7eb;
            background-color: #f9fafb;
            display: flex;
            gap: 12px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-back {
            background-color: #6b7280;
            color: white;
        }

        .btn-back:hover {
            background-color: #4b5563;
        }

        .btn-edit {
            background-color: #16a34a;
            color: white;
        }

        .btn-edit:hover {
            background-color: #15803d;
        }

        .btn-delete {
            background-color: #dc2626;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-delete:hover {
            background-color: #b91c1c;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Detail Produk</h1>
        </div>

        <div class="content">
            <div class="detail-row">
                <div class="label">Nama Produk:</div>
                <div class="value">{{ $produk->nama_produk }}</div>
            </div>

            <div class="detail-row">
                <div class="label">Deskripsi:</div>
                <div class="value">{{ $produk->deskripsi ?? '-' }}</div>
            </div>

            <div class="detail-row">
                <div class="label">Harga:</div>
                <div class="value">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
            </div>

            <div class="detail-row">
                <div class="label">Stok:</div>
                <div class="value">{{ $produk->stok }}</div>
            </div>

            <div class="detail-row">
                <div class="label">Dibuat pada:</div>
                <div class="value">{{ $produk->created_at->format('d/m/Y H:i') }}</div>
            </div>

            <div class="detail-row">
                <div class="label">Terakhir diupdate:</div>
                <div class="value">{{ $produk->updated_at->format('d/m/Y H:i') }}</div>
            </div>
        </div>


            </form>
        </div>
    </div>

</body>
</html>
