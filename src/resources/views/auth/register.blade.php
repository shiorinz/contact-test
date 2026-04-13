@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="register-page">
    <h2 class="register-page__title">Register</h2>

    <div class="register-card">
        <form action="/register" method="post" class="register-form">
            @csrf

            <div class="register-form__group">
                <label class="register-form__label" for="name">お名前</label>
                <input
                    class="register-form__input @error('name') input-error @enderror"
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    placeholder="例: 山田 太郎"
                >
                @error('name')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="email">メールアドレス</label>
                <input
                    class="register-form__input @error('email') input-error @enderror"
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

            <div class="register-form__group">
                <label class="register-form__label" for="password">パスワード</label>
                <input
                    class="register-form__input @error('password') input-error @enderror"
                    type="password"
                    name="password"
                    id="password"
                    placeholder="例: coachtech1106"
                >
                @error('password')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="register-form__button">
                <button type="submit" class="register-form__button-submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection