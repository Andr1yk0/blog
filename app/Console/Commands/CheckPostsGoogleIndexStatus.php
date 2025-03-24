<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Services\GoogleAPIService;
use Illuminate\Console\Command;

class CheckPostsGoogleIndexStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-posts-google-index-status';

    public function handle(GoogleAPIService $googleAPIService)
    {
        $posts = Post::whereNotNull('published_at')->get();
        foreach ($posts as $post) {
            $res = $googleAPIService->getPageIndexStatus("https://prostocode.com/posts/{$post->slug}");
            try {
                $verdict = $res->getInspectionResult()->getIndexStatusResult()->verdict;
                    $post->indexed_by_google = $verdict === 'PASS';
                    $post->save();
            }catch (\Throwable $exception){
                \Log::error($exception->getMessage() . "\n" .$exception->getTraceAsString());
            }
        }
    }
}
