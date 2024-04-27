<?php

namespace Tests\Feature\Controllers;

use App\Models\Post;
use App\Models\Tag;
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

    public function test_posts_by_tag()
    {
        $posts = Post::factory()->published()->count(3)->create();
        $tag = Tag::factory()->create();
        $tag->posts()->attach([$posts[0]->id, $posts[1]->id]);

        $response = $this->get('/posts/tagged/'.$tag->slug);
        $response->assertStatus(200);
        $response->assertSee($posts[0]->title);
        $response->assertSee($posts[1]->title);
        $response->assertDontSee($posts[2]->title);
    }

    public function test_show_published_post(): void
    {
        $post = Post::factory()->published()->create();

        $response = $this->get("/posts/$post->slug");

        $response->assertStatus(200);
        $response->assertSee($post->title);
    }
}
