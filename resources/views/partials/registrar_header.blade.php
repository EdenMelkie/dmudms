<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: lightseagreen;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('registrar') }}">
            <img src="{{ asset('images/dmu-logo.png') }}" alt="DMU Logo" style="height: 40px; margin-right: 10px;">
            DMU Dormitory Management System Registrar Page
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Management Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-cogs"></i> Tasks
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('registrar.students') }}"><i class="fas fa-users"></i> Manage Students</a></li>
                        <li><a class="dropdown-item" href="{{ route('registrar.notify') }}"><i class="fas fa-bell"></i> Manage Notifications</a></li>
                        <!-- <li><a class="dropdown-item" href="{{ route('registrar.notify') }}"><i class="fas fa-file-alt"></i> Policies & Regulations</a></li> -->
                    </ul>
                </li>

                <!-- Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i>
                        @if(session('username')) Welcome, {{ session('username') }} @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-edit"></i> Edit Profile</a></li>
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

<style>
    .dropdown-menu {
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: lightcoral;
        color: white;
    }

    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
    }
</style>
