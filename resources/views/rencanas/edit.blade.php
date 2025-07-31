<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rencana - SantriKoding.com</title>
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
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Kancil Akurat</a>
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

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form action="{{ route('rencanas.update', $rencana->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Seksi/Bagian</label>
                            <input type="text" class="form-control @error('nama_seksi') is-invalid @enderror" name="nama_seksi" value="{{ old('nama_seksi', $rencana->nama_seksi) }}" placeholder="Masukkan Nama Seksi">
                            @error('nama_seksi')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Penarikan Dana Per Seksi</label>
                            <input type="number" class="form-control @error('saldo_tahunan') is-invalid @enderror" name="saldo_tahunan" value="{{ old('saldo_tahunan', $rencana->saldo_tahunan) }}" placeholder="Masukkan Saldo Tahunan">
                            @error('saldo_tahunan')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            @foreach ([1, 2, 3, 4] as $i)
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">Minggu {{ $i }}</label>
                                    <input type="number" class="form-control @error('minggu_{{$i}}') is-invalid @enderror" name="minggu_{{ $i }}" value="{{ old("minggu_$i", $rencana->{'minggu_'.$i}) }}" placeholder="Isi Anggaran Minggu {{ $i }}">
                                    @error("minggu_$i")
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Saldo</label>
                            <input type="number" class="form-control @error('sisa_saldo_bulan') is-invalid @enderror" name="sisa_saldo_bulan" value="{{ old('sisa_saldo_bulan', $rencana->sisa_saldo_bulan) }}" placeholder="Masukkan Sisa Saldo Bulan">
                            @error('sisa_saldo_bulan')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Bulan</label>
                            <select class="form-control @error('bulan') is-invalid @enderror" name="bulan">
                                <option value="">-- Pilih Bulan --</option>
                                @foreach (['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bln)
                                    <option value="{{ $bln }}" {{ old('bulan', $rencana->bulan) == $bln ? 'selected' : '' }}>{{ $bln }}</option>
                                @endforeach
                            </select>
                            @error('bulan')
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
