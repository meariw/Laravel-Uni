@extends('layouts.app')

@section('title', 'Новости из БД — Aesthetic Café & Bakery')

@section('content')
    <h1>Новости (из базы данных) ☕</h1>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table class="db-articles-table">
        <thead>
            <tr>
                <th>Дата</th>
                <th>Заголовок</th>
                <th>Краткое описание</th>
                <th>Полное описание</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->datePublic }}</td>
                    <td><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></td>
                    <td>{{ $article->shortDesc }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($article->desc, 150) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="db-articles-pagination">
        {{ $articles->links('pagination.custom') }}
    </div>
@endsection

@section('styles')
    <style>
        .alert-success { margin-top: 15px; padding: 10px 15px; background: #e8f5e9; color: #2e7d32; border-radius: 4px; }
        .db-articles-table { width: 100%; border-collapse: collapse; margin-top: 25px; background: #fff; box-shadow: 0 2px 8px rgba(75, 56, 50, 0.1); }
        .db-articles-table th, .db-articles-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #f0e4d8; }
        .db-articles-table th { background: #6f4e37; color: #fff; font-weight: 500; }
        .db-articles-table tr:hover { background: #faf3ec; }
        .db-articles-pagination { margin-top: 25px; }
        .app-pagination {
            display: flex;
            gap: 8px;
            margin-top: 25px;
        }

        .app-pagination .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
            min-width: 90px;
            height: 36px;
            padding: 0 12px;
            border: 1px solid #e0d3c4;
            border-radius: 4px;
            text-decoration: none;
            color: #6f4e37;
            font-size: 14px;
            white-space: nowrap;
            background: #fff;
            transition: background 0.2s, color 0.2s;
        }

        .app-pagination .page-link:hover {
            background: #faf3ec;
        }

        .app-pagination .page-link.disabled {
            color: #c9bcae;
            border-color: #f0e4d8;
            cursor: default;
        }
    </style>
@endsection