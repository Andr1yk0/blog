@extends('layouts.admin')
@section('header')
    <h1 class="h2">Dashboard</h1>
@endsection
@section('content')
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:gap-8">
        <!-- Card -->
        <div
            class="flex flex-col overflow-hidden rounded-lg bg-white shadow-xs dark:bg-gray-800 dark:text-gray-100"
        >
            <div class="grow p-5">
                <dl class="space-y-1">
                    <dt class="text-2xl font-bold">{{$statsData['publishedPosts']}}</dt>
                    <dd
                        class="text-sm font-semibold tracking-wider text-gray-500 uppercase dark:text-gray-400"
                    >
                        Published posts
                    </dd>
                </dl>
            </div>
        </div>
        <!-- END Card -->

        <!-- Card -->
        <div
            class="flex flex-col overflow-hidden rounded-lg bg-white shadow-xs dark:bg-gray-800 dark:text-gray-100"
        >
            <div class="grow p-5">
                <dl class="space-y-1">
                    <dt class="text-2xl font-bold">{{$statsData['indexedPosts']}}</dt>
                    <dd
                        class="text-sm font-semibold tracking-wider text-gray-500 uppercase dark:text-gray-400"
                    >
                        Indexed posts
                    </dd>
                </dl>
            </div>
        </div>
        <!-- END Simple Card -->

        <!-- Card -->
        <div
            class="flex flex-col overflow-hidden rounded-lg bg-white shadow-xs dark:bg-gray-800 dark:text-gray-100"
        >
            <div class="grow p-5">
                <dl class="space-y-1">
                    <dt class="text-2xl font-bold">$27,910</dt>
                    <dd
                        class="text-sm font-semibold tracking-wider text-gray-500 uppercase dark:text-gray-400"
                    >
                        Wallet
                    </dd>
                </dl>
            </div>
        </div>
        <!-- END Card -->
    </div>
    <x-ad-sense-report/>
@endsection
