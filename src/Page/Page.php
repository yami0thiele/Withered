<?php

namespace Y0t\Withered\Page;

class Page
{
    private $meta;
    private $content;
    private $path;

    public function __construct($meta, $content, $path)
    {
        $this->meta = $meta;
        $this->content = $content;
        $this->path = $path;
    }

    public function getMeta(string $key): ?string
    {
        return $this->meta[$key] ?? null;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }
}
