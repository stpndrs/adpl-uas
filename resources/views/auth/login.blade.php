<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Monitoring PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            background-color: #2563eb;
            border: none;
            border-radius: 10px;
            padding: 12px;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .form-control-custom {
            background-color: #f1f5f9;
            border: none;
            border-radius: 10px;
            padding: 12px 15px;
        }

        .text-orange {
            color: #f97316;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="text-center mb-4">
                    <h2 class="fw-bold"><span class="text-orange">Monitoring</span> PKL</h2>
                    <p class="text-muted small">Silahkan masuk menggunakan akun Anda</p>
                </div>

                <div class="card login-card p-4">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger border-0 small mb-4" style="border-radius: 10px;">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('login.auth') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Username (NISN/NIP)</label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light"
                                        style="border-radius: 10px 0 0 10px;">
                                        <i class="bi bi-person text-muted"></i>
                                    </span>
                                    <input type="text" name="username" class="form-control form-control-custom"
                                        placeholder="Masukkan username" value="{{ old('username') }}" required
                                        autofocus>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light"
                                        style="border-radius: 10px 0 0 10px;">
                                        <i class="bi bi-lock text-muted"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control form-control-custom"
                                        placeholder="********" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 fw-bold">Masuk Sekarang</button>
                        </form>
                    </div>
                </div>

                <p class="text-center mt-4 text-muted small">Copyright &copy; 2024 - Monitoring PKL</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
