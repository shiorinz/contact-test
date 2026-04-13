@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-page">
    <h2 class="admin-page__title">Admin</h2>

    <form class="search-form" action="/search" method="get">
        <div class="search-form__group search-form__group--keyword">
            <input
                type="text"
                name="keyword"
                class="search-form__input"
                placeholder="名前やメールアドレスを入力してください"
                value="{{ request('keyword') }}"
            >
        </div>

        <div class="search-form__group">
            <select name="gender" class="search-form__select">
                <option value="">性別</option>
                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>男性</option>
                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>女性</option>
                <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>その他</option>
            </select>
        </div>

        <div class="search-form__group">
            <select name="category" class="search-form__select">
                <option value="">お問い合わせの種類</option>
                <option value="商品のお届けについて" {{ request('category') == '商品のお届けについて' ? 'selected' : '' }}>商品のお届けについて</option>
                <option value="商品の交換について" {{ request('category') == '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
                <option value="商品トラブル" {{ request('category') == '商品トラブル' ? 'selected' : '' }}>商品トラブル</option>
                <option value="ショップへのお問い合わせ" {{ request('category') == 'ショップへのお問い合わせ' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                <option value="その他" {{ request('category') == 'その他' ? 'selected' : '' }}>その他</option>
            </select>
        </div>

        <div class="search-form__group">
            <input
                type="date"
                name="date"
                class="search-form__date"
                value="{{ request('date') }}"
            >
        </div>

        <div class="search-form__button">
            <button type="submit" class="search-form__button-submit">検索</button>
        </div>

        <div class="search-form__button">
            <a href="/reset" class="search-form__button-reset">リセット</a>
        </div>
    </form>

    <div class="admin-page__sub">
        <a href="{{ url('/export') . '?' . http_build_query(request()->query()) }}" class="export-button">エクスポート</a>

        @if ($contacts->hasPages())
        <div class="pagination">
            @if ($contacts->onFirstPage())
                <span class="pagination__item pagination__item--disabled">&lt;</span>
            @else
                <a href="{{ $contacts->previousPageUrl() }}" class="pagination__item">&lt;</a>
            @endif

            @for ($i = 1; $i <= $contacts->lastPage(); $i++)
                @if ($i == $contacts->currentPage())
                    <span class="pagination__item pagination__item--active">{{ $i }}</span>
                @else
                    <a href="{{ $contacts->url($i) }}" class="pagination__item">{{ $i }}</a>
                @endif
            @endfor

            @if ($contacts->hasMorePages())
                <a href="{{ $contacts->nextPageUrl() }}" class="pagination__item">&gt;</a>
            @else
                <span class="pagination__item pagination__item--disabled">&gt;</span>
            @endif
        </div>
        @endif
    </div>

    <div class="admin-table">
        <table class="admin-table__inner">
            <thead>
                <tr class="admin-table__row admin-table__row--head">
                    <th class="admin-table__header">お名前</th>
                    <th class="admin-table__header">性別</th>
                    <th class="admin-table__header">メールアドレス</th>
                    <th class="admin-table__header">お問い合わせの種類</th>
                    <th class="admin-table__header"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contacts as $contact)
                <tr class="admin-table__row">
                    <td class="admin-table__item">
                        {{ $contact->last_name }} {{ $contact->first_name }}
                    </td>

                    <td class="admin-table__item">
                        @if($contact->gender === 'male')
                            男性
                        @elseif($contact->gender === 'female')
                            女性
                        @else
                            その他
                        @endif
                    </td>

                    <td class="admin-table__item">
                        {{ $contact->email }}
                    </td>

                    <td class="admin-table__item">
                        {{ $contact->type }}
                    </td>

                    <td class="admin-table__item admin-table__item--button">
                        <button
                            type="button"
                            class="detail-button"
                            onclick="openModal({{ $contact->id }})"
                        >
                            詳細
                        </button>
                    </td>
                </tr>
                @empty
                <tr class="admin-table__row">
                    <td class="admin-table__item admin-table__item--empty" colspan="5">
                        該当するお問い合わせはありません
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- モーダル --}}
@foreach ($contacts as $contact)
<div class="modal" id="modal-{{ $contact->id }}">
    <div class="modal__overlay" onclick="closeModal({{ $contact->id }})"></div>

    <div class="modal__content">
        <button
            type="button"
            class="modal__close"
            onclick="closeModal({{ $contact->id }})"
        >
            ×
        </button>

        <div class="modal__body">
            <div class="modal__row">
                <div class="modal__label">お名前</div>
                <div class="modal__value">{{ $contact->last_name }} {{ $contact->first_name }}</div>
            </div>

            <div class="modal__row">
                <div class="modal__label">性別</div>
                <div class="modal__value">
                    @if($contact->gender === 'male')
                        男性
                    @elseif($contact->gender === 'female')
                        女性
                    @else
                        その他
                    @endif
                </div>
            </div>

            <div class="modal__row">
                <div class="modal__label">メールアドレス</div>
                <div class="modal__value">{{ $contact->email }}</div>
            </div>

            <div class="modal__row">
                <div class="modal__label">電話番号</div>
                <div class="modal__value">
                    {{ $contact->tel1 }}{{ $contact->tel2 }}{{ $contact->tel3 }}
                </div>
            </div>

            <div class="modal__row">
                <div class="modal__label">住所</div>
                <div class="modal__value">{{ $contact->address }}</div>
            </div>

            <div class="modal__row">
                <div class="modal__label">建物名</div>
                <div class="modal__value">{{ $contact->building }}</div>
            </div>

            <div class="modal__row">
                <div class="modal__label">お問い合わせの種類</div>
                <div class="modal__value">{{ $contact->type }}</div>
            </div>

            <div class="modal__row">
                <div class="modal__label">お問い合わせ内容</div>
                <div class="modal__value">{{ $contact->detail }}</div>
            </div>

            <div class="modal__button">
                <form action="/delete/{{ $contact->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="modal__delete-button">削除</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    function openModal(id) {
        document.getElementById(`modal-${id}`).classList.add('is-active');
    }

    function closeModal(id) {
        document.getElementById(`modal-${id}`).classList.remove('is-active');
    }
</script>
@endsection