<?php

namespace Y0t\Withered\Page;

class Page
{
    private $meta;
    private $content;

    public function __construct($meta, $content)
    {
        $this->meta = $meta;
        $this->content = $content;
    }

    public function getMeta(string $key): ?string
    {
        return $this->meta[$key] ?? null;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
}