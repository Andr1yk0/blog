<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostEditAdminRequest;
use App\Http\Requests\UploadPostImageRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Services\GoogleAPIService;
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
            ->allowedSorts(['id', 'title', 'slug', 'published_at', 'indexed_by_google', 'updated_at', 'created_at'])
            ->defaultSort('-id')
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

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted');
    }

    public function uploadImage(PostsService $postsService, UploadPostImageRequest $request)
    {
        $filepath = $postsService->uploadPhoto($request->file('image'));
        return response()->json(['path' => $filepath]);
    }

    public function indexNow(Post $post, GoogleAPIService $googleAPIService)
    {
        $googleAPIService->indexNow('https://prostocode.com/posts/' . $post->slug);
        return redirect()->route('admin.posts.index');
    }
}
