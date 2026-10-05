@extends('layouts.app')

@section('title', 'Новая статья — Aesthetic Café & Bakery')

@section('content')
    <h1>Новая статья</h1>

    <form action="{{ route('articles.store') }}" method="POST" class="article-form">
        @csrf

        <div class="form-group">
            <label for="datePublic">Дата публикации</label>
            <input type="date" name="datePublic" id="datePublic" value="{{ old('datePublic') }}">
            @error('datePublic') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">
            @error('title') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="shortDesc">Краткое описание</label>
            <input type="text" name="shortDesc" id="shortDesc" value="{{ old('shortDesc') }}">
            @error('shortDesc') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="desc">Полное описание</label>
            <textarea name="desc" id="desc" rows="6">{{ old('desc') }}</textarea>
            @error('desc') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn-add">Сохранить</button>
    </form>
@endsection

@section('styles')
    <style>
        .article-form { max-width: 500px; margin-top: 20px; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; margin-bottom: 6px; font-weight: 500; color: #6f4e37; }
        .form-group input, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #e0d3c4; border-radius: 4px; font-family: inherit; font-size: 15px; }
        .form-error { color: #b03a2e; font-size: 13px; margin-top: 4px; }
        .btn-add { background: #6f4e37; color: #fff; padding: 10px 22px; border: none; border-radius: 4px; font-size: 15px; cursor: pointer; }
        .btn-add:hover { background: #4b3832; }
    </style>
@endsection