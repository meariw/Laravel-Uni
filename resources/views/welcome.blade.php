@extends('layouts.app')

@section('title', 'Главная — Aesthetic Café & Bakery')

@section('content')
    <h1>Новости и заметки ☕</h1>
    <p>Свежие статьи о кофе, десертах и жизни нашей кофейни.</p>

    <div class="articles-list">
        @foreach ($articles as $id => $article)
            <div class="article-card">
                <a href="{{ route('galery', ['id' => $id]) }}">
                    <img src="{{ asset('img/articles/' . $article['preview_image']) }}"
                         alt="{{ $article['name'] }}"
                         class="article-preview">
                </a>
                <div class="article-info">
                    <span class="article-date">{{ $article['date'] }}</span>
                    <h2>
                        <a href="{{ route('galery', ['id' => $id]) }}">
                            {{ $article['name'] }}
                        </a>
                    </h2>
                    <p>{{ $article['shortDesc'] ?? \Illuminate\Support\Str::limit($article['desc'], 120) }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('styles')
    <style>
        .articles-list {
            display: flex;
            flex-direction: column;
            gap: 25px;
            margin-top: 30px;
        }

        .article-card {
            display: flex;
            gap: 20px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(75, 56, 50, 0.1);
        }

        .article-preview {
            width: 200px;
            height: 150px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .article-info {
            padding: 15px 20px 15px 0;
        }

        .article-date {
            font-size: 13px;
            color: #a07d63;
        }

        .article-info h2 {
            margin: 6px 0;
            font-size: 22px;
        }

        .article-info h2 a {
            color: #6f4e37;
            text-decoration: none;
        }

        .article-info h2 a:hover {
            color: #e8c39e;
        }

        .article-info p {
            font-size: 15px;
            line-height: 1.5;
            margin: 0;
        }

        @media (max-width: 600px) {
            .article-card { flex-direction: column; }
            .article-preview { width: 100%; height: 180px; }
        }
    </style>
@endsection