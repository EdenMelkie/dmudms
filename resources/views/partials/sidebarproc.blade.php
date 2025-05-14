<nav class="p-3">
    <h4><i class="fas fa-user-shield"></i> Proctor Tasks</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('proctor') }}" class="nav-link text-white">
                <i class="fas fa-home"></i> Homepage
            </a>
        </li>


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
                <i class="fas fa-exclamation-triangle"></i> Report Property Issues
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('proctor.viewPlacedStudents') }}" class="nav-link text-white">
                <i class="fas fa-user-edit"></i> View Student Placement
            </a>
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