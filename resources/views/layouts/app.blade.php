<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bs-primary: #2563eb;
            --bs-orange: #f97316;
        }
        
        body {
            background-color: #f8fafc;
            font-family: "Poppins", sans-serif;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: white;
            border-right: 1px solid #e2e8f0;
        }

        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        .nav-link {
            color: #64748b;
            padding: 12px 25px;
        }

        .nav-link.active {
            background-color: #eff6ff;
            color: var(--bs-primary);
            border-left: 4px solid var(--bs-primary);
            font-weight: 600;
        }

        .form-control-custom {
            background-color: #f1f5f9;
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
        }

        .btn-orange {
            background-color: var(--bs-orange);
            color: white;
        }

        .btn-orange:hover {
            background-color: #ea580c;
            color: white;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <div class="sidebar d-flex flex-column p-3">
        <h4 class="px-3 mb-4 fw-bold">Logo</h4>
        <small class="text-uppercase text-muted px-3 mb-2" style="font-size: 10px;">Main Menu</small>
        <ul class="nav nav-pills flex-column mb-auto">
            <li><a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"><i
                        class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
            <li><a href="/students" class="nav-link {{ request()->is('students*') ? 'active' : '' }}"><i
                        class="bi bi-people me-2"></i> Data Siswa</a></li>
            <li><a href="/teachers" class="nav-link {{ request()->is('teachers*') ? 'active' : '' }}"><i
                        class="bi bi-person-badge me-2"></i> Data Guru</a></li>
            <li><a href="/companies" class="nav-link {{ request()->is('companies*') ? 'active' : '' }}"><i
                        class="bi bi-building me-2"></i> Data Instansi</a></li>
            <li><a href="/users" class="nav-link {{ request()->is('users*') ? 'active' : '' }}"><i
                        class="bi bi-person-gear me-2"></i> Data Pengguna</a></li>
            <li><a href="/monitorings" class="nav-link {{ request()->is('monitorings*') ? 'active' : '' }}"><i
                        class="bi bi-display me-2"></i> Data Monitoring</a></li>
        </ul>
    </div>

    <div class="main-content">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4 py-3">
            <div class="ms-auto d-flex align-items-center">
                <span class="me-2 fw-bold">Admin</span>
                <img src="https://ui-avatars.com/api/?name=Admin" class="rounded-circle" width="35">
            </div>
        </nav>

        <div class="p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
