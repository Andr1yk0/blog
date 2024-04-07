@php
    use App\Models\Post;
    /**
     * @var Post $post
     */
@endphp
@extends('layouts.app')
@section('content')
    <x-header-google-add />
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-[auto,minmax(71ch,1fr)] items-start gap-x-8 gap-y-8">
            <div>
                <x-card class="mb-6">
                    <x-slot:header>
                        <h3 class="text-base font-semibold leading-6 text-text-clr-900">Top tags</h3>
                    </x-slot>
                    <div class="flex flex-wrap gap-1">
                        @foreach($tags as $tag)
                            <x-tag :tag="$tag"/>
                        @endforeach
                    </div>
                </x-card>
                <x-sidebar-google-add />
                @if($post->related->isNotEmpty())
                    <x-card>
                        <x-slot:header>
                            <h3 class="text-base font-semibold leading-6 text-text-clr-900">Related posts</h3>
                            </x-slot>
                            <ul role="list" class="divide-y divide-text-clr-300">
                                @foreach($post->related as $relatedPost)
                                    <li class="flex flex-wrap items-center justify-between gap-x-6 gap-y-4 py-3 sm:flex-nowrap">
                                        <div>
                                            <p class="leading-6 text-text-clr-950">
                                                <a href="{{ route('posts.show', [$relatedPost->slug]) }}"
                                                   class="hover:underline underline-offset-4 decoration-clr-400"
                                                >
                                                    {{ $relatedPost->title }}
                                                </a>
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                    </x-card>
                @endif
            </div>
            <div class="order-first lg:order-last lg:col-span-2 xl:col-span-1">
                <x-card>
                    <x-slot:header>
                        <div class="group relative max-w-[65ch] mx-auto lg:mx-0">
                            <h1 class="mt-2 text-xl font-semibold text-text-clr-900 mb-4">
                                {{ $post->title }}
                            </h1>
                            <div class="flex items-center gap-x-4">
                                <time datetime="{{ $post->published_at->format('Y-m-d') }}"
                                      class="block text-sm leading-6 text-text-clr-600 text-center"
                                >
                                    {{ $post->published_at_formatted }}
                                </time>
                                <div class="flex gap-1">
                                    @foreach($post->tags as $tag)
                                        <x-tag :tag="$tag"/>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </x-slot>


                    <div class="mx-auto prose prose-base prose-pre:mt-2 prose-p:mb-0 mb-5">
                        {!! $post->body_html !!}
                    </div>
                    <div class="flex flex-wrap mt-16">
                        @if($post->previous)
                            <div class="relative py-5 basis-full hover:bg-text-clr-100 md:basis-1/2">
                                <div class="mx-auto flex gap-x-2 px-4">
                                    <div class="flex items-center gap-x-2">
                                        <x-icons.outline.chevron-left class="text-text-clr-400" />
                                    </div>
                                    <div class="flex gap-x-4 flex-1">
                                        <div class="min-w-0 flex-auto">
                                            <p class="mt-1 text-xs leading-5 text-text-clr-500">
                                                Previous post
                                            </p>
                                            <p class="text-sm font-semibold leading-6 text-text-clr-900">
                                                <a href="{{ route('posts.show', [$post->previous->slug]) }}">
                                                    <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                                    {{ $post->previous->title }}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($post->next)
                            <div class="relative py-5 ml-auto basis-full hover:bg-text-clr-100 md:basis-1/2">
                                <div class="mx-auto flex gap-x-2 px-4">
                                    <div class="flex gap-x-4 flex-1">
                                        <div class="min-w-0 flex-auto">
                                            <p class="mt-1 text-xs leading-5 text-text-clr-500 text-right">
                                                Next post
                                            </p>
                                            <p class="text-sm text-right font-semibold leading-6 text-text-clr-900">
                                                <a href="{{ route('posts.show', [$post->next->slug]) }}">
                                                    <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                                    {{ $post->next->title }}
                                                </a>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="flex items-center gap-x-2">
                                        <x-icons.outline.chevron-right class="text-text-clr-400" />
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </x-card>
                <x-block-google-add />
            </div>
        </div>
    </div>
    <x-footer-google-add />
@endsection
@push('scripts')
    <script src="{{ mix('js/pages/posts-show.js') }}"></script>
@endpush
