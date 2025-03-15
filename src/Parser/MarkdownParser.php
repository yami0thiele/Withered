<?php

namespace Y0t\Withered\Parser;

use Parsedown;
use Symfony\Component\Yaml\Yaml;

class MarkdownParser
{
    private $parsedown;

    public function __construct()
    {
        $this->parsedown = new Parsedown();
    }

    function parse(string $md): array {
        [$frontMatter, $content] = $this->splitFrontMatterAndContent($md);
        return [
            'frontMatter' => $frontMatter,
            'content' => $this->parsedown->text($content),
        ];
    }

    /**
     * FrontMatter と　コンテンツ部分に分割する。
     * @param string $md
     */
    function splitFrontMatterAndContent(string $md): array {
        $parts = explode(PHP_EOL, $md);

        if (count($parts) < 3 || !str_contains($parts[0], '---')) {
            echo "FrontMatter is not found." . PHP_EOL;
            return [[], $md];
        }

        $frontMatter = [];
        $content = [];
        $isFrontMatter = true;
        foreach (array_splice($parts, 1) as $part) {
            if (str_contains($part, '---')) {
                $isFrontMatter = false;
                continue;
            }

            if ($isFrontMatter) {
                $frontMatter[] = $part;
            } else {
                $content[] = $part;
            }
        }

        if ($isFrontMatter) {
            // FrontMatter が閉じられていない場合は、全てコンテンツとして扱う
            echo "FrontMatter is not closed." . PHP_EOL;
            return [[], $md];
        }
         
        return [Yaml::parse(implode(PHP_EOL, $frontMatter)), implode(PHP_EOL, $content)];
    }
}