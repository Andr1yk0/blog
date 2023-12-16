<!doctype html>
<html
    x-cloak
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    :class="{dark: isDarkMode, light: !isDarkMode}"
    x-data="{isDarkMode: localStorage.getItem('darkMode')}"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($SEOData))
        {!! seo($SEOData) !!}
    @endif
    <link rel="icon" href="{{asset('favicon.ico')}}" sizes="any">
    <link rel="icon" href="{{asset('favicon.png')}}" type="image/png">
    <link rel="apple-touch-icon" href="{{asset('apple-icon.png')}}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
@env('production')
    <script async src="https://www.googletagmanager.com/gtag/js?id={{config('google.ga_measurement_id')}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{config('google.ga_measurement_id')}}');
    </script>
@endenv
<body class="theme-indigo bg-text-clr-200">
<div class="flex flex-col h-screen justify-between">
    <x-main-header />
    <div class="mb-auto">
        @yield('content')
        <x-notification />
    </div>
    <footer class="bg-text-clr-50 mt-10 shadow">
        <div class="mx-auto max-w-7xl p-6 md:flex md:items-center md:justify-between">
            <div class="flex justify-center space-x-6 md:order-2">
                <a href="https://github.com/Andr1yk0" target="_blank" class="text-text-clr-500 hover:text-text-clr-600">
                    <span class="sr-only">GitHub</span>
                    <x-icons.github />
                </a>
                <a href="https://www.linkedin.com/in/andriy-lozynskyy-2a64a898/" target="_blank" class="text-text-clr-500 hover:text-text-clr-600">
                    <span class="sr-only">Linkedin</span>
                    <x-icons.linkedin />
                </a>
            </div>
            <div class="mt-8 md:order-1 md:mt-0">
                <p class="text-center text-xs leading-5 text-text-clr-600">&copy; 2023 prostocode.com. All rights reserved.</p>
            </div>
        </div>
    </footer>
</div>
<script src="{{ mix('js/app.js') }}"></script>
@stack('scripts')
<script>
    Alpine.start();
</script>
</body>
</html>
