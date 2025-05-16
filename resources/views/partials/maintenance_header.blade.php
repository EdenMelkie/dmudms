<?php
if (session('userType') !== 'Maintenance') {
    header("Location: " . url('/invalid'));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Maintainer Panel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />

    <style>
        /* Navbar background */
        .navbar {
            background-color: #90ee90; /* lightgreen */
        }

        .navbar-brand {
            color: black;
            font-weight: 700;
            font-size: 1.4rem;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .nav-link {
            color: black;
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link:focus {
            color: #0b6623; /* darker green */
        }

        /* Dropdown menu */
        .dropdown-menu {
            background-color: #f0f0f0;
        }

        .dropdown-item {
            color: black;
            font-weight: 500;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #dc3545; /* Bootstrap danger red */
            color: white;
        }

        /* Logout button styling inside dropdown */
        .dropdown-item.btn {
            width: 100%;
            text-align: left;
            padding-left: 1rem;
            border: none;
            background: none;
            font-weight: 500;
            color: black;
            cursor: pointer;
        }

        .dropdown-item.btn:hover,
        .dropdown-item.btn:focus {
            background-color: #dc3545;
            color: white;
        }

        /* Show dropdown menu on hover */
        .nav-item.dropdown:hover > .dropdown-menu {
            display: block;
            margin-top: 0; /* Override Bootstrap default margin */
        }

        /* Keep arrow rotated on hover */
        .dropdown-toggle::after {
            transition: transform 0.15s ease-in-out;
        }

        .nav-item.dropdown:hover > .nav-link.dropdown-toggle::after {
            transform: rotate(180deg);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('admin') }}">
                <img src="{{ asset('images/dmu-logo.png') }}" alt="DMU Logo" />
                <span>DMU Dormitory Management System Maintainers Page</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <!-- Maintenance Services Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="maintenanceDropdown" role="button" aria-expanded="false">
                            <i class="fas fa-cogs me-1"></i> Maintenance Services
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="maintenanceDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('maintainer') }}">
                                    <i class="fas fa-list me-2"></i> View Maintenance Requests
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('maintainer') }}">
                                    <i class="fas fa-sync-alt me-2"></i> Update Request Status
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-center" href="#"
                            id="profileDropdown" role="button" aria-expanded="false">
                            <i class="fas fa-user fa-lg"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-edit me-2"></i> Edit Profile
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item btn">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
