<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 24/12/17
 * Time: 1:06
 */

namespace AeroTransfers\Controllers;

class BaseController
{
    /** @var \Slim\Container $container  */
    protected $container = null;

    public function __construct(\Slim\Container $container = null)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container->{$property}){
            return $this->container->{$property};
        }
    }
}