# Work Report

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .note {
            width: 100%;
            border: 1px solid #000;
            padding: 10px;
            margin: 5px;
        }

        .signature {
            width: 100%;
            border-collapse: collapse;
            padding-top: 40px;
            margin-bottom: 2px;
            text-align: center;

        }
    </style>
</head>

<body>

    <h1>Work Report</h1>
    <h2>{{ $record1->judul_pekerjaan }}</h2>
    <p>Mulai Pekerjaan : {{ $record1->jam_mulai }}</p>
    <p>Selesai Pekerjaan : {{ $record1->jam_selesai }}</p>

    <div class="container">
        <div class="note">
            <h3>problem</h3>
            <p>{{ $record1->deskripsi_masalah }}</p>
            <a href="http://127.0.0.1:8000/storage/{{ $record1->image_sebelum_pekerjaan}}">Link Gambar</a>
        </div>
        <div class="note">
            <h3>progress</h3>
            <p>{{ $record1->deskripsi_progress }}</p>
            <a href="http://127.0.0.1:8000/storage/{{ $record1->image_progress_pekerjaan}}">Link Gambar</a>
        </div>
        <div class="note">
            <h3>final finish</h3>
            <p>{{ $record1->deskripsi_penyelesaian }}</p>
            <a href="http://127.0.0.1:8000/storage/{{ $record1->image_setelah_pekerjaan}}">Link Gambar</a>
        </div>
    </div>

    <table class="signature">
        <tr>
            <td class="signatures">
                <p>____________________</p>
                <p>Worker</p>
            </td>
            <td class="signatures">
                <p>____________________</p>
                <p>Supervisor</p>
            </td>
        </tr>
    </table>

</body>

</html>