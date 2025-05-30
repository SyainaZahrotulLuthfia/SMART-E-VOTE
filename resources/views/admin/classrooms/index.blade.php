@extends('layouts.app')

@section('title')
    Classroom
@endsection

@section('breadcrumb')
    / Admin
@endsection

@section('page')
    / Classroom
@endsection

@section('content')
    <div class="container pb-2">
        <!-- Header Section -->
        <div class="row justify-content-start g-2">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4>Total {{ count($classrooms) }}</h4>
                                <small class="text-muted">Kelas aktif</small>
                            </div>
                            <div class="text-end">
                                <a class="btn btn-primary btn-hover-effect d-flex align-items-center gap-1"
                                    href="{{ route('classrooms.create') }}">
                                    <i data-feather="plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('classrooms.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 mt-3">
                                <label for="formFile" class="form-label">Upload file data kelas</label>
                                <div class="d-flex flex-column flex-md-row align-items-stretch gap-2">
                                    <input class="form-control" id="formFile" name="file" type="file" required>
                                    <button type="submit" class="btn btn-primary btn-hover-effect">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pencarian -->
        @if ($classrooms->count())
            <div class="row mb-4 mt-1">
                <div class="col-md-12 me-auto">
                    <input type="search" id="searchClass"
                        class="form-control form-control-lg shadow-sm rounded-3 text-muted"
                        placeholder="Cari nama kelas...">
                </div>
            </div>
        @endif

        <!-- Daftar Kelas -->
        <div class="row" id="classroomList">
            @foreach ($classrooms as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 wow zoomIn widget-hover mb-4 classroom-card">
                    <div class="card h-100 shadow-sm rounded-4">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold text-center classroom-name">{{ $item->classroom }}</h5>
                                <div class="d-flex align-items-center mb-2 justify-content-center">
                                    @if ($item->is_active)
                                        <i data-feather="check-circle" class="text-success me-2"></i>
                                        <span class="text-success">Aktif</span>
                                    @else
                                        <i data-feather="alert-triangle" class="text-danger me-2"></i>
                                        <span class="text-danger">Tidak Aktif</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-1 pt-1 d-flex justify-content-center align-items-center gap-4">
                                <a class="btn btn-link btn-hover-effect text-danger d-flex flex-column align-items-center p-0"
                                    href="{{ route('classrooms.show', $item->id) }}">
                                    <i data-feather="users" style="font-size: 22px;"></i>
                                </a>

                                <a href="{{ route('classrooms.edit', $item->id) }}" title="Edit"
                                    class="text-success btn-hover-effect fs-5 d-flex align-items-center">
                                    <i data-feather="edit"></i>
                                </a>

                                <form action="{{ route('classrooms.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this)"
                                        class="btn p-0 text-danger btn-hover-effect fs-5 d-flex align-items-center"
                                        style="background: none; border: none;">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pesan Data Kosong (awal) -->
        @if ($classrooms->count() == 0)
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <i data-feather="alert-circle" class="text-danger mb-2" style="width: 40px; height: 40px;"></i>
                        <h5 class="fw-bold">Data kelas belum tersedia</h5>
                        <p class="text-secondary">Silakan tambahkan data kelas terlebih dahulu untuk melanjutkan.</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Pesan jika tidak ada hasil pencarian -->
        <div id="notFoundMessage" class="text-center text-muted mt-3 mb-3" style="display: none;">
            <i data-feather="info" class="mb-1"></i><br>
            Tidak ada kelas yang sesuai dengan pencarian.
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

        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("searchClass");
            const cards = document.querySelectorAll(".classroom-card");
            const noDataMessage = document.getElementById("noDataMessage");
            const notFoundMessage = document.getElementById("notFoundMessage");

            searchInput?.addEventListener("input", function() {
                const keyword = this.value.toLowerCase().trim();

                let found = 0;
                cards.forEach(card => {
                    const name = card.querySelector(".classroom-name").textContent.toLowerCase();
                    if (name.includes(keyword)) {
                        card.style.display = "";
                        found++;
                    } else {
                        card.style.display = "none";
                    }
                });

                // Jika data kosong awal, hide pesan kosong
                if (noDataMessage) noDataMessage.style.display = 'none';

                if (found === 0) {
                    notFoundMessage.style.display = 'block';
                } else {
                    notFoundMessage.style.display = 'none';
                }
            });

            feather.replace();
        });
    </script>
@endsection
