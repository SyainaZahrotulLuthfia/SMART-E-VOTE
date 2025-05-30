@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    / Student
@endsection

@section('page')
    / Dashboard
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            @php
                $allVotesEnded = $votes->every(function ($vote) {
                    return \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($vote->end));
                });
            @endphp

            {{-- Tampilkan header hanya jika ada data --}}
            @if (!$votes->isEmpty())
                <div class="container px-3">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body text-center">
                            <h5 class="mb-2">
                                @if ($allVotesEnded)
                                    <h4 class="fw-bold mb-0">
                                        @if ($allVotesEnded)
                                            Rekapitulasi hasil pemungutan suara
                                        @else
                                        @endif
                                    </h4>
                                @else
                                    <div style="text-align: center; margin-top: 1px;">
                                        {{-- Foto pengguna --}}
                                        <img src="{{ asset('assets/images/dashboard/4.png') }}" alt="User Photo"
                                            style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">

                                        {{-- Nama dan kelas --}}
                                        <h3 class="mt-3 ">{{ Auth::user()->name }}</h3>
                                        @if (Auth::user()->classroom)
                                            <p class="badge bg-primary">Student - {{ Auth::user()->classroom->classroom }}
                                            </p>
                                        @endif

                                        {{-- Tanggal hari ini --}}
                                        <p class="text-primary">
                                            {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y H:i') }}
                                        </p>
                                    </div>
                                @endif
                            </h5>
                            {{-- <p class="text-secondary mb-0">
                                @if ($allVotesEnded)
                                    Rekapitulasi hasil pemungutan suara yang telah berakhir.
                                @else
                                    Pilih kandidat terbaik karena suara yang diberikan tidak dapat diubah.
                                @endif
                            </p> --}}
                        </div>
                    </div>

                </div>
            @endif

            {{-- Tampilkan peringatan jika tidak ada data --}}
            @if ($votes->isEmpty())
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <i data-feather="alert-circle" class="text-danger mb-2" style="width: 40px; height: 40px;"></i>
                            <h5 class="fw-bold">Belum ada sesi pemungutan suara yang tersedia</h5>
                            <p class="text-secondary">Silakan cek kembali nanti atau hubungi administrator jika ada kendala.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Loop data jika tersedia --}}
            @foreach ($votes as $item)
                @if (\Carbon\Carbon::now() > \Carbon\Carbon::parse($item->end))
                    <div class="col-xxl-3 col-md-6 col-sm-6 mb-1">
                        <div class="card shadow-sm overflow-hidden">
                            <span
                                class="position-absolute top-0 end-0 bg-gradient bg-primary text-white px-3 py-1 fw-bold shadow-sm rounded-bottom-start small">
                                <i class="bi bi-check-circle-fill me-1"></i> Kandidat Terpilih
                            </span>
                            <div class="card-body text-center p-4">
                                <h5 class="fw-bold mb-1 mt-3">
                                    <i class="bi bi-bar-chart-steps me-2"></i>{{ $item->vote_name }}
                                </h5>
                                <p class="text-muted mb-3 small">
                                    <i class="bi bi-clock-history me-1"></i>Berakhir:
                                    {{ \Carbon\Carbon::parse($item->end)->translatedFormat('d F Y H:i') }} WIB
                                </p>

                                @if ($item->winner)
                                    <div class="winner-section">
                                        <img src="{{ asset('storage/' . $item->winner->image_candidate) }}"
                                            alt="Foto Pemenang" class="rounded-circle shadow zoom-on-hover"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                        <h6 class="mt-3 fw-bold">{{ $item->winner->name_candidate }}</h6>
                                        <p class="text-secondary mb-1">
                                            <i class="bi bi-person-vcard me-1"></i> Nomor:
                                            <strong>{{ $item->winner->number_candidate }}</strong>
                                        </p>
                                        <p class="badge bg-primary fs-6 py-2 px-3 mt-2">
                                            {{ $item->winner->boxes_count }} Suara
                                        </p>


                                    </div>
                                @else
                                    <p class="fw-semibold text-danger mt-4">
                                        <i class="bi bi-x-circle me-1"></i> Belum ada data pemenang.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-xxl-3 col-md-6 col-sm-6 mb-1">
                        <div class="card shadow-sm mb-4 wow zoomIn widget-hover">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-3 text">
                                            {{ $item->vote_name }}
                                        </h5>
                                        <p class="text-muted small dark-mode-subtext mb-0">
                                            <strong>Mulai:</strong>
                                            {{ \Carbon\Carbon::parse($item->start)->translatedFormat('d F Y H:i') }} WIB
                                            <br>
                                            <strong>Berakhir:</strong>
                                            {{ \Carbon\Carbon::parse($item->end)->translatedFormat('d F Y H:i') }} WIB
                                        </p>
                                    </div>
                                    <div class="text-end">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="Gambar"
                                            class="rounded-3 shadow-sm" style="width: 120px; height: auto;">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-light text-center py-3">
                                <a class="btn btn-primary rounded-pill px-4 py-2 shadow-sm btn-hover-effect"
                                    href="{{ route('student.candidates.index', $item->id) }}">
                                    Lihat Kandidat
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
