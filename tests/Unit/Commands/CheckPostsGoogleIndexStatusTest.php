<?php

use App\Console\Commands\CheckPostsGoogleIndexStatus;
use App\Models\Post;
use App\Services\GoogleAPIService;
use Tests\RefreshDatabaseCustom;

uses(RefreshDatabaseCustom::class);

test('checks published posts index status', function () {
    $publishedPost = Post::factory()->published()->create();
    Post::factory()->create();

    $googleServiceMock = $this->mock(GoogleAPIService::class, function ($mock) use ($publishedPost) {
        $mock->shouldReceive('getPageIndexStatus')->with('https://prostocode.com/posts/'. $publishedPost->slug)->once();
    });
    (new CheckPostsGoogleIndexStatus())->handle($googleServiceMock);
});