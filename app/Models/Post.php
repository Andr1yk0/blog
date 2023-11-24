<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'body_html', 'body_markdown', 'published_at'];

    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => $value ? Carbon::parse($value, 'UTC')->tz(config('app.timezone')) : null,
        );
    }

    public function publishedAtFormatted(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => $this->published_at ? $this->published_at->format('F d, Y') : null,
        );
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function previous(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => $this->where('id', '<', $this->id)->orderBy('id', 'desc')->first()
        );
    }

    public function next(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => $this->where('id', '>', $this->id)->orderBy('id', 'asc')->first()
        );
    }
}
