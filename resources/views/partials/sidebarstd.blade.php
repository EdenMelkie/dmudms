<style>
    .sidebar-link {
        border-radius: 5px;
        transition: background-color 0.2s ease;
        padding: 8px 12px;
    }

    .sidebar-link:hover {
        background-color: #f0f0f0;
        text-decoration: none;
    }
</style>

<div class="sidebar p-3 bg-light border-end h-100">
    <ul class="nav flex-column">
        <!-- <li class="nav-item mb-2">
            <a class="nav-link text-dark sidebar-link" href="{{ route('student') }}">
                <i class="fas fa-home me-2"></i> Home
            </a>
        </li> -->
        <li class="nav-item mb-2">
            <a class="nav-link text-dark sidebar-link" href="{{ route('view1') }}">
                <i class="fas fa-bed me-2"></i> View Placement
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link text-dark sidebar-link" href="{{ route('replacements.index') }}">
                <i class="fas fa-exchange-alt me-2"></i> Request Replacement
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link text-dark sidebar-link" href="{{ route('emergency.create') }}">
                <i class="fas fa-exclamation-triangle me-2"></i> Manage Emergency
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link text-dark sidebar-link" href="{{ route('emergency.index') }}">
                <i class="fas fa-file-signature me-2"></i> View Emergency
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link text-dark sidebar-link" href="{{ route('requests.create') }}">
                <i class="fas fa-file-signature me-2"></i> Submit Requests
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link text-dark sidebar-link" href="{{ route('exit_papers.create') }}">
                <i class="fas fa-file-alt"></i> Exit Paper Form
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link text-dark sidebar-link" href="{{ route('student.edit') }}">
                <i class="fas fa-user-edit me-2"></i> Edit Profile
            </a>
        </li>
        <li class="nav-item mt-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 text-start">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>