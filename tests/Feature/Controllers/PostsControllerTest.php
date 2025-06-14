<?php

use App\Models\Post;
use App\Models\Tag;

test('posts index page', function () {
    $publishedPost = Post::factory()->published()->create();
    $draftPost = Post::factory()->create();

    $response = $this->get('/posts');

    $response->assertStatus(200);
    $response->assertSee($publishedPost->title);
    $response->assertDontSee($draftPost->title);
});

test('posts by tag', function () {
    $posts = Post::factory()->published()->count(3)->create();
    $tag = Tag::factory()->create();
    $tag->posts()->attach([$posts[0]->id, $posts[1]->id]);

    $response = $this->get('/posts/tagged/'.$tag->slug);
    $response->assertStatus(200);
    $response->assertSee($posts[0]->title);
    $response->assertSee($posts[1]->title);
    $response->assertDontSee($posts[2]->title);
});

test('show published post', function () {
    $post = Post::factory()->published()->create();

    $response = $this->get("/posts/$post->slug");

    $response->assertStatus(200);
    $response->assertSee($post->title);
});
