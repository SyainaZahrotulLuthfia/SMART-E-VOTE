@extends('layouts.app')

@section('title')
    Edit
@endsection

@section('breadcrumb')
    / Student
@endsection

@section('page')
    / Edit
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <div class="mb-3">
                            <h4 class="mb-1">Halaman Edit Data Siswa</h4>
                            <small class="text-muted d-block">Form Wajib di Isi</small>
                        </div> --}}
                        <form class="resposive" action="{{ route('users.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form theme-form">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Nisn</label>
                                            <input type="hidden" name="classroom_id" value="{{ $user->classroom_id }}">
                                            <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                                id="nisn" name="nisn" value="{{ $user->nisn }}" required
                                                placeholder="Nisn">
                                            @error('nisn')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Nama Siswa</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ $user->name }}" required
                                                placeholder="Nama siswa">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ $user->email }}" required
                                                placeholder="Email">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Password</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" id="password"
                                                name="password" value="{{ $user->password }}" required
                                                placeholder="Password">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="text-end">
                                            <button class="btn btn-primary m-1 btn-hover-effect"
                                                type="submit">Simpan</button>
                                            <a class="btn btn-light btn-hover-effect"
                                                href="{{ route('classrooms.show', $classroom_id) }}">Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
