<?php

namespace Y0t\Withered\Config;

class Config
{
    public function get(?string $key) {
        $config = require('config.php');

        if ($key !== null) {
            return $config[$key] ?? null;
        }
        return $config;
    }
}
