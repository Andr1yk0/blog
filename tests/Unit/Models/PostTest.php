<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use Tests\TestCase;
use Tests\RefreshDatabaseCustom;

class PostTest extends TestCase
{
    use RefreshDatabaseCustom;

    public function test_get_previous_post(): void
    {
        $posts = Post::factory()->count(3)->published()->create();
        $secondPost = $posts[1];

        $this->assertEquals($posts[0]->id, $secondPost->previous->id);
        $this->assertNull($posts[0]->previous);
    }

    public function test_get_next_post(): void
    {
        $posts = Post::factory()->count(3)->published()->create();
        $firstPost = $posts[0];

        $this->assertEquals($posts[1]->id, $firstPost->next->id);
        $this->assertNull($posts[2]->next);
    }
}
