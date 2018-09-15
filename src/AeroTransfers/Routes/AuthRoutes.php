<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 30/12/17
 * Time: 13:02
 */

namespace AeroTransfers\Routes;

use Slim\App;
use AeroTransfers\Controllers\Users;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthRoutes
{
    static public function getRoutes(App $app)
    {
        $app->get(
            '/auth/signup',
            Users::class . ":getSignUp",
            function (Request $request, Response $response, $args) {
                return $response;
            }
        )->setName("auth.signup");

        $app->post(
            '/auth/signup',
            Users::class . ":postSignUp",
            function (Request $request, Response $response, $args) {
                return $response;
            }
        );

        $app->get(
            '/auth/signin',
            Users::class . ":getSignIn",
            function (Request $request, Response $response, $args) {
                return $response;
            }
        )->setName("auth.signin");

        $app->post(
            '/auth/signin',
            Users::class . ":postSignIn",
            function (Request $request, Response $response, $args) {
                return $response;
            }
        );

        $app->get(
            '/auth/signout',
            Users::class . ":getSignOut",
            function (Request $request, Response $response, $args) {
                return $response;
            }
        )->setName("auth.signout");
    }
}