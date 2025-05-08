<!DOCTYPE html>
<html>

<head>
    <title>Email from Sawah Lope</title>
</head>

<body>
    <h2>Halo, {{ $ticket['full_name'] }}.</h2>
    <p>Berikut ini adalah kode tiket yang anda pesan:</p>
    <h1>{{ $ticket['ticket_code'] }}</h1>
    <p>Pakai kode tersebut untuk login dalam website kami.</p>
    <p>Terima Kasih!</p>
</body>

</html>
