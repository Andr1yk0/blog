<?php

namespace App\Console\Commands;

use App\Services\SitemapService;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{

    protected $signature = 'sitemap:generate';
    protected $description = 'Generate sitemap.xml';

    public function handle(SitemapService $sitemapService)
    {
        $sitemapService->generateSitemap();
    }
}
