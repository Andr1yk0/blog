<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PageController extends Controller
{
    public function about(): View|Factory|Application
    {
        return view('pages.about', [
            'SEOData' => new SEOData(
                title: 'About',
                description: 'Carefully crafted posts and quizzes about web development technologies.',
            )
        ]);
    }

    public function posts(): View|Factory|Application
    {
        return view('pages.posts', [
            'SEOData' => new SEOData(
                title: 'Posts',
                description: 'Practical posts about PHP, JavaScript, Docker and other web development technologies.',
            ),
            'tags' => Tag::withCount('posts')->get(),
        ]);
    }

    public function tests(): View|Factory|Application
    {
        return view('pages.tests');
    }

    public function contacts(): View|Factory|Application
    {
        return view('pages.contacts');
    }
}
