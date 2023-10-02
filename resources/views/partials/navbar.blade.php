<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $title === 'Halaman' ? 'active' : '' }}" href="/">Halaman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $title === 'Tentang' ? 'active' : '' }}" href="/about">Tentang</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/dashboard">Absensi</a></li>
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
                            <a class="nav-link {{ $title === 'Masuk' ? 'active' : '' }}" href="/login"><i
                                    class="bi bi-box-arrow-in-right"></i> Masuk</a>
                        </li>
                    </ul>
                @endauth
            </ul>
        </div>
    </div>
</nav>
