<nav class="bg-text-clr-50 shadow mb-6" x-data="{ isMobileMenuOpened: false}">
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex px-2 lg:px-0 justify-between w-full">
                <div class="flex flex-shrink-0 items-center">
                    <a href="/">
                        <img class="block h-8 w-auto lg:hidden" src="{{asset('logo.png')}}" alt="prostocode.com">
                        <img class="hidden h-8 w-auto lg:block" src="{{asset('logo.png')}}" alt="prostocode.com">
                    </a>
                </div>
                <div class="hidden lg:ml-6 lg:flex lg:space-x-8">
                    @foreach($menuItems as $menuItem)
                        <a href="{{$menuItem['url']}}"
                            @class([
                                 'inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium',
                                 'border-clr-500 text-clr-500' => $menuItem['is_active'],
                                 'border-transparent text-text-clr-700 hover:border-text-clr-300 hover:text-text-clr-800' => !$menuItem['is_active'],
                            ])>{{ $menuItem['title'] }}</a>
                    @endforeach
                </div>
                <div class="flex items-center">
                    <button type="button"
                            aria-label="Dark mode switcher"
                            class="rounded-full p-2 text-text-clr-500 hover:text-text-clr-600"
                            @click="isDarkMode = !isDarkMode; isDarkMode ? localStorage.setItem('darkMode', 'true') : localStorage.removeItem('darkMode');"
                    >
                            <x-icons.outline.sun x-show="isDarkMode" />
                            <x-icons.outline.moon x-show="!isDarkMode" />
                    </button>
                </div>
            </div>
            <div class="flex items-center lg:hidden">
                <button type="button"
                        class="inline-flex items-center justify-center rounded-md p-2 text-text-clr-500 hover:text-text-clr-600"
                        aria-controls="mobile-menu"
                        aria-expanded="false"
                        @click="isMobileMenuOpened = !isMobileMenuOpened"
                >
                    <span class="sr-only">Open main menu</span>
                    <x-icons.outline.bars-3 x-cloak x-show="!isMobileMenuOpened" />
                    <x-icons.outline.x-mark x-cloak x-show="isMobileMenuOpened" />
                </button>
            </div>
            <div class="hidden lg:ml-4 lg:flex lg:items-center">
            </div>
        </div>
    </div>
    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-cloak :class="isMobileMenuOpened ? '' : 'hidden'">
        <div class="space-y-1 pb-3 pt-2">
            @foreach($menuItems as $menuItem)
                <a href="{{$menuItem['url']}}"
                    @class([
                         'block border-l-4 py-2 pl-3 pr-4 text-base font-medium',
                         'border-clr-500 text-text-clr-700' => $menuItem['is_active'],
                         'border-transparent text-text-clr-600 hover:bg-text-clr-100 hover:border-text-clr-300 hover:text-text-clr-800' => !$menuItem['is_active'],
                     ])
                >
                    {{ $menuItem['title'] }}
                </a>
            @endforeach
        </div>
    </div>
</nav>
