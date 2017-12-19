<?php

namespace Calculator\SlimTest\Domain\Text;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 6/06/17
 * Time: 16:12
 */

class Text
{
    /** @var int */
    private $op1;

    /** @var int */
    private $op2;

    /** @var \Slim\Container $container  */
    private $container = null;

    public function __construct(\Slim\Container $container = null)
    {
        $this->container = $container;
    }
    
    public function suma(Request $request, Response $response, $args)
    {
        $this->container->logger->info("Call to concatena function");
        $response->getBody()->write($args['op1'] . $args['op2']);
        return $this->container->cache->allowCache($response, 'public', 3600);
    }

    /**
     * @return int
     */
    public function saluda(Request $request, Response $response, $args)
    {
        $response->getBody()->write("Hello World");
        return $this->container->cache->allowCache($response, 'public', 3600);
    }
}
