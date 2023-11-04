<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug'
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    public function publishedPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class)->whereNotNull('published_at');
    }

    public function subTags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'sub_tags', 'tag_id', 'sub_tag_id');
    }

    public function mainTags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'sub_tags', 'sub_tag_id', 'tag_id');
    }
}
