<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'dmudms') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">


        <div>
            @include('partials.registrar_header')

        </div>

        <div>

            <main class="py-4">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Sidebar Column -->
                        <div class="col-md-3 col-lg-2 bg-light border-end" style="min-height: 100vh;">
                            @include('partials.sidebar_reg')
                        </div>

                        <!-- Main Content Column -->
                        <div class="col-md-9 col-lg-10">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
            @include('partials.footer')
        </div>
</body>



</html>