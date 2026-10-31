<h2>Добавлена новая статья</h2>

<p><strong>{{ $article->title }}</strong></p>
<p>{{ $article->shortDesc }}</p>
<p>Дата публикации: {{ $article->datePublic }}</p>

<p><a href="{{ route('articles.show', $article->id) }}">Перейти к статье</a></p>