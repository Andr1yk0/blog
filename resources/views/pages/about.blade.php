@extends('layouts.app')
@section('content')
    <div class="bg-gray-100 dark:bg-gray-800/50 dark:text-gray-100">
        <div
            class="container mx-auto space-y-16 px-4 py-16 lg:px-8 lg:py-32 xl:max-w-7xl"
        >
            <div>
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
