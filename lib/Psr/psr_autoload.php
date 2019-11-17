<?php

function psrClassPrefix($class): string {
    if (strlen($class) < 3) {
        return '';
    }
    return substr($class, 0, 4);
}

function psrClassPath($class): string {

    return str_replace('\\', '/', substr($class, 4));
}

function psrAutoloader($class) {
    $firstPart = psrClassPrefix($class);
    if ($firstPart != 'Psr\\') {
        return;
    }
    $shortPath = psrClassPath($class);
    $fullPath = __DIR__ . '/' . $shortPath . '.php';
    if (!file_exists($fullPath)) {
        error_log("Cannot find class " . $class . " by path " . $fullPath);
        return;
    }
    include_once $fullPath;
}

spl_autoload_register('psrAutoloader');