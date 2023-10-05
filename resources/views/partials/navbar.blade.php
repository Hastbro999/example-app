 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">


 <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
     <div class="container">
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav">
                 @if (request()->is('dashboard'))
                     <a class="navbar-brand" href="">Absensi</a>
                     @can('admin')
                         <a class="navbar-brand" href="/admin">Admin</a>
                         <a class="navbar-brand" href="/allRiwayat">Riwayat Pegawai</a>
                     @endcan
                 @elseif (request()->is('/') || request()->is('about') || request()->is('login') || request()->is('register'))
                     <li class="nav-item">
                         <a class="nav-link {{ $title === 'Halaman' ? 'active' : '' }}" href="/">Halaman</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ $title === 'Tentang' ? 'active' : '' }}" href="/about">Tentang</a>
                     </li>
                 @else
                     <a class="navbar-brand bi bi-arrow-left" href="/dashboard">Kembali</a>
                 @endif

             </ul>
             <ul class="navbar-nav ms-auto">
                 @auth
                     <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle" href="/#" id="navbarDropdown" role="button"
                             data-bs-toggle="dropdown" aria-expanded="false">
                             Welcome, {{ auth()->user()->name }}
                         </a>
                         <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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
                     <ul class="navbar-nav ms-auto">
                         <li class="nav-item">
                             <a class="nav-link" href="/login"><i class="bi bi-box-arrow-in-right"></i> Masuk</a>
                         </li>
                     </ul>
                 @endauth
             </ul>
         </div>
     </div>
 </nav>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
 </script>
