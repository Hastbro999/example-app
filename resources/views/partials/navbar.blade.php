<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Add Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <!-- Navbar Brand (Logo) -->
            <a class="navbar-brand" href="/">Absensi</a>

            <!-- Hamburger Menu Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links (Collapsible) -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Conditional Links -->
                    @if (request()->is('dashboard'))
                        @can('admin')
                            <li class="nav-item">
                                <a class="nav-link" href="/admin">Admin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/allRiwayat">Riwayat Pegawai</a>
                            </li>
                        @endcan
                    @elseif (request()->is('/') || request()->is('about') || request()->is('login') || request()->is('register'))
                        <li class="nav-item">
                            <a class="nav-link {{ $title === 'Halaman' ? 'active' : '' }}" href="/">Halaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $title === 'Tentang' ? 'active' : '' }}" href="/about">Tentang</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link bi bi-arrow-left" href="/dashboard">Kembali</a>
                        </li>
                    @endif
                </ul>
                <!-- User Dropdown (Right Aligned) -->
                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Welcome, {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- Conditional Links -->
                                @if (request()->is('dashboard'))
                                    <li><a class="dropdown-item" href="/">Halaman</a></li>
                                @else
                                    <li><a class="dropdown-item" href="/dashboard">Absensi</a></li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login"><i class="bi bi-box-arrow-in-right"></i> Masuk</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Your page content goes here -->

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
