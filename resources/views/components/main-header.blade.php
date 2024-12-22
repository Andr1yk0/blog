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
            class="flex flex-col gap-4 text-center md:flex-row md:items-center md:justify-between md:gap-0"
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
        </div>
    </div>
</header>
