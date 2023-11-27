<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Post;
use App\Models\Tag;
use Tests\AuthUser;
use Tests\RefreshDatabaseCustom;
use Tests\TestCase;

class PostAdminControllerTest extends TestCase
{
    use RefreshDatabaseCustom, AuthUser;

    public function test_posts_list(): void
    {
        $post = Post::factory()->create();

        $response = $this->setUser()->get('/admin/posts');

        $response->assertStatus(200)
            ->assertSee($post->title);
    }

    public function test_create_post(): void
    {
        $postData = Post::factory()->raw();
        $tag = Tag::factory()->create();
        $postData['tags'] = (string)$tag->id;

        $response = $this->setUser()->post('/admin/posts', $postData);

        $response->assertRedirect('/admin/posts');
        $this->assertDatabaseHas('posts', [
            'title' => $postData['title']
        ]);
    }

    public function test_create_post_page(): void
    {
        $response = $this->setUser()->get('/admin/posts/create');

        $response->assertSuccessful()->assertSee('Create post');
    }

    public function test_edit_post_page(): void
    {
        $post = Post::factory()->create();

        $response = $this->setUser()->get("/admin/posts/$post->id/edit");

        $response->assertSuccessful()->assertSee($post->title);
    }

    public function test_update_post(): void
    {
        $post = Post::factory()->create();
        $tag = Tag::factory()->create();
        $postData = $post->toArray();
        $postData['title'] = 'new title';
        $postData['tags'] = (string)$tag->id;

        $response = $this->setUser()->patch("/admin/posts/$post->id", $postData);
        $response->assertRedirect('/admin/posts')->assertSessionHas('success');
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => $postData['title']
        ]);
        $this->assertDatabaseHas('post_tag', [
            'post_id' => $post->id,
            'tag_id' => $tag->id,
        ]);
    }

    public function test_delete_post()
    {
        $post = Post::factory()->create();
        $tag = Tag::factory()->create();
        $post->tags()->sync([$tag->id]);

        $response = $this->setUser()->delete("/admin/posts/$post->id");

        $response->assertRedirect('/admin/posts')->assertSessionHas('success');
        $this->assertDatabaseEmpty('posts');
        $this->assertDatabaseEmpty('post_tag');
    }
}
