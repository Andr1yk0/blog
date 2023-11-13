<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Sitemap\SitemapGenerator;

class SettingsAdminController extends Controller
{
    public function index(): View
    {
        return view('admin.settings.index');
    }

    public function generateSitemap(): RedirectResponse
    {
        SitemapGenerator::create('https://prostocode.com')->writeToFile(public_path('sitemap.xml'));
        return redirect()->back()->with('success', 'Sitemap generated successfully!');
    }
}
