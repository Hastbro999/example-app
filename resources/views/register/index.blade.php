@extends('layouts.main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@section('master')
<div class="row justify-content-center">
    <div class="col-md-4">
        <h1 class="h3 mb-3 fw-normal">Form Daftar</h1>

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <main class="form-registration">
            <form action="/register" method="POST" autocomplete="off">
                @csrf
                <div class="form-floating mb-1">
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="form-control @error('name') is-invalid
                        @enderror" id="name"
                           placeholder="Nama">
                    <label for="name">Nama</label>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-1">
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid
                        @enderror" id="email"
                           placeholder="name@example.com">
                    <label for="email">Email</label>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-1">
                    <input type="password" name="password" style="margin-bottom: 10px"
                           class="form-control @error('password') is-invalid
                        @enderror"
                           id="password" placeholder="Password">
                    <i id="togglePassword" class="far fa-eye" style="position: absolute; top:22px; right:30px"></i>
                    <label for="password">Password</label>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button class="btn btn-primary w-100 py-2 mb-1" type="submit">Daftar</button>
                <small class="d-block text-center mt-3">Sudah punya akun? <a href="/login">Masuk</a></small>
                <p class="mt-5 mb-3 text-body-secondary">&copy; 2023</p>
            </form>
        </main>
    </div>
</div>
<script>
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('togglePassword');

    togglePasswordButton.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePasswordButton.classList.remove('fa-eye');
            togglePasswordButton.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            togglePasswordButton.classList.remove('fa-eye-slash');
            togglePasswordButton.classList.add('fa-eye');
        }
    });
</script>
@endsection
