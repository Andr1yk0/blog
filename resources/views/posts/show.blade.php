@php
    use App\Models\Post;
    /**
     * @var Post $post
     */
@endphp
@extends('layouts.app')
@section('content')
    <!-- Blog Post Section: Left Aligned With Extras -->
    <div class="">
        <div
            class="container mx-auto space-y-16 px-4 py-16 lg:px-8 lg:py-16 xl:max-w-7xl"
        >
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-12 lg:gap-6">
                <div class="rounded-lg bg-white shadow-sm lg:col-span-8 dark:bg-gray-900 overflow-hidden max-h-max">
                    <div class="p-4 md:p-6 lg:p-8">
                        @foreach($post->tags as $postTag)
                            <span
                                class="inline-flex rounded-full bg-clr-100 mb-1 px-2 py-1 text-sm font-semibold leading-4 text-clr-800 dark:bg-clr-900/75 dark:text-clr-200"
                            >
                                {{$postTag->title}}
                            </span>
                        @endforeach
                        <h1 class="mb-4 text-2xl md:text-3xl lg:text-4xl font-black text-black dark:text-white">
                            {{$post->title}}
                        </h1>
                        <h3
                            class="text-md md:text-lg lg:text-xl font-medium leading-relaxed text-gray-700 dark:text-gray-300"
                        >
                          <span class="font-semibold">{{$post->published_at_formatted}}</span>
                        </h3>
                    </div>
                    <div class="px-4 md:px-6 lg:px-8">
                        <article
                            class="prose prose-sm md:prose-lg prose-blue dark:prose-invert prose-a:no-underline hover:prose-a:opacity-75 prose-img:rounded-lg prose-pre:mt-2 prose-p:mb-0"
                        >
                            {!! $post->body_html !!}
                        </article>
                    </div>
                    <div
                        class="mt-10 flex gap-6 bg-gray-50 p-4 text-center text-sm justify-between md:text-left"
                    >
                        <div class="text-gray-500">
                            Share on:
                        </div>
                        <nav class="space-x-4 lg:w-1/3 lg:text-right">
                            <a
                                href="https://twitter.com/intent/tweet?url={{url()->current()}}"
                                class="text-gray-400 hover:text-gray-800 dark:hover:text-white"
                                target="_blank"
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
                            <a href="https://www.facebook.com/sharer.php?u={{url()->current()}}" target="_blank" class="text-gray-400 hover:text-[#1877f2]">
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
                                href="https://www.linkedin.com/shareArticle?mini=true&url={{url()->current()}}"
                                class="text-gray-400 hover:text-[#0077b6]"
                                target="_blank"
                            >
                                <svg
                                    class="bi bi-linkedin inline-block size-5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 16 16"
                                    aria-hidden="true"
                                >
                                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                                </svg>
                            </a>
                            <a
                                href="https://reddit.com/submit?url={{url()->current()}}"
                                class="text-gray-400 hover:text-[#ff4500]"
                                target="_blank"
                            >
                                <svg
                                    class="bi bi-reddit inline-block size-5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 16 16"
                                    aria-hidden="true"
                                >
                                    <path d="M6.167 8a.831.831 0 0 0-.83.83c0 .459.372.84.83.831a.831.831 0 0 0 0-1.661zm1.843 3.647c.315 0 1.403-.038 1.976-.611a.232.232 0 0 0 0-.306.213.213 0 0 0-.306 0c-.353.363-1.126.487-1.67.487-.545 0-1.308-.124-1.671-.487a.213.213 0 0 0-.306 0 .213.213 0 0 0 0 .306c.564.563 1.652.61 1.977.61zm.992-2.807c0 .458.373.83.831.83.458 0 .83-.381.83-.83a.831.831 0 0 0-1.66 0z"/><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.828-1.165c-.315 0-.602.124-.812.325-.801-.573-1.9-.945-3.121-.993l.534-2.501 1.738.372a.83.83 0 1 0 .83-.869.83.83 0 0 0-.744.468l-1.938-.41a.203.203 0 0 0-.153.028.186.186 0 0 0-.086.134l-.592 2.788c-1.24.038-2.358.41-3.17.992-.21-.2-.496-.324-.81-.324a1.163 1.163 0 0 0-.478 2.224c-.02.115-.029.23-.029.353 0 1.795 2.091 3.256 4.669 3.256 2.577 0 4.668-1.451 4.668-3.256 0-.114-.01-.238-.029-.353.401-.181.688-.592.688-1.069 0-.65-.525-1.165-1.165-1.165z"/>
                                </svg>
                            </a>
                            <a
                                href="https://mastodonshare.com/?url={{url()->current()}}"
                                target="_blank"
                                class="text-gray-400 hover:text-[#5c4fe5]"
                            >
                                <svg
                                    class="bi bi-mastodon inline-block size-5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 16 16"
                                    aria-hidden="true"
                                >
                                    <path d="M11.19 12.195c2.016-.24 3.77-1.475 3.99-2.603.348-1.778.32-4.339.32-4.339 0-3.47-2.286-4.488-2.286-4.488C12.062.238 10.083.017 8.027 0h-.05C5.92.017 3.942.238 2.79.765c0 0-2.285 1.017-2.285 4.488l-.002.662c-.004.64-.007 1.35.011 2.091.083 3.394.626 6.74 3.78 7.57 1.454.383 2.703.463 3.709.408 1.823-.1 2.847-.647 2.847-.647l-.06-1.317s-1.303.41-2.767.36c-1.45-.05-2.98-.156-3.215-1.928a3.614 3.614 0 0 1-.033-.496s1.424.346 3.228.428c1.103.05 2.137-.064 3.188-.189zm1.613-2.47H11.13v-4.08c0-.859-.364-1.295-1.091-1.295-.804 0-1.207.517-1.207 1.541v2.233H7.168V5.89c0-1.024-.403-1.541-1.207-1.541-.727 0-1.091.436-1.091 1.296v4.079H3.197V5.522c0-.859.22-1.541.66-2.046.456-.505 1.052-.764 1.793-.764.856 0 1.504.328 1.933.983L8 4.39l.417-.695c.429-.655 1.077-.983 1.934-.983.74 0 1.336.259 1.791.764.442.505.661 1.187.661 2.046v4.203z"/>
                                </svg>
                            </a>
                        </nav>
                    </div>
                </div>
                <div class="lg:col-span-4 max-h-max">
                    <div
                        class="rounded-lg bg-white shadow-sm lg:block dark:bg-gray-900 mb-6 overflow-hidden"
                    >
                        <div class="bg-gray-50 px-5 py-4 dark:bg-gray-700/50">
                            <h3 class="mb-1 font-semibold">Tags</h3>
                        </div>
                        <div class="grow p-5">
                            <div
                                class="flex rounded-xl border-gray-200 text-gray-400 dark:border-gray-700 dark:bg-gray-800"
                            >
                                <x-top-tags />
                            </div>
                        </div>
                    </div>
                    @if($post->related->isNotEmpty())
                        <div
                            class="rounded-lg bg-white overflow-hidden shadow-sm lg:block dark:bg-gray-900 "
                        >
                            <div class="bg-gray-50 px-5 py-4 dark:bg-gray-700/50">
                                <h3 class="mb-1 font-semibold">Similar posts</h3>
                            </div>
                            <nav
                                class="divide-y divide-gray-200 overflow-hidden bg-white dark:divide-gray-700 dark:bg-gray-900 dark:text-gray-100"
                            >
                                @foreach($post->related as $relatedPost)
                                    <a
                                        href="{{ route('posts.show', [$relatedPost->slug]) }}"
                                        class="flex items-center text-sm font-semibold justify-between p-4 text-gray-700 hover:bg-gray-50 hover:text-gray-700 active:bg-white dark:text-gray-200 dark:hover:bg-gray-800/50 dark:active:bg-gray-900"
                                    >
                                        {{$relatedPost->title}}
                                    </a>
                                @endforeach
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ mix('js/pages/posts-show.js') }}"></script>
@endpush
