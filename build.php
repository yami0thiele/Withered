<?php

require_once 'vendor/autoload.php';

use Y0t\Withered\Parser\MarkdownParser;

$parser = new MarkdownParser();
$md = file_get_contents('sample.md');
$contents = $parser->parse($md);

echo (json_encode($contents, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL);