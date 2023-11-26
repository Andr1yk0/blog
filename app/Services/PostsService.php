<?php

namespace App\Services;

use App\Models\Post;
use Carbon\Carbon;

class PostsService
{
    public function create(array $data): Post
    {
        $post = new Post();
        return $this->save($post, $data);
    }

    public function update(Post $post, array $data): Post
    {
        return $this->save($post, $data);
    }

    public function save(Post $post, array $data): Post
    {
        $data['published_at'] = isset($data['published_at']) ? Carbon::parse($data['published_at'], config('app.timezone'))->setTimezone('UTC') : null;
        $tagIds = explode(',', $data['tags']);
        $post->fill($data);
        $post->save();
        $post->tags()->sync($tagIds);
        return $post;
    }
}
