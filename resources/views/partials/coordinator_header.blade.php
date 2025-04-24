<?php
if (session('userType') !== 'Coordinator') {
    header("Location: " . url('/invalid'));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorate Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
    /* Custom Styling */
    .navbar {
        /* background-color: lightslategray; */
        background-color: aqua;
        color: black;
    }

    .navbar-brand {
        color: black;
        /*   lightgrey */
        font-size: 1.5rem;
        font-weight: bold;
    }

    .navbar-nav .nav-link {
        color: black;
        /* lightpink */
        margin-right: 15px;
    }

    .dropdown-menu {
        background-color: goldenrod;
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

    <!-- Directorate Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="{{ route('coordinator') }}">
            <i class="fas fa-briefcase"></i><span class="pagess"> Coordinator Page </span>
        </a>
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('coordinator') }}">
                            <i class="fas fa-home"></i> Page
                        </a>
                    </li>

                    <!-- Directorate Management Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="directorateDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-tasks"></i> Proctor Management
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('coordinator.placement') }}">
                                    <i class="fas fa-chart-line"></i> View Assignment</a></li>
                            <li><a class="dropdown-item" href="{{ route('coordinator.proctor') }}">
                                    <i class="fas fa-check-circle"></i>Manage  Proctors</a></li>
                            <li><a class="dropdown-item" href="{{ route('coordinator.blocks') }}">
                                    <i class="fas fa-check-circle"></i> View Blocks</a></li>
                            <li><a class="dropdown-item" href="{{ route('coordinator.proctor.assign') }}">
                                    <i class="fas fa-file-alt"></i> Assign Proctors</a></li>
                        </ul>
                    </li>

                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> <!-- Person Icon -->
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                            <!-- Edit Profile Option -->
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-edit"></i>
                                    Profile</a></li>

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