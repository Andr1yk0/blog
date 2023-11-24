<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function contacts(): View|Factory|Application
    {
        return view('pages.contacts');
    }
}
