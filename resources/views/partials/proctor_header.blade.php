<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proctor Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
    /* Remove default body padding and margin */
    body,
    html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
    }

    /* Ensure navbar spans full width */
    .navbar {
        background-color: lightcoral;
        color: black;
        width: 100%;
        margin: 0;
    }

    /* Remove padding from the container */
    .container-fluid {
        padding-left: 0;
        padding-right: 0;
        width: 100vw;
        /* Ensures full width */
    }

    /* Navbar styling */
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

    /* Navbar links adjustments for mobile responsiveness */
    .navbar-toggler {
        border-color: transparent;
    }

    /* Side dropdown adjustments */
    .dropdown-menu {
        position: absolute;
        top: 50px;
        left: -200px;
        /* Adjust left position */
        width: 200px;
        z-index: 1000;
    }

    .dropdown-item {
        width: 100%;
    }

    /* Adjust dropdown items for side menu */
    .dropdown-menu.show {
        display: block;
    }

    /* Custom styling for the side dropdown */
    .navbar-nav .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        position: absolute;
        left: 0;
        top: 100%;
    }

    /* Media query for mobile */
    @media (max-width: 768px) {
        .navbar-toggler {
            border-color: transparent;
        }
    }
    </style>
</head>

<body>

    <!-- Proctor Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="{{ route('proctor') }}">
            <i class="fas fa-user-shield"></i><span class="pagess"> Proctor Page </span>
        </a>
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('proctor') }}">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>

                    <!-- Proctor Management Dropdown (Side menu) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="proctorDropdown" role="button"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-cogs"></i> Dormitory Management
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('proctor.viewRooms') }}">
                                    <i class="fas fa-door-open"></i> View Rooms</a></li>
                            <li><a class="dropdown-item" href="{{ route('proctor.approveRequests') }}">
                                    <i class="fas fa-check-circle"></i> Approve Requests</a></li>
                            <li><a class="dropdown-item" href="{{ route('proctor.reportProperty') }}">
                                    <i class="fas fa-exclamation-triangle"></i> Report Property Issues</a></li>
                            <li><a class="dropdown-item" href="{{ route('proctor.updateStudentStatus') }}">
                                    <i class="fas fa-user-edit"></i> Update Student Status</a></li>
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