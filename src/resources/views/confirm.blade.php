@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<h2 class="title">Confirm</h2>

<form class="form" action="/thanks" method="post">
  @csrf

  <table class="confirm-table">
    <tr>
      <th>お名前</th>
      <td>{{ $contact['last_name'] }} {{ $contact['first_name'] }}</td>
    </tr>

    <tr>
      <th>性別</th>
      <td>
        @if($contact['gender'] == 'male') 男性
        @elseif($contact['gender'] == 'female') 女性
        @else その他
        @endif
      </td>
    </tr>

    <tr>
      <th>メールアドレス</th>
      <td>{{ $contact['email'] }}</td>
    </tr>

    <tr>
      <th>電話番号</th>
      <td>{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}</td>
    </tr>

    <tr>
      <th>住所</th>
      <td>{{ $contact['address'] }}</td>
    </tr>

    <tr>
      <th>建物名</th>
      <td>{{ $contact['building'] }}</td>
    </tr>

    <tr>
      <th>お問い合わせの種類</th>
      <td>{{ $contact['type'] }}</td>
    </tr>

    <tr>
      <th>お問い合わせ内容</th>
      <td>{{ $contact['detail'] }}</td>
    </tr>
  </table>

  <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
  <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
  <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
  <input type="hidden" name="email" value="{{ $contact['email'] }}">
  <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
  <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
  <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
  <input type="hidden" name="address" value="{{ $contact['address'] }}">
  <input type="hidden" name="building" value="{{ $contact['building'] }}">
  <input type="hidden" name="type" value="{{ $contact['type'] }}">
  <input type="hidden" name="detail" value="{{ $contact['detail'] }}">

  <div class="button-group">
    <button type="submit" class="submit-btn">送信</button>
    <button type="submit" formaction="/back" formmethod="post" class="back-btn">
        修正
    </button>
</div>

</form>
@endsection