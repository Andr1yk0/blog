<?php

namespace App\Services;

use App\Models\Post;

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
        $post->fill($data);
        $post->save();
        return $post;
    }
}
