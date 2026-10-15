@extends('layouts.app')

@section('title', 'Вход — Aesthetic Café & Bakery')

@section('styles')
<style>
    .signin-form {
        display: flex;
        flex-direction: column;
        gap: 18px;
        max-width: 420px;
        margin-top: 30px;
    }

    .signin-form label {
        font-size: 15px;
        color: #6f4e37;
        margin-bottom: 6px;
        display: block;
    }

    .signin-form input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #d8c3ab;
        border-radius: 6px;
        font-family: 'Georgia', serif;
        font-size: 16px;
        background: #fffaf3;
        color: #4b3832;
    }

    .signin-form input:focus {
        outline: none;
        border-color: #6f4e37;
    }

    .signin-form button {
        background: #6f4e37;
        color: #fdf6ee;
        border: none;
        padding: 12px 20px;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        font-family: 'Georgia', serif;
        letter-spacing: 0.5px;
        transition: background 0.2s;
    }

    .signin-form button:hover {
        background: #4b3832;
    }

    .error-list {
        background: #fbe9e7;
        border: 1px solid #e8a39e;
        color: #a33a2c;
        padding: 12px 16px;
        border-radius: 6px;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .error-list ul {
        margin: 0;
        padding-left: 18px;
    }

    .success-box {
        background: #e8f3e6;
        border: 1px solid #a9d3a3;
        color: #2f6b2a;
        padding: 12px 16px;
        border-radius: 6px;
        margin-bottom: 10px;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
    <h1>Вход</h1>

    @if (session('success'))
        <div class="success-box">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="error-list">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="signin-form" action="{{ route('authenticate') }}" method="POST">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com">
        </div>

        <div>
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" placeholder="Ваш пароль">
        </div>

        <button type="submit">Войти</button>
    </form>
@endsection