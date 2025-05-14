<body>
    <div class="d-flex">
 Ohh        <nav class="bg-dark text-white p-3 vh-100" style="width: 250px;">
            <h4 class="text-white mb-4"><i class="fas fa-user-shield"></i> Admin Tasks</h4>
            <ul class="nav flex-column">
               

                <li class="nav-item mb-2">
                    <a href="{{ route('admin.create_account') }}" class="nav-link text-white">
                        <i class="fas fa-user-plus"></i> Create Account
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('employees.index') }}" class="nav-link text-white">
                        <i class="fas fa-user-edit"></i> View Employees
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('admin.reset_account') }}" class="nav-link text-white">
                        <i class="fas fa-sync-alt"></i> Reset Account
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

        <!-- Main Content Area -->
       
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
