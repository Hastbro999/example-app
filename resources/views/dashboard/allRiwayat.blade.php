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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .filter-form {
            text-align: center;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .filter-form label {
            margin-right: 10px;
            font-weight: bold;
        }

        .filter-form input {
            padding: 8px;
            margin-right: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .filter-form button {
            padding: 5px 15px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 10px;
        }

        .filter-form button:hover {
            background-color: #555;
        }

        .clear-button {
            padding: 8px 15px;
            background-color: #ccc;
            color: #333;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }

        .clear-button:hover {
            background-color: #bbb;
        }

        .columns {
            display: flex;
            gap: 20px;
        }

        .column {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            flex: 1;
        }

        .column h2 {
            margin-top: 0;
            font-size: 20px;
            margin-bottom: 15px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            text-align: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    @include('partials.navbar')

    <div class="container">
        <!-- Filter Form -->
        <form class="filter-form col-md-12" method="GET" action="{{ url('/allRiwayat') }}">
            <label for="start_date">Tanggal Mulai:</label>
            <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">
            <label for="end_date">Tanggal Akhir:</label>
            <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">
            <label for="search">Cari Nama:</label>
            <input type="text" id="search" name="search" placeholder="Nama Pegawai" value="{{ request('search') }}">
            <button type="submit">Filter</button>
            <a href="{{ url('/allRiwayat') }}" class="clear-button">Clear Filter</a>

            <div class="columns">

                <div class="col-md-6">
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

                <div class="col-md-6" style="margin-left: -20px;border-left: white solid;">
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
        </form>
    </div>

    <div class="d-flex justify-content-center">
        {{ $getDataMasuk->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
    </div>
</body>

</html>