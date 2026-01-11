f
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
        <h4 class="px-3 mb-4 fw-bold text-orange" style="color: #f97316;">Monitoring PKL</h4>
        <small class="text-uppercase text-muted px-3 mb-2" style="font-size: 10px;">Main Menu</small>

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart me-2"></i> Dashboard
                </a>
            </li>

            @if (Auth::user()->role == 1)
                <li><a href="{{ route('students.index') }}"
                        class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
                        <i class="bi bi-book me-2"></i> Data Siswa</a></li>

                <li><a href="{{ route('teachers.index') }}"
                        class="nav-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}">
                        <i class="bi bi-clipboard me-2"></i> Data Guru</a></li>

                <li><a href="{{ route('companies.index') }}"
                        class="nav-link {{ request()->routeIs('companies.*') ? 'active' : '' }}">
                        <i class="bi bi-building me-2"></i> Data Instansi</a></li>

                <li><a href="{{ route('users.index') }}"
                        class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i> Data Pengguna</a></li>

                <li><a href="{{ route('submissions.index') }}"
                        class="nav-link {{ request()->routeIs('submissions.*') ? 'active' : '' }}">
                        <i class="bi bi-display me-2"></i> Data Pengajuan</a></li>

                <li><a href="{{ route('monitorings.index') }}"
                        class="nav-link {{ request()->routeIs('monitorings.*') ? 'active' : '' }}">
                        <i class="bi bi-activity me-2"></i> Data Monitoring</a></li>
            @elseif(Auth::user()->role == 2)
                <li><a href="{{ route('teacher.monitoring.index') }}"
                        class="nav-link {{ request()->routeIs('teacher.monitoring.*') ? 'active' : '' }}">
                        <i class="bi bi-activity me-2"></i> Data Monitoring</a></li>
            @elseif(Auth::user()->role == 3)
                <li><a href="{{ route('company.monitoring.index') }}"
                        class="nav-link {{ request()->routeIs('company.monitoring.*') ? 'active' : '' }}">
                        <i class="bi bi-activity me-2"></i> Data Monitoring</a></li>
            @elseif (Auth::user()->role == 4)
                <li>
                    <a href="{{ route('student.submissions.index') }}"
                        class="nav-link {{ request()->routeIs('student.submissions.*') ? 'active' : '' }}">
                        <i class="bi bi-bookmark me-2"></i> Pengajuan PKL
                    </a>
                </li>
                <li>
                    <a href="{{ route('student.activities.index') }}"
                        class="nav-link {{ request()->routeIs('student.activities.index') ? 'active' : '' }}">
                        <i class="bi bi-clipboard me-2"></i> Presensi & Kegiatan
                    </a>
                </li>
                <li>
                    <a href="{{ route('student.reports.index') }}"
                        class="nav-link {{ request()->routeIs('student.reports.index') ? 'active' : '' }}">
                        <i class="bi bi-hard-drive me-2"></i> Laporan
                    </a>
                </li>
            @endif

            <hr>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" class="w-100">
                    @csrf
                    <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start">
                        <i class="bi bi-box-arrow-left me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4 py-3">
            <div class="ms-auto d-flex align-items-center">
                <span class="me-2 fw-bold">{{ Auth::user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" class="rounded-circle"
                    width="35">
            </div>
        </nav>

        <div class="p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
