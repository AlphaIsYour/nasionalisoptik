<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #70574D;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 30px;
            background-color: #f9f9f9;
        }
        .order-info {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #70574D;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .items-table th, .items-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .items-table th {
            background-color: #70574D;
            color: white;
        }
        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #70574D;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #70574D;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Terima Kasih atas Pesanan Anda!</h1>
    </div>

    <div class="content">
        <p>Halo <strong>{{ $order->customer_name }}</strong>,</p>
        
        <p>Pesanan Anda telah berhasil dibuat. Berikut adalah detail pesanan Anda:</p>

        <div class="order-info">
            <p><strong>Nomor Pesanan:</strong> {{ $order->order_number }}</p>
            <p><strong>Tanggal:</strong> {{ $order->created_at->format('d F Y, H:i') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        </div>

        <h3>Detail Pesanan:</h3>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            Total: Rp {{ number_format($order->total, 0, ',', '.') }}
        </div>

        @if($order->payment_method === 'bank_transfer')
        <div class="order-info">
            <h4>Instruksi Pembayaran:</h4>
            <p><strong>Bank BCA</strong></p>
            <p>No. Rekening: <strong>1234567890</strong></p>
            <p>Atas Nama: <strong>Optik Nasionalis</strong></p>
            <p style="margin-top: 10px;">Setelah melakukan transfer, silakan upload bukti pembayaran melalui halaman pesanan Anda.</p>
        </div>
        @endif

        <center>
            <a href="{{ route('orders.show', $order) }}" class="button">Lihat Pesanan</a>
        </center>

        <p>Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.</p>
        
        <p>Terima kasih telah berbelanja di Optik Nasionalis!</p>
    </div>

    <div class="footer">
        <p>Optik Nasionalis Kacamata</p>
        <p>Jl. Panglima Sudirman 206A, Turen, Malang</p>
        <p>+62 813 3129 6965</p>
    </div>
</body>
</html>