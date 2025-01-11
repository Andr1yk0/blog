<!doctype html>
<html x-data lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="theme-teal">
<div x-data="{
            showProfileDropdown: false,
            showMobileSidebar: false,
            logoutHandler: function () {
                axios.post('logout').then(() => {
                    window.location.href = '/';
                });
            }
        }">
    <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
    <div class="relative z-50 lg:hidden" x-show="showMobileSidebar" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900/80"
             x-show="showMobileSidebar"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
        ></div>
        <div class="fixed inset-0 flex">
            <div class="relative mr-16 flex w-full max-w-xs flex-1"
                 x-show="showMobileSidebar"
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
            >
                <!--
                  Close button, show/hide based on off-canvas menu state.
                -->
                <div class="absolute left-full top-0 flex w-16 justify-center pt-5"
                     x-show="showMobileSidebar"
                     x-transition:enter="transition ease-in-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in-out duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                >
                    <button type="button" class="-m-2.5 p-2.5" @click="showMobileSidebar = false">
                        <span class="sr-only">Close sidebar</span>
                        <x-icons.outline.x-mark class="text-white"/>
                    </button>
                </div>
                <x-admin-sidebar/>
            </div>
        </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-48 lg:flex-col">
        <x-admin-sidebar/>
    </div>

    <div class="lg:pl-48">
        <div
            class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8"
        >
            <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="showMobileSidebar = true">
                <span class="sr-only">Open sidebar</span>
                <x-icons.outline.bars-3/>
            </button>
            <div class="flex flex-1 justify-end gap-x-4 self-stretch lg:gap-x-6">
                <div class="flex items-center gap-x-4 lg:gap-x-6">
                    <div class="relative"
                         @mouseenter="showProfileDropdown = true"
                         @mouseleave="showProfileDropdown = false"
                    >
                        <button
                            id="user-menu-button"
                            type="button"
                            class="-m-1.5 flex items-center p-1.5"
                            aria-expanded="false"
                            aria-haspopup="true"
                        >
                            <span class="sr-only">Open user menu</span>
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-gray-500">
                                <span class="text-sm font-medium leading-none text-white">A</span>
                            </span>
                            <span class="hidden lg:flex lg:items-center">
                                <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">Admin</span>
                                <x-icons.mini.chevron-down class="ml-2 text-gray-400"/>
                            </span>
                        </button>
                        <div
                            class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="user-menu-button"
                            tabindex="-1"
                            x-cloak
                            x-show="showProfileDropdown"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                        >
                            {{--                            <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="user-menu-item-0">Your profile</a>--}}
                            <a href="#" @click="logoutHandler"
                               class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50" role="menuitem"
                               tabindex="-1" id="user-menu-item-1">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="py-10">
            <div class="px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>
</div>
<x-notification/>
<x-loader/>
<script src="{{ mix('js/admin.js') }}"></script>
@stack('scripts')
<script>
    Alpine.start();
</script>
</body>
</html>
