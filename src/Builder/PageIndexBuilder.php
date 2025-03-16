<?php

namespace Y0t\Withered\Builder;

use Y0t\Withered\Parser\MarkdownParser;

class PageIndexBuilder
{
    private $config;
    private $page;
    private $pages;

    public function __construct($config, $page, $pages)
    {
        $this->config = $config;
        $this->page = $page;
        $this->pages = $pages;
    }

    public function buildContent(): string
    {
        $content = $this->page->getContent();

        usort($this->pages, function ($a, $b) {
            return strtotime($b->getMeta('date')) <=> strtotime($a->getMeta('date'));
        });

        $list = [];

        foreach ($this->pages as $page) {
            $list[] = <<<HTML
            <li>
                <div class="posted_at">{$page->getMeta('date')}</div>
                <a href="{$page->getPath()}">{$page->getMeta('title')}</a>
            </li>
            HTML;
        }

        $list = implode('', $list);
        
        $extraContent = <<<HTML
        <ul class="post_list">
            {$list}
        </ul>
        HTML;

        return $content . $extraContent;
    }
}
