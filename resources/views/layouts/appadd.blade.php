 
 
 <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DMU-DMS</title>
    <link rel="shortcut icon" href="images/debremarkos_logo.png" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <div>
            @include('partials.admin_header')

        </div> <!-- Include the header partial -->

        <main class="py-4">
            @yield('content')
            <!-- Main content area that is specific to the page -->
        </main>
    </div>
    @include('partials.footer')
</body>

</html>
