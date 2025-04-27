<?php

spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/src/';
    $class = str_replace('\\', '/', $class);
    $file = $baseDir . $class . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});