<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class AboutController extends Controller
{
    public function about(): View|Factory|Application
        {
            return view('pages.about', [
                'SEOData' => new SEOData(
                    title: 'About',
                    description: 'Personal blog about web development technologies. I write short posts about problems and solutions that I encounter in my work',
                )
            ]);
        }
}
