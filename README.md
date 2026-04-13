# FashionablyLate

## 環境構築

### Dockerビルド

```bash
# リポジトリをクローン
git clone <リポジトリURL>

# Dockerコンテナ起動
docker-compose up -d --build
```

### Laravel環境構築

```bash
# PHPコンテナへ入る
docker-compose exec php bash

# Composerインストール
composer install

# .env作成
cp .env.example .env

# アプリケーションキー作成
php artisan key:generate

# マイグレーション実行
php artisan migrate

# シーディング実行
php artisan db:seed
```

## 使用技術（実行環境）

* PHP 8.x
* Laravel 8.x
* MySQL 8.x
* Docker / Docker Compose
* Laravel Fortify

## ER図

![alt text](image.png)

## URL

* 開発環境：[http://localhost/](http://localhost/)
* phpMyAdmin：[http://localhost:8080/](http://localhost:8080/)

## 主な機能

* お問い合わせフォーム入力
* 確認画面表示
* サンクスページ表示
* お問い合わせ内容の保存
* 管理画面一覧表示
* 条件検索（名前・メール・性別・種類・日付）
* ページネーション
* CSVエクスポート
* お問い合わせ削除
* 会員登録 / ログイン / ログアウト（Fortify）

## ダミーデータ

* categoriesテーブル：5件
* contactsテーブル：35件

## 補足

管理画面はログイン後にアクセス可能です。

