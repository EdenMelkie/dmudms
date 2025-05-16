<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorate Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #17a2b8;
            padding: 1rem;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            color: #fff;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .nav-link {
            color: #fff !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #ffd700 !important;
        }

        .dropdown-menu {
            background-color: #ffc107;
            border: none;
        }

        .dropdown-menu .dropdown-item {
            color: #000;
            font-weight: 500;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-logout {
            background-color: #e74c3c;
            color: #fff;
            border-radius: 4px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background-color: #c0392b;
        }

        /* Hoverable Dropdown */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }

        .sidebar-light-green {
            background-color: #d4edda;
            /* Bootstrap's light green */
            color: #155724;
            /* Dark green text */
        }

        /* Make sure all nav links inherit the color */
        .sidebar-light-green .nav-link {
            color: #155724;
        }

        /* On hover, make text a bit darker for contrast */
        .sidebar-light-green .nav-link:hover {
            color: #0b2e13;
        }

        /* Optionally, style active links with a slightly different green or shade */
        .sidebar-light-green .nav-link.active {
            background-color: #c3e6cb;
            color: #0b2e13;
            font-weight: 600;
        }


        /* Responsive Fix */
        @media (max-width: 991.98px) {
            .nav-item.dropdown:hover .dropdown-menu {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Directorate Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('coordinator') }}">
                <img src="{{ asset('images/dmu-logo.png') }}" alt="DMU Logo">
                DMU Dormitory Management System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('coordinator') }}">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>

                    <!-- Directorate Management Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="directorateDropdown" role="button">
                            <i class="fas fa-tasks me-1"></i>Proctor Management
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('coordinator.view_students') }}">
                                    <i class="fas fa-chart-line me-1"></i>View Assignment</a></li>
                            <li><a class="dropdown-item" href="{{ route('coordinator.placement') }}">
                                    <i class="fas fa-check-circle me-1"></i>Manage Proctors</a></li>
                            <li><a class="dropdown-item" href="{{ route('coordinator.blocks') }}">
                                    <i class="fas fa-building me-1"></i>View Blocks</a></li>
                            <li><a class="dropdown-item" href="{{ route('coordinator.proctor.assign') }}">
                                    <i class="fas fa-file-alt me-1"></i>Assign Proctors</a></li>
                        </ul>
                    </li>

                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button">
                            <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-cog me-1"></i>Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                                    </button>
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