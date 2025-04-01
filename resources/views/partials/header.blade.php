<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand"><i>Dormitory Management Systems</i></a>

        <!-- Toggler for responsive navbar -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Login -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>


            </ul>
        </div>
    </div>
</nav>

<style>
/* General navbar styles */
.navbar {
    background: linear-gradient(135deg, #4caf50, #1b6e1e);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    padding: 15px;
}

.navbar-brand {
    font-size: 2.5rem;
    font-weight: bold;
    color: purple;
    text-transform: uppercase;
    font-family: 'Arial', sans-serif;
}

.navbar-toggler {
    border: none;
}

.navbar-toggler-icon {
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="%23fff" viewBox="0 0 30 30"><path d="M4 7h22v2H4zm0 7h22v2H4zm0 7h22v2H4z"/></svg>');
}

.navbar-nav {
    margin-left: auto;
    /* Pushes the links to the right */
}

.navbar-nav .nav-link {
    color: #fff !important;
    font-size: 1rem;
    margin: 0 10px;
    font-weight: 500;
    transition: color 0.3s ease, transform 0.3s ease;
}

.navbar-nav .nav-link:hover {
    color: #ffd700 !important;
    transform: scale(1.1);
}

.navbar-nav .nav-item {
    position: relative;
}

.navbar-nav .nav-item::after {
    content: "";
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 2px;
    background: #ffd700;
    transition: width 0.3s ease;
}

.navbar-nav .nav-item:hover::after {
    width: 100%;
}

.container {
    max-width: 1200px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .navbar-brand {
        font-size: 1.2rem;
    }

    .navbar-nav .nav-link {
        margin: 5px 0;
        font-size: 0.9rem;
    }

    .navbar-nav .nav-item::after {
        display: none;
    }
}
</style>