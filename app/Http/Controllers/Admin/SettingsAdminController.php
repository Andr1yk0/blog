<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SitemapService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingsAdminController extends Controller
{
    public function index(): View
    {
        return view('admin.settings.index');
    }

    public function generateSitemap(SitemapService $sitemapService): RedirectResponse
    {
        $sitemapService->generateSitemap();

        return redirect()->back()->with('success', 'Sitemap generated successfully!');
    }
}
