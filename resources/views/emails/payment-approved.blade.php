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
            background-color: #10B981;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 30px;
            background-color: #f9f9f9;
        }
        .success-box {
            background-color: #D1FAE5;
            border-left: 4px solid #10B981;
            padding: 20px;
            margin: 20px 0;
        }
        .order-info {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #70574D;
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
        .icon {
            font-size: 48px;
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>✓ Pembayaran Dikonfirmasi!</h1>
    </div>

    <div class="content">
        <p>Halo <strong>{{ $order->customer_name }}</strong>,</p>
        
        <div class="success-box">
            <div class="icon">✅</div>
            <p style="text-align: center; font-size: 18px; font-weight: bold; color: #10B981;">
                Pembayaran Anda telah berhasil dikonfirmasi!
            </p>
        </div>

        <p>Kami telah menerima dan memverifikasi pembayaran Anda. Pesanan Anda akan segera diproses.</p>

        <div class="order-info">
            <p><strong>Nomor Pesanan:</strong> {{ $order->order_number }}</p>
            <p><strong>Tanggal Pembayaran:</strong> {{ $order->paid_at?->format('d F Y, H:i') ?? now()->format('d F Y, H:i') }}</p>
            <p><strong>Total Pembayaran:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
            <p><strong>Status Pesanan:</strong> {{ ucfirst($order->status) }}</p>
        </div>

        <h3>Langkah Selanjutnya:</h3>
        <ul>
            <li>Pesanan Anda sedang dikemas oleh tim kami</li>
            <li>Anda akan menerima email notifikasi saat pesanan dikirim</li>
            <li>Nomor resi pengiriman akan diberikan setelah pesanan dikirim</li>
        </ul>

        <center>
            <a href="{{ route('orders.show', $order) }}" class="button">Lacak Pesanan</a>
        </center>

        <p>Terima kasih atas kepercayaan Anda berbelanja di Optik Nasionalis!</p>
    </div>

    <div class="footer">
        <p>Optik Nasionalis Kacamata</p>
        <p>Jl. Panglima Sudirman 206A, Turen, Malang</p>
        <p>+62 813 3129 6965</p>
    </div>
</body>
</html>