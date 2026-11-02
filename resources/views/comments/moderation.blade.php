@extends('layouts.app')

@section('title', 'Модерация комментариев — Aesthetic Café & Bakery')

@section('content')
    <h1>Модерация комментариев</h1>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @forelse ($pending as $comment)
        <div class="comment-item">
            <div class="comment-head">
                <strong>{{ $comment->author }}</strong>
                <span class="comment-date">{{ $comment->created_at->format('d.m.Y H:i') }}</span>
            </div>
            <div class="comment-article">
                К статье:
                <a href="{{ route('articles.show', $comment->article_id) }}">{{ $comment->article->title }}</a>
            </div>
            <p>{{ $comment->text }}</p>

            <div class="moderation-actions">
                <form action="{{ route('comments.approve', $comment->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-approve">Принять</button>
                </form>
                <form action="{{ route('comments.reject', $comment->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-reject">Отклонить</button>
                </form>
            </div>
        </div>
    @empty
        <p>Нет комментариев, ожидающих модерации.</p>
    @endforelse

    <h2 class="rejected-title">Отклонённые комментарии</h2>

    @forelse ($rejected as $comment)
        <div class="comment-item comment-rejected">
            <div class="comment-head">
                <strong>{{ $comment->author }}</strong>
                <span class="comment-date">{{ $comment->created_at->format('d.m.Y H:i') }}</span>
            </div>
            <div class="comment-article">
                К статье:
                <a href="{{ route('articles.show', $comment->article_id) }}">{{ $comment->article->title }}</a>
            </div>
            <p>{{ $comment->text }}</p>
            <div class="rejected-label">Отклонён</div>
        </div>
    @empty
        <p>Отклонённых комментариев нет.</p>
    @endforelse
@endsection

@section('styles')
    <style>
        .comment-item { background: #fff; padding: 15px 18px; border-radius: 4px; margin-bottom: 12px; box-shadow: 0 2px 8px rgba(75, 56, 50, 0.1); }
        .comment-head { display: flex; justify-content: space-between; font-size: 14px; }
        .comment-date { color: #9c8a7d; }
        .comment-article { font-size: 14px; margin-top: 4px; }
        .comment-article a { color: #6f4e37; }
        .moderation-actions { display: flex; gap: 10px; }
        .btn-approve { background: #6f4e37; color: #fff; border: none; padding: 8px 18px; border-radius: 4px; cursor: pointer; font-size: 15px; }
        .btn-reject { background: none; border: 1px solid #b03a2e; color: #b03a2e; padding: 8px 18px; border-radius: 4px; cursor: pointer; font-size: 15px; }
        .success { background: #e8f3e8; color: #2e6b2e; padding: 10px 15px; border-radius: 4px; margin-bottom: 15px; }
        .rejected-title { margin-top: 40px; color: #6f4e37; }
        .comment-rejected { opacity: 0.75; }
        .rejected-label { color: #b03a2e; font-size: 14px; font-weight: bold; }
    </style>
@endsection