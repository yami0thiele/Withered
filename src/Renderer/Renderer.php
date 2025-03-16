<?php

namespace Y0t\Withered\Renderer;

class Renderer
{
    private $page;
    private $config;
    private $builder;

    public function __construct($config, $page, $builder)
    {
        $this->config = $config;
        $this->page = $page;
        $this->builder = $builder;
    }

    public function render()
    {
        $renderer = $this;
        ob_start();
        include 'templates/layout.php';
        $output = ob_get_clean();
        return $output;
    }

    public function getContent()
    {
        return $this->builder->buildContent();
    }

    public function getMeta(string $key): ?string
    {
        return $this->page->getMeta($key);
    }

    public function getConfig(?string $key)
    {
        return $this->config->get($key);
    }
}
