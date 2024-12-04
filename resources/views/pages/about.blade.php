@extends('layouts.app')
@section('content')
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
@endsection
