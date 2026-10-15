@extends('layouts.app')

@section('title', 'Редактирование комментария — Aesthetic Café & Bakery')

@section('content')
    <div class="article-card">
        <h1>Редактировать комментарий</h1>

        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Автор</label>
            <input type="text" name="author" value="{{ old('author', $comment->author) }}">
            @error('author') <div class="error">{{ $message }}</div> @enderror

            <label>Текст</label>
            <textarea name="text" rows="5">{{ old('text', $comment->text) }}</textarea>
            @error('text') <div class="error">{{ $message }}</div> @enderror

            <button type="submit" class="btn-add">Сохранить</button>
            <a href="{{ route('articles.show', $comment->article_id) }}" class="back-link">← Назад к статье</a>
        </form>
    </div>
@endsection

@section('styles')
    <style>
        label { display: block; margin-top: 15px; margin-bottom: 5px; color: #6f4e37; }
        input, textarea { width: 100%; padding: 8px; border: 1px solid #d9cfc4; border-radius: 4px; font-family: inherit; }
        .error { color: #b03a2e; font-size: 13px; margin-top: 4px; }
        .btn-add { margin-top: 20px; display: inline-block; background: #6f4e37; color: #fff; padding: 8px 18px; border-radius: 4px; text-decoration: none; border: none; cursor: pointer; font-size: 15px; }
    </style>
@endsection