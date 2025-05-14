<head>
    <style>
        /* Ensure the dropdown menus are hidden by default */
        .nav-item.dropdown .dropdown-menu {
            display: none;
            position: absolute;
            z-index: 1000;
        }

        /* Show dropdown menu on hover */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }

        /* Optional: Add some spacing between the dropdown and other elements */
        .nav-item.dropdown .dropdown-menu {
            margin-top: 10px;
        }

        /* Optional: Style the dropdown menu to improve visibility */
        .nav-item.dropdown .dropdown-menu {
            background-color: #f8f9fa; /* Light background */
            border-radius: 0.25rem;
        }

        /* Style for each item in the dropdown */
        .nav-item.dropdown .dropdown-item {
            color: #333;
        }

        /* Hover effect on the dropdown items */
        .nav-item.dropdown .dropdown-item:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('proctor') }}">
            <i class="fas fa-user-shield"></i> Proctor Page
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('proctor') }}"><i class="fas fa-home"></i> Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="proctorDropdown" role="button" aria-expanded="false">
                        <i class="fas fa-cogs"></i> Management
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="proctorDropdown">
                        <li><a class="dropdown-item" href="{{ route('proctor.blockProctors') }}">View Placement</a></li>
                        <li><a class="dropdown-item" href="{{ route('requests.proctor') }}">Manage Requests</a></li>
                        <li><a class="dropdown-item" href="{{ route('materials.view') }}">Report Issues</a></li>
                        <li><a class="dropdown-item" href="{{ route('proctor.viewPlacedStudents') }}">Student Placement</a></li>
                    </ul>
                </li>

                <!-- Profile -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-edit"></i> Edit Profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    // Ensure dropdown toggles when clicked
    document.addEventListener('DOMContentLoaded', function () {
        var dropdownToggle = document.querySelectorAll('.dropdown-toggle');
        
        dropdownToggle.forEach(function (toggle) {
            toggle.addEventListener('click', function (e) {
                var dropdownMenu = this.nextElementSibling;
                
                // If dropdown is already open, close it
                if (dropdownMenu.style.display === 'block') {
                    dropdownMenu.style.display = 'none';
                } else {
                    // Otherwise, show the dropdown menu
                    dropdownMenu.style.display = 'block';
                }
                
                // Prevent the default link behavior
                e.preventDefault();
            });
        });
    });
</script>
