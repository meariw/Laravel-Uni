<h2>Статистика сайта за день</h2>

<p>Всего просмотров статей: <strong>{{ $totalViews }}</strong></p>

@foreach ($views as $view)
    <p>{{ $view->url }}: {{ $view->total }}</p>
@endforeach

<p>Новых комментариев: <strong>{{ $commentsCount }}</strong></p>