@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="login-page">
    <h2 class="login-page__title">Login</h2>

    <div class="login-card">
        <form action="/login" method="post" class="login-form">
            @csrf

            <div class="login-form__group">
                <label class="login-form__label" for="email">メールアドレス</label>
                <input
                    class="login-form__input @error('email') input-error @enderror"
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    placeholder="例: test@example.com"
                >
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="login-form__group">
                <label class="login-form__label" for="password">パスワード</label>
                <input
                    class="login-form__input @error('password') input-error @enderror"
                    type="password"
                    name="password"
                    id="password"
                    placeholder="例: coachtech1106"
                >
                @error('password')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="login-form__button">
                <button type="submit" class="login-form__button-submit">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection