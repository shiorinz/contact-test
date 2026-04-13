<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="logo">FashionablyLate</h1>

            @if (request()->is('login'))
                <a href="/register" class="header__link">register</a>
            @elseif (request()->is('register'))
                <a href="/login" class="header__link">login</a>
            @elseif (request()->is('admin') || request()->is('search') || request()->is('reset'))
                <form action="/logout" method="post" class="header__logout-form">
                    @csrf
                    <button type="submit" class="header__link header__logout-button">logout</button>
                </form>
            @endif
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>