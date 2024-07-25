<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel='stylesheet' href="/css/style.css">
    <title>Absensi</title>
</head>

<body onload="getLocation()">
@include('partials.navbar')

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
        <a href="/riwayat/{{ auth()->user()->id }}">
            <button type="button"
                    class="btn btn-primary btn-lg px-4 gap-3 mb-3">Riwayat
            </button>
        </a>
        <div class="d-grid gap-2 justify-content-center">
            <div class="d-flex" style="margin: auto">
                <form class="myForm" action="/masuk" method="post">
                    @csrf
                    <input type="hidden" value="" name="latitude">
                    <input type="hidden" value="{{ auth()->user()->name }}" name="name">
                    <input type="hidden" value="{{ auth()->user()->id }}" name="id_user">
                    <input type="hidden" value="{{ date('Y-m-d') }}" name="tgl">
                    <input type="hidden" value="" name="longitude">
                    <button class="btn btn-primary btn-lg px-4 gap-3" id="masuk" type="submit">Masuk</button>
                </form>
                &nbsp;
                <form class="myForm2" action="/keluar" method="post">
                    @csrf
                    <input type="hidden" value="" name="latitude2">
                    <input type="hidden" value="{{ auth()->user()->name }}" name="name">
                    <input type="hidden" value="{{ auth()->user()->id }}" name="id_user">
                    <input type="hidden" value="{{ date('Y-m-d') }}" name="tgl">
                    <input type="hidden" value="" name="longitude2">
                    <button class="btn btn-primary btn-lg px-4 gap-3" id="keluar" type="submit">Keluar</button>
                </form>
            </div>
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
            <div class="iframe-container">
                <iframe id="coordinates" allowfullscreen frameborder="0" width="100%" height="100%"></iframe>
            </div>
        </div>
    </div>
</div>
</body>

</html>
