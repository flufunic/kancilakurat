<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Realisasi - SantriKoding.com</title>
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

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form action="{{ route('realisasis.update', $realisasi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Nama Seksi</label>
                            <input type="text" class="form-control @error('nama_seksi') is-invalid @enderror" name="nama_seksi" value="{{ old('nama_seksi', $realisasi->nama_seksi) }}" placeholder="Masukkan Nama Seksi">

                            @error('nama_seksi')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Sisa Anggaran</label>
                            <input type="number" class="form-control @error('sisa_anggaran') is-invalid @enderror" name="sisa_anggaran" value="{{ old('sisa_anggaran', $realisasi->sisa_anggaran) }}" placeholder="Masukkan Sisa Anggaran">

                            @error('sisa_anggaran')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Link Spreadsheet</label>
                            <textarea class="form-control @error('link_spreadsheet') is-invalid @enderror" name="link_spreadsheet" rows="3" placeholder="Masukkan Link Spreadsheet">{{ old('link_spreadsheet', $realisasi->link_spreadsheet) }}</textarea>

                            @error('link_spreadsheet')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
