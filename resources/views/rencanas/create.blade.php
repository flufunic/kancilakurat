<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Rencana - Rencana Bulanan</title>
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

                        <form action="{{ route('rencanas.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">SEKSI/BAGIAN</label>
                                <input type="text" class="form-control @error('nama_seksi') is-invalid @enderror" name="nama_seksi" value="{{ old('nama_seksi') }}" placeholder="Masukkan Nama Seksi">
                                @error('nama_seksi')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">PENARIKAN DANA PRESISI</label>
                                <input type="number" class="form-control @error('saldo_tahunan') is-invalid @enderror" name="saldo_tahunan" value="{{ old('saldo_tahunan') }}" placeholder="Masukkan Saldo Tahunan">
                                @error('saldo_tahunan')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                @foreach(['minggu_1', 'minggu_2', 'minggu_3', 'minggu_4'] as $minggu)
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">{{ strtoupper(str_replace('_', ' ', $minggu)) }}</label>
                                        <input type="number" class="form-control @error($minggu) is-invalid @enderror" name="{{ $minggu }}" value="{{ old($minggu, 0) }}">
                                        @error($minggu)
                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">SALDO</label>
                                <input type="number" class="form-control @error('sisa_saldo_bulan') is-invalid @enderror" name="sisa_saldo_bulan" value="{{ old('sisa_saldo_bulan', 0) }}" placeholder="Masukkan Sisa Saldo Bulan">
                                @error('sisa_saldo_bulan')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="font-weight-bold">BULAN</label>
                                <select class="form-control @error('bulan') is-invalid @enderror" name="bulan">
                                    <option value="">-- Pilih Bulan --</option>
                                    @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                                        <option value="{{ $bulan }}" {{ old('bulan') == $bulan ? 'selected' : '' }}>{{ $bulan }}</option>
                                    @endforeach
                                </select>
                                @error('bulan')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">SIMPAN</button>
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
