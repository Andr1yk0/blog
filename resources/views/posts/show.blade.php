@extends('layouts.app')
@section('content')
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
        <div class="grid grid-cols-1 items-start gap-x-8 gap-y-8 md:grid-cols-3">
            <x-card>
                <x-slot:header>
                    <h3 class="text-base font-semibold leading-6 text-text-clr-900">Top tags</h3>
                </x-slot>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                        <x-tag :tag="$tag"/>
                    @endforeach
                </div>
            </x-card>
            <div class="grid grid-cols-1 md:col-span-2">
                <x-card>
                    <div class="group relative">
                        <div class="flex items-center gap-x-4">
                            <time datetime="{{ $post->published_at->format('Y-m-d') }}"
                                  class="block text-sm leading-6 text-text-clr-600"
                            >
                                {{ $post->published_at_formatted }}
                            </time>
                            @foreach($post->tags as $tag)
                                <x-tag :tag="$tag"/>
                            @endforeach
                        </div>
                        <h1 class="mt-2 text-2xl font-semibold text-text-clr-900">
                            {{ $post->title }}
                        </h1>
                    </div>
                    <hr class="my-5">
                    <div class="mx-auto prose prose-base lg:prose-lg prose-pre:mt-2 prose-p:mb-0 mb-5">
                        {!! $post->body_html !!}
                    </div>
                    <hr class="my-5">
                    <div class="flex">
                        @if($post->previous)
                            <div class="relative py-5 hover:bg-text-clr-100 basis-1/2">
                                <div class="mx-auto flex gap-x-2 px-4">
                                    <div class="flex items-center gap-x-2">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-text-clr-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                        </svg>
                                    </div>
                                    <div class="flex gap-x-4 flex-1">
                                        <div class="min-w-0 flex-auto">
                                            <p class="text-sm text-center font-semibold leading-6 text-text-clr-900">
                                                <a href="{{ route('posts.show', [$post->previous->slug]) }}">
                                                    <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                                    {{ $post->previous->title }}
                                                </a>
                                            </p>
                                            <p class="mt-1 text-center text-xs leading-5 text-text-clr-500">
                                                {{ $post->previous->published_at_formatted }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($post->next)
                            <div class="relative py-5 hover:bg-text-clr-100 basis-1/2 ml-auto">
                                <div class="mx-auto flex gap-x-2 px-4">
                                    <div class="flex gap-x-4 flex-1">
                                        <div class="min-w-0 flex-auto">
                                            <p class="text-sm text-center font-semibold leading-6 text-text-clr-900">
                                                <a href="{{ route('posts.show', [$post->next->slug]) }}">
                                                    <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                                    {{ $post->next->title }}
                                                </a>
                                            </p>
                                            <p class="mt-1 text-xs leading-5 text-text-clr-500 text-center">
                                                {{ $post->next->published_at_formatted }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-x-2">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-text-clr-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </x-card>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ mix('js/pages/posts-show.js') }}"></script>
@endpush
