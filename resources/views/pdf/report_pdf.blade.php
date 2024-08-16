<!DOCTYPE html>
<html>

<head>
    <title>Pengajuan {{ $record->id }} - {{ $record->judul_pengajuan }}</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
        }

        .customer-info {
            margin-top: 10px;
        }

        .room-details {
            margin-top: 10px;
        }

        .room-table {
            border-collapse: collapse;
            width: 100%;
        }

        .room-table th,
        .room-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .summary {
            margin-top: 10px;
        }

        .footer {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="" alt="Hotel Logo">
        <h1> Pengajuan The Cabin Hotel</h1>

        <h2>STATUS: {{ $record->status_pengajuan }}</h2>
        <p>dibuat pada : {{ $record->created_at }}</p>
        <p>id pengajuan : {{ $record->id }}</p>
    </div>

    <div>
        <h2>Data Pengaju</h2>
        <p>Nama : {{ $record->user_id }} ( {{ $record->nama_divisi }} )</p>
    </div>
    <div class="customer-info">
        <h2>Data Detail Pengajuan</h2>
        <p>Item pengajuan : {{ $record->judul_pengajuan }} </p>
        <p>Nominal : {{ $record->nominal }} </p>
        <p>RAB / Non RAB : {{ $record->nama_bank }} </p>
    </div>
    <div class="room-details">
        <table class="room-table">
            <tr>
                <th>No Cabin</th>
                <th>Jenis Cabin</th>
                <th>Jml Org</th>
                <th>Harga/Cabin</th>
            </tr>
            <tr>
                <td>0221</td>
                <td>Big Private</td>
                <td>2</td>
                <td>Rp. 195.000</td>
            </tr>
        </table>
    </div>
    <div class="summary">
        <p>Subtotal: Rp. 195.000</p>
        <p>Diskon: Rp. 0</p>
        <p>DP & Extra: Rp. 0</p>
        <p>Total Pembayaran: Rp. 195.000</p>
    </div>
    <div class="footer">
        <p>Pernyataan saya menyatakan</p>
        <ol>
            <li>Tidak membawa atau mengkonsumsi narkoba dan turunannya</li>
            <li>Tidak merokok di dalam kamar, jika ketahuan merokok bersedia membayar denda sebesar Rp.500.000</li>
        </ol>
        <p>Kasir</p>
        <p>Front Office an Delvira</p>
        <p>Tamu</p>
        <p>Mr TEST praptono</p>
    </div>
</body>

</html>