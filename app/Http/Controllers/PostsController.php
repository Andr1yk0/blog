<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\QueryBuilder\QueryBuilder;

class PostsController extends Controller
{
    public function index(?Tag $tag = null): View|Application|Factory
    {
        $seoTitle = $tag ? $tag->title.' posts' : 'Posts';
        $postsQuery = Post::published()->with('tags');
        $description = 'Practical posts about PHP, JavaScript, Docker and other web development technologies.';
        if ($tag) {
            $postsQuery->whereHas('tags', function ($query) use ($tag) {
                $query->where('slug', $tag->slug);
            });
            if($tag->description){
                $description = "Posts about {$tag->title} - {$tag->description}";
            }
        }

        if(request('page') && request('page') != 1){
            $description .= ' Page ' . request('page');
            $seoTitle .= " Page " . request('page');
        }

        $posts = QueryBuilder::for($postsQuery)
            ->defaultSort('-published_at')
            ->allowedSorts(['published_at'])
            ->paginate(10)
            ->appends(request()->query());

        return view('posts.index', [
            'SEOData' => new SEOData(
                title: $seoTitle,
                description: $description,
                image: asset('logo.jpg')
            ),
            'posts' => $posts,
            'pageTag' => $tag,
        ]);
    }

    public function show(Post $post): View|Application|Factory
    {
        return view('posts.show', [
            'SEOData' => new SEOData(
                title: $post->title,
                description: $post->meta_description,
                image: $post->image_url ?? asset('logo.jpg'),
            ),
            'post' => $post,
        ]);
    }
}
