<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;

class TagAdminController extends Controller
{
    public function index(): View
    {
        $tags = Tag::withCount('posts')->paginate(10);
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
            'slug' => 'required|unique:tags'
        ]);

        Tag::create($data);

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
            'slug' => 'required|unique:tags,slug,' . $tag->id
        ]);

        $tag->update($data);

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
