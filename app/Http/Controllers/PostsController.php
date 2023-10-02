<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PostsController extends Controller
{
    public function index(): View|Application|Factory
    {
        return view('posts.index', [
            'SEOData' => new SEOData(
                title: 'Posts',
                description: 'Practical posts about PHP, JavaScript, Docker and other web development technologies.',
            ),
            'tags' => Tag::withCount('posts')->get(),
        ]);
    }
}
