<?php
if (session('userType') !== 'Admin') {
    header("Location: " . url('/invalid'));
    exit();
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Admin Page')</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <style>
        .navbar {
            background-color: #2c3e50;
        }

        .navbar-brand {
            color: white;
            font-weight: 600;
            font-size: 1.3rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-brand img {
            height: 40px;
            width: auto;
            margin-right: 12px;
        }

        .navbar-nav .nav-link {
            color: white;
            margin-right: 15px;
        }

        .dropdown-menu {
            background-color: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.15);
        }

        .dropdown-menu .dropdown-item {
            color: #212529;
            padding: 0.5rem 1.5rem;
        }

        .dropdown-menu .dropdown-item:hover,
        .dropdown-menu .dropdown-item:focus {
            background-color: #f8f9fa;
            color: #212529;
        }

        .btn-logout {
            background-color: #e74c3c;
            color: white;
            border-radius: 5px;
        }

        .btn-logout:hover {
            background-color: #c0392b;
        }

        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }

        .nav-item.dropdown .dropdown-toggle::after {
            display: none;
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- Admin Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('admin') }}">
                <img src="{{ asset('images/dmu-logo.png') }}" alt="DMU Logo" />
                <span>DMU Dormitory Management System Admin Page</span>
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Removed the old 'Page' nav item to avoid duplication -->

                    <!-- Account Management -->
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="accountDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-user-cog"></i> Account Management
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.create_account') }}">
                                    <i class="fas fa-user-plus"></i> Create Account
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('employees.index') }}">
                                    <i class="fas fa-user-edit"></i> View Employees
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.students') }}">
                                    <i class="fas fa-user-graduate"></i> Manage Students
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Profile -->
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="profileDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-user"></i>
                            @if(session('username'))
                            Welcome, {{ session('username') }}
                            @endif
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-edit"></i> Edit Profile
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item btn">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>