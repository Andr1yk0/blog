<?php

test('generates sitemap', function () {
    $sitemapPath = public_path('sitemap.xml');
    File::delete($sitemapPath);
    $this->artisan('sitemap:generate')->assertSuccessful();

    expect($sitemapPath)->toBeFile();
});
