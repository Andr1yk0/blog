<?php

namespace App\Services;

use Psr\Http\Message\UriInterface;
use Spatie\Sitemap\SitemapGenerator;

class SitemapService
{
    public function generateSitemap(): SitemapGenerator
    {
        return SitemapGenerator::create(config('app.url'))
            ->shouldCrawl(function (UriInterface $url){
                parse_str($url->getQuery(), $params);
                return empty($params) || !isset($params['page']) || (int)$params['page'] !== 1;
            })
            ->writeToFile(public_path('sitemap.xml'));
    }
}
