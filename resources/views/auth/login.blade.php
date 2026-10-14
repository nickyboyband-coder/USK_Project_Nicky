<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Administrator</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f5f8;
        }
    </style>
</head>

<body>

    <div class="container min-vh-100 d-flex justify-content-center align-items-center">

        <div class="row justify-content-center w-100">

            <div class="col-12 col-sm-10 col-md-8 col-lg-5">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4 p-md-5">

                        <!-- Judul -->
                        <div class="text-center mb-4">

                            <h1 class="fw-bold mb-2">
                                Admin Login
                            </h1>

                            <p class="text-secondary mb-0">
                                Aplikasi Pengelolaan Data Peserta Sertifikasi
                            </p>

                        </div>

                        <!-- Alert Success -->
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Alert Error -->
                        @if ($errors->any())

                            <div class="alert alert-danger" role="alert">

                                <ul class="mb-0 ps-3">

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>

                            </div>

                        @endif

                        <!-- Form Login -->
                        <form action="{{ route('login.process') }}" method="POST">

                            @csrf

                            <!-- Email -->
                            <div class="mb-3">

                                <label for="email" class="form-label fw-bold">
                                    Email
                                </label>

                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="Masukkan email" class="form-control form-control-lg" required>

                            </div>

                            <!-- Password -->
                            <div class="mb-4">

                                <label for="password" class="form-label fw-bold">
                                    Password
                                </label>

                                <input type="password" id="password" name="password" placeholder="Masukkan password"
                                    class="form-control form-control-lg" required>

                                    

                            </div>

                            <!-- Tombol Login -->
                            <div class="d-grid">

                                <button type="submit" class="btn btn-secondary btn-lg fw-bold">
                                    Login
                                </button>

                            </div>

                        </form>

                        <!-- Link Daftar -->
                        <div class="text-center mt-4">

                            <p class="text-secondary mb-0">
                                Belum punya akun?

                                <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">
                                    Daftar di sini
                                </a>
                            </p>
                            <!-- Tombol Kembali ke Welcome -->
                            <a href="{{ route('welcome') }}" class="btn btn-outline-secondary w-100 fw-bold">
                                &larr; Kembali
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
