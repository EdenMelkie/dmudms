@extends('layouts.app')

@section('content')
<style>
<<<<<<< HEAD
    body {
        background: url('/path-to-your-image.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Arial', sans-serif;
    }

    .card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .card-header {
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        color: #333;
        background-color: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
    }

    .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-link {
        color: #007bff;
    }

    .btn-link:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .form-check-label {
        color: #333;
    }

    .error-message {
        color: red;
        font-size: 1rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    #loginForm {
        display: none;
    }

    .loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(255, 255, 255, 0.8);
        z-index: 1000;
    }
</style>

<!-- Loading indicator (hidden by default, shown via JS) -->
<div class="loading" style="display: none;">Loading...</div>

=======
body {
    background: url('/path-to-your-image.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: 'Arial', sans-serif;
}

.card {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.card-header {
    font-size: 1.5rem;
    font-weight: bold;
    text-align: center;
    color: #333;
    background-color: #f8f9fa;
    border-bottom: 2px solid #e9ecef;
}

.form-control {
    border-radius: 5px;
    border: 1px solid #ced4da;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-link {
    color: #007bff;
}

.btn-link:hover {
    color: #0056b3;
    text-decoration: underline;
}

.form-check-label {
    color: #333;
}

.error-message {
    color: red;
    font-size: 1rem;
    font-weight: bold;
    margin-bottom: 10px;
}
</style>

>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
<<<<<<< HEAD
=======
                    <!-- Display the error message in red if there is an error -->
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
                    @if(session('error'))
                    <div class="error-message">
                        {{ session('error') }}
                    </div>
                    @endif

<<<<<<< HEAD
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
=======
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="username"
                                class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276

                            <div class="col-md-6">
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
<<<<<<< HEAD
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
=======
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<<<<<<< HEAD
<script>
    // Show loading immediately when page starts loading
    document.addEventListener('DOMContentLoaded', function() {
        var loadingDiv = document.querySelector('.loading');
        var loginForm = document.getElementById('loginForm');
        
        // Show loading indicator
        loadingDiv.style.display = 'flex';
        
        // Check user type
        var userType = "{{ session('userType') }}";
        
        if (userType) {
            try {
                let routeUrl;
                
                const routes = {
                    'Admin': "{{ route('admin') }}",
                    'Proctor': "{{ route('proctor') }}",
                    'Directorate': "{{ route('directorate') }}",
                    'Coordinator': "{{ route('coordinator') }}",
                    'Student': "{{ route('student') }}",
                    'Registrar': "{{ route('registrar') }}",
                    'Maintenance': "{{ route('maintenance') }}"
                };
                
                if (routes[userType]) {
                    window.location.href = routes[userType];
                } else {
                    console.log('Unknown userType: ', userType);
                    showLoginForm();
                }
            } catch (e) {
                console.error("Error while redirecting:", e);
                showLoginForm();
            }
        } else {
            showLoginForm();
        }
        
        function showLoginForm() {
            loginForm.style.display = 'block';
            loadingDiv.style.display = 'none';
        }
    });
</script>
=======
>>>>>>> 2f20f73a4a564310b533c9bd07a33dddc6cdf276
@endsection