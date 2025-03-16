<?php

namespace Y0t\Withered\Builder;

class PostBuilder
{
    private $config;
    private $page;
    private $mainTemplate;

    public function __construct($config, $page, $mainTemplate)
    {
        $this->config = $config;
        $this->page = $page;
        $this->mainTemplate = $mainTemplate;
    }

    public function buildContent(): string
    {
        $config = $this->config;
        $page = $this->page;
        ob_start();
        include 'templates/' . $this->mainTemplate;
        $output = ob_get_clean();
        return $output;
    }
}