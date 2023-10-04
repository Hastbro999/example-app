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
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid
                        @enderror" id="name"
                            placeholder="Nama" value="{{ $value->name }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-1">
                        <input type="email" name="email"
                            class="form-control @error('email') is-invalid
                        @enderror" id="email"
                            placeholder="name@example.com" value="{{ $value->email }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-1">
                        <input type="text" name="alamat"
                            class="form-control @error('alamat') is-invalid
                        @enderror"
                            id="alamat" value="{{ $value->alamat }}">
                    </div>
                    <div class="form-floating mb-1">
                        <label for="job" class="form-label"></label>
                        <select id="job" class="form-select pt-2" name="job">
                            @if ($value->job == null)
                                <option selected hidden>Jobdesk</option>
                            @else
                                <option selected hidden value="{{ $value->job }}">{{ $value->job }}</option>
                            @endif
                            <option value="Kuli">Kuli</option>
                            <option value="a">a</option>
                            <option value="s">s</option>
                            <option value="d">d</option>
                        </select>
                    </div>
                    <button class="btn btn-primary w-100 py-2 mb-1" type="submit">Simpan</button>
                </form>
            </main>
        </div>
    </div>
@endsection
