@extends('layouts.app')

@section('title')
    Candidate
@endsection

@section('breadcrumb')
    / Admin
@endsection

@section('page')
    / Candidate
@endsection

@section('content')
    <div class="container">
        <!-- Header Section -->
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4>Total {{ $vote->candidates->count() }}</h4>
                                <small class="text-muted">{{ $vote->vote_name }}</small>
                            </div>
                            <div class="text-end">
                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                    <a class="btn btn-primary btn-hover-effect d-flex align-items-center gap-1"
                                        href="{{ route('vote.create_candidate', $vote->id) }}       ">
                                        <i data-feather="plus"></i>
                                        Tambah
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kandidat Items Section -->
        <div class="row mt-1">
            @forelse ($vote->candidates as $item)
                <div class="col-md-4 col-lg-4 col-sm-6 box-col-6 col-ed-none wow zoomIn">
                    <div class="card mobile-app-card upgrade-plan widget-hover position-relative">
                        <div class="blog-box blog-grid text-center">
                            <!-- Gambar Kandidat -->
                            <img class="img-fluid top-radius-blog" src="{{ asset('storage/' . $item->image_candidate) }}"
                                alt="{{ $item->name_candidate }}" style="height: 325px; object-fit: cover;">

                            <!-- Tombol View di pojok kanan atas gambar -->
                            <a href="{{ route('candidates.show', $item->id) }}"
                                class="position-absolute top-0 end-0 m-2 p-2 btn-hover-effect" style="z-index: 5;">
                                <i data-feather="chevron-down" class="text-light" style="width: 20px; height: 20px;"></i>
                            </a>

                            <div class="blog-details-main">
                                <ul class="blog-social ">
                                    <li class="text-secondary">No: {{ $item->number_candidate }}</li>
                                    <li class="text-secondary">Kelas: {{ $item->classroom_candidate }}</li>
                                </ul>
                                <hr>

                                <!-- Nama Kandidat -->
                                {{-- <h5 class="blog-bottom-details fw-bold text-secondary" style="font-size: 10px;">
                                    {{ $item->vote->vote_name }}</h5> --}}
                                <h5 class="blog-bottom-details fw-bold">{{ $item->name_candidate }}</h5>

                                <!-- Visi & Misi Kandidat -->
                                <div class="px-3">
                                    <p class="small text-truncate text-secondary" title="{{ $item->vision }}">
                                        <strong>Visi:</strong> {{ Str::limit($item->vision, 100, '...') }}
                                    </p>
                                    <p class="small text-truncate text-secondary" title="{{ $item->mission }}">
                                        <strong>Misi:</strong> {{ Str::limit($item->mission, 100, '...') }}
                                    </p>
                                </div>

                                <!-- Garis bawah nama kandidat -->
                                <hr class="my-3">

                                <!-- Tombol Aksi -->
                                <div class="d-flex justify-content-center mb-3 mt-3">
                                    <td>
                                        <ul class="action list-inline m-0">
                                            <!-- Tombol Edit (Hijau) -->
                                            <li class="list-inline-item me-2 btn-hover-effect">
                                                <a href="{{ route('candidates.edit', $item->id) }}" class="text-success"
                                                    style="font-size: 1.5rem;">
                                                    <i data-feather="edit"></i>
                                                </a>
                                            </li>

                                            <!-- Tombol Hapus (Merah) dengan Konfirmasi -->
                                            <li class="list-inline-item btn-hover-effect">
                                                <form action="{{ route('candidates.destroy', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a onclick="confirmDelete(this)" class="text-danger"
                                                        style="font-size: 1.5rem; cursor: pointer;">
                                                        <i data-feather="trash-2"></i>
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <i data-feather="alert-circle" class="text-danger mb-2" style="width: 40px; height: 40px;"></i>
                            <h5 class="fw-bold">Data kandidat belum tersedia</h5>
                            <p class="text-secondary">Silakan tambahkan data kandidat terlebih dahulu untuk melanjutkan.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Confirm Delete Script -->
    <script>
        function confirmDelete(button) {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data Pemilihan akan dihapus secara permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true // ⬅️ Ini membalik posisi tombol
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
    </script>
@endsection
