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

        Tag::factory()->create(['title' => 'Laravel']);
        Tag::factory()->create(['title' => 'PHP']);
        Tag::factory()->create(['title' => 'MySQL']);
        Tag::factory()->create(['title' => 'HTML/CSS']);
        Tag::factory()->create(['title' => 'GIT']);
    }
}
