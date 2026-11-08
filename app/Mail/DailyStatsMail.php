<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyStatsMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public $views,
        public int $totalViews,
        public int $commentsCount
    ) {
    }

    public function build()
    {
        return $this->subject('Статистика сайта за день')
                    ->view('emails.daily-stats');
    }
}