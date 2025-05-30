@extends('layouts.app')

@section('title')
    Candidate
@endsection

@section('breadcrumb')
    / Student
@endsection

@section('page')
    / Candidate
@endsection

@section('content')
    <div class="container">
        {{-- Notifikasi --}}
        @if (session('error'))
            <script>
                Swal.fire({
                    title: "Terjadi kesalahan!",
                    text: "{{ session('error') }}",
                    icon: "warning"
                });
            </script>
        @endif

        @if (session('success'))
            <script>
                Swal.fire({
                    title: "Keren!",
                    text: "{{ session('success') }}",
                    icon: "success"
                });
            </script>
        @endif

        <div class="col-sm-12">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h5 class="fw-bold text">{{ $vote->vote_name }}</h5>
                </div>
            </div>

            @php
                $currentDateTime = now();
            @endphp

            {{-- Peringatan jika voting belum dimulai atau sudah berakhir --}}
            @if ($currentDateTime < $vote->start)
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <i data-feather="alert-circle" class="text-danger mb-2" style="width: 40px; height: 40px;"></i>
                        <h5 class="fw-bold">Voting belum dimulai!</h5>
                        <p class="text-secondary">Silakan cek kembali nanti atau hubungi administrator jika ada kendala.</p>
                    </div>
                </div>
            @elseif ($currentDateTime > $vote->end)
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <i data-feather="alert-circle" class="text-danger mb-2" style="width: 40px; height: 40px;"></i>
                        <h5 class="fw-bold">Voting telah berakhir!</h5>
                        <p class="text-secondary">Kamu tidak dapat memilih kandidat.</p>
                    </div>
                </div>
            @endif

            <div class="card-body">
                @if ($candidates->count() > 0)
                    <div class="row">
                        @foreach ($candidates as $item)
                            <div class="col-md-4 col-lg-4 col-sm-6 box-col-6 wow zoomIn mb-4">
                                <div class="card mobile-app-card upgrade-plan widget-hover position-relative">
                                    <div class="blog-box blog-grid text-center">
                                        <img class="img-fluid top-radius-blog"
                                            src="{{ asset('storage/' . $item->image_candidate) }}"
                                            alt="{{ $item->name_candidate }}"
                                            style="height: 325px; object-fit: cover; border-radius: .25rem;">

                                        {{-- Tombol view --}}
                                        <a href="{{ route('student.candidates.show', $item->id) }}"
                                            class="position-absolute top-0 end-0 m-2 p-2 btn-hover-effect"
                                            style="z-index: 5;">
                                            <i data-feather="chevron-down" class="text-light"
                                                style="width: 20px; height: 20px;"></i>
                                        </a>

                                        <div class="blog-details-main">
                                            <ul class="blog-social mb-2">
                                                <li class="text-secondary">No: {{ $item->number_candidate }}</li>
                                                <li class="text-secondary">Kelas: {{ $item->classroom_candidate }}</li>
                                            </ul>
                                            <hr>

                                            <h5 class="blog-bottom-details fw-bold">{{ $item->name_candidate }}</h5>

                                            <div class="px-3 mb-3">
                                                <p class="small text-truncate text-secondary" title="{{ $item->vision }}">
                                                    <strong>Visi:</strong> {{ Str::limit($item->vision, 100, '...') }}
                                                </p>
                                                <p class="small text-truncate text-secondary" title="{{ $item->mission }}">
                                                    <strong>Misi:</strong> {{ Str::limit($item->mission, 100, '...') }}
                                                </p>
                                            </div>

                                            {{-- Tombol Pilih --}}
                                            <form action="{{ route('boxes.store') }}" method="POST" class="vote-form">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                <input type="hidden" name="vote_id" value="{{ $vote->id }}">
                                                <input type="hidden" name="candidate_id" value="{{ $item->id }}">

                                                <div class="card-footer text-center border-0 pt-1">
                                                    @if ($currentDateTime >= $vote->start && $currentDateTime <= $vote->end)
                                                        <button type="submit"
                                                            class="btn btn-outline-primary w-100 py-2 btn-hover-effect rounded-pill d-flex align-items-center justify-content-center">
                                                            <i data-feather="user-plus" class="me-2"></i> Pilih
                                                        </button>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-outline-secondary w-100 py-2 rounded-pill d-flex align-items-center justify-content-center"
                                                            disabled>
                                                            <i data-feather="user-x" class="me-2"></i> Tidak Tersedia
                                                        </button>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <i data-feather="alert-circle" class="text-danger mb-2"
                                    style="width: 40px; height: 40px;"></i>
                                <h5 class="fw-bold">Data Kandidat Belum Tersedia!</h5>
                                <p class="text-secondary">Silakan cek kembali nanti atau hubungi administrator jika ada
                                    kendala.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Feather Icons & SweetAlert --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            feather.replace();

            document.querySelectorAll('.vote-form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin ingin memilih?',
                        text: "Suara yang sudah dipilih tidak dapat diubah!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, pilih!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
