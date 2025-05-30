@extends('layouts.app')

@section('title')
    Student
@endsection

@section('breadcrumb')
    / Admin
@endsection

@section('page')
    / Student
@endsection

@section('content')
    <div class="container mb-4">

        <!-- Header dan upload file -->
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4>Total {{ $students->count() }}</h4>
                                <small class="text-muted">Kelas: {{ $classroom->classroom }}</small>
                            </div>
                            <div class="text-end">
                                <div class="d-flex justify-content-end gap-2 flex-wrap">

                                    <a class="btn btn-primary btn-hover-effect d-flex align-items-center gap-1"
                                        href="{{ route('classroom.create_user', $id) }}">
                                        <i data-feather="plus"></i>
                                        Tambah
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <div class="mb-3 mt-3">
                                <label for="file" class="form-label">Upload file data siswa</label>
                                <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data"
                                    class="d-flex flex-column flex-md-row align-items-stretch gap-2">
                                    @csrf
                                    <input class="form-control" id="file" name="file" type="file" required>
                                    <input type="hidden" name="classroom_id" value="{{ $id }}">
                                    <button type="submit" class="btn btn-primary btn-hover-effect">Kirim</button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Pencarian -->
        @if ($students->count())
            <div class="row mb-4 mt-1">
                <div class="col-md-12 me-auto">
                    <input type="search" id="searchStudent"
                        class="form-control form-control-lg shadow-sm rounded-3 text-muted"
                        placeholder="Cari nama siswa...">
                </div>
            </div>
        @endif

        <!-- Daftar Siswa -->
        <div class="row" id="studentList">
            @forelse ($students as $item)
                <div class="col-md-4 mb-4 student-card">
                    <div class="card h-100 shadow-sm wow zoomIn widget-hover">
                        <div class="card-body pb-1">
                            <p class="card-title fs-5 fw-semibold mb-2 student-name">{{ $item->name }}</p>
                            <p class="card-text mb-1">
                                <strong>NISN:</strong>
                                <span class="text-muted dark-mode-subtext">{{ $item->nisn ?? '-' }}</span>
                            </p>
                            <p class="card-text mb-1">
                                <strong>Email:</strong><br>
                                <span class="text-muted dark-mode-subtext">{{ $item->email }}</span>
                            </p>
                            <p class="card-text mb-3">
                                <strong>Kelas:</strong> <span
                                    class="text-muted dark-mode-subtext">{{ $item->classroom->classroom ?? '-' }}</span>
                            </p>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if ($item->is_active == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Offline</span>
                                    @endif
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('users.edit', $item->id) }}" class="text-success btn-hover-effect"
                                        style="font-size: 1.3rem;">
                                        <i data-feather="edit"></i>
                                    </a>
                                    <form action="{{ route('users.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this)"
                                            class="btn p-0 text-danger btn-hover-effect"
                                            style="font-size: 1.3rem; border: none; background: transparent;">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    </form>
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
                            <h5 class="fw-bold">Data siswa belum tersedia</h5>
                            <p class="text-secondary">Silakan tambahkan data siswa terlebih dahulu untuk melanjutkan.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pesan jika tidak ada hasil pencarian -->
        <div id="notFoundMessage" class="text-center text-muted mt-3 mb-3" style="display: none;">
            <i data-feather="info" class="mb-1"></i><br>
            Tidak ada siswa yang sesuai dengan pencarian.
        </div>
    </div>

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

        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("searchStudent");
            const cards = document.querySelectorAll(".student-card");
            const notFoundMessage = document.getElementById("notFoundMessage");

            searchInput?.addEventListener("input", function() {
                const keyword = this.value.toLowerCase().trim();

                let found = 0;
                cards.forEach(card => {
                    const name = card.querySelector(".student-name").textContent.toLowerCase();
                    if (name.includes(keyword)) {
                        card.style.display = "";
                        found++;
                    } else {
                        card.style.display = "none";
                    }
                });

                if (found === 0) {
                    notFoundMessage.style.display = "block";
                } else {
                    notFoundMessage.style.display = "none";
                }
            });

            feather.replace();
        });
    </script>
@endsection
