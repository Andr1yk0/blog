<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostEditAdminRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostsService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostAdminController extends Controller
{
    public function index(): View
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(10),
        ]);
    }

    public function create(): View
    {
        $formAction = route('admin.posts.store');
        $categories = Category::with('tags')->get();
        return view('admin.posts.create', compact('formAction', 'categories'));
    }

    public function store(PostEditAdminRequest $request, PostsService $postsService): RedirectResponse
    {
        $postsService->create($request->all());
        return redirect()->route('admin.posts.index')->with('success', 'Post created');
    }
}
