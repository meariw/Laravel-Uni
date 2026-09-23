@extends('layouts.app')

@section('title', 'Новости из БД — Aesthetic Café & Bakery')

@section('content')
    <h1>Новости (из базы данных) ☕</h1>
    <p>Демонстрация работы с моделью, миграциями и фабриками.</p>

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
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->shortDesc }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($article->desc, 150) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('styles')
    <style>
        .db-articles-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(75, 56, 50, 0.1);
        }

        .db-articles-table th,
        .db-articles-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #f0e4d8;
        }

        .db-articles-table th {
            background: #6f4e37;
            color: #fff;
            font-weight: 500;
        }

        .db-articles-table tr:hover {
            background: #faf3ec;
        }
    </style>
@endsection