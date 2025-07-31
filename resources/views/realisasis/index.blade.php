<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Realisasi - KancilAkurat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .pagination {
        display: flex;
        justify-content: center;
        padding-left: 0;
        list-style: none;
        border-radius: 0.25rem;
    }

    .pagination li {
        display: inline;
    }

    .pagination li a,
    .pagination li span {
        position: relative;
        display: block;
        padding: 0.4rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #0d6efd;
        background-color: #fff;
        border: 1px solid #dee2e6;
        text-decoration: none;
        font-size: 0.875rem;
        border-radius: 0.25rem;
    }

    .pagination li.active span {
        z-index: 3;
        color: #fff;
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>

<body style="margin: 0; padding: 0; position: relative;">

    <!-- Gambar background -->
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                background: url('{{ secure_asset('storage/imigrasi.jpg') }}') no-repeat center center fixed;
                background-size: cover; z-index: -2;"></div>

    <!-- Overlay gelap transparan -->
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                background-color: rgba(0, 0, 0, 0.5); z-index: -1;"></div>


<!-- ✅ HEADER / NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">KancilAkurat</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dipas.*') ? 'active' : '' }}" href="{{ route('dipas.index') }}">DIPA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('rencanas.*') ? 'active' : '' }}" href="{{ route('rencanas.index') }}">Rencana</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('realisasis.*') ? 'active' : '' }}" href="{{ route('realisasis.index') }}">Realisasi</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4 fw-bold text-white" style="font-size: 2rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">Data Realisasi Anggaran</h3>
                <hr>
            </div>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('realisasis.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">SEKSI/BAGIAN</th>
                            <th scope="col">SISA ANGGARAN</th>
                            <th scope="col">LINK DOKUMEN</th>
                            <th scope="col" style="width: 20%">AKSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($realisasis as $realisasi)
                            <tr>
                                <td>{{ $realisasi->nama_seksi }}</td>
                                <td>{{ "Rp " . number_format($realisasi->sisa_anggaran, 2, ',', '.') }}</td>
                               <td>
                                    @if($realisasi->link_spreadsheet)
                                        <a href="{{ $realisasi->link_spreadsheet }}" target="_blank" class="btn btn-sm btn-secondary">
                                            Lihat Dokumen
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada link</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda yakin?');" action="{{ route('realisasis.destroy', $realisasi->id) }}" method="POST">
                                        <a href="{{ route('realisasis.edit', $realisasi->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="alert alert-danger m-0">
                                        Data realisasi belum tersedia.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                   {{ $realisasis->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('sukses') }}",
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@elseif(session('error'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
             text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif



</body>
</html>
