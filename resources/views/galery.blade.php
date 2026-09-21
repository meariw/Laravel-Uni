@extends('layouts.app')

@section('title', $article['name'] . ' — Aesthetic Café & Bakery')

@section('content')
    <a href="{{ route('home') }}" class="back-link">&larr; Назад к новостям</a>

    <span class="article-date">{{ $article['date'] }}</span>
    <h1>{{ $article['name'] }}</h1>

    <img src="{{ asset('img/articles/' . $article['full_image']) }}"
         alt="{{ $article['name'] }}"
         class="article-full-image">

    <p>{{ $article['desc'] }}</p>
@endsection

@section('styles')
    <style>
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #6f4e37;
            text-decoration: none;
            font-size: 15px;
        }

        .back-link:hover { color: #e8c39e; }

        .article-full-image {
            width: 100%;
            max-height: 450px;
            object-fit: cover;
            border-radius: 10px;
            margin: 20px 0;
        }
    </style>
@endsection