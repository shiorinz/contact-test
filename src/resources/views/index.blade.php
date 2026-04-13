@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<h2 class="title">Contact</h2>

<form action="/confirm" method="post" class="form">
    @csrf

    {{-- お名前 --}}
    <div class="form-group">
        <label>お名前<span class="required">※</span></label>
        <div class="form-group__content">
            <div class="name-input">
                <input
                    type="text"
                    name="last_name"
                    placeholder="例: 山田"
                    value="{{ old('last_name') }}"
                >
                <input
                    type="text"
                    name="first_name"
                    placeholder="例: 太郎"
                    value="{{ old('first_name') }}"
                >
            </div>
            <div class="form__error">
                @error('last_name')
                    <p>{{ $message }}</p>
                @enderror
                @error('first_name')
                    <p>{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- 性別 --}}
    <div class="form-group">
        <label>性別<span class="required">※</span></label>
        <div class="form-group__content">
            <div class="radio-group">
                <label class="radio-label">
                    <input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                    男性
                </label>
                <label class="radio-label">
                    <input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                    女性
                </label>
                <label class="radio-label">
                    <input type="radio" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}>
                    その他
                </label>
            </div>
            <div class="form__error">
                @error('gender')
                    <p>{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- メールアドレス --}}
    <div class="form-group">
        <label>メールアドレス<span class="required">※</span></label>
        <div class="form-group__content">
            <input
                type="email"
                name="email"
                placeholder="例: test@example.com"
                value="{{ old('email') }}"
            >
            <div class="form__error">
                @error('email')
                    <p>{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- 電話番号 --}}
    <div class="form-group">
        <label>電話番号<span class="required">※</span></label>
        <div class="form-group__content">
            <div class="tel-input">
                <input
                    type="text"
                    name="tel1"
                    placeholder="080"
                    value="{{ old('tel1') }}"
                >
                <span>-</span>
                <input
                    type="text"
                    name="tel2"
                    placeholder="1234"
                    value="{{ old('tel2') }}"
                >
                <span>-</span>
                <input
                    type="text"
                    name="tel3"
                    placeholder="5678"
                    value="{{ old('tel3') }}"
                >
            </div>
            <div class="form__error">
                @error('tel1')
                    <p>{{ $message }}</p>
                @enderror
                @error('tel2')
                    <p>{{ $message }}</p>
                @enderror
                @error('tel3')
                    <p>{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- 住所 --}}
    <div class="form-group">
        <label>住所<span class="required">※</span></label>
        <div class="form-group__content">
            <input
                type="text"
                name="address"
                placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3"
                value="{{ old('address') }}"
            >
            <div class="form__error">
                @error('address')
                    <p>{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- 建物名 --}}
    <div class="form-group">
        <label>建物名</label>
        <div class="form-group__content">
            <input
                type="text"
                name="building"
                placeholder="例: 千駄ヶ谷マンション101"
                value="{{ old('building') }}"
            >
        </div>
    </div>

    {{-- お問い合わせの種類 --}}
    <div class="form-group">
        <label>お問い合わせの種類<span class="required">※</span></label>
        <div class="form-group__content">
            <select name="type">
                <option value="">選択してください</option>
                <option value="商品のお届けについて" {{ old('type') == '商品のお届けについて' ? 'selected' : '' }}>商品のお届けについて</option>
                <option value="商品の交換について" {{ old('type') == '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
                <option value="商品トラブル" {{ old('type') == '商品トラブル' ? 'selected' : '' }}>商品トラブル</option>
                <option value="ショップへのお問い合わせ" {{ old('type') == 'ショップへのお問い合わせ' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                <option value="その他" {{ old('type') == 'その他' ? 'selected' : '' }}>その他</option>
            </select>
            <div class="form__error">
                @error('type')
                    <p>{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- お問い合わせ内容 --}}
    <div class="form-group">
        <label>お問い合わせ内容<span class="required">※</span></label>
        <div class="form-group__content">
            <textarea
                name="detail"
                placeholder="お問い合わせ内容をご記載ください"
            >{{ old('detail') }}</textarea>
            <div class="form__error">
                @error('detail')
                    <p>{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- ボタン --}}
    <div class="form-button">
        <button type="submit">確認画面</button>
    </div>
</form>
@endsection