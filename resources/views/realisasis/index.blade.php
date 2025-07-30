<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Realisasi - KancilAkurat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: url('{{ secure_asset('storage/imigrasi.jpg') }}') no-repeat center center fixed; background-size: cover;">


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
                <h3 class="text-center my-4">Data Realisasi Anggaran</h3>
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
                            <th scope="col">DOKUMEN</th>
                            <th scope="col" style="width: 20%">AKSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($realisasis as $realisasi)
                            <tr>
                                <td>{{ $realisasi->nama_seksi }}</td>
                                <td>{{ "Rp " . number_format($realisasi->sisa_anggaran, 2, ',', '.') }}</td>
                                <td>
                                        <a href="{{ asset('storage/strukturs/' . $realisasi->lihat_dokumen) }}" target="_blank" class="btn btn-sm btn-secondary">
                                            Lihat Dokumen
                                        </a>
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
                    {{ $realisasis->links() }}
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
