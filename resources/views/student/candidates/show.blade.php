@extends('layouts.app')

@section('title')
    Detail
@endsection

@section('breadcrumb')
    / Candidate
@endsection

@section('page')
    / Detail
@endsection

@section('content')
    <div class="container pt-2 pb-4" style="margin-top: -1rem;">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card h-100 card-body text-center p-4">

                    <!-- Gambar Kandidat -->
                    <img src="{{ asset('storage/' . $candidate->image_candidate) }}" alt="{{ $candidate->name_candidate }}"
                        class="img-fluid rounded-3 shadow mb-3"
                        style="height: 300px; object-fit: cover; transition: transform 0.3s ease;"
                        onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">

                    <!-- Nama Kandidat dan Nama Vote -->
                    <h3 class="fw-bold text-bold mt-3">{{ $candidate->name_candidate }}</h3>
                    <p class="text-muted mb-0">{{ $vote->vote_name }}</p>

                    <hr class="my-4">

                    <!-- Detail Info -->
                    <div class="row text-start px-3 mb-4">
                        <div class="col-md-6 mb-3 d-flex align-items-start">
                            <i data-feather="hash" class="text-bold me-2"></i>
                            <div>
                                <strong>Nomor:</strong><br>
                                <span>{{ $candidate->number_candidate }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 d-flex align-items-start">
                            <i data-feather="users" class="text-bold me-2"></i>
                            <div>
                                <strong>Kelas:</strong><br>
                                <span>{{ $candidate->classroom_candidate }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Panel Visi -->
                    <div class="card bg-light rounded-3 p-3 text-start shadow-sm mb-3">
                        <h5 class="fw-semibold text-muted d-flex align-items-center mb-2">Visi</h5>
                        <p class="text-muted mb-0" style="text-align: justify;">{{ $candidate->vision }}</p>
                    </div>

                    <!-- Panel Misi -->
                    <div class="card bg-light rounded-3 p-3 text-start shadow-sm mb-4">
                        <h5 class="fw-semibold text-muted d-flex align-items-center mb-2">Misi</h5>
                        <p class="text-muted mb-0" style="text-align: justify;">{{ $candidate->mission }}</p>
                    </div>

                    <hr class="my-4">


                    <!-- Tombol Kembali -->
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('student.candidates.index', $vote->id) }}"
                            class="btn btn-outline-primary d-flex align-items-center gap-2 btn-hover-effect px-4 py-2">
                            Kembali
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Feather Icons Initialization --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            feather.replace();
        });
    </script>
@endsection
