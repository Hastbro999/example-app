<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <link rel='stylesheet' href="/css/style.css">
    <title>Absensi</title>
    </head>

<body onload="getLocation()">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="">Absensi</a>

            @can('admin')
            <a class="navbar-brand" href="/admin">Admin</a>
            @endcan
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/">Halaman</a></li>
                            <li>
                                <hr class="dropdown-divider">

                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="px-4 py-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72"
            height="57">
        <div class="col-lg-6 mx-auto">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session()->get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <button type="button" class="btn btn-primary btn-lg px-4 gap-3 mb-3">Riwayat</button>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <form class="myForm" action="/masuk" method="post">
                    @csrf
                    <input type="hidden" value="" name="latitude">
                    <input type="hidden" value="{{ auth()->user()->id }}" name="id_user">
                    <input type="hidden" value="{{ date('Y-m-d H:i') }}" name="tgl">
                    <input type="hidden" value="" name="longitude">
                    <button class="btn btn-primary btn-lg px-4 gap-3" id="masuk" type="submit">Masuk</button>
                </form>
                <form class="myForm2" action="/keluar" method="post">
                    @csrf
                    <input type="hidden" value="" name="latitude2">
                    <input type="hidden" value="{{ auth()->user()->id }}" name="id_user">
                    <input type="hidden" value="{{ date('Y-m-d H:i') }}" name="tgl">
                    <input type="hidden" value="" name="longitude2">
                    <button class="btn btn-primary btn-lg px-4 gap-3" id="keluar" type="submit">Keluar</button>
                </form>
                <script type="text/javascript">
                    function getLocation() {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(showPosition);
                        }
                    }

                    function showPosition(position) {
                        document.querySelector('.myForm input[name="latitude"]').value = position.coords.latitude;
                        document.querySelector('.myForm input[name="longitude"]').value = position.coords.longitude;
                        document.querySelector('.myForm2 input[name="latitude2"]').value = position.coords.latitude;
                        document.querySelector('.myForm2 input[name="longitude2"]').value = position.coords.longitude;
                        document.getElementById('coordinates').src =
                            `https://www.google.com/maps?q=${position.coords.latitude},${position.coords.longitude}&hl=es;z=14&output=embed`;
                    }
                </script>
                <div style="position: absolute; top:360px">
                    <iframe id="coordinates" width="400px" height="300px"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
