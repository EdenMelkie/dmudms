<?php
if (session('userType') !== 'Admin') {
    header("Location: " . url('/invalid'));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Custom Styling */
        .navbar {
            background-color: #2C3E50;
        }

        .navbar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: white;
            margin-right: 15px;
        }

        .dropdown-menu {
            background-color: #ffffff;
            /* White background */
            border: 1px solid rgba(0, 0, 0, .15);
        }

        .dropdown-menu .dropdown-item {
            color: #212529;
            /* Dark text color */
            padding: 0.5rem 1.5rem;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #f8f9fa;
            /* Light gray on hover */
            color: #212529;
        }

        /* Ensure dropdown is visible on focus for accessibility */
        .dropdown-menu .dropdown-item:focus {
            background-color: #f8f9fa;
        }

        .btn-logout {
            background-color: #E74C3C;
            color: white;
            border-radius: 5px;
        }

        .btn-logout:hover {
            background-color: #C0392B;
        }
    </style>
</head>

<body>

    <!-- Admin Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="{{ route('admin') }}">
            <i class="fas fa-user-shield"></i> Admin Page
        </a>
        <div class="container-fluid">


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin') }}">
                            <i class="fas fa-home"></i> Page
                        </a>
                    </li>

                    <!-- Account Management Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-user-cog"></i> Account Management
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.create_account') }}">
                                    <i class="fas fa-user-plus"></i> Create Account</a></li>
                            <li><a class="dropdown-item" href="{{ route('employees.index') }}">
                                    <i class="fas fa-user-edit"></i> View Employees</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.reset_account') }}">
                                    <i class="fas fa-sync-alt"></i> Reset Account</a></li>
                        </ul>
                    </li>

                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <!-- Displaying username from session -->
                            @if(session('username'))
                            Welcome, {{ session('username') }}
                            @endif
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                            <!-- Edit Profile Option -->
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-edit"></i>
                                    Edit Profile</a></li>

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