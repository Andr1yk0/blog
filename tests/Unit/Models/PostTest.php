<?php

use App\Models\Post;
use App\Models\Tag;

uses(\Tests\RefreshDatabaseCustom::class);

test('get previous post', function () {
    $posts = Post::factory()->count(3)->published()->create();
    $secondPost = $posts[1];

    expect($secondPost->previous->id)->toEqual($posts[0]->id);
    expect($posts[0]->previous)->toBeNull();
});

test('get next post', function () {
    $posts = Post::factory()->count(3)->published()->create();
    $firstPost = $posts[0];

    expect($firstPost->next->id)->toEqual($posts[1]->id);
    expect($posts[2]->next)->toBeNull();
});

test('get related posts', function () {
    $posts = Post::factory()->count(5)->published()->create();
    $tags = Tag::factory()->count(3)->create();
    $posts[0]->tags()->sync($tags->take(2));

    $firstRelated = $posts[1];
    $firstRelated->tags()->sync($tags);
    $secondRelated = $posts[2];
    $secondRelated->tags()->sync($tags[0]);
    $notRelated = $posts[3];
    $notRelated->tags()->sync($tags[2]);

    $relatedPosts = $posts[0]->related;
    expect($relatedPosts)->toHaveCount(2);
    expect($relatedPosts[0]->id)->toEqual($firstRelated->id);
    expect($relatedPosts[1]->id)->toEqual($secondRelated->id);
});