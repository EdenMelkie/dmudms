<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'dmudms') }}</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 56px; /* header height */
            left: 0;
            background-color: #343a40;
            padding-top: 1rem;
            z-index: 1000;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
            margin-top: 56px;
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
        }
    </style>

    @yield('styles')
    @stack('scripts')
</head>

<body>
    <div id="app">
        <!-- Header -->
        @include('partials.proctor_header')

        <!-- Sidebar -->
        <div class="sidebar">
            @include('partials.sidebarproc')
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>

        @include('partials.footer')
    </div>
</body>

</html>
