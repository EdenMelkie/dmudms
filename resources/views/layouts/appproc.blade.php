{{-- Access control --}}
<?php
if (session('userType') !== 'Proctor') {
    header("Location: " . url('/invalid'));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Proctor Panel</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <style>
        /* Header */
        .navbar-brand img {
            height: 32px;
            margin-right: 10px;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 56px;
            /* Leave space for navbar */
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
        }

        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 1.5rem;
            margin-top: 56px;
            /* Below fixed navbar */
        }

        /* Dropdown hover effect */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0.5rem;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('proctor') }}">
                <img src="{{ asset('images/dmu-logo.png') }}" alt="Logo">
                DMU Dormitory Management System Proctor Page
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Management Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="proctorDropdown" role="button">
                            <i class="fas fa-cogs me-1"></i> Management
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="proctorDropdown">
                            <li><a class="dropdown-item" href="{{ route('proctor.blockProctors') }}"><i class="fas fa-users-cog me-1"></i> View Placement</a></li>
                            <li><a class="dropdown-item" href="{{ route('requests.proctor') }}"><i class="fas fa-envelope-open-text me-1"></i> Manage Requests</a></li>
                            <li><a class="dropdown-item" href="{{ route('materials.view') }}"><i class="fas fa-tools me-1"></i> Register materials</a></li>
                            <li><a class="dropdown-item" href="{{ route('proctor.viewPlacedStudents') }}"><i class="fas fa-user-graduate me-1"></i> Student Placement</a></li>
                            <li><a class="dropdown-item" href="{{ route('exit_papers.viewByProctor') }}"><i class="fas fa-user-graduate me-1"></i> View Exit Papers</a></li>
                        </ul>
                    </li>

                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button">
                            <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-edit me-1"></i> Edit Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-1"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <nav class="sidebar p-3">
        <h4 class="text-white"><i class="fas fa-user-shield"></i> Proctor Tasks</h4>
        <ul class="nav flex-column">

            <li class="nav-item mb-2">
                <a href="{{ route('proctor.blockProctors') }}" class="nav-link text-white">
                    <i class="fas fa-door-open"></i> View Placement
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('requests.proctor') }}" class="nav-link text-white">
                    <i class="fas fa-check-circle"></i> Manage Requests
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('materials.view') }}" class="nav-link text-white">
                    <i class="fas fa-exclamation-triangle"></i> Register Room status
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('proctor.viewPlacedStudents') }}" class="nav-link text-white">
                    <i class="fas fa-user-edit"></i> View Student Placement
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('exit_papers.viewByProctor') }}" class="nav-link text-white">
                    <i class="fas fa-user-graduate me-1"></i> View Exit Papers
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('profile.edit') }}" class="nav-link text-white">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>
            </li>
            <li class="nav-item mt-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')

    </div>
    <div style="margin-top: 30px;">
        @include('partials.footer')
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>