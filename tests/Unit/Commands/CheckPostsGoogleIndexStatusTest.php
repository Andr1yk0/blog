<?php

namespace Tests\Unit\Commands;

use App\Console\Commands\CheckPostsGoogleIndexStatus;
use App\Models\Post;
use App\Services\GoogleAPIService;
use Tests\TestCase;
use Tests\RefreshDatabaseCustom;

class CheckPostsGoogleIndexStatusTest extends TestCase
{
    use RefreshDatabaseCustom;

    public function test_checks_published_posts_index_status(): void
    {
        $publishedPost = Post::factory()->published()->create();
        Post::factory()->create();

        $googleServiceMock = $this->mock(GoogleAPIService::class, function ($mock) use ($publishedPost) {
            $mock->shouldReceive('getPageIndexStatus')->with('https://prostocode.com/posts/'. $publishedPost->slug)->once();
        });
        (new CheckPostsGoogleIndexStatus())->handle($googleServiceMock);
    }
}
