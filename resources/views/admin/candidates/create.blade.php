@extends('layouts.app')

@section('title')
    Create
@endsection

@section('breadcrumb')
    / Candidate
@endsection

@section('page')
    / Create
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form class="" action="{{ route('candidates.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form theme-form">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <input type="hidden" name="vote_id" value="{{ $vote->id }}">
                                            <p class="form-control-plaintext">{{ $vote->vote_name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Nomor Kandidat</label>
                                            <input type="number"
                                                class="form-control @error('number_candidate') is-invalid @enderror"
                                                id="number_candidate" name="number_candidate"
                                                value="{{ old('number_candidate') }}" required placeholder="Nomor kandidat">
                                            @error('number_candidate')
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
                                            <label>Nama Kandidat</label>
                                            <input type="text"
                                                class="form-control @error('name_candidate') is-invalid @enderror"
                                                id="name_candidate" name="name_candidate"
                                                value="{{ old('name_candidate') }}" required placeholder="Nama kandidat">
                                            @error('name_candidate')
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
                                            <label>Kelas Kandidat</label>
                                            <input type="text"
                                                class="form-control @error('classroom_candidate') is-invalid @enderror"
                                                id="classroom_candidate" name="classroom_candidate"
                                                value="{{ old('classroom_candidate') }}" required
                                                placeholder="Kelas kandidat">
                                            @error('classroom_candidate')
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
                                            <label for="image_candidate" class="form-label">Gambar Kandidat</label>
                                            <input class="form-control @error('image_candidate') is-invalid @enderror"
                                                type="file" id="image_candidate" name="image_candidate"
                                                value="{{ old('image_candidate') }}" required>
                                            @error('image_candidate')
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
                                            <label>Visi</label>
                                            <input type="text" class="form-control @error('vision') is-invalid @enderror"
                                                id="vision" name="vision" value="{{ old('vision') }}" required
                                                placeholder="Visi">
                                            @error('vision')
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
                                            <label>Misi</label>
                                            <input type="text"
                                                class="form-control @error('mission') is-invalid @enderror" id="mission"
                                                name="mission" value="{{ old('mission') }}" required placeholder="Misi">
                                            @error('mission')
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
                                                type="submit">Tambah</button>
                                            <a class="btn btn-light btn-hover-effect"
                                                href="{{ route('votes.show', $vote->id) }}">Kembali</a>
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
