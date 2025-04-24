<?php
if (session('userType') !== 'Registrar') {
    header("Location: " . url('/invalid'));
    exit();
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .navbar {
            background-color: lightseagreen;
            color: black;
        }

        .navbar-brand {
            color: black;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: black;
            margin-right: 15px;
        }

        .dropdown-menu {
            background-color: lightgray;
        }

        .dropdown-menu .dropdown-item {
            color: black;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: red;
        }

        .btn-logout {
            background-color: #E74C3C;
            color: black;
            border-radius: 5px;
        }

        .btn-logout:hover {
            background-color: #C0392B;
        }

        .pagess {
            color: black;
        }
    </style>
</head>

<body>

    <!-- Registrar Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="{{ route('registrar') }}">
            <i class="fas fa-user-graduate"></i><span class="pagess"> Registrar Page </span>
        </a>
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('registrar') }}">
                            <i class="fas fa-home"></i> Registrar
                        </a>
                    </li>

                    <!-- Registrar Management Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="registrarDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-cogs"></i> What to DO?
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('registrar.students') }}">
                                    <i class="fas fa-check-circle"></i> Manage Students
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('registrar.notify') }}">
                                    <i class="fas fa-check-circle"></i> Manage Notifications
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('registrar.notify') }}">
                                    <i class="fas fa-file-alt"></i> Policies & Regulations
                                </a>
                            </li>
                        </ul>

                    </li>

                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> <!-- Person Icon -->
                            <!-- Displaying username from session -->
                            @if(session('username'))
                            Welcome, {{ session('username') }}
                            @endif
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                            <!-- Edit Profile Option -->
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-edit"></i> Edit Profile
                                </a>
                            </li>

                            <!-- Logout Option -->
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item btn"><i class="fas fa-sign-out-alt"></i>
                                        Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>