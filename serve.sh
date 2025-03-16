#!/bin/bash

# PHPでビルドを実行
php build.php

# Dockerコンテナを起動
docker compose up -d
