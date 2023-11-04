<a href="{{route('posts.index.tagged', [$tag->slug])}}" class="rounded bg-indigo-50 px-2 py-1 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-100">
    {{ $tag->title }}
    @if($tag->published_posts_count)
       <span class="ml-auto w-9 min-w-max whitespace-nowrap rounded-full bg-white px-2 py-0.5 text-center text-xs font-medium leading-5 text-gray-600 ring-1 ring-inset ring-gray-200" aria-hidden="true">{{$tag->published_posts_count}}</span>
    @endif
</a>
