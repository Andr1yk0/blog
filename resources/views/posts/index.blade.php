@extends('layouts.app')
@section('content')
    <div class="bg-gray-50 dark:bg-gray-800/50">
        <div class="container mx-auto p-4 lg:p-8 xl:max-w-7xl">
            <div
                class="space-y-2 py-2 text-center sm:flex sm:items-center sm:justify-between sm:space-y-0 sm:text-left lg:py-0"
            >
                <div class="grow max-w-[65ch]">
                    <h1 class="mb-1 text-xl font-bold">{{isset($pageTag) ? 'Posts about ' . $pageTag->title : 'All posts'}}</h1>
                    @if(isset($pageTag) && $pageTag->description)
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{$pageTag->description}}</p>
                    @endif
                </div>
                <div class="sm:w-48">
                    @php($sort = request()->get('sort') === 'published_at' ? 'published_at' : '')
                    <select
                        class="block w-full rounded-lg border border-gray-200 py-2 pl-3 pr-10 focus:border-clr-500 focus:ring focus:ring-clr-500/50 dark:border-gray-700 dark:bg-gray-800 dark:focus:border-clr-500"
                        x-data="{sort: '{{$sort}}'}"
                        x-init="$watch('sort', (value) => {
                                    let url = window.location.href.split(/[?#]/)[0];
                                    if(value !== ''){
                                        url += '?sort=' + value;
                                    }
                                    window.location = url;
                                })"
                        x-model="sort"
                    >
                        <option value="">Newest first</option>
                        <option value="published_at">Oldest first</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto p-4 lg:p-8 xl:max-w-7xl">
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-12 lg:gap-6">
            <div
                class="rounded-lg lg:col-span-8 dark:bg-gray-900"
            >
                <div>
                    <div class="container mx-auto space-y-10 xl:max-w-7xl">
                        <div class="space-y-4 sm:space-y-10">
                            @foreach($posts as $post)
                                <div
                                    class="flex flex-col overflow-hidden rounded-lg bg-white shadow-sm lg:flex-row dark:bg-gray-800"
                                >
                                    <div
                                        class="w-full p-6 lg:self-center lg:px-10 lg:py-8"
                                    >
                                        <div class="mb-3 inline-flex flex-wrap items-center gap-1">
                                            @foreach($post->tags as $tag)
                                                <div
                                                    class="inline-flex rounded-full bg-clr-100 px-2 py-1 text-sm font-semibold leading-4 text-clr-800 dark:bg-clr-900/75 dark:text-clr-200"
                                                >
                                                    {{$tag->title}}
                                                </div>
                                            @endforeach
                                        </div>
                                        <h4 class="mb-2 text-lg font-bold sm:text-xl">
                                            <a
                                                href="{{route('posts.show', [$post->slug])}}"
                                                class="leading-7 text-gray-800 hover:text-gray-600 dark:text-gray-200 dark:hover:text-gray-400"
                                            >
                                                {{$post->title}}
                                            </a>
                                        </h4>
                                        <p class="mb-3 text-sm text-gray-600 dark:text-gray-400">
                                           <span class="font-medium">{{ $post->published_at_formatted }}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {!! $posts->onEachSide(1)->links() !!}
                    </div>
                </div>
            </div>
            <div
                class="rounded-lg bg-white shadow-sm lg:col-span-4 lg:block dark:bg-gray-800 max-h-max overflow-hidden"
            >
                <div class="bg-gray-50 px-5 py-4 dark:bg-gray-700/50">
                    <h3 class="mb-1 font-semibold">Tags</h3>
                </div>
                <div class="grow p-5">
                    <div
                        class="flex rounded-xl text-gray-400"
                    >
                        <x-top-tags />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
