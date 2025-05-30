@extends('layouts.app')

@section('title')
    Results
@endsection

@section('breadcrumb')
    / Admin
@endsection

@section('page')
    / Results
@endsection

@section('content')
    <div class="container mt-4">

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h2 class="fw-bold mb-2">Hasil Perolehan Suara</h2>
                        <h6 class="text-secondary mb-0">{{ $vote->vote_name }}</h6>
                    </div>
                </div>
            </div>
        </div>




        <div class="row">
            @if ($candidates->count() && $candidates->sum('boxes_count') > 0)
                @foreach ($candidates as $candidate)
                    <div class="col-md-6 mb-4">
                        <div
                            class="card shadow-sm wow zoomIn widget-hover border
                    @if ($loop->first) border-primary border-3 @endif">
                            <div class="position-absolute top-0 start-0 m-2">
                                <span class="badge bg-light text-muted fs-7 px-2 py-1 shadow rounded-pill">
                                    No. {{ $candidate->number_candidate ?? 'N/A' }}
                                </span>
                            </div>

                            {{-- Badge pemenang jika pertama --}}
                            @if ($loop->first)
                                <span
                                    class="position-absolute top-0 end-0 bg-primary text-white px-3 py-1 fw-bold shadow-sm small"
                                    style="border-top-right-radius: 0.75rem !important; border-bottom-left-radius: 0;">
                                    <i class="bi bi-trophy-fill me-1"></i> Terpilih
                                </span>
                            @endif

                            <div class="card-body text-center">
                                <img src="{{ asset('storage/' . $candidate->image_candidate) }}"
                                    alt="Foto {{ $candidate->name_candidate }}" class="rounded-circle mb-3" width="125"
                                    height="125" style="object-fit: cover;">
                                <h6 class="fw-bold">{{ $candidate->name_candidate }}</h6>
                                <p class="text-muted">Kelas:
                                    <span class="text-secondary text-center">{{ $candidate->classroom_candidate }}</span>
                                </p>
                                <h4 class="fw-bold">{{ $candidate->boxes_count }} Suara</h4>
                            </div>
                            <div class="card-footer bg-light text-center">
                                <small class="text-muted">Status:
                                    {{ $candidate->is_active ? '🟢 Aktif' : '🔴 Tidak Aktif' }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <i data-feather="alert-circle" class="text-danger mb-2" style="width: 40px; height: 40px;"></i>
                            <h5 class="fw-bold">Belum ada Hasil yang masuk dalam daftar!</h5>
                            <p class="text-secondary">Silakan cek data perolehan suara terlebih dahulu untuk melanjutkan.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
