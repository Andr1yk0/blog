<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\StorageAttributes;

class MediaAdminController extends Controller
{
    public function index()
    {
        $mediaFiles = Storage::disk('public')->listContents('media', true)
            ->filter(fn (StorageAttributes $attributes) => $attributes->isFile())->toArray();

        return view('admin.media.index', compact('mediaFiles'));
    }

    public function store(Request $request)
    {
        $path = "media/{$request->path}";
        $file = $request->file('file');
        if (Storage::disk('public')->exists($path.'/'.$file->getClientOriginalName())) {
            return redirect()->route('admin.media.index')->withErrors(['File already exists!']);
        }
        $file->storeAs($path, $file->getClientOriginalName(), ['disk' => 'public']);

        return redirect()->route('admin.media.index')->with('success', 'File has been uploaded!');
    }

    public function destroy(Request $request)
    {
        if ($post = Post::where('body_html', 'like', "%{$request->path}%")->first()) {
            return redirect()->route('admin.media.index')->withErrors(["File is used in post #{$post->id}!"]);
        }

        Storage::disk('public')->delete($request->path);

        return redirect()->route('admin.media.index')->with('success', 'File has been deleted!');
    }
}
