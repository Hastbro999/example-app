<!DOCTYPE html>
<html>
<link rel='stylesheet' href="/css/pagination.css">


<head>
    <title>Riwayat Data</title>
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
                        <th>Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($masuk as $dataMasuk)
                        <tr style="border-bottom: 1px solid #252525">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dataMasuk->tgl_masuk }}</td>
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
                        <th>Tanggal Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($keluar as $dataKeluar)
                        <tr style="border-bottom: 1px solid #252525">
                            <td>{{ $dataKeluar->tgl_keluar }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="container">
        {{ $masuk->links('pagination::bootstrap-5') }}
    </div>
</body>

</html>
