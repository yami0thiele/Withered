<?php

require_once 'vendor/autoload.php';

use Y0t\Withered\Parser\MarkdownParser;
use Y0t\Withered\Config\Config;
use Y0t\Withered\Page\Page;

$parser = new MarkdownParser();
$md = file_get_contents('sample.md');
$parsed = $parser->parse($md);

$config = new Config();
$page = new Page($parsed['frontMatter'], $parsed['content']);

require 'templates/layout.php';
