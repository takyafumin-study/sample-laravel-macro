Laravelのmacro機能実装サンプル
====================

環境
----------

* PHP, 8.2.1
    - composer, v2.5.1
    - xdebug, v3.2.0
* Laravel, 9.5.1
* docker container
    - mysql, 8.0.32
    - adminer, latest
    - mailhog, latest


機能
----------

|         機能         |          URL           |
| -------------------- | ---------------------- |
| Laravel              | http://localhost/      |
| DB WebGUI(adminer)   | http://localhost:8080/ |
| Mail WebGUI(mailhog) | http://localhost:8025/ |


使い方
----------

phpライブラリインストール後、リポジトリをcloneして開発用サーバを起動してください

* phpライブラリインストール

```bash
./run.sh composer install
```

* dockerコンテナ起動(mysql, adminer, mailhog)

```bash
./run.sh up -d
```

* laravel開発サーバ起動

```bash
./run.sh artisan serve
```
