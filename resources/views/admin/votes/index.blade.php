@extends('layouts.app')

@section('title')
    Vote
@endsection

@section('breadcrumb')
    / Admin
@endsection

@section('page')
    / Vote
@endsection

@section('content')
    <div class="container mb-3">
        <!-- Header Section -->
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4>Total {{ count($votes) }}</h4>
                                <small class="text-muted">Data pemilihan aktif</small>
                            </div>
                            <div class="text-end">
                                <a class="btn btn-primary btn-hover-effect d-flex align-items-center gap-1"
                                    href="{{ route('votes.create') }}">
                                    <i data-feather="plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Voting Items Section -->
        <div class="row">
            @if ($votes->count())
                @foreach ($votes as $item)
                    <div class="col-xxl-3 col-md-6 col-sm-6 mb-3">
                        <div class="card h-100 shadow-sm mb-4 wow zoomIn widget-hover position-relative">
                            <!-- Icons at top right corner -->
                            <div class="position-absolute top-0 end-0 d-flex gap-1 p-2" style="z-index: 1;">
                                <a href="{{ route('votes.success', $item->id) }}"
                                    class="badge bg-light text-muted shadow-sm btn-hover-effect"
                                    style="border-radius: 0.5rem;" title="Approve">
                                    Voting Masuk </a>
                                <a href="{{ route('votes.pending', $item->id) }}"
                                    class="badge bg-light text-muted shadow-sm btn-hover-effect"
                                    style="border-radius: 0.5rem;" title="Reject">
                                    Belum Voting </a>
                            </div>

                            <div class="card-body d-flex justify-content-between align-items-center">
                                <!-- Left Side: Text and Date Information -->
                                <div>
                                    <h5 class="mb-3 mt-3">{{ $item->vote_name }}</h5>
                                    <p class="text-muted small dark-mode-subtext">
                                        <strong>Mulai:</strong>
                                        {{ \Carbon\Carbon::parse($item->start)->translatedFormat('d F Y H:i') }} WIB <br>
                                        <strong>Berakhir:</strong>
                                        {{ \Carbon\Carbon::parse($item->end)->translatedFormat('d F Y H:i') }} WIB <br>
                                    </p>
                                </div>

                                <!-- Right Side: Image -->
                                <div class="text-end">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Gambar"
                                        class="rounded-3 shadow-sm" style="width: 120px; height: auto;">
                                </div>
                            </div>

                            <!-- Footer: Action Buttons -->
                            <div class="card-footer text-center">
                                <div class="d-flex justify-content-around">
                                    <div class="text-end mt-0">
                                        <a class="btn btn-link text-success btn-hover-effect"
                                            href="{{ route('votes.show', $item->id) }}">
                                            <i data-feather="users"></i>
                                            <span>Kandidat</span>
                                        </a>
                                    </div>
                                    <div class="text-end mt-0">
                                        <a class="btn btn-link text-danger btn-hover-effect"
                                            href="{{ route('votes.report', $item->id) }}">
                                            <i data-feather="award"></i>
                                            <span>Hasil</span>
                                        </a>
                                    </div>

                                    <a href="{{ route('votes.edit', $item->id) }}"
                                        class="btn btn-link text-success btn-hover-effect">
                                        <i data-feather="edit" style="font-size: 1.5rem;"></i>
                                    </a>
                                    <form action="{{ route('votes.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <a onclick="confirmDelete(this)" class="btn btn-link text-danger btn-hover-effect"
                                            style="cursor: pointer;">
                                            <i data-feather="trash-2" style="font-size: 1.5rem;"></i>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <i data-feather="alert-circle" class="text-danger mb-2" style="width: 40px; height: 40px;"></i>
                            <h5 class="fw-bold">Data pemilihan belum tersedia</h5>
                            <p class="text-secondary">Silakan tambahkan data pemilihan terlebih dahulu untuk melanjutkan.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
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


    <!-- Pastikan replace ikon Feather dijalankan -->
    <script>
        feather.replace();
    </script>
@endsection
