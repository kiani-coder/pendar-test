<?php

namespace App\Jobs;

use App\Mail\ArticleCreatedMail;
use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendArticleCreatedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $article;
    
    // Number of retries in case of failure
    public $tries = 5;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('admin@example.com')->send(new ArticleCreatedMail($this->article));
    }

    public function failed(\Exception $exception)
    {
        Log::error('Failed to send ArticleCreatedEmail: ' . $exception->getMessage());
    }
}
