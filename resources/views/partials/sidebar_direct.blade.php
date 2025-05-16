<div class="sidebar">
    <div class="p-4 bg-light border rounded-3 shadow-sm">
        <div class="navbar-brand mb-3">
            <i class="fas fa-briefcase"></i> Tasks
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold text-primary' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" href="{{ route('home') }}">
                    <i class="fas fa-home me-2"></i> Home
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('search.form') ? 'active fw-bold text-primary' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" href="{{ route('placements.search') }}">
                    <i class="fas fa-search me-2"></i> View Assignments
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('directorate.blocks') ? 'active fw-bold text-primary' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" href="{{ route('directorate.blocks') }}">
                    <i class="fas fa-chart-line me-2"></i> Manage Blocks
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('placements.index') ? 'active fw-bold text-primary' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" href="{{ route('placements.index') }}">
                    <i class="fas fa-check-circle me-2"></i> Manage Students
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('notifications') ? 'active fw-bold text-primary' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" href="{{ route('notifications') }}">
                    <i class="fas fa-bell me-2"></i> View Notifications
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active fw-bold text-primary' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" href="{{ route('profile.edit') }}">
                    <i class="fas fa-user-edit me-2"></i> Profile
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
