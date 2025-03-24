<!doctype html>
<html
    x-cloak
    x-data="appData()"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    @if(isset($SEOData))
        {!! seo($SEOData) !!}
    @endif
    @if((int)request()->query('page') === 1)
        <link rel="canonical" href="{{request()->fullUrlWithoutQuery('page')}}">
    @endif
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @env('production')
        <script
            async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9710254041885287"
            crossorigin="anonymous"
        ></script>
    @endenv
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
<body class="bg-text-clr-200" :class="{dark: isDarkMode, light: !isDarkMode, [themeClass]: true}">
<div
    id="page-container"
    class="mx-auto flex min-h-dvh w-full min-w-[320px] flex-col bg-gray-100 dark:bg-gray-900 dark:text-gray-100"
>
    <main id="page-content" class="flex max-w-full flex-auto flex-col">
        <div class="relative bg-white dark:bg-gray-900 dark:text-gray-100">
            <x-main-header/>
        </div>
        <div class="grow">
            @yield('content')
        </div>

        <footer id="page-footer" class="bg-clr-900 text-gray-100">
            <div
                class="container mx-auto flex flex-col gap-6 px-4 py-16 text-center text-sm lg:flex-row-reverse lg:gap-0 lg:px-8 lg:py-32 xl:max-w-7xl"
            >
                <nav class="space-x-4 lg:w-1/4 lg:text-right">
                    <a
                        href="https://www.linkedin.com/in/andriy-lozynskyy-2a64a898/"
                        class="text-gray-400 hover:text-[#0077b6]"
                        target="_blank"
                    >
                        <svg
                            class="bi bi-linkedin inline-block size-5"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 16 16"
                            aria-hidden="true"
                        >
                            <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                        </svg>
                    </a>
                    <a
                        href="https://stackoverflow.com/users/5712529/andriy-lozynskiy"
                        class="text-gray-400 hover:text-[#f48024]"
                        target="_blank"
                    >
                        <svg class="bi bi-stack-overflow inline-block size-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true"><path d="M12.412 14.572V10.29h1.428V16H1v-5.71h1.428v4.282h9.984z"/><path d="M3.857 13.145h7.137v-1.428H3.857v1.428zM10.254 0 9.108.852l4.26 5.727 1.146-.852L10.254 0zm-3.54 3.377 5.484 4.567.913-1.097L7.627 2.28l-.914 1.097zM4.922 6.55l6.47 3.013.603-1.294-6.47-3.013-.603 1.294zm-.925 3.344 6.985 1.469.294-1.398-6.985-1.468-.294 1.397z"/></svg>
                    </a>
                    <a
                        href="https://github.com/Andr1yk0"
                        class="text-gray-400 hover:text-[#333] dark:hover:text-gray-50"
                        target="_blank"
                    >
                        <svg
                            class="icon-github inline-block size-5"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                        >
                            <path
                                d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"
                            ></path>
                        </svg>
                    </a>
                </nav>
                <nav class="space-x-2 sm:space-x-4 lg:w-1/2 lg:text-center">
                    <a
                        href="{{route('terms')}}"
                        class="font-medium text-white/80 hover:text-white whitespace-nowrap"
                    >
                        Terms & conditions
                    </a>
                    <a
                        href="{{route('cookie-policy')}}"
                        class="font-medium text-white/80 hover:text-white whitespace-nowrap"
                    >
                        Cookie policy
                    </a>
                    <a
                        href="{{route('privacy-policy')}}"
                        class="font-medium text-white/80 hover:text-white whitespace-nowrap"
                    >
                        Privacy policy
                    </a>
                </nav>
                <div class="text-white/70 lg:w-1/4 lg:text-left">
                    <span class="font-medium">Prostocode</span> © {{date('Y')}}
                </div>
            </div>
        </footer>
    </main>
    <x-notification />
    <x-loader />
</div>
<script src="{{ mix('js/app.js') }}"></script>
@stack('scripts')
<script>
    Alpine.data('appData', () => ({
        isDarkMode: localStorage.getItem('darkMode'),
        themeClass: localStorage.getItem('theme') ? localStorage.getItem('theme') : 'theme-teal'
    }))
    Alpine.start();
</script>
</body>
</html>
