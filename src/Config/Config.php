<?php

namespace Y0t\Withered\Config;

class Config
{
    public function get(string $key = null) {
        $config = require('config.php');

        if ($key) {
            return $config[$key] ?? null;
        }
        return $config;
    }
}
