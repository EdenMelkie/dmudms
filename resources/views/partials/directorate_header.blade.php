<?php
if (session('userType') !== 'Directorate') {
    header("Location: " . url('/invalid'));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proctor Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Reset body and html margins/paddings */
        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        /* Navbar styling */
        .navbar {
            background-color: lightcoral;
            color: black;
            width: 100%;
            margin: 0;
        }

        .navbar-brand {
            color: black;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: black;
            margin-right: 15px;
            font-size: 1.1rem;
        }

        .dropdown-menu {
            background-color: lightgray;
            border-radius: 5px;
        }

        .dropdown-menu .dropdown-item {
            color: black;
            padding: 10px;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: red;
            color: white;
        }

        .btn-logout {
            background-color: #E74C3C;
            color: black;
            border-radius: 5px;
        }

        .btn-logout:hover {
            background-color: #C0392B;
        }

        .navbar-nav .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            position: absolute;
            left: 0;
            top: 100%;
        }

        /* Navbar mobile styling */
        .navbar-toggler {
            border-color: transparent;
        }

        /* Adjustments for mobile */
        @media (max-width: 768px) {
            .navbar-toggler {
                border-color: transparent;
            }

            .navbar-nav .nav-item .dropdown-menu {
                width: 100%;
                left: 0;
            }
        }

        .pagess {
            color: black;
            font-size: 1.2rem;
            margin-left: 10px;
        }

        /* Navbar toggle button */
        .navbar-toggler-icon {
            background-color: white;
        }
    </style>
</head>

<body>

    <!-- Directorate Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="navbar-brand text-center w-100">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('registrar') }}">
                <img src="{{ asset('images/dmu-logo.png') }}" alt="DMU Logo" style="height: 40px; margin-right: 10px;">
                <span class="pagess">Debremarkos University Student Service Directorate Page</span> </a>
        </div>

        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <!-- Directorate Management Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="directorateDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-tasks"></i> Directorate Management
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('directorate.blocks') }}">
                                    <i class="fas fa-chart-line"></i> Manage Blocks</a></li>
                            <li><a class="dropdown-item" href="{{ route('placements.index') }}">
                                    <i class="fas fa-check-circle"></i> Manage Students</a></li>
                            <li><a class="dropdown-item" href="{{ route('notifications') }}">
                                    <i class="fas fa-check-circle"></i> View Notifications</a></li>
                            <!-- <li><a class="dropdown-item" href="{{ route('notifications') }}">   <i class="fas fa-file-alt"></i> Policies & Regulations</a></li> -->
                        </ul>
                    </li>

                    <!-- Welcome Message -->
                    @if(session('username'))
                    <li class="nav-item">
                        <span class="nav-link text-white">
                            Welcome, {{ session('username') }}!
                        </span>
                    </li>
                    @endif

                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> <!-- Person Icon -->
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-edit"></i> Profile</a></li>
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