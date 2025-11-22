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
            background-color: #8B5CF6;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 30px;
            background-color: #f9f9f9;
        }
        .shipping-box {
            background-color: #EDE9FE;
            border-left: 4px solid #8B5CF6;
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
        .items-list {
            background-color: white;
            padding: 15px;
            margin: 15px 0;
        }
        .items-list ul {
            list-style: none;
            padding: 0;
        }
        .items-list li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📦 Pesanan Anda Sedang Dikirim!</h1>
    </div>

    <div class="content">
        <p>Halo <strong>{{ $order->customer_name }}</strong>,</p>
        
        <div class="shipping-box">
            <div class="icon">🚚</div>
            <p style="text-align: center; font-size: 18px; font-weight: bold; color: #8B5CF6;">
                Pesanan Anda sedang dalam perjalanan!
            </p>
        </div>

        <p>Kabar baik! Pesanan Anda telah dikemas dan sedang dalam perjalanan menuju alamat Anda.</p>

        <div class="order-info">
            <p><strong>Nomor Pesanan:</strong> {{ $order->order_number }}</p>
            <p><strong>Tanggal Pengiriman:</strong> {{ now()->format('d F Y, H:i') }}</p>
            <p><strong>Alamat Pengiriman:</strong><br>
                {{ $order->shipping_address }}<br>
                {{ $order->city }}, {{ $order->postal_code }}
            </p>
        </div>

        <h3>Produk yang Dikirim:</h3>
        <div class="items-list">
            <ul>
                @foreach($order->items as $item)
                <li>
                    <strong>{{ $item->product_name }}</strong> × {{ $item->quantity }}
                </li>
                @endforeach
            </ul>
        </div>

        <h3>Estimasi Pengiriman:</h3>
        <p>Pesanan Anda diperkirakan akan tiba dalam <strong>2-3 hari kerja</strong>.</p>

        <div class="order-info" style="background-color: #FEF3C7; border-left-color: #F59E0B;">
            <p style="margin: 0;"><strong>💡 Tips:</strong></p>
            <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                <li>Pastikan ada yang menerima paket di alamat tujuan</li>
                <li>Siapkan KTP untuk verifikasi penerima</li>
                <li>Cek kondisi paket sebelum menerima</li>
            </ul>
        </div>

        <center>
            <a href="{{ route('orders.show', $order) }}" class="button">Lacak Pesanan</a>
        </center>

        <p>Terima kasih telah berbelanja di Optik Nasionalis. Kami berharap Anda puas dengan produk kami!</p>
    </div>

    <div class="footer">
        <p>Optik Nasionalis Kacamata</p>
        <p>Jl. Panglima Sudirman 206A, Turen, Malang</p>
        <p>+62 813 3129 6965</p>
    </div>
</body>
</html>