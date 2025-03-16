<?php

require_once 'vendor/autoload.php';

use Y0t\Withered\Builder\PostBuilder;
use Y0t\Withered\Parser\MarkdownParser;
use Y0t\Withered\Builder\PageIndexBuilder;
use Y0t\Withered\Config\Config;
use Y0t\Withered\Page\Page;
use Y0t\Withered\Renderer\Renderer;

$parser = new MarkdownParser();
$idx = file_get_contents('pages/index.md');
$md0 = file_get_contents('sample-0.md');
$md1 = file_get_contents('sample-1.md');
$parsedIdx = $parser->parse($idx);
$parsed0 = $parser->parse($md0);
$parsed1 = $parser->parse($md1);

$config = new Config();
$page0 = new Page($parsed0['frontMatter'], $parsed0['content'], 'pages/page.php');
$page1 = new Page($parsed1['frontMatter'], $parsed1['content'], 'pages/page.php');
// $pageRenderer = new Renderer($config, $page0, new PostBuilder($config, $page0, 'pages/page.php'));

$page = new Page($parsedIdx['frontMatter'], $parsedIdx['content'], 'pages/page.php');
$pages = [$page0, $page1];
$indexRenderer = new Renderer($config, $page, new PageIndexBuilder($config, $page, $pages));

$output = $indexRenderer->render();
echo $output;
