<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bukti Pembayaran - Sawah Lope</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
        }

        h2 {
            color: #2f855a;
        }

        .code {
            font-size: 1.5rem;
            font-weight: bold;
            background-color: #e6fffa;
            padding: 10px;
            border-left: 5px solid #38a169;
            margin: 20px 0;
        }

        .footer {
            font-size: 0.9rem;
            color: #777;
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Halo, {{ $reservation['full_name'] }}!</h2>

        <p>Terima kasih telah melakukan reservasi di <strong>Sawah Lope</strong>.</p>

        <p>Berikut adalah detail bukti pembayaran Anda:</p>

        <div class="code">
            Kode Tiket: {{ $ticketCode }}
        </div>

        <ul>
            <li><strong>Tanggal Kunjungan:</strong> {{ \Carbon\Carbon::parse($reservation['visit_date'])->format('d M Y') }}</li>
            <li><strong>Jumlah Tamu:</strong> {{ $reservation['guest_count'] }} orang</li>
            <li><strong>Metode Pembayaran:</strong> {{ ucfirst($payment['payment_method'] ?? '-') }}</li>
            <li><strong>Total Dibayar:</strong> Rp {{ number_format($payment['amount'] ?? 0, 0, ',', '.') }}</li>
            <li><strong>ID Pembayaran:</strong> {{ $payment['order_id'] ?? '-' }}</li>
        </ul>

        <p>Silakan gunakan kode tiket di atas untuk validasi saat kedatangan.</p>

        <p class="footer">Sawah Lope &copy; {{ now()->year }}<br>Terima kasih telah mempercayai kami!</p>
    </div>
</body>

</html>
