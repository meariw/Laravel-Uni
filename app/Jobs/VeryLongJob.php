<?php

namespace App\Jobs;

use App\Mail\NewArticleMail;
use App\Models\Article;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class VeryLongJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public Article $article)
    {
    }

    public function handle(): void
    {
        $moderators = User::whereHas('role', fn ($q) => $q->where('name', 'moderator'))->get();
        Mail::to($moderators)->send(new NewArticleMail($this->article));
    }
}