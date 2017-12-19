<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

// Fetch DI Container
$container = $app->getContainer();

// Register service provider
$container['cache'] = function () {
    return new \Slim\HttpCache\CacheProvider();
};

// Register middleware
$app->add(new \Slim\HttpCache\Cache('public', 86400));