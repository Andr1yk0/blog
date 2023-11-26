<?php

namespace Tests\Unit\Commands;

use File;
use Tests\TestCase;

class GenerateSitemapTest extends TestCase
{
    public function test_generates_sitemap(): void
    {
        $sitemapPath = public_path('sitemap.xml');
        File::delete($sitemapPath);
        $this->artisan('sitemap:generate')->assertSuccessful();

        $this->assertFileExists($sitemapPath);
    }
}
