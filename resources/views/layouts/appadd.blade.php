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

         <main class="container-fluid">
             <div class="row">
                 <!-- Sidebar -->
                 <div class="col-md-3 col-lg-2 bg-light min-vh-100">
                     @include('partials.sidebar_add')
                 </div>

                 <!-- Main Content -->
                 <div class="col-md-9 col-lg-10 py-4">
                     @yield('content')
                 </div>
             </div>
         </main>

     </div>
     @include('partials.footer')
 </body>

 </html>