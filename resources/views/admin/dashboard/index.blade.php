@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    / Admin
@endsection

@section('page')
    / Dahboard
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row size-column">
            <div class="col-xxl-10 col-md-12 box-col-8 grid-ed-12 ">
                <div class="row">
                    <div class="col-xxl-5 col-md-7 box-col-7 ">
                        <div class="row">
                            <div class="col-sm-12 col-ed-none wow fadeIn">
                                <div class="card o-hidden welcome-card widget-hover position-relative">
                                    <div class="card-body" style="background: linear-gradient(135deg, #3B82F6, #9333EA);">
                                        <h4 class="mb-3 mt-1 f-w-500 mb-0 f-22">Halo, {{ Auth::user()->name }} <span> <img
                                                    src="../assets/images/dashboard-7/hand.png" alt="hand vector"
                                                    style="width: 25px; height: 25px;"></span></h4>
                                        <p>SMART E-Vote dirancang khusus bagi admin
                                            dalam mengelola proses pemilihan secara efisien dan aman.</p>

                                    </div><img class="welcome-img" src="../assets/images/dashboard-3/widget.svg"
                                        alt="search image">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card small-widget">
                                    <div class="card-body primary"> <span class="f-light">Total Kelas</span>
                                        <div class="d-flex align-items-end gap-1">
                                            <h4>
                                                @isset($countClassrooms)
                                                    <h4>{{ $countClassrooms }}</h4>
                                                @else
                                                    <h4>Data tidak ada</h4>
                                                @endisset
                                            </h4>
                                            {{-- <span class="font-primary f-12 f-w-500"><i
                                                    class="icon-arrow-up"></i><span></span>
                                            </span> --}}
                                        </div>
                                        <a href="{{ route('classrooms.index') }}">
                                            <div class="bg-gradient" style="cursor: pointer;">
                                                <svg class="stroke-icon svg-fill">
                                                    <use href="{{ asset('assets/svg/icon-sprite.svg#new-order') }}"></use>
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card small-widget">
                                    <div class="card-body warning"><span class="f-light">Kategori Pemilihan</span>
                                        <div class="d-flex align-items-end gap-1">
                                            <h4>
                                                @isset($countVotes)
                                                    <h4>{{ $countVotes }}</h4>
                                                @else
                                                    <h4>Data tidak ada</h4>
                                                @endisset
                                            </h4>
                                            {{-- <span class="font-warning f-12 f-w-500"><i
                                                    class="icon-arrow-up"></i><span></span></span> --}}
                                        </div>
                                        <a href="{{ route('votes.index') }}">
                                            <div class="bg-gradient">
                                                <svg class="stroke-icon svg-fill">
                                                    <use href="../assets/svg/icon-sprite.svg#fill-others"></use>
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card small-widget">
                                    <div class="card-body secondary"><span class="f-light">Total Kandidat</span>
                                        <div class="d-flex align-items-end gap-1">
                                            <h4>
                                                @isset($countCandidates)
                                                    <h4>{{ $countCandidates }}</h4>
                                                @else
                                                    <h4>Data tidak ada</h4>
                                                @endisset
                                            </h4>
                                            {{-- <span class="font-secondary f-12 f-w-500"><i
                                                    class="icon-arrow-up"></i><span></span></span> --}}
                                        </div>
                                        <a href="{{ route('votes.index') }}">
                                            <div class="bg-gradient">
                                                <svg class="stroke-icon svg-fill">
                                                    <use href="../assets/svg/icon-sprite.svg#stroke-blog"></use>
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card small-widget">
                                    <div class="card-body success"><span class="f-light">Total Siswa</span>
                                        <div class="d-flex align-items-end gap-1">
                                            <h4>
                                                @isset($countStudents)
                                                    <h4>{{ $countStudents }}</h4>
                                                @else
                                                    <h4>Data tidak ada</h4>
                                                @endisset
                                            </h4>
                                            {{-- <span class="font-success f-12 f-w-500"><i
                                                    class="icon-arrow-up"></i><span></span></span> --}}
                                        </div>
                                        <a href="{{ route('classrooms.index') }}">
                                            <div class="bg-gradient">
                                                <svg class="stroke-icon svg-fill">
                                                    <use href="../assets/svg/icon-sprite.svg#customers"></use>
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-5 col-sm-6 box-col-5">
                        <div class="card widget-hover position-relative">
                            <div class="card-header card-no-border">
                                <div class="header-top d-flex justify-content-between align-items-center">
                                    <h5 class="m-0">Kandidat Teratas</h5>
                                    <a href="{{ route('votes.index') }}" class="btn btn-link p-0">View All</a>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <ul class="list-unstyled mb-0">
                                    @forelse ($topCandidates as $candidate)
                                        <li class="d-flex align-items-center mb-3">
                                            <img src="{{ asset('storage/' . $candidate->image_candidate) }}"
                                                alt="{{ $candidate->name_candidate }}" class="rounded-circle me-3"
                                                style="width: 50px; height: 50px; object-fit: cover;">

                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 fw-bold d-flex align-items-center" style="font-size: 15px;">
                                                    <span class="me-2" style="font-weight: 600;">
                                                        {{ $candidate->number_candidate }}.
                                                    </span>
                                                    <span class="candidate-name-truncate"
                                                        style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px; display: inline-block;">
                                                        {{ $candidate->name_candidate }}
                                                    </span>
                                                </h6>

                                                <style>
                                                    @media (max-width: 767px) {
                                                        .candidate-name-truncate {
                                                            white-space: normal !important;
                                                            overflow: visible !important;
                                                            text-overflow: unset !important;
                                                            max-width: 100% !important;
                                                        }
                                                    }
                                                </style>

                                                <h6 class="mt-1 text-secondary" style="font-size: 11px;">
                                                    {{ $candidate->vote->vote_name }}</h6>
                                                <span class="text-muted">{{ $candidate->boxes_count }} Suara</span>

                                                <div class="progress mt-1" style="height: 6px;">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: {{ $maxVotes > 0 ? ($candidate->boxes_count / $maxVotes) * 100 : 0 }}%;"
                                                        aria-valuenow="{{ $candidate->boxes_count }}" aria-valuemin="0"
                                                        aria-valuemax="{{ $maxVotes }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="text-center text-muted py-3">Belum ada kandidat yang masuk dalam daftar.
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="card course-box">
                    <div class="card-body">
                        <div class="course-widget">
                            <div class="course-icon">
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#course-1"></use>
                                </svg>
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $countVotedStudents }}</h4>
                                <span class="f-light">Siswa sudah melakukan voting</span>
                                <a class="btn btn-light f-light" href="{{ route('votes.index') }}">
                                    View All
                                    <span class="ms-2">
                                        <svg class="fill-icon f-light">
                                            <use href="../assets/svg/icon-sprite.svg#arrowright"></use>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card course-box">
                    <div class="card-body">
                        <div class="course-widget">
                            <div class="course-icon">
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#course-2"></use>
                                </svg>
                            </div>
                            <div>
                                <h4 class="mb-0">{{ $countNotVotedStudents }}</h4>
                                <span class="f-light">Siswa belum melakukan voting</span>
                                <a class="btn btn-light f-light" href="{{ route('votes.index') }}">
                                    View All
                                    <span class="ms-2">
                                        <svg class="fill-icon f-light">
                                            <use href="../assets/svg/icon-sprite.svg#arrowright"></use>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-md-8 col-sm-12 notification box-col-7">
                <div class="card height-equal widget-hover position-relative">
                    <div class="card-header card-no-border">
                        <div class="header-top d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Upcoming Pemilihan</h5>
                            <div class="card-header-right-icon">
                                <a href="{{ route('votes.index') }}" class="btn btn-link p-0">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        @if ($upcomingVotes->isEmpty())
                            <p class="text-muted">Tidak ada pemilihan yang akan datang.</p>
                        @else
                            <ul class="list-unstyled">
                                @foreach ($upcomingVotes as $vote)
                                    <li class="d-flex mb-3">
                                        {{-- Warna dot bisa diacak atau berdasarkan status --}}
                                        <div class="activity-dot-primary mt-1"
                                            style="min-width: 10px; height: 10px; border-radius: 50%; background-color: #007bff;">
                                        </div>
                                        <div class="w-100 ms-3">
                                            <p class="d-flex justify-content-between mb-1" style="font-size: 13px;">
                                                <span class="date-content light-background">
                                                    {{ \Carbon\Carbon::parse($vote->start)->translatedFormat('d F Y') }}
                                                </span>
                                                <span>
                                                    {{ \Carbon\Carbon::parse($vote->start)->diffForHumans(null, true, false, 2) }}
                                                </span>

                                            </p>
                                            <h6 class="mt-3 mb-1 fw-semibold">{{ $vote->vote_name }}<span
                                                    class="dot-notification"></span></h6>
                                            <p class="f-light mb-0" style="font-size: 14px;">
                                                Dimulai: {{ \Carbon\Carbon::parse($vote->start)->format('H:i') }} |
                                                Berakhir: {{ \Carbon\Carbon::parse($vote->end)->format('H:i') }}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 col-sm-6 box-col-5">
                <div class="card widget-hover position-relative">
                    <div class="card-body">
                        <div class="default-datepicker">
                            <div class="datepicker-here" data-language="en"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
