<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
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
        $data = request()->validate([
            'title' => 'required',
            'slug' => 'required|unique:tags',
            'sub_tags' => 'string',
        ]);

        $tag = Tag::create($data);
        $tag->subTags()->sync(explode(',', $data['sub_tags']));

        return redirect()->route('admin.tags.index')->with('success', 'Tag created successfully');
    }

    public function edit(Tag $tag): View
    {
        $formAction = route('admin.tags.update', $tag);
        return view('admin.tags.edit', compact('tag', 'formAction'));
    }

    public function update(Tag $tag): RedirectResponse
    {
        $data = request()->validate([
            'title' => 'required',
            'slug' => 'required|unique:tags,slug,' . $tag->id,
            'sub_tags' => 'string',
        ]);

        $tag->update($data);
        $tag->subTags()->sync(explode(',', $data['sub_tags']));

        return redirect()->route('admin.tags.index')->with('success', 'Tag updated successfully');
    }

    public function destroy(Tag $tag): JsonResponse
    {
        $tag->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
