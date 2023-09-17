<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\View;
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
}
