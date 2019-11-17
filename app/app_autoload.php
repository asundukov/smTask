<?php

function appClassAutoloader($class) {
    $appPath = str_replace('\\', '/', $class);
    $fullPath = __DIR__ . '/' . $appPath . '.php';
    if (!file_exists($fullPath)) {
        error_log("Cannot find class " . $class . " by path " . $fullPath);
        return;
    }
    include_once $fullPath;
}

spl_autoload_register('appClassAutoloader');
