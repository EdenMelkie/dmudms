<div class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student') }}">
                <i class="fas fa-home"></i> Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('view1') }}">
                <i class="fas fa-bed"></i> View Placement
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('student') }}">
                <i class="fas fa-exchange-alt"></i> Request Replacement
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('emergency.create') }}">
                <i class="fas fa-exclamation-triangle"></i> Manage Emergency
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('emergency.index') }}">
                <i class="fas fa-file-signature"></i> View Emergency
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('requests.create') }}">
                <i class="fas fa-file-signature"></i> Submit Requests
            </a>
        </li>
    </ul>
</div>
