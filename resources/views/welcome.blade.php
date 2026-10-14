<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang - Aplikasi Sertifikasi</title>

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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background: linear-gradient(135deg, #1e293b, #334155) !important;
        }
        .hero-section {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.03), rgba(51, 65, 85, 0.08));
            border-radius: 1rem;
            padding: 4rem 2rem;
        }
        .btn {
            border-radius: 0.5rem;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    

    <!-- Main Content -->
    <main class="container d-flex align-items-center justify-content-center flex-grow-1 py-5">
        <div class="text-center hero-section shadow-sm border col-lg-8 mx-auto">
            
            <div class="mb-3">
                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold">
                    <i class="bi bi-star-fill me-1"></i> Sistem Informasi Resmi
                </span>
            </div>

            <h1 class="fw-bold display-6 mb-3 text-dark">
                Selamat Datang di <span class="text-primary">Aplikasi Sertifikasi</span>
            </h1>

            <p class="text-muted lead mb-4 px-lg-4 fs-6">
                Sistem informasi terpadu yang dirancang untuk mengelola data peserta 
                dan skema sertifikasi secara mudah, cepat, dan terstruktur.
            </p>

            <div class="d-flex justify-content-center gap-2 flex-wrap">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2 shadow-sm">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary px-4 py-2">
                        <i class="bi bi-person-plus me-1"></i> Daftar Akun Baru
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="btn btn-primary px-5 py-2 shadow-sm">
                        <i class="bi bi-speedometer2 me-1"></i> Buka Dashboard
                    </a>
                @endguest
            </div>

            <p class="text-muted small mt-5 mb-0">
                &copy; {{ date('Y') }} Aplikasi Sertifikasi. All rights reserved.
            </p>

        </div>
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>