<?php

namespace App\Events;

use App\Models\Article;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewArticleEvent implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public function __construct(public Article $article)
    {
    }

    public function broadcastOn(): Channel
    {
        return new Channel('test');
    }

    public function broadcastWith(): array
    {
        return [
            'article' => [
                'id'    => $this->article->id,
                'title' => $this->article->title,
            ],
        ];
    }
}