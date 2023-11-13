<?php

namespace App\Services;

use Spatie\Sitemap\SitemapGenerator;

class SitemapService
{
    public function generateSitemap(): SitemapGenerator
    {
        return SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));
    }
}
