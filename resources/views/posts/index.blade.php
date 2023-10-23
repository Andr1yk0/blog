@extends('layouts.app')
@section('content')
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
        <div class="grid grid-cols-1 items-start gap-x-8 gap-y-8 md:grid-cols-3">
            <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Top tags</h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <x-tag :tag="$tag"/>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:col-span-2">
                <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
                    <div class="px-4 py-5 sm:px-6">
                        <div class="-ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap">
                            <div class="ml-4 mt-2">
                                <h1 class="text-xl font-semibold leading-6 text-gray-900">
                                    {{isset($pageTag) ? $pageTag->title : 'All'}} posts
                                </h1>
                            </div>
                            <div class="ml-4 mt-2 flex-shrink-0">
                                <div>
                                    @php($sort = request()->get('sort') === 'published_at' ? 'published_at' : '')
                                    <select
                                        x-data="{sort: '{{$sort}}'}"
                                        x-init="$watch('sort', (value) => {
                                                let url = window.location.href.split(/[?#]/)[0];
                                                if(value !== ''){
                                                    url += '?sort=' + value;
                                                }
                                                window.location = url;
                                            })"
                                        x-model="sort"
                                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    >
                                        <option value="">Newest first</option>
                                        <option value="published_at">Oldest first</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 sm:px-6">
                        <div class="divide-y divide-gray-900/10">
                            @foreach($posts as $post)
                                <article class="py-10">
                                    <div class="group relative max-w-xl">
                                        <div class="flex items-center gap-x-4">
                                            <time datetime="{{ $post->published_at->format('Y-m-d') }}"
                                                  class="block text-sm leading-6 text-gray-600"
                                            >
                                                {{ $post->published_at_formatted }}
                                            </time>
                                            @foreach($post->tags as $tag)
                                                <x-tag :tag="$tag"/>
                                            @endforeach
                                        </div>

                                        <h2 class="mt-2 text-lg font-semibold text-gray-900 group-hover:text-gray-600">
                                            <a href="#">
                                                {{ $post->title }}
                                            </a>
                                        </h2>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                    <div class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <div class="flex flex-1 justify-between sm:hidden">
                                <a href="#"
                                   class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                                <a href="#"
                                   class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                            </div>
                            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Showing
                                        <span class="font-medium">1</span>
                                        to
                                        <span class="font-medium">10</span>
                                        of
                                        <span class="font-medium">97</span>
                                        results
                                    </p>
                                </div>
                                <div>
                                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                                         aria-label="Pagination">
                                        <a href="#"
                                           class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                            <span class="sr-only">Previous</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                 aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </a>
                                        <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
                                        <a href="#" aria-current="page"
                                           class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">1</a>
                                        <a href="#"
                                           class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">2</a>
                                        <a href="#"
                                           class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex">3</a>
                                        <span
                                            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>
                                        <a href="#"
                                           class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex">8</a>
                                        <a href="#"
                                           class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">9</a>
                                        <a href="#"
                                           class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">10</a>
                                        <a href="#"
                                           class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                            <span class="sr-only">Next</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                 aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
