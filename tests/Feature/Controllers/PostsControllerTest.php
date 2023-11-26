<?php

namespace Tests\Feature\Controllers;

use App\Models\Post;
use Tests\TestCase;

class PostsControllerTest extends TestCase
{
    public function test_posts_index_page(): void
    {
        $publishedPost = Post::factory()->published()->create();
        $draftPost = Post::factory()->create();

        $response = $this->get('/posts');

        $response->assertStatus(200);
        $response->assertSee($publishedPost->title);
        $response->assertDontSee($draftPost->title);
    }

    public function test_show_published_post(): void
    {
        $post = Post::factory()->published()->create();

        $response = $this->get("/posts/$post->slug");

        $response->assertStatus(200);
        $response->assertSee($post->title);
    }
}
