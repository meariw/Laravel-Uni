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

        .notifications {
            position: relative;
            display: inline-block;
            margin-left: 25px;
        }

        .notifications summary {
            color: #fdf6ee;
            cursor: pointer;
            list-style: none;
            font-size: 16px;
        }

        .notifications summary::-webkit-details-marker { display: none; }

        .notifications ul {
            position: absolute;
            right: 0;
            top: 28px;
            z-index: 10;
            min-width: 260px;
            margin: 0;
            padding: 8px 0;
            list-style: none;
            background: #fdf6ee;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
        }

        .notifications li a {
            display: block;
            margin: 0;
            padding: 8px 16px;
            color: #4b3832;
        }

        .notifications li a:hover { background: #e8c39e; color: #4b3832; }

        .notifications .empty { padding: 8px 16px; color: #4b3832; }

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
    @vite(['resources/js/app.js'])
    @yield('styles')
</head>
<body>

    <header>
        <div class="logo">☕ Aesthetic Café & Bakery</div>
        <nav>
            <a href="{{ route('home') }}">Главная</a>
            <a href="{{ route('about') }}">О нас</a>
            <a href="{{ route('contacts') }}">Контакты</a>
            <a href="{{ route('articles.index') }}">Новости (БД)</a>

            @can('create', App\Models\Article::class)
                <a href="{{ route('articles.create') }}">Создать новость</a>
            @endcan

            @can('moderate', App\Models\Comment::class)
                <a href="{{ route('comments.moderation') }}">Модерация</a>
            @endcan

            @auth
                @unless (auth()->user()->isModerator())
                    @php $unread = auth()->user()->unreadNotifications; @endphp
                    <details class="notifications">
                        <summary>🔔 Уведомления ({{ $unread->count() }})</summary>
                        <ul>
                            @forelse ($unread as $notification)
                                <li>
                                    <a href="{{ route('articles.show', ['article' => $notification->data['id'], 'notification' => $notification->id]) }}">
                                        {{ $notification->data['title'] }}
                                    </a>
                                </li>
                            @empty
                                <li class="empty">Нет новых уведомлений</li>
                            @endforelse
                        </ul>
                    </details>
                @endunless

                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:#fdf6ee;cursor:pointer;font-family:inherit;font-size:16px;margin-left:25px;padding:0">
                        Выйти ({{ auth()->user()->name }})
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('register') }}">Регистрация</a>
                <a href="{{ route('login') }}">Вход</a>
            @endguest
        </nav>
    </header>
    <div id="app"></div>

    <main>
        @yield('content')
    </main>

    <footer>
        Таряник Арина Владимировна &mdash; группа 251-321
    </footer>

</body>
</html>