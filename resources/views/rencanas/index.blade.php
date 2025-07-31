<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Rencana Anggaran - KancilAkurat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
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
           <h3 class="text-center my-4 fw-bold text-white" style="font-size: 2rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.8);">
                Data Rencana Penarikan Dana Per Seksi</h3>

            <hr>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <a href="{{ route('rencanas.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SEKSI/BAGIAN</th>
                                <th>Penarikan Dana Per Seksi</th>
                                <th>MINGGU 1</th>
                                <th>MINGGU 2</th>
                                <th>MINGGU 3</th>
                                <th>MINGGU 4</th>
                                <th>SALDO</th>
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
                    {{ $rencanas->links('vendor.pagination.bootstrap-4') }}
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
