@extends('layouts.app')

@section('title', $article->title . ' — Aesthetic Café & Bakery')

@section('content')
    <div class="article-card">
        <div class="article-date">{{ $article->datePublic }}</div>
        <h1>{{ $article->title }}</h1>
        <h6>{{ $article->shortDesc }}</h6>
        <p>{{ $article->desc }}</p>

        <div class="article-actions">
            @auth
                <a href="{{ route('articles.edit', $article->id) }}" class="btn-add">Редактировать</a>
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                      onsubmit="return confirm('Удалить статью?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Удалить</button>
                </form>
            @endauth
            <a href="{{ route('articles.index') }}" class="back-link">← Назад к списку</a>
        </div>

        <div class="comments-block">
            <h2>Комментарии ({{ $article->comments->count() }})</h2>

            @if (session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif

            @forelse ($article->comments as $comment)
                <div class="comment-item">
                    <div class="comment-head">
                        <strong>{{ $comment->author }}</strong>
                        <span class="comment-date">{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <p>{{ $comment->text }}</p>
                    @auth
                        <div class="comment-actions">
                            <a href="{{ route('comments.edit', $comment->id) }}">Редактировать</a>
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                  onsubmit="return confirm('Удалить комментарий?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete-small">Удалить</button>
                            </form>
                        </div>
                    @endauth
                </div>
            @empty
                <p>Пока нет комментариев.</p>
            @endforelse

            @auth
                <h3>Добавить комментарий</h3>
                <form action="{{ route('articles.comments.store', $article->id) }}" method="POST">
                    @csrf
                    <label>Имя</label>
                    <input type="text" name="author" value="{{ old('author', auth()->user()->name) }}">
                    @error('author') <div class="error">{{ $message }}</div> @enderror

                    <label>Комментарий</label>
                    <textarea name="text" rows="3">{{ old('text') }}</textarea>
                    @error('text') <div class="error">{{ $message }}</div> @enderror

                    <button type="submit" class="btn-add btn-submit">Отправить</button>
                </form>
            @endauth

            @guest
                <p><a href="{{ route('login') }}">Войдите</a>, чтобы оставить комментарий.</p>
            @endguest
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .article-card { background: #fff; padding: 30px; border-radius: 6px; box-shadow: 0 2px 8px rgba(75, 56, 50, 0.1); }
        .article-date { color: #9c8a7d; font-size: 14px; margin-bottom: 8px; }
        .article-actions { margin-top: 25px; display: flex; align-items: center; gap: 15px; }
        .btn-add { background: #6f4e37; color: #fff; padding: 8px 18px; border-radius: 4px; text-decoration: none; font-size: 15px; }
        .btn-delete { background: none; border: 1px solid #b03a2e; color: #b03a2e; padding: 8px 18px; border-radius: 4px; cursor: pointer; font-size: 15px; }
        .back-link { color: #6f4e37; text-decoration: none; margin-left: auto; }

        .comments-block { margin-top: 35px; border-top: 1px solid #eee2d6; padding-top: 20px; }
        .comment-item { background: #faf6f1; padding: 12px 15px; border-radius: 4px; margin-bottom: 10px; }
        .comment-head { display: flex; justify-content: space-between; font-size: 14px; }
        .comment-date { color: #9c8a7d; }
        .comment-actions { display: flex; gap: 12px; margin-top: 6px; font-size: 13px; }
        .comment-actions a { color: #6f4e37; }
        .btn-delete-small { background: none; border: none; color: #b03a2e; cursor: pointer; font-size: 13px; padding: 0; }
        .btn-submit { margin-top: 15px; border: none; cursor: pointer; }
        .success { background: #e8f3e8; color: #2e6b2e; padding: 10px 15px; border-radius: 4px; margin-bottom: 15px; }
        label { display: block; margin-top: 12px; margin-bottom: 4px; color: #6f4e37; }
        input, textarea { width: 100%; padding: 8px; border: 1px solid #d9cfc4; border-radius: 4px; font-family: inherit; }
        .error { color: #b03a2e; font-size: 13px; margin-top: 4px; }
    </style>
@endsection