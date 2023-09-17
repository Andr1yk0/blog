<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($SEOData))
        {!! seo($SEOData) !!}
    @endif
    <link rel="icon" href="{{asset('favicon.ico')}}" sizes="any">
    <link rel="icon" href="{{asset('favicon.png')}}" type="image/png">
    <link rel="apple-touch-icon" href="{{asset('apple-icon.png')}}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
<div id="app">
    <nav
        class="navbar navbar-light shadow-sm navbar-expand-lg bg-white"
        aria-label="Offcanvas navbar large"
    >
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{asset('logo.png')}}" height="35" alt="logo"/>
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar2"
                aria-controls="offcanvasNavbar2"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div
                class="offcanvas offcanvas-end"
                tabindex="-1"
                id="offcanvasNavbar2"
                aria-labelledby="offcanvasNavbar2Label"
            >
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Offcanvas</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="offcanvas"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="/posts">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/tests">Tests</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="app-container container-xxl p-4">
        @yield('content')
    </div>
    <footer class="footer mt-auto py-3 bg-white shadow-sm">
        <div class="container text-center">
            <span class="text-body-secondary">© 2023 Prostocode.com. All rights reserved.</span>
        </div>
    </footer>
</div>
</body>
</html>
