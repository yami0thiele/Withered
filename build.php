<?php

require_once 'vendor/autoload.php';

use Y0t\Withered\Builder\PostBuilder;
use Y0t\Withered\Parser\MarkdownParser;
use Y0t\Withered\Builder\PageIndexBuilder;
use Y0t\Withered\Config\Config;
use Y0t\Withered\Page\Page;
use Y0t\Withered\Renderer\Renderer;

// ビルドディレクトリの作成
if (!is_dir('build')) {
    mkdir('build', 0755, true);
}
if (!is_dir('build/posts')) {
    mkdir('build/posts', 0755, true);
}

// 設定とパーサーの初期化
$config = new Config();
$parser = new MarkdownParser();

// ブログ記事の読み込みと変換
$postPages = [];
$postsDir = 'pages/posts';
$postFiles = scandir($postsDir);

foreach ($postFiles as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) !== 'md') {
        continue;
    }

    $filePath = $postsDir . '/' . $file;
    $content = file_get_contents($filePath);
    $parsed = $parser->parse($content);
    
    // ファイル名をスラグとして使用
    $slug = pathinfo($file, PATHINFO_FILENAME);
    $outputPath = '/posts/' . $slug . '.html';
    
    $page = new Page($parsed['frontMatter'], $parsed['content'], $outputPath);
    $postPages[] = $page;
    
    // 個別の投稿ページを生成
    $postRenderer = new Renderer($config, $page, new PostBuilder($config, $page, 'pages/page.php'));
    $output = $postRenderer->render();
    
    file_put_contents('build' . $outputPath, $output);
    echo "Generated: build{$outputPath}\n";
}

// 投稿を日付順にソート
usort($postPages, function ($a, $b) {
    return strtotime($b->getMeta('date')) <=> strtotime($a->getMeta('date'));
});

// インデックスページの生成
$indexContent = file_get_contents('pages/index.md');
$parsedIndex = $parser->parse($indexContent);
$indexPage = new Page($parsedIndex['frontMatter'], $parsedIndex['content'], '/index.html');
$indexRenderer = new Renderer($config, $indexPage, new PageIndexBuilder($config, $indexPage, $postPages));
$indexOutput = $indexRenderer->render();

file_put_contents('build/index.html', $indexOutput);
echo "Generated: build/index.html\n";

// アセットディレクトリのコピー（存在する場合）
if (is_dir('assets')) {
    if (!is_dir('build/assets')) {
        mkdir('build/assets', 0755, true);
    }
    
    // 簡易的な再帰コピーの実装
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator('assets', RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    foreach ($iterator as $item) {
        $target = 'build/' . substr($item->getPathname(), 0);
        
        if ($item->isDir()) {
            if (!is_dir($target)) {
                mkdir($target, 0755, true);
            }
        } else {
            copy($item->getPathname(), $target);
        }
    }
    
    echo "Copied assets directory\n";
}

echo "Build completed successfully!\n";
