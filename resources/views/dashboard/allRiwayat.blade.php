<!DOCTYPE html>
<html>

<head>
    <title>Riwayat Data Semua Pegawai</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="/css/pagination.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .column {
            background-color: #fff;
            border-radius: 8px;
            margin: 20px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            text-align: left;
            padding: 8px 16px;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        @media screen and (min-width: 768px) {

            /* Apply responsive styles for screens wider than 768px */
            .container {
                flex-direction: row;
                justify-content: space-between;
                align-items: flex-start;
            }

            .column {
                width: 48%;
            }
        }
    </style>
</head>

<body>
@include('partials.navbar')

<div class="container">
    <div class="column">
        <h2>Riwayat Data Masuk</h2>
        <table>
            <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Masuk</th>
                <th>Latidute & Longitude</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($getDataMasuk as $dataMasuk)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $dataMasuk->name_user }}</td>
                <td>{{ $dataMasuk->tgl_masuk }}</td>
                <td>{{ $dataMasuk->latitude }} & {{ $dataMasuk->longitude }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="column">
        <h2>Riwayat Data Keluar</h2>
        <table>
            <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Keluar</th>
                <th>Latidute & Longitude</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($getDataKeluar as $dataKeluar)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $dataKeluar->name_user }}</td>
                <td>{{ $dataKeluar->tgl_keluar }}</td>
                <td>{{ $dataKeluar->latitude_keluar }} & {{ $dataKeluar->longitude_keluar }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-center">
    {{ $getDataMasuk->links('pagination::bootstrap-5') }}
</div>
</body>

</html>
