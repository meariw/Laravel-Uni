<?php

namespace App\Notifications;

use App\Models\Article;
use Illuminate\Notifications\Notification;

class NewArticleNotification extends Notification
{
    public function __construct(public Article $article)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'id'    => $this->article->id,
            'title' => $this->article->title,
        ];
    }
}