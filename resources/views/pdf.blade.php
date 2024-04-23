<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #e6e6e6;
            border-radius: 5px;
        }

        .info p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .total-row {
            font-weight: bold;
        }

        .thank-you {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #e6e6e6;
            border-radius: 5px;
        }

        .thank-you h3 {
            color: #009688;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 style="color: #009688;">Struk Pembelian</h1>
        </div>
        <div class="info">
            <p><strong>Tanggal:</strong> {{ date('Y-m-d H:i:s') }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <!-- resources/views/pdf_template.blade.php -->


                @if ($detailPenjualan && $detailPenjualan->isNotEmpty())
                @foreach ($detailPenjualan as $index => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->produk ? $item->produk->nama : 'Nama Produk Tidak Tersedia' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->product ? $item->product->price : 'Harga Produk Tidak Tersedia' }}</td>
                        <td>{{ $item->subtotal }}</td>
                    </tr>
                @endforeach
            
                @else
                    <tr>
                        <td colspan="5">Data penjualan tidak valid.</td>
                    </tr>
                @endif









                <tr class="total-row">
                    <td colspan="4" style="text-align: right;">Total Harga:</td>
                    <td>Rp {{ isset($totalHarga) ? number_format($totalHarga) : '0' }}</td>
                </tr>
            </tbody>
        </table>
        <div class="thank-you">
            {{-- @if ($user)
                <h3>Terima kasih atas pembeliannya, {{ $user->nama }}!</h3>
            @else
                <h3>Terima kasih atas pembeliannya!</h3>
            @endif --}}
        </div>
    </div>
</body>

</html>
