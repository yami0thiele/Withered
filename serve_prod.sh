#!/bin/bash

# 設定ファイルの読み込み
if [ -f "./server_config.sh" ]; then
  source ./server_config.sh
else
  echo "エラー: server_config.shが見つかりません。server_config.sh.sampleを複製して設定してください。"
  exit 1
fi

php build.php

# rsync で 配信用サーバにファイルを転送
echo "配信用サーバにファイルを転送中..."
rsync -avz --delete $SOURCE_DIR $REMOTE_SERVER:$DEST_DIR --progress

if [ $? -eq 0 ]; then
  echo "転送が完了しました。"
else
  echo "エラー: ファイルの転送に失敗しました。"
  exit 1
fi
