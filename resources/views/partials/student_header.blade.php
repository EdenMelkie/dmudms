<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #007BFF;
        }

        .navbar-brand {
            color: white !important;
            font-size: 1.6rem;
            font-weight: bold;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-size: 1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #FFD700 !important;
        }

        /* Dropdown on hover */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }

        .dropdown-menu {
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .dropdown-menu .dropdown-item {
            color: #333;
            font-weight: 500;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #007BFF;
            color: white;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .btn.dropdown-item {
            width: 100%;
            text-align: left;
            padding: 8px 16px;
        }

        main {
            margin-bottom: 40px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark shadow">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('student') }}">
                <img src="{{ asset('images/dmu-logo.png') }}" alt="DMU Logo">
                <span>DMU Dormitory Management System</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="studentDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-concierge-bell"></i> Student Services
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('view1') }}"><i class="fas fa-bed"></i> View Placement</a></li>
                            <li><a class="dropdown-item" href="{{ route('replacements.index') }}"><i class="fas fa-exchange-alt"></i> Requests</a></li>
                            <li><a class="dropdown-item" href="{{ route('emergency.create') }}"><i class="fas fa-exclamation-triangle"></i> Manage Emergency</a></li>
                            <li><a class="dropdown-item" href="{{ route('emergency.index') }}"><i class="fas fa-file-signature"></i> View Emergency</a></li>
                            <li><a class="dropdown-item" href="{{ route('requests.create') }}"><i class="fas fa-file-signature"></i> Submit Requests</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('student.edit') }}"><i class="fas fa-edit"></i> Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
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