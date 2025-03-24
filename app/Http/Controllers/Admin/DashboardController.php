<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\GoogleAPIService;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function dashboard(GoogleAPIService $googleAPIService): View
    {
        $statsData =  [
            'publishedPosts' => Post::whereNotNull('published_at')->count(),
            'indexedPosts' => Post::where('indexed_by_google', 1)->count(),
        ];
        return view('admin.dashboard', compact('statsData'));
    }
}
