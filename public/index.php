<?php

$libDir = __DIR__.'/../lib';
$appDir = __DIR__.'/../app';
$configDir = __DIR__.'/../config';

require_once $libDir.'/Psr/psr_autoload.php';
require_once $libDir.'/jsonmapper/src/JsonMapper.php';
require_once $appDir.'/app_autoload.php';

use Psr\Log\NullLogger;
use sm\apiclient\curl\Config;
use sm\apiclient\curl\CurlClient;
use stat\PostsStat;

try {
    $defaultLogger = new NullLogger();
    $client = new CurlClient(new Config($configDir, $defaultLogger));

    $allPosts = array();
    for ($i = 1; $i <= 10; $i++) {
        $allPosts = array_merge($allPosts, $client->getPosts(1)->data->posts);
    }

    $postsStat = new PostsStat($defaultLogger);

    $statData = $postsStat->getStat(...$allPosts);

    header("Content-type: application/json");
    echo json_encode($statData);

} catch (Exception $e) {
    header("Content-type: text/plain", true, 500);
    echo 'Something went wrong.';
}