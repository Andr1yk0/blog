<div {{$attributes}}>
    @foreach($tags as $tag)
        <a
            href="{{route('posts.index.tagged', [$tag->slug])}}"
            class="inline-flex rounded-full bg-clr-100 mb-1 px-2 py-1 text-sm font-semibold leading-4 text-clr-800 dark:bg-clr-900/75 dark:text-clr-200"
        >
            <span>{{$tag->title}}</span>
            <span class="px-1 text-clr-500">({{$tag->published_posts_count}})</span>
        </a>
    @endforeach
</div>
