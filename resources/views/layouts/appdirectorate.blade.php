<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DMU DMS</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        #app {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            padding-top: 1.5rem;
            padding-bottom: 3rem;
        }

        .sidebar {
            background-color: #ffffff;
            border-right: 1px solid #dee2e6;
            padding: 1rem;
            min-height: 100vh;
        }

        footer {
            background-color: #ffffff;
            border-top: 1px solid #dee2e6;
            padding: 1rem;
            text-align: center;
            color: #666;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        .btn-link.unassign-btn {
            color: #dc3545;
            font-weight: bold;
        }

        .btn-link.unassign-btn:hover {
            color: #a71d2a;
        }

        .table th {
            background-color: #f1f1f1;
        }

        main{
            margin-bottom: 40px;
        }
    </style>

    @yield('style')
</head>
<body>
    <div id="app">
        @include('partials.directorate_header')

        <main class="py-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-lg-2 sidebar">
                        @include('partials.sidebar_direct')
                    </div>
                    <div class="col-md-9 col-lg-10">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    <footer>
        @include('partials.footer')
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>
