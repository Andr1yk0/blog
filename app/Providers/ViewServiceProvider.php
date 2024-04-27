<?php

namespace App\Providers;

use App\Models\Tag;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        \View::composer('components.top-tags', function (View $view) {
            $view->with('tags', Tag::withCount('publishedPosts')
                ->whereHas('publishedPosts')
                ->orderBy('published_posts_count', 'desc')
                ->get()
            );
        });
    }
}
