<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 27/12/17
 * Time: 16:41
 */

namespace AeroTransfers\Middleware;

use Slim\Container;

class Middleware
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}