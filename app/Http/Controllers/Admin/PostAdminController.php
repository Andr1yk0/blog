<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostEditAdminRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Services\PostsService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\QueryBuilder\QueryBuilder;

class PostAdminController extends Controller
{
    public function index(): View
    {
        $query = Post::with('tags');
        $posts = QueryBuilder::for($query)
            ->allowedFilters(['title', 'content', 'tags.title'])
            ->allowedSorts(['id', 'title', 'slug', 'published_at', 'updated_at', 'created_at'])
            ->paginate(10)
            ->appends(request()->query());
        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        $formAction = route('admin.posts.store');
        $tags = Tag::all();
        return view('admin.posts.create', compact('formAction', 'tags'));
    }

    public function store(PostEditAdminRequest $request, PostsService $postsService): RedirectResponse
    {
        $postsService->create($request->all());
        return redirect()->route('admin.posts.index')->with('success', 'Post created');
    }

    public function edit(Post $post): View
    {
        $formAction = route('admin.posts.update', $post);
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'formAction', 'tags'));
    }

    public function update(Post $post, PostEditAdminRequest $request, PostsService $postsService): RedirectResponse
    {
        $postsService->update($post, $request->all());
        return redirect()->route('admin.posts.index')->with('success', 'Post updated');
    }
}
