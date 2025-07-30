<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data DIPA - KancilAkurat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #f0f0f0">

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
            <h3 class="text-center my-4">Data DIPA</h3>
            <hr>

            <div class="card shadow-sm rounded border-0">
                <div class="card-body">
                    <a href="{{ route('dipas.create') }}" class="btn btn-success mb-3">TAMBAH PDF</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NAMA</th>
                                <th>FILE PDF</th>
                                <th style="width: 20%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dipas as $dipa)
                                <tr>
                                    <td>{{ $dipa->nama }}</td>
                                    <td>
                                        <a href="{{ asset('storage/dipas/' . $dipa->file_pdf) }}" target="_blank" class="btn btn-sm btn-secondary">
                                            Lihat PDF
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Yakin ingin menghapus?');" action="{{ route('dipas.destroy', $dipa->id) }}" method="POST">
                                            <a href="{{ route('dipas.edit', $dipa->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-danger">Belum ada data DIPA.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $dipas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
