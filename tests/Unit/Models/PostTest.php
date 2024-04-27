<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use App\Models\Tag;
use Tests\RefreshDatabaseCustom;
use Tests\TestCase;

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

    public function test_get_related_posts(): void
    {
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
        $this->assertCount(2, $relatedPosts);
        $this->assertEquals($firstRelated->id, $relatedPosts[0]->id);
        $this->assertEquals($secondRelated->id, $relatedPosts[1]->id);
    }
}
