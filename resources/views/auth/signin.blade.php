@extends('layouts.app')

@section('title', 'Регистрация — Aesthetic Café & Bakery')

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
</style>
@endsection

@section('content')
    <h1>Регистрация</h1>

    @if ($errors->any())
        <div class="error-list">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="signin-form" action="{{ route('signin.post') }}" method="POST">
        @csrf

        <div>
            <label for="name">Имя</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ваше имя">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com">
        </div>

        <div>
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" placeholder="Не менее 6 символов">
        </div>

        <button type="submit">Зарегистрироваться</button>
    </form>
@endsection