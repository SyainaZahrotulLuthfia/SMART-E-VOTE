@extends('layouts.app')

@section('title')
    Report
@endsection

@section('breadcrumb')
    / Admin
@endsection

@section('page')
    / Report
@endsection

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <h4>Belum Menggunakan Hak Suara</h4>
                    <span>Total <strong>{{ count($pendingUsers) }}</strong> siswa belum memilih untuk voting:
                        <strong>{{ $vote->vote_name }}</strong></span>
                </div>
                <div class="card-body">

                    <!-- Pencarian -->
                    <div class="mb-3 d-flex justify-content-end">
                        <input type="search" id="searchInput" class="form-control form-control-lg shadow-sm"
                            placeholder="Cari nama atau kelas...">
                    </div>

                    <div class="table-responsive theme-scrollbar">
                        <table id="pendingTable" class="table table-striped table-bordered mb-0" style="width:100%">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th style="min-width: 50px">No</th>
                                    <th style="min-width: 150px">Nama</th>
                                    <th style="min-width: 100px">Kelas</th>
                                    <th style="min-width: 200px">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pendingUsers as $user)
                                    <tr>
                                        <td class="text-center"></td> <!-- Nomor otomatis -->
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->classroom->classroom ?? '-' }}</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">Semua siswa sudah memilih.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("searchInput");
            const table = document.getElementById("pendingTable");
            const tbody = table.querySelector("tbody");
            const rows = Array.from(tbody.querySelectorAll("tr")).filter(row => !row.classList.contains(
                "no-data-row"));

            function renderTable() {
                const keyword = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                const oldNoData = tbody.querySelector(".no-data-row");
                if (oldNoData) oldNoData.remove();

                rows.forEach(row => {
                    const nama = row.cells[1].textContent.toLowerCase();
                    const kelas = row.cells[2].textContent.toLowerCase();

                    if (nama.includes(keyword) || kelas.includes(keyword)) {
                        row.style.display = "";
                        row.cells[0].textContent = ++visibleCount;
                    } else {
                        row.style.display = "none";
                    }
                });

                if (visibleCount === 0) {
                    const tr = document.createElement("tr");
                    tr.classList.add("no-data-row");
                    tr.innerHTML =
                        `<td colspan="4" class="text-center py-4">Data tidak ditemukan.</td>`;
                    tbody.appendChild(tr);
                }
            }

            searchInput.addEventListener("input", renderTable);
            renderTable();
        });
    </script>
@endsection
