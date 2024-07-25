@extends('layouts.main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@section('master')
<div class="row justify-content-center">
    <div class="col-md-4">
        <h1 class="h3 mb-3 fw-normal">Edit</h1>

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <main class="form-edit">
            <form action="{{ route('admin.update', $value->id) }}" enctype="multipart/form-data" autocomplete="off"
                  method="POST">
                @csrf
                @method('PUT')
                <div class="form-floating mb-1">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                           placeholder="Nama" value="{{ old('name', $value->name) }}">
                    <label for="name">Nama</label>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-1">
                    <input type="email" name="email" class="form-control" id="email"
                           value="{{ old('email', $value->email) }}" disabled>
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-1">
                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                           id="alamat" placeholder="Alamat" value="{{ old('alamat', $value->alamat) }}">
                    <label for="alamat">Alamat</label>
                    @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-1">
                    <label for="job" class="form-label">Jobdesk</label>
                    <select id="job" class="form-select @error('job') is-invalid @enderror" name="job">
                        <option value="" disabled selected hidden>{{ $value->job ?? 'Select Job' }}</option>
                        <option value="Kuli" {{ (old(
                        'job', $value->job) == 'Kuli') ? 'selected' : '' }}>Kuli</option>
                        <option value="Mandor" {{ (old(
                        'job', $value->job) == 'Mandor') ? 'selected' : '' }}>Mandor</option>
                        <option value="Pengawas" {{ (old(
                        'job', $value->job) == 'Pengawas') ? 'selected' : '' }}>Pengawas</option>
                    </select>
                    @error('job')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button class="btn btn-primary w-100 py-2 mb-1" type="submit">Simpan</button>
            </form>
        </main>
    </div>
</div>
@endsection
