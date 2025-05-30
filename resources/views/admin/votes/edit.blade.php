@extends('layouts.app')

@section('title')
    Edit
@endsection

@section('breadcrumb')
    / Vote
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
                            <h4 class="mb-1">Halaman Edit Data Vote</h4>
                            <small class="text-muted d-block">Form Wajib di Isi</small>
                        </div> --}}
                        <form class="resposive" action="{{ route('votes.update', $vote->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form theme-form">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label>Nama Pemilihan</label>
                                            <input type="text"
                                                class="form-control @error('vote_name') is-invalid @enderror" id="vote_name"
                                                name="vote_name" value="{{ $vote->vote_name }}" required
                                                placeholder="Nama pemilihan">
                                            @error('vote_name')
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
                                            <label for="image" class="form-label">Gambar Pemilihan</label>
                                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                                id="image" name="image">
                                            @error('image')
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
                                            <label>Mulai</label>
                                            <input type="datetime-local"
                                                class="form-control @error('start') is-invalid @enderror" id="start"
                                                name="start" value="{{ $vote->start }}" required placeholder="Mulai">
                                            @error('start')
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
                                            <label>Berakhir</label>
                                            <input type="datetime-local"
                                                class="form-control @error('end') is-invalid @enderror" id="end"
                                                name="end" value="{{ $vote->end }}" required placeholder="Berakhir">
                                            @error('end')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="text-end">
                                        <button class="btn btn-primary m-1 btn-hover-effect" type="submit">Simpan</button>
                                        <a class="btn btn-light btn-hover-effect"
                                            href="{{ route('votes.index') }}">Kembali</a>
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
