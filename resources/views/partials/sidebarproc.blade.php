<nav class="p-3">
    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a href="{{ route('proctor.blockProctors') }}" class="nav-link text-white">
                <i class="fas fa-door-open"></i> View Placement
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('requests.proctor') }}" class="nav-link text-white">
                <i class="fas fa-check-circle"></i> Manage Requests
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('materials.view') }}" class="nav-link text-white">
                <i class="fas fa-exclamation-triangle"></i> Register Room status
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('proctor.viewPlacedStudents') }}" class="nav-link text-white">
                <i class="fas fa-user-edit"></i> View Student Placement
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('exit_papers.viewByProctor') }}" class="nav-link text-white">
                <i class="fas fa-user-graduate me-1"></i> view Exit Papers </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('profile.edit') }}" class="nav-link text-white">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
        </li>

        <li class="nav-item mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</nav>