<!-- resources/views/partials/sidebar.blade.php -->

<div class="sidebar">


    <div class="p-4 bg-light border rounded-3 shadow-sm">
        <div class="navbar-brand">
            <i class="fas fa-briefcase"></i> Tasks
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold text-primary' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" href="{{ route('home') }}">
                    <i class="fas fa-home me-2"></i> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('placements.search') ? 'active fw-bold text-primary' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" href="{{ route('placements.search') }}">
                    <i class="fas fa-search me-2"></i> View Assignments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('about') ? 'active fw-bold text-primary' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" href="{{ route('about') }}">
                    <i class="fas fa-info-circle me-2"></i> About
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('help') ? 'active fw-bold text-primary' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" href="{{ route('help') }}">
                    <i class="fas fa-question-circle me-2"></i> Help
                </a>
            </li>

            @guest
            <li class="nav-item mt-4">
                <a class="btn btn-outline-success w-100 py-2 text-center rounded-pill hover-shadow" href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </a>
            </li>
            @else
            <li class="nav-item mt-4">
                <a class="btn btn-outline-danger w-100 py-2 text-center rounded-pill hover-shadow" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            @endguest
        </ul>
    </div>
</div>