@extends('layouts.app')

@section('title')
    Edit
@endsection

@section('breadcrumb')
    / Candidate
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
                        <form class="resposive" action="{{ route('candidates.update', $candidate->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form theme-form">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <input type="hidden" name="vote_id" value="{{ $candidate->vote_id }}">
                                            <p class="form-control-plaintext">
                                                {{ $candidate->vote->vote_name }}
                                            </p>
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
                                                value="{{ $candidate->number_candidate }}" required
                                                placeholder="Tambah nama kandidat">
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
                                                value="{{ $candidate->name_candidate }}" required
                                                placeholder="Tambah data nama">
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
                                                value="{{ $candidate->classroom_candidate }}" required
                                                placeholder="Tambah data kelas">
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
                                                type="file" id="image_candidate" name="image_candidate">

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
                                                id="vision" name="vision" value="{{ $candidate->vision }}" required
                                                placeholder="Tambah data visi">
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
                                                name="mission" value="{{ $candidate->mission }}" required
                                                placeholder="Tambah data misi">
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
                                                type="submit">Simpan</button>
                                            <a class="btn btn-light btn-hover-effect"
                                                href="{{ route('votes.show', $candidate->vote_id) }}">Kembali</a>
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
