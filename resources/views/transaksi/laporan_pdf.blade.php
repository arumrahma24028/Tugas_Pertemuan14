<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th {
            background: #eeeeee;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
        }

        .total {
            margin-top: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h2>Laporan Transaksi Perpustakaan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>

        <tbody>
            @foreach($transaksis as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->kode_transaksi }}</td>
                    <td>{{ $t->anggota->nama }}</td>
                    <td>{{ $t->buku->judul }}</td>
                    <td>{{ $t->status }}</td>
                    <td>Rp {{ number_format($t->denda, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">
        Total Transaksi: {{ $transaksis->count() }}
    </p>

    <p class="total">
        Total Denda: Rp {{ number_format($totalDenda, 0, ',', '.') }}
    </p>

</body>
</html>