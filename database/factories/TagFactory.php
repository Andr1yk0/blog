<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tag;
use Illuminate\Support\Str;
use App\Models\Category;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->words(2, true),
            'slug' => function(array $attributes) {
                return  Str::slug($attributes['title']);
            },
            'category_id' => function() {
                return Category::factory()->create()->id;
            }
        ];
    }
}
