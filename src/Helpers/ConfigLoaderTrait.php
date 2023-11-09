<?php

namespace Loki\Helpers;

trait ConfigLoaderTrait {

    public function getConfig($key) {
        list($filename, $configKey) = explode('.', $key, 2);

        $path = __DIR__ . '/../config/' . $filename . '.php';
        if (file_exists($path)) {
            $config = require $path;
            return $config[$configKey] ?? null;
        }
        return null;
    }
}