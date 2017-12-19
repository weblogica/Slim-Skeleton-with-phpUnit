<?php
// Routes

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Calculator\SlimTest\Domain\Text\Text;
use Calculator\SlimTest\Domain\Math\Math;

$app->get('/suma/{op1}/{op2}', Math::class . ":suma");
$app->get('/concatena/{op1}/{op2}', Text::class . ":suma");
$app->get('/helloWorld', Text::class . ":saluda");

$app->get('/[{name}]', function (Request $request, Response $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    /** @var \Slim\HttpCache\CacheProvider $this->cache */
    return $this->renderer->render($this->cache->denyCache($response), 'index.phtml', $args);
});
