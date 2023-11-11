<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\QueryBuilder\QueryBuilder;

class PostsController extends Controller
{
    public function index(Tag $tag = null): View|Application|Factory
    {
        $seoTitle = $tag ? $tag->title . ' posts' : 'Posts';
        $postsQuery = Post::with('tags');
        if($tag) {
            $postsQuery->whereHas('tags', function($query) use ($tag) {
                $query->where('slug', $tag->slug);
            });
        }

        $posts = QueryBuilder::for($postsQuery)
            ->defaultSort('-published_at')
            ->allowedSorts(['published_at'])
            ->paginate(10)
            ->appends(request()->query());

        return view('posts.index', [
            'SEOData' => new SEOData(
                title: $seoTitle,
                description: 'Practical posts about PHP, JavaScript, Docker and other web development technologies.',
            ),
            'tags' => Tag::withCount('publishedPosts')
                ->whereHas('publishedPosts')
                ->orderBy('published_posts_count', 'desc')
                ->get(),
            'posts' => $posts,
            'pageTag' => $tag
        ]);
    }

    public function show(Post $post): View|Application|Factory
    {
        $seoTitle = $post->title;
        $seoDescription = null;
        $firstParagraphMatches = [];
        if(preg_match('/^<p>(.+?)<\/p>/', $post->body_html, $firstParagraphMatches) && isset($firstParagraphMatches[1])) {
            $seoDescription = strip_tags($firstParagraphMatches[1]);
        }
        return view('posts.show', [
            'SEOData' => new SEOData(
                title: $seoTitle,
                description: $seoDescription,
            ),
            'post' => $post,
            'tags' => Tag::withCount('publishedPosts')
                ->whereHas('publishedPosts')
                ->orderBy('published_posts_count', 'desc')
                ->get(),
        ]);
    }
}
