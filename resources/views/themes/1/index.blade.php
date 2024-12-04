@extends('themes.base.app')
@section('page')
    <div
        id="page-container"
        class="mx-auto flex min-h-dvh w-full min-w-[320px] flex-col bg-gray-100 dark:bg-gray-900 dark:text-gray-100"
    >
        <main id="page-content" class="flex max-w-full flex-auto flex-col">
            <div
                class="relative overflow-hidden bg-white dark:bg-gray-900 dark:text-gray-100"
            >
                <header
                    id="page-header"
                    class="bg-blue-900 relative flex flex-none items-center py-8"
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
                                <a
                                    href="javascript:void(0)"
                                    class="text-sm font-semibold text-gray-100 hover:text-blue-300"
                                >
                                    <span>About</span>
                                </a>
                                <a
                                    href="javascript:void(0)"
                                    class="text-sm font-semibold text-gray-100 hover:text-blue-300"
                                >
                                    <span>Posts</span>
                                </a>
                                <a
                                    href="javascript:void(0)"
                                    class="text-sm font-semibold text-gray-100 hover:text-blue-300"
                                >
                                    <span>Contacts</span>
                                </a>
                            </nav>
                        </div>
                    </div>
                </header>
            </div>
            <div class="bg-gray-100 dark:bg-gray-800/50 dark:text-gray-100">
                <div
                    class="container mx-auto space-y-16 px-4 py-16 lg:px-8 lg:py-32 xl:max-w-7xl"
                >
                    <div>
                        <svg
                            class="hi-solid hi-code-bracket-square -ml-2.5 mb-5 inline-block size-16 text-blue-600"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M3 6a3 3 0 013-3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm14.25 6a.75.75 0 01-.22.53l-2.25 2.25a.75.75 0 11-1.06-1.06L15.44 12l-1.72-1.72a.75.75 0 111.06-1.06l2.25 2.25c.141.14.22.331.22.53zm-10.28-.53a.75.75 0 000 1.06l2.25 2.25a.75.75 0 101.06-1.06L8.56 12l1.72-1.72a.75.75 0 10-1.06-1.06l-2.25 2.25z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <h2 class="mb-3 text-4xl font-black text-black dark:text-white">
                            About the author
                        </h2>
                        <h3
                            class="text-xl font-medium leading-relaxed text-gray-800 lg:w-1/2 dark:text-gray-300"
                        >
                            I'm a full-stack web developer from Lviv, Ukraine. I have 8+ years of experience in building web applications with PHP and JavaScript.
                        </h3>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-900 dark:text-gray-100">
                <div class="container mx-auto space-y-16 px-4 py-5 lg:px-8 lg:py-10 xl:max-w-7xl">
                    <div class="text-center">
                        <h2 class="mb-2 text-4xl font-black text-black dark:text-white">
                            Experience heatmap
                        </h2>
                    </div>
                    <x-experience-heatmap />
                </div>
            </div>
            <footer
                id="page-footer"
                class="bg-blue-900 text-gray-100"
            >
                <div
                    class="container mx-auto flex flex-col gap-6 px-4 py-16 text-center text-sm lg:flex-row-reverse lg:gap-0 lg:px-8 lg:py-32 xl:max-w-7xl"
                >
                    <nav class="space-x-4 lg:w-1/3 lg:text-right">
                        <a
                            href="javascript:void(0)"
                            class="text-gray-400 hover:text-gray-800 dark:hover:text-white"
                        >
                            <svg
                                class="bi bi-twitter-x inline-block size-5"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor"
                                viewBox="0 0 16 16"
                                aria-hidden="true"
                            >
                                <path
                                    d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"
                                />
                            </svg>
                        </a>
                        <a
                            href="javascript:void(0)"
                            class="text-gray-400 hover:text-[#1877f2]"
                        >
                            <svg
                                class="icon-facebook inline-block size-5"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                            >
                                <path
                                    d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.378 14.192 5 15.115 5H18V0h-3.808C10.596 0 9 1.583 9 4.615V8z"
                                ></path>
                            </svg>
                        </a>
                        <a
                            href="javascript:void(0)"
                            class="text-gray-400 hover:text-[#405de6]"
                        >
                            <svg
                                class="icon-instagram inline-block size-5"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                            >
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"
                                ></path>
                            </svg>
                        </a>
                        <a
                            href="javascript:void(0)"
                            class="text-gray-400 hover:text-[#333] dark:hover:text-gray-50"
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
                    <nav class="space-x-2 sm:space-x-4 lg:w-1/3 lg:text-center">
                        <a
                            href="javascript:void(0)"
                            class="font-medium text-white/80 hover:text-white"
                        >
                            Terms & conditions
                        </a>
                        <a
                            href="javascript:void(0)"
                            class="font-medium text-white/80 hover:text-white"
                        >
                            Cookie policy
                        </a>
                        <a
                            href="javascript:void(0)"
                            class="font-medium text-white/80 hover:text-white"
                        >
                            Privacy policy
                        </a>
                    </nav>
                    <div class="text-white/70 lg:w-1/3 lg:text-left">
                        <span class="font-medium">Prostocode</span> © {{date('Y')}}
                    </div>
                </div>
            </footer>
        </main>
    </div>
@endsection

