#!/usr/bin/env bash

PROJECT_DIR=laravel-app
CMD_DOCKER=docker-compose
export COMPOSE_FILE=docker-compose.yml

cd ${PROJECT_DIR}

if [ ! -f .env ];then
    cp .env.example .env
fi

function display_help {

    echo "Usage:";
    echo "  run.sh [command] [options/sub-command]"
    echo "";
    echo "command:";
    echo "";
    echo "  environment:";
    echo "      up   [options]          Execute docker-compose up";
    echo "      down [options]          Execute docker-compose down";
    echo "";
    echo "  develop:";
    echo "      artisan [sub-command]   Execute artisan command on APP Container";
    echo "      tinker                  Execute php artisan tinekr on APP Container";
    echo "";
    echo "  ci:";
    echo "      phpcs                   PHP Code FormatCheck(phpcs)";
    echo "      phpcs:fix               PHP Code Format(phpcbf)";
    echo "      phpmd                   PHP Code Check(phpmd)";
    echo "      ci                      Code Check(phpcbf & phpcs & phpmd)";
    echo "";
    echo "  others:";
    echo "      help                    Display command help";
    echo "";
    exit 0;
}


# --------------------
#
# 各コマンド
#
# --------------------
if [ $# = 0 ]; then
  display_help

elif [ $1 = "help" ]; then
  display_help

elif [ $1 = "up" ]; then
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

elif [ $1 = "phpcs" ]; then
  composer phpcs

elif [ $1 = "phpcs:fix" ]; then
  composer phpcs:fix

elif [ $1 = "phpmd" ]; then
  composer phpmd

elif [ $1 = "ci" ]; then
  composer phpcs:fix
  composer phpcs
  composer phpmd

elif [ $# -ge 1 ]; then
  # 未指定のパラメータの場合、docker-copmoseコマンドをそのまま呼び出す
  docker-compose $@
fi
