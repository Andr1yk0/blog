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
                                 'border-clr-500 text-text-clr-700' => $menuItem['is_active'],
                                 'border-transparent text-text-clr-500 hover:border-text-clr-300 hover:text-text-clr-600' => !$menuItem['is_active'],
                            ])>{{ $menuItem['title'] }}</a>
                    @endforeach
                </div>
                <div class="flex items-center">
                    <button type="button"
                            aria-label="Dark mode switcher"
                            class="rounded-full p-2 text-text-clr-500 hover:text-text-clr-600"
                            @click="isDarkMode = !isDarkMode; isDarkMode ? localStorage.setItem('darkMode', 'true') : localStorage.removeItem('darkMode');"
                    >

                        <svg x-show="isDarkMode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
                        </svg>

                        <svg x-show="!isDarkMode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex items-center lg:hidden">
                <button type="button"
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500"
                        aria-controls="mobile-menu"
                        aria-expanded="false"
                        @click="isMobileMenuOpened = !isMobileMenuOpened"
                >
                    <span class="sr-only">Open main menu</span>
                    <svg x-cloak
                         class="h-6 w-6"
                         :class="isMobileMenuOpened ? 'hidden' : 'block'"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         aria-hidden="true"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                    <svg x-cloak class="h-6 w-6" :class="isMobileMenuOpened ? 'block' : 'hidden'" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
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
                         'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' => !$menuItem['is_active'],
                     ])
                >
                    {{ $menuItem['title'] }}
                </a>
            @endforeach
        </div>
    </div>
</nav>
