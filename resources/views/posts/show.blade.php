@extends('layouts.app')
@section('content')
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
        <div class="grid grid-cols-1 items-start gap-x-8 gap-y-8 md:grid-cols-3">
            <x-card>
                <x-slot:header>
                    <h3 class="text-base font-semibold leading-6 text-gray-900">Top tags</h3>
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
                                  class="block text-sm leading-6 text-gray-600"
                            >
                                {{ $post->published_at_formatted }}
                            </time>
                            @foreach($post->tags as $tag)
                                <x-tag :tag="$tag"/>
                            @endforeach
                        </div>
                        <h1 class="mt-2 text-2xl font-semibold text-gray-900">
                            {{ $post->title }}
                        </h1>
                    </div>
                    <hr class="my-5">
                    <div class="mx-auto prose prose-base lg:prose-lg prose-pre:mt-2 prose-p:mb-0">
                        {!! $post->body_html !!}
                    </div>
                </x-card>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ mix('js/pages/posts-show.js') }}"></script>
@endpush
