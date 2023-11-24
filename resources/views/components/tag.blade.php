<a href="{{route('posts.index.tagged', [$tag->slug])}}" class="rounded bg-clr-100 px-2 py-1 text-sm font-semibold text-clr-700 hover:bg-clr-200">
    {{ $tag->title }}
    @if($tag->published_posts_count)
       <span class="ml-auto w-9 min-w-max whitespace-nowrap rounded-full bg-text-clr-50 px-2 py-0.5 text-center text-xs font-medium leading-5 text-text-clr-700" aria-hidden="true">{{$tag->published_posts_count}}</span>
    @endif
</a>
