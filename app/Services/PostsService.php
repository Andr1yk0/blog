<?php

namespace App\Services;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

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
        if(isset($data['base64_image']) && $data['base64_image'] && $post->image_text){
            \Storage::disk('public')->delete($post->image_path);
            $image = base64_decode(explode(',', $data['base64_image'])[1]);
            \Storage::disk('public')->put($post->image_path, $image);
        }
        return $post;
    }

    public function uploadPhoto(UploadedFile $file)
    {
        $filename = $file->getClientOriginalPath();
        $storagePath = 'media/posts/images';
        \Storage::disk('public')->putFileAs($storagePath, $file, $filename);
        return "/storage/". $storagePath . "/" . $filename;
    }
}
