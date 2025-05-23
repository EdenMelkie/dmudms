<?php
if (session('userType') !== 'Proctor') {
    header("Location: " . url('/invalid'));
    exit();
}
?>
<head>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <style>
        /* Custom dropdown on hover */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0.5rem;
            animation: fadeIn 0.3s ease-in-out;
        }

        .dropdown-menu {
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }

        .dropdown-item {
            transition: all 0.2s;
        }

        .dropdown-item:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .navbar-brand img {
            height: 32px;
            margin-right: 10px;
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

        .navbar-nav .nav-link {
            font-weight: 500;
        }
    </style>
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow">
    <div class="container-fluid">
        <!-- Logo and brand -->
        <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('proctor') }}">
            <img src="{{ asset('images/dmu-logo.png') }}" alt="Logo"> DMU Dormitory Management System Proctor Page
        </a>

        <!-- Toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation links -->
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
                        <li><a class="dropdown-item" href="{{ route('materials.view') }}"><i class="fas fa-tools me-1"></i> Report Issues</a></li>
                        <li><a class="dropdown-item" href="{{ route('proctor.viewPlacedStudents') }}"><i class="fas fa-user-graduate me-1"></i> Student Placement</a></li>
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
