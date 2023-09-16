<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'email' => 'admin@example.com'
        ]);

        $phpCategory = Category::factory()->create(['title' => 'PHP']);
        $jsCategory = Category::factory()->create(['title' => 'JavaScript']);
        $htmlCategory = Category::factory()->create(['title' => 'HTML']);
        $laravelCategory = Category::factory()->create(['title' => 'Laravel']);
        $mysqlCategory = Category::factory()->create(['title' => 'MySQL']);
        $gitCategory = Category::factory()->create(['title' => 'Git']);
        $linuxCategory = Category::factory()->create(['title' => 'Linux']);
        $dockerCategory = Category::factory()->create(['title' => 'Docker']);
        $laravelTestingTag = Tag::factory()->create(['title' => 'Testing', 'category_id' => $laravelCategory->id]);
        $laravelStorageTag = Tag::factory()->create(['title' => 'Storage', 'category_id' => $laravelCategory->id]);

        Post::factory()
            ->hasAttached([$laravelTestingTag, $laravelStorageTag])
            ->create([
                'title' => 'How to test code that uses Laravel Storage temporaryUrl method',
                'category_id' => $laravelCategory->id,
            ]);


    }
}
