<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Sertifikasi')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts Inter & Bootstrap Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #334155;
        }
        .navbar {
            background: linear-gradient(135deg, #1e293b, #334155) !important;
        }
        .card {
            border-radius: 0.75rem;
        }
        .btn {
            border-radius: 0.5rem;
            font-weight: 500;
        }
    </style>
</head>

<body class="bg-light d-flex flex-column min-vh-100">

<!-- Navbar Modern -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="navbar-brand fw-bold fs-5 d-flex align-items-center gap-2">
            <i class="bi bi-shield-check text-info"></i> Aplikasi Sertifikasi
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-2 mt-3 mt-lg-0">
                
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link text-light px-3 py-2 rounded hover-bg">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                </li>

               @auth
                @if (auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a href="{{ route('peserta.index') }}" class="nav-link text-light px-3 py-2 rounded">
                            <i class="bi bi-people me-1"></i> Data User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('skema.index') }}" class="nav-link text-light px-3 py-2 rounded">
                            <i class="bi bi-journal-text me-1"></i> Data Skema
                        </a>
                    </li>
                @endif
            @endauth

                <li class="nav-item ms-lg-2">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm px-3 py-2 d-flex align-items-center gap-1">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- Main Content Container -->
<main class="container py-5 flex-grow-1">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
                <div>{{ session('error') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2 mb-1">
                <i class="bi bi-exclamation-octagon-fill text-danger fs-5"></i>
                <strong>Terjadi Kesalahan:</strong>
            </div>
            <ul class="mb-0 ps-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')

</main>

<!-- Footer Sederhana -->
<footer class="bg-white text-center py-3 text-muted border-top small">
    <div class="container">
        &copy; {{ date('Y') }} Aplikasi Sertifikasi. All rights reserved.
    </div>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>