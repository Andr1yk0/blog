<?php

use App\Models\Tag;

uses(\Tests\AuthUser::class);
uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('tags list', function () {
    $tag = Tag::factory()->create();

    $response = $this->setUser()->get('admin/tags');

    $response->assertStatus(200)
        ->assertSee($tag->title);
});

test('create tag form', function () {
    $response = $this->setUser()->get('admin/tags/create');

    $response->assertStatus(200)
        ->assertSee('Create tag');
});

test('store tag', function () {
    $tagData = Tag::factory()->raw();
    $tagData['sub_tags'] = [];

    $response = $this->setUser()->post('/admin/tags', $tagData);

    $response->assertRedirect('/admin/tags')
        ->assertSessionHas('success', 'Tag created successfully');
    $this->assertDatabaseHas('tags', \Arr::only($tagData, ['title', 'slug']));
});

test('update tag form', function () {
    $tag = Tag::factory()->create();

    $response = $this->setUser()->get('admin/tags/' . $tag->id . '/edit');

    $response->assertStatus(200);
    $response->assertSee('Edit tag');
    $response->assertSee($tag->title);
    $response->assertSee($tag->slug);
});

test('update tag', function () {
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
});

test('delete tag', function () {
    $tag = Tag::factory()->create();

    $response = $this->setUser()->delete('admin/tags/' . $tag->id);

    $response->assertRedirect('/admin/tags')
        ->assertSessionHas('success', 'Tag has been deleted');

    $this->assertDatabaseEmpty('tags');
});