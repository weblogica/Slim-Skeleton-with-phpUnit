<?php

namespace Calculator\SlimTest\Domain\Math;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 6/06/17
 * Time: 16:12
 */

class Math
{
    /** @var int */
    private $op1;

    /** @var int */
    private $op2;

    private $container = null;

    public function __construct(Container $container = null)
    {
        $this->container = $container;
    }

    public function suma(Request $request, Response $response, $args)
    {
        $response->getBody()->write((int)$args['op1'] + (int)$args['op2']);
        return $response;

        /** Todo investigate cache functions */
        //return $this->container->cache->allowCache($response, 'public', 3600);
    }
}
