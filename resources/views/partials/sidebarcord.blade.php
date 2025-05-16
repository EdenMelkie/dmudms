<div class="p-4 border rounded-3 shadow-sm sidebar-light-green">

    <h5 class="mb-4 text-uppercase text-muted font-weight-bold">Tasks</h5>
    <ul class="nav flex-column">

        <!-- View Assignments -->
        <li class="nav-item">
            <a href="{{ route('coordinator.view_students') }}" class="nav-link {{ request()->routeIs('coordinator.view_students') ? 'active fw-bold' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" style="transition: background-color 0.3s;">
                <i class="fas fa-chart-line me-2"></i> View Assignment
            </a>
        </li>

        <!-- Proctor Specific Links -->
        @if(session('userType') === 'Proctor')
            <li class="nav-item">
                <a href="{{ route('proctor.viewRooms') }}" class="nav-link {{ request()->routeIs('proctor.viewRooms') ? 'active fw-bold' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" style="transition: background-color 0.3s;">
                    <i class="fas fa-bed me-2"></i> View Rooms
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('proctor.assignRoom') }}" class="nav-link {{ request()->routeIs('proctor.assignRoom') ? 'active fw-bold' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" style="transition: background-color 0.3s;">
                    <i class="fas fa-user-plus me-2"></i> Assign Room
                </a>
            </li>
        @endif

        <!-- Coordinator Specific Links -->
        @if(session('userType') === 'Coordinator')
            <li class="nav-item">
                <a href="{{ route('coordinator.placement') }}" class="nav-link {{ request()->routeIs('coordinator.placement') ? 'active fw-bold' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" style="transition: background-color 0.3s;">
                    <i class="fas fa-check-circle me-2"></i> Manage Proctors
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('coordinator.blocks') }}" class="nav-link {{ request()->routeIs('coordinator.blocks') ? 'active fw-bold' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" style="transition: background-color 0.3s;">
                    <i class="fas fa-building me-2"></i> View Blocks
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('coordinator.proctor.assign') }}" class="nav-link {{ request()->routeIs('coordinator.proctor.assign') ? 'active fw-bold' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow" style="transition: background-color 0.3s;">
                    <i class="fas fa-file-alt me-2"></i> Assign Proctors
                </a>
            </li>
        @endif

        <!-- Auth Section: Login or Logout -->
        @guest
            <li class="nav-item mt-4">
                <a href="{{ route('login') }}" class="btn btn-outline-success w-100 py-2 text-center rounded-pill hover-shadow">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </a>
            </li>
        @else
            <li class="nav-item mt-4">
                <a href="{{ route('logout') }}" class="btn btn-outline-danger w-100 py-2 text-center rounded-pill hover-shadow"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </li>
        @endguest
    </ul>
</div>
