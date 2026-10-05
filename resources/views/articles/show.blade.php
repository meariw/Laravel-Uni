@extends('layouts.app')

@section('title', $article->title . ' — Aesthetic Café & Bakery')

@section('content')
    <div class="article-card">
        <div class="article-date">{{ $article->datePublic }}</div>
        <h1>{{ $article->title }}</h1>
        <h6>{{ $article->shortDesc }}</h6>
        <p>{{ $article->desc }}</p>

        <div class="article-actions">
            <a href="{{ route('articles.edit', $article->id) }}" class="btn-add">Редактировать</a>
            <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                  onsubmit="return confirm('Удалить статью?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Удалить</button>
            </form>
            <a href="{{ route('articles.index') }}" class="back-link">← Назад к списку</a>
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
    </style>
@endsection