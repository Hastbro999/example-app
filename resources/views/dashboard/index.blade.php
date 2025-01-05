<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href="/css/style.css">
    <title>Absensi</title>

    <!-- Leaflet.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Leaflet.js JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        #map {
            height: 500px;
            right: -50%;
            left: -50%;
            width: 200%;
        }
    </style>
</head>

<!-- Masukan latitude dan location untuk titik lokasi jika ingin default lokasi dihapus lati dan long-->
<body onload="getLocation(-7.871586114722994, 110.42632987165258)">
    @include('partials.navbar')

    <div class="px-4 py-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://i.ibb.co.com/jv3mP5h/pupr.jpg" alt="Error" width="72" height="57">
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
                <button type="button" class="btn btn-primary btn-lg px-4 gap-3 mb-3">Riwayat</button>
            </a>
            <div class="d-grid gap-2 justify-content-center">
                <div class="d-flex" style="margin: auto">
                    <form class="myForm" action="/masuk" method="post" onsubmit="disableButton('masuk'); return validateDistance();">
                        @csrf
                        <input type="hidden" value="" name="latitude">
                        <input type="hidden" value="{{ auth()->user()->name }}" name="name">
                        <input type="hidden" value="{{ auth()->user()->id }}" name="id_user">
                        <input type="hidden" value="{{ date('Y-m-d') }}" name="tgl">
                        <input type="hidden" value="" name="longitude">
                        <button class="btn btn-primary btn-lg px-4 gap-3" id="masuk" type="submit">Masuk</button>
                    </form>
                    &nbsp;
                    <form class="myForm2" action="/keluar" method="post" onsubmit="disableButton('keluar'); return validateDistance();">
                        @csrf
                        <input type="hidden" value="" name="latitude2">
                        <input type="hidden" value="{{ auth()->user()->name }}" name="name">
                        <input type="hidden" value="{{ auth()->user()->id }}" name="id_user">
                        <input type="hidden" value="{{ date('Y-m-d') }}" name="tgl">
                        <input type="hidden" value="" name="longitude2">
                        <button class="btn btn-primary btn-lg px-4 gap-3" id="keluar" type="submit">Keluar</button>
                    </form>
                </div>

                <div id="map"></div>

                <script type="text/javascript">
                    function disableButton(buttonId) {
                        const button = document.getElementById(buttonId);
                        // Untuk disable button masuk 
                        button.disabled = false;
                    }


                    // PENTING UNTUK MERUBAH LOKASI KANTOR
                    const officeLocation = {
                        lat: -7.71904, // Merubah lokasi kantor latitude
                        lng: 110.26894 // Merubah lokasi kantor longitude
                    };

                    function getLocation(customLat, customLng) {
                        if (customLat !== undefined && customLng !== undefined) {
                            showPosition({
                                coords: {
                                    latitude: customLat,
                                    longitude: customLng
                                }
                            });
                        } else if (navigator.geolocation) {
                            // Jika tidak, gunakan geolocation
                            navigator.geolocation.getCurrentPosition(showPosition);
                        } else {
                            alert("Geolocation is not supported by this browser.");
                        }
                    }

                    // PENTING UNTUK MEMBUAT RADIUS KANTOR
                    function showPosition(position) {
                        var lat = position.coords.latitude;
                        var lng = position.coords.longitude;

                        document.querySelector('.myForm input[name="latitude"]').value = lat;
                        document.querySelector('.myForm input[name="longitude"]').value = lng;
                        document.querySelector('.myForm2 input[name="latitude2"]').value = lat;
                        document.querySelector('.myForm2 input[name="longitude2"]').value = lng;

                        // Initialize the map and set view to user's location
                        var map = L.map('map').setView([lat, lng], 15);

                        // Add OpenStreetMap tiles
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        // Add a marker at the user's location
                        var marker = L.marker([lat, lng]).addTo(map);

                        // Merubah radius kantor (angka 200 diubah sesuai dengan kebutuhan)
                        var circle = L.circle(officeLocation, {
                            color: 'blue',
                            fillColor: '#30f',
                            fillOpacity: 0.5,
                            radius: 200
                        }).addTo(map);

                        // Bind popup to marker
                        marker.bindPopup("You are here.").openPopup();
                    }


                    // PENTING UNTUK VALIDASI JARAK DAN MENAMPILKAN PESAN ERROR
                    function validateDistance() {
                        var userLat = parseFloat(document.querySelector('.myForm input[name="latitude"]').value || document.querySelector('.myForm2 input[name="latitude2"]').value);
                        var userLng = parseFloat(document.querySelector('.myForm input[name="longitude"]').value || document.querySelector('.myForm2 input[name="longitude2"]').value);

                        var distance = calculateDistance(officeLocation.lat, officeLocation.lng, userLat, userLng);

                        if (distance > 200) { // angka 200 disamakan dengan radius kantor
                            alert("Anda berada di luar radius yang diizinkan. Silakan mendekat ke kantor.");
                            return false;
                        }

                        return true;
                    }

                    // PENTING!!!
                    function calculateDistance(lat1, lng1, lat2, lng2) {
                        const R = 6371e3; // Jari-jari bumi dalam meter

                        // Mengkonversi derajat ke radian
                        const φ1 = lat1 * Math.PI / 180;
                        const φ2 = lat2 * Math.PI / 180;
                        const Δφ = (lat2 - lat1) * Math.PI / 180;
                        const Δλ = (lng2 - lng1) * Math.PI / 180;

                        // Haversine formula
                        const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                            Math.cos(φ1) * Math.cos(φ2) *
                            Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
                        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

                        // Menghitung jarak
                        const distance = R * c; // Jarak dalam meter

                        return distance;
                    }
                </script>
            </div>
        </div>
    </div>
</body>

</html>