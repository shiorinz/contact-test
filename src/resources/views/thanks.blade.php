@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')

<div class="thanks-container">

    <div class="thanks-bg">Thank you</div>

    <p class="thanks-message">
        お問い合わせありがとうございました
    </p>

    <a href="/" class="home-btn">HOME</a>

</div>

@endsection