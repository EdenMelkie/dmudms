<div class="p-4 bg-light border rounded-3 shadow-sm">
    <h5 class="mb-4 text-uppercase text-muted font-weight-bold">Registrar Tasks</h5>
    <ul class="nav flex-column">

        <!-- Manage Students -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('registrar.students') ? 'active fw-bold text-primary' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow">
                <i class="fas fa-users me-2"></i> Manage Students
            </a>
        </li>

        <!-- Manage Notifications -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('registrar.notify') ? 'active fw-bold text-primary' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow">
                <i class="fas fa-bell me-2"></i> Manage Notifications
            </a>
        </li>

        <!-- Policies & Regulations -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active fw-bold text-primary' : '' }} d-flex align-items-center py-2 px-3 rounded-3 mb-2 hover-shadow">
                <i class="fas fa-file-alt me-2"></i> Edit Profile
            </a>
        </li>

        <!-- Logout Option -->
        <li class="nav-item mt-4">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 py-2 text-center rounded-pill hover-shadow">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>
