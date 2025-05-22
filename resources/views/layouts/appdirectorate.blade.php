<style>
    html, body {
        height: 100%;
        margin: 0;
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
        padding-bottom: 250px; /* Add space here */
        margin-bottom: 100px;
    }

    .sidebar {
        background-color: #f8f9fa;
        border-right: 1px solid #dee2e6;
    }

    footer {
        background-color: #f1f1f1;
        padding: 1rem;
        text-align: center;
    }
</style>

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
</body>