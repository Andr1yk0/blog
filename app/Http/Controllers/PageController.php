<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PageController extends Controller
{


    public function posts(): View|Factory|Application
    {

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
