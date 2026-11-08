<?php

namespace App\Console\Commands;

use App\Mail\DailyStatsMail;
use App\Models\ArticleView;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyStats extends Command
{
    protected $signature = 'stats:send-daily';

    protected $description = 'Отправка модераторам статистики за день';

    public function handle()
    {
        $views = ArticleView::whereDate('created_at', today())
            ->selectRaw('url, count(*) as total')
            ->groupBy('url')
            ->get();

        $totalViews = $views->sum('total');

        $commentsCount = Comment::whereDate('created_at', today())->count();

        $moderators = User::whereHas('role', function ($query) {
            $query->where('name', 'moderator');
        })->get();

        foreach ($moderators as $moderator) {
            Mail::to($moderator->email)
                ->send(new DailyStatsMail($views, $totalViews, $commentsCount));
        }

        $this->info('Статистика отправлена');
    }
}