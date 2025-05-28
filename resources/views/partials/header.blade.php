<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'DMU_DMS') }}</a> -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img width="40px" height="40px" src="{{ asset('images/dmu-logo.png') }}" alt="DMU Logo" />
            <span>DMU Dormitory Management System</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Left Navigation Links -->
            <ul class="navbar-nav me-auto">


                <li class="nav-item">
                    <a class="nav-link" href="{{ route('placements.search') }}">View Assignments</a>
                </li>
                <!-- Add custom styling to the About and Help links -->
                <li class="nav-item about-link">
                    <a class="nav-link" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item help-link">
                    <a class="nav-link" href="{{ route('help') }}">Help</a>
                </li>
            </ul>

            <!-- Right Side: Login/Logout -->
            <ul class="navbar-nav">
                @guest
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-success" href="{{ route('login') }}">Login</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


<style>
    /* General navbar styles */
    .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1050;
        background: linear-gradient(135deg, #2e7d32, #66bb6a);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        padding: 12px 0;
        border-radius: 0 0 10px 10px;
        transition: top 0.3s ease;
        /* smooth sliding */

    }



    /* Brand/logo styles */
    .navbar-brand {
        font-size: 2rem;
        font-weight: 700;
        color: #ffffff !important;
        text-transform: uppercase;
        font-family: 'Segoe UI', sans-serif;
        letter-spacing: 1px;
    }

    /* Toggler styles */
    .navbar-toggler {
        border: none;
    }

    .navbar-toggler-icon {
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="%23fff" viewBox="0 0 30 30"><path d="M4 7h22v2H4zm0 7h22v2H4zm0 7h22v2H4z"/></svg>');
    }

    /* Nav links */
    .navbar-nav .nav-link {
        color: #fff !important;
        font-size: 1rem;
        font-weight: 500;
        padding: 8px 12px;
        margin: 0 6px;
        border-radius: 4px;
        transition: all 0.3s ease-in-out;
    }

    /* Hover effect for nav links */
    .navbar-nav .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.15);
        color: #ffeb3b !important;
        transform: scale(1.05);
    }

    /* Underline animation */
    .navbar-nav .nav-item {
        position: relative;
    }

    .navbar-nav .nav-item::after {
        content: '';
        position: absolute;
        bottom: 3px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background: #ffeb3b;
        transition: width 0.3s ease;
    }

    .navbar-nav .nav-item:hover::after {
        width: 80%;
    }

    /* Login/Logout button style */
    .navbar-nav .btn {
        padding: 6px 14px;
        font-size: 0.95rem;
        border-radius: 20px;
    }


    /* Container width */
    .container {
        max-width: 1200px;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .navbar-brand {
            font-size: 1.4rem;
        }

        .navbar-nav .nav-link {
            font-size: 0.95rem;
            margin: 4px 0;
        }

        .navbar-nav .nav-item::after {
            display: none;
        }
    }
</style>