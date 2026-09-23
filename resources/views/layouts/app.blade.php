<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aesthetic Café & Bakery')</title>
    <style>
        * { box-sizing: border-box; }

        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            font-family: 'Georgia', serif;
            background: #fdf6ee;
            color: #4b3832;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: #6f4e37;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            color: #fdf6ee;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        nav a {
            color: #fdf6ee;
            text-decoration: none;
            margin-left: 25px;
            font-size: 16px;
            letter-spacing: 0.3px;
            transition: color 0.2s;
        }

        nav a:hover {
            color: #e8c39e;
        }

        main {
            flex: 1;
            max-width: 800px;
            margin: 50px auto;
            padding: 0 20px;
            width: 100%;
        }

        main h1 {
            font-size: 42px;
            margin-bottom: 10px;
            color: #6f4e37;
            position: relative;
            padding-bottom: 16px;
        }

        main h1::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 70px;
            height: 4px;
            background: #e8c39e;
            border-radius: 2px;
        }

        main p {
            font-size: 17px;
            line-height: 1.8;
        }

        footer {
            background: #4b3832;
            color: #e8c39e;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }
    </style>
    @yield('styles')
</head>
<body>

    <header>
        <div class="logo">☕ Aesthetic Café & Bakery</div>
        <nav>
            <a href="{{ route('home') }}">Главная</a>
            <a href="{{ route('about') }}">О нас</a>
            <a href="{{ route('contacts') }}">Контакты</a>
            <a href="{{ route('signin') }}">Регистрация</a>
            <a href="{{ route('db.articles') }}">Новости (БД)</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        Таряник Арина Владимировна &mdash; группа 251-321
    </footer>

</body>
</html>