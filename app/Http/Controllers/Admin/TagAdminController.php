<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\QueryBuilder\QueryBuilder;

class TagAdminController extends Controller
{
    public function index(): View
    {
        $query = Tag::withCount('posts');
        $tags = QueryBuilder::for($query)
            ->allowedSorts(['id', 'title', 'slug', 'posts_count', 'created_at', 'updated_at'])
            ->paginate(10)
            ->appends(request()->query());

        return view('admin.tags.index', compact('tags'));
    }

    public function create(): View
    {
        $formAction = route('admin.tags.store');

        return view('admin.tags.create', compact('formAction'));
    }

    public function store(): RedirectResponse
    {
        $data = request()->all();
        $tag = Tag::create($data);
        $subTags = $data['sub_tags'] ? explode(',', $data['sub_tags']) : [];
        $tag->subTags()->sync($subTags);

        return redirect()->route('admin.tags.index')->with('success', 'Tag created successfully');
    }

    public function edit(Tag $tag): View
    {
        $formAction = route('admin.tags.update', $tag);

        return view('admin.tags.edit', compact('tag', 'formAction'));
    }

    public function update(Tag $tag): RedirectResponse
    {
        $data = request()->all();
        $tag->update($data);

        $subTags = $data['sub_tags'] ? explode(',', $data['sub_tags']) : [];
        $tag->subTags()->sync($subTags);

        return redirect()->route('admin.tags.index')->with('success', 'Tag updated successfully');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('success', 'Tag has been deleted');
    }
}
