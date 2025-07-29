<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Rencana Anggaran - KancilAkurat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

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
                    <a class="nav-link {{ request()->routeIs('rencanas.*') ? 'active' : '' }}" href="{{ route('rencanas.index') }}">Rencana</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('realisasis.*') ? 'active' : '' }}" href="{{ route('realisasis.index') }}">Realisasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('strukturs.*') ? 'active' : '' }}" href="{{ route('strukturs.index') }}">Struktur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dipas.*') ? 'active' : '' }}" href="{{ route('dipas.index') }}">DIPA</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center my-4">Data Rencana Anggaran</h3>
            <hr>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('rencanas.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NAMA SEKSI</th>
                                <th>SALDO TAHUNAN</th>
                                <th>MINGGU 1</th>
                                <th>MINGGU 2</th>
                                <th>MINGGU 3</th>
                                <th>MINGGU 4</th>
                                <th>SISA SALDO BULAN</th>
                                <th>BULAN</th>
                                <th style="width: 20%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($rencanas as $rencana)
                            <tr>
                                <td>{{ $rencana->nama_seksi }}</td>
                                <td>{{ "Rp " . number_format($rencana->saldo_tahunan, 2, ',', '.') }}</td>
                                <td>{{ "Rp " . number_format($rencana->minggu_1, 2, ',', '.') }}</td>
                                <td>{{ "Rp " . number_format($rencana->minggu_2, 2, ',', '.') }}</td>
                                <td>{{ "Rp " . number_format($rencana->minggu_3, 2, ',', '.') }}</td>
                                <td>{{ "Rp " . number_format($rencana->minggu_4, 2, ',', '.') }}</td>
                                <td>{{ "Rp " . number_format($rencana->sisa_saldo_bulan, 2, ',', '.') }}</td>
                                <td>{{ $rencana->bulan }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda yakin?');" action="{{ route('rencanas.destroy', $rencana->id) }}" method="POST">
                                        <a href="{{ route('rencanas.edit', $rencana->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-danger">Data rencana belum tersedia.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $rencanas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SweetAlert untuk notifikasi --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: "success",
        title: "BERHASIL",
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
    });
</script>
@elseif(session('error'))
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
