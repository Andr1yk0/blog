<?php

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\UploadedFile;

uses(\Tests\AuthUser::class);
uses(\Tests\RefreshDatabaseCustom::class);

test('posts list', function () {
    $post = Post::factory()->create();

    $response = $this->setUser()->get('/admin/posts');

    $response->assertStatus(200)
        ->assertSee($post->title);
});

test('create post', function () {
    $postData = Post::factory()->raw();
    $tag = Tag::factory()->create();
    $postData['tags'] = (string) $tag->id;

    $response = $this->setUser()->post('/admin/posts', $postData);

    $response->assertRedirect('/admin/posts');
    $this->assertDatabaseHas('posts', [
        'title' => $postData['title'],
    ]);
});

test('create post page', function () {
    $response = $this->setUser()->get('/admin/posts/create');

    $response->assertSuccessful()->assertSee('Create post');
});

test('edit post page', function () {
    $post = Post::factory()->create();

    $response = $this->setUser()->get("/admin/posts/$post->id/edit");

    $response->assertSuccessful()->assertSee($post->title);
});

test('update post', function () {
    $post = Post::factory()->create();
    $tag = Tag::factory()->create();
    $postData = $post->toArray();
    $postData['title'] = 'new title';
    $postData['tags'] = (string) $tag->id;

    $response = $this->setUser()->patch("/admin/posts/$post->id", $postData);
    $response->assertRedirect('/admin/posts')->assertSessionHas('success');
    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => $postData['title'],
    ]);
    $this->assertDatabaseHas('post_tag', [
        'post_id' => $post->id,
        'tag_id' => $tag->id,
    ]);
});

test('create post with image', function () {
    $postData = Post::factory()->raw();
    $tag = Tag::factory()->create();
    $postData['tags'] = (string) $tag->id;
    $postData['base64_image'] = file_get_contents(base_path('tests/fixtures/base64.txt'));
    $postData['image_text'] = 'test';
    \Storage::fake('public');
    $this->withoutExceptionHandling();
    $response = $this->setUser()->post('/admin/posts', $postData);

    $response->assertRedirect('/admin/posts');

    $post = Post::first();
    \Storage::disk('public')->assertExists($post->image_path);
});

test('delete post', function () {
    $post = Post::factory()->create();
    $tag = Tag::factory()->create();
    $post->tags()->sync([$tag->id]);

    $response = $this->setUser()->delete("/admin/posts/$post->id");

    $response->assertRedirect('/admin/posts')->assertSessionHas('success');
    $this->assertDatabaseEmpty('posts');
    $this->assertDatabaseEmpty('post_tag');
});

test('upload image', function () {
    $storage = \Storage::fake('public');

    $response = $this->setUser()->post('/admin/posts/upload-image', [
        'image' => UploadedFile::fake()->image('test.png')
    ]);

    $response->assertSuccessful();
    $response->assertJsonFragment(['path' => '/storage/media/posts/images/test.png']);
    $storage->assertExists('media/posts/images/test.png');
});