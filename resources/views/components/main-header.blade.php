<header
    id="page-header"
    class="bg-clr-900 relative flex flex-none items-center py-8"
>
    <div
        class="container mx-auto flex flex-col gap-4 px-4 text-center md:flex-row md:items-center md:justify-between md:gap-0 lg:px-8 xl:max-w-7xl"
    >
        <div>
            <a
                href="/"
                class="group inline-flex items-center gap-2 text-lg font-bold tracking-wide text-gray-900 hover:text-gray-600 dark:text-gray-100 dark:hover:text-gray-300"
            >
                <img class="block h-10 w-auto" src="{{asset('logo.svg')}}" alt="prostocode.com">
                <div>
                    <div class="text-gray-100 text-xl text-left">
                        ProstoCode
                    </div>
                    <div class="text-gray-100 text-xs">
                        Web development tips
                    </div>
                </div>
            </a>
        </div>
        <div
            class="flex gap-4 text-center items-center justify-between md:gap-0"
        >
            <nav class="space-x-3 md:space-x-6">
                @foreach($menuItems as $menuItem)
                    <a
                        href="{{$menuItem['url']}}"
                        class="text-sm font-semibold text-gray-100 hover:text-clr-300"
                    >
                        <span>{{$menuItem['title']}}</span>
                    </a>
                @endforeach
            </nav>
            <div class="md:ml-4 flex gap-2">
                <button
                    type="button"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-white/20 bg-transparent px-3 py-2 text-sm font-semibold leading-5 text-gray-100 hover:border-clr-500/75 hover:text-gray-50 hover:shadow-sm focus:ring focus:ring-clr-600/60 active:border-clr-500/50 active:shadow-none"
                    @click="isDarkMode = !isDarkMode; isDarkMode ? localStorage.setItem('darkMode', 'true') : localStorage.removeItem('darkMode');"
                >
                    <svg x-show="!isDarkMode" class="bi bi-sun inline-block size-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                    </svg>
                    <svg x-show="isDarkMode" class="bi bi-moon inline-block size-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z"/>
                    </svg>
                </button>
                <x-theme-switch />
            </div>
        </div>
    </div>
</header>
