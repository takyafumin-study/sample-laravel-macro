#!/usr/bin/env bash

PROJECT_DIR=laravel-app
CMD_DOCKER=docker-compose
export COMPOSE_FILE=docker-compose.yml

cd ${PROJECT_DIR}

if [ ! -f .env ];then
    cp .env.example .env
fi


# --------------------
#
# 各コマンド
#
# --------------------
if [ $1 = "up" ]; then
  shift 1
  docker-compose up $@

elif [ $1 = "down" ]; then
  shift 1
  docker-compose down $@

elif [ $1 = "composer" ]; then
  shift 1
  composer $@

elif [ $1 = "artisan" ]; then
  shift 1
  php artisan $@

elif [ $# -ge 1 ]; then
  # 未指定のパラメータの場合、docker-copmoseコマンドをそのまま呼び出す
  docker-compose $@
fi
