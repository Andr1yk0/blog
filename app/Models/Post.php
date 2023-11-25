<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $body_markdown
 * @property string $body_html
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @method static PostFactory factory($count = null, $state = [])
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post published()
 * @method static Builder|Post query()
 * @method static Builder|Post whereBodyHtml($value)
 * @method static Builder|Post whereBodyMarkdown($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post wherePublishedAt($value)
 * @method static Builder|Post whereSlug($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    public function previous(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->where('id', '<', $this->id)
                ->published()
                ->orderBy('id', 'desc')
                ->first()
        );
    }

    public function next(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->where('id', '>', $this->id)
                ->published()
                ->orderBy('id', 'asc')
                ->first()
        );
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublished(Builder $query): void
    {
        $query->whereNotNull('published_at');
    }


}
