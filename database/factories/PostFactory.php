<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->words(5, true),
            'slug' => function(array $attributes) {
                return  Str::slug($attributes['title']);
            },
            'body' => fake()->paragraphs(3, true),
            'category_id' => function() {
                return Category::factory()->create()->id;
            }
        ];
    }
}
