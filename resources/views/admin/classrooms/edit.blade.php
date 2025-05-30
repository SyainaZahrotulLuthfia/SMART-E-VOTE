@extends('layouts.app')

@section('title')
    Edit
@endsection

@section('breadcrumb')
    / Classroom
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
                        <form class="resposive" action="{{ route('classrooms.update', $classroom->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form theme-form">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nama Kelas</label>
                                            <input type="text"
                                                class="form-control @error('classroom') is-invalid @enderror" id="classroom"
                                                name="classroom" value="{{ $classroom->classroom }}" required
                                                placeholder="Nama kelas">
                                            @error('classroom')
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
                                                href="{{ route('classrooms.index') }}">Kembali</a>
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
