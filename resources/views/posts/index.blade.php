@extends('layouts.app')
@section('content')
    <x-header-google-add />
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
        <div class="grid grid-cols-1 items-start gap-x-8 gap-y-8 md:grid-cols-3">
            <div>
                <x-top-tags />
                <x-sidebar-google-add />
            </div>
            <div class="grid grid-cols-1 order-first md:order-last md:col-span-2">
                <x-card>
                    <x-slot:header>
                        <div class="-ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap">
                            <div class="ml-4 mt-2">
                                <h1 class="text-xl font-semibold leading-6 text-text-clr-900">
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
                                        class="mt-2 block w-full rounded-md border-0 bg-text-clr-50 py-1.5 pl-3 pr-10 text-text-clr-900 ring-1 ring-inset ring-text-clr-300 focus:ring-2 focus:ring-clr-600 sm:text-sm sm:leading-6"
                                    >
                                        <option value="">Newest first</option>
                                        <option value="published_at">Oldest first</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </x-slot>
                    <div class="divide-y divide-text-clr-300">
                            @foreach($posts as $post)
                                <article class="py-10">
                                    <div class="group relative max-w-xl">
                                        <div class="flex items-center gap-x-4">
                                            <time datetime="{{ $post->published_at->format('Y-m-d') }}"
                                                  class="block text-sm leading-6 text-text-clr-500"
                                            >
                                                {{ $post->published_at_formatted }}
                                            </time>
                                            <div class="flex gap-1">
                                                @foreach($post->tags as $tag)
                                                    <x-tag :tag="$tag"/>
                                                @endforeach
                                            </div>
                                        </div>
                                        <h2 class="mt-2 text-xl font-semibold text-text-clr-900 hover:underline underline-offset-4 decoration-clr-400">
                                            <a href="{{ route('posts.show', [$post->slug]) }}">
                                                {{ $post->title }}
                                            </a>
                                        </h2>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                        {{$posts->links()}}
                </x-card>
            </div>
        </div>
    </div>
    <x-footer-google-add />
@endsection
