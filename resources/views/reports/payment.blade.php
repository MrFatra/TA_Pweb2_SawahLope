<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pembayaran</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f3f3f3;
        }

        .text-right {
            text-align: right;
        }

        .badge {
            padding: 3px 7px;
            border-radius: 4px;
            color: #fff;
            font-size: 11px;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-warning {
            background-color: #ffc107;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .badge-info {
            background-color: #17a2b8;
        }
    </style>
</head>

<body>
    <h1>Laporan Pembayaran</h1>

    <table>
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Nama Pemesan</th>
                <th>Tipe Pembayaran</th>
                <th>Jumlah</th>
                <th>Metode</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $payment)
                <tr>
                    <td>{{ $payment->order_id }}</td>
                    <td>{{ $payment->full_name }}</td>
                    <td>
                        @if ($payment->payable_type === \App\Models\Ticket::class)
                            <span class="badge badge-success">Tiket</span>
                        @elseif ($payment->payable_type === \App\Models\Reservation::class)
                            <span class="badge badge-info">Reservasi</span>
                        @else
                            <span class="badge badge-danger">Tidak Diketahui</span>
                        @endif
                    </td>
                    <td class="text-right">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>
                        @php
                            $statusClass =
                                [
                                    'pending' => 'badge-warning',
                                    'paid' => 'badge-success',
                                    'failed' => 'badge-danger',
                                ][$payment->status] ?? 'badge-info';
                            $statusText =
                                [
                                    'pending' => 'Menunggu',
                                    'paid' => 'Dibayar',
                                    'failed' => 'Dibatalkan',
                                ][$payment->status] ?? 'Tidak Diketahui';
                        @endphp
                        <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><em>Dicetak pada: {{ now()->format('d/m/Y H:i') }}</em></p>
</body>

</html>
