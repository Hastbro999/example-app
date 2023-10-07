<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<link rel='stylesheet' href="/css/pagination.css">

<head>
    <title>Riwayat Data Semua Pegawai</title>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getDataMasuk as $dataMasuk)
                        <tr style="border-bottom: 1px solid #252525">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dataMasuk->name_user }}</td>
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
                        {{-- <th>No</th> --}}
                        <th>Nama</th>
                        <th>Tanggal Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getDataKeluar as $dataKeluar)
                        <tr style="border-bottom: 1px solid #252525">
                            {{-- <td>{{ $loop->iteration }}</td> --}}
                            <td>{{ $dataKeluar->name_user }}</td>
                            <td>{{ $dataKeluar->tgl_keluar }}</td>
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
