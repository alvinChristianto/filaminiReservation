<!DOCTYPE html>
<html>

<head>
    <title>kartu keluarga {{ $record1->no_kk }} </title>
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

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="" alt="Hotel Logo">
        <h1> Data kartu Keluarga</h1>

        <h2>nomor kk: {{ $record1->no_kk }}</h2>
        <p>rt : {{ $record1->rt }}</p>
        <p>rw : {{ $record1->rw }}</p>
        <p>alamat : {{ $record1->address }}</p>
        <p>kelurahan : {{ $record1->kelurahan }}</p>
        <p>kecamatan : {{ $record1->kecamatan }}</p>
        <p>kabupaten : {{ $record1->kabupaten }}</p>
        <p>provinsi : {{ $record1->provinsi }}</p>
    </div>

    <div>
        <h2>Data anggota keluarga</h2>

        <table>
            <tr>
                <th>no ktp</th>
                <th>nama</th>
                <th>rt</th>
                <th>rw</th>
            </tr>
            @foreach ($record2 as $r2)
            <tr>
                <td>{{ $r2->no_ktp }}</td>
                <td>{{ $r2->name }}</td>
                <td>{{ $r2->rt }}</td>
                <td>{{ $r2->rw }}</td>
            </tr>
            @endforeach

        </table>
    </div>

</body>

</html>