<!DOCTYPE html>
<html>

<head>
    <title>Riwayat Data</title>
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
        <!-- Form untuk filter tanggal -->
        <form action="{{ route('riwayat', $id) }}" method="GET" class="filter-form col-md-12">
            <label for="start_date">Tanggal Mulai:</label>
            <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">
            <label for="end_date">Tanggal Akhir:</label>
            <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">
            <button type="submit">Filter</button>
            <a href="{{ route('riwayat', $id) }}" class="clear-button">Clear Filter</a>

            <div class="columns">
                <!-- Riwayat Data Masuk -->
                <div class="col-md-6">
                    <h2>Riwayat Data Masuk</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Masuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($masuk as $dataMasuk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dataMasuk->tgl_masuk }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination">
                        {{ $masuk->links('pagination::bootstrap-5') }}
                    </div>
                </div>

                <!-- Riwayat Data Keluar -->
                <div class="col-md-6">
                    <h2>Riwayat Data Keluar</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($keluar as $dataKeluar)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dataKeluar->tgl_keluar }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination">
                        {{ $keluar->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>