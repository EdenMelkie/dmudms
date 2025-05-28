<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DMU-DMS</title>
    <link rel="shortcut icon" href="{{ asset('images/debremarkos_logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column min-vh-100">
    <div id="app">
        @include('partials.header')

        <main class="py-4" style="padding-top: 0;">
            <div class="container-fluid">
                <div class="row">
                    <!-- Sidebar Column -->
                    <div class="col-md-3 col-lg-2 bg-light border-end" style="min-height: 100vh;">
                        @include('partials.sidebar')
                    </div>

                    <!-- Main Content Column -->
                    <div class="col-md-9 col-lg-10">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('partials.footer')
    <script>
        let lastScrollTop = 0;
        const header = document.querySelector('.navbar'); // your header class

        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop) {
                // Scrolling down — hide header
                header.style.top = '-80px'; // height of your navbar
            } else {
                // Scrolling up — show header
                header.style.top = '0';
            }

            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        });
    </script>
</body>


</html>