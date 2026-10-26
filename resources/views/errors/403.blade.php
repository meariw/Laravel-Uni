@extends('layouts.app')

@section('title', 'Доступ запрещён — Aesthetic Café & Bakery')

@section('content')
    <h1>403 — Доступ запрещён</h1>
    <p>{{ $message }}</p>
    <p><a href="{{ route('home') }}">← На главную</a></p>
@endsection