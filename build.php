<?php

require_once 'vendor/autoload.php';

use Y0t\Withered\Parser\MarkdownParser;
use Y0t\Withered\Config\Config;
use Y0t\Withered\Page\Page;

$parser = new MarkdownParser();
$md = file_get_contents('sample.md');
$contents = $parser->parse($md);

$config = new Config();
$page = new Page($contents);

require 'templates/layout.php';

