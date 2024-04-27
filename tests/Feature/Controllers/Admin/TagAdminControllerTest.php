<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AuthUser;
use Tests\TestCase;

class TagAdminControllerTest extends TestCase
{
    use AuthUser, RefreshDatabase;

    public function test_tags_list(): void
    {
        $tag = Tag::factory()->create();

        $response = $this->setUser()->get('admin/tags');

        $response->assertStatus(200)
            ->assertSee($tag->title);
    }

    public function test_create_tag_form(): void
    {
        $response = $this->setUser()->get('admin/tags/create');

        $response->assertStatus(200)
            ->assertSee('Create tag');
    }

    public function test_store_tag(): void
    {
        $tagData = Tag::factory()->raw();
        $tagData['sub_tags'] = [];

        $response = $this->setUser()->post('/admin/tags', $tagData);

        $response->assertRedirect('/admin/tags')
            ->assertSessionHas('success', 'Tag created successfully');
        $this->assertDatabaseHas('tags', \Arr::only($tagData, ['title', 'slug']));
    }

    public function test_update_tag_form(): void
    {
        $tag = Tag::factory()->create();

        $response = $this->setUser()->get('admin/tags/' . $tag->id . '/edit');

        $response->assertStatus(200);
        $response->assertSee('Edit tag');
        $response->assertSee($tag->title);
        $response->assertSee($tag->slug);
    }

    public function test_update_tag(): void
    {
        $tag = Tag::factory()->create();
        $tagData = [
            'title' => 'new title',
            'slug' => 'new-slug',
            'sub_tags' => [],
        ];

        $response = $this->setUser()->put('admin/tags/' . $tag->id, $tagData);

        $response->assertRedirect('/admin/tags')
            ->assertSessionHas('success', 'Tag updated successfully');

        $this->assertDatabaseHas('tags', \Arr::only($tagData, ['title', 'slug']));
        $this->assertDatabaseCount('tags', 1);
    }

    public function test_delete_tag(): void
    {
        $tag = Tag::factory()->create();

        $response = $this->setUser()->delete('admin/tags/' . $tag->id);

        $response->assertRedirect('/admin/tags')
            ->assertSessionHas('success', 'Tag has been deleted');

        $this->assertDatabaseEmpty('tags');
    }
}
