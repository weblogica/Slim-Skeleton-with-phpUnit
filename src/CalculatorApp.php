<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 18/12/17
 * Time: 17:53
 */

namespace Calculator;

use Calculator\SlimTest\Domain\Math\Math;
use Calculator\SlimTest\Domain\Text\Text;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class CalculatorApp
{
    private $app;

    public function __construct() {
        // Instantiate the app
        $settings = require __DIR__ . '/../src/settings.php';
        $app = new \Slim\App($settings);

        $container = $this->getDependencies($app);
        $this->getMiddleware($container, $app);
        $this->getRoutes($app);

        $this->app = $app;
    }

    /**
     * Get an instance of the application.
     *
     * @return \Slim\App
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param $app
     */
    private function getRoutes($app)
    {
        $app->get('/suma/{op1}/{op2}', Math::class . ":suma");
        $app->get('/concatena/{op1}/{op2}', Text::class . ":suma");
        $app->get('/helloWorld', Text::class . ":saluda");

        $app->get('/[{name}]', function (Request $request, Response $response, $args) {
            // Sample log message
            $this->logger->info("Slim-Skeleton '/' route");

            /** @var \Slim\HttpCache\CacheProvider $this ->cache */
            return $this->renderer->render($this->cache->denyCache($response), 'index.phtml', $args);
        });
    }

    /**
     * @param $container
     * @param $app
     */
    private function getMiddleware($container, $app)
    {
        // Application middleware - Register service provider
        $container['cache'] = function () {
            return new \Slim\HttpCache\CacheProvider();
        };

        // Register middleware
        $app->add(new \Slim\HttpCache\Cache('public', 86400));
    }

    /**
     * @param $app
     * @return mixed
     */
    private function getDependencies(\Slim\App $app)
    {
        /** @var \Slim\Container $container */
        $container = $app->getContainer();

        // view renderer
        $container['renderer'] = function ($c) {
            $settings = $c->get('settings')['renderer'];
            return new \Slim\Views\PhpRenderer($settings['template_path']);
        };

        // monolog
        $container['logger'] = function ($c) {
            $settings = $c->get('settings')['logger'];
            $logger   = new \Monolog\Logger($settings['name']);
            $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
            $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
            return $logger;
        };

        return $container;
    }
}