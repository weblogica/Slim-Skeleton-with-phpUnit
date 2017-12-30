<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 27/12/17
 * Time: 16:44
 */

namespace AeroTransfers\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

class OldInputMiddleware extends Middleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        $this->container->view->getEnvironment()->addGlobal('oldInputs', $_SESSION['oldInputs']);
        $_SESSION['oldInputs'] = $request->getParams();

        $response = $next($request, $response);

        return $response;
    }
}