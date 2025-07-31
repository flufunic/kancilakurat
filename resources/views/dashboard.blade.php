<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - KANCIL AKURAT</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('{{ asset('images/imigrasi.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            color: white;
            min-height: 100vh;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.5); 
            padding: 60px 30px;
            border-radius: 12px;
        }

        .btn-custom {
            width: 180px;
            margin: 10px;
        }

        nav {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(4px);
            border-bottom: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-dark" href="{{ route('dashboard') }}">
                Kancil Akurat
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item me-3">
                        <a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="overlay text-center">
            <h1 class="mb-4">Selamat Datang di Halaman Admin <br><strong>KANCIL AKURAT</strong></h1>

            <div class="d-flex flex-wrap justify-content-center">
                <a href="{{ route('dipas.index') }}" class="btn btn-danger btn-custom">DIPA</a>
                <a href="{{ route('rencanas.index') }}" class="btn btn-primary btn-custom">RENCANA</a>
                <a href="{{ route('realisasis.index') }}" class="btn btn-success btn-custom">REALISASI</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
