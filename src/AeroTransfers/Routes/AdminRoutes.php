<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 30/12/17
 * Time: 12:59
 */

namespace AeroTransfers\Routes;

use Slim\App;
use AeroTransfers\Controllers\Cities;
use AeroTransfers\Controllers\Services;

class AdminRoutes
{
    static public function getRoutes(App $app)
    {
        $app->get(
            '/admin/cities',
            Cities::class . ":getCity",
            function (Request $request, Response $response, $args) {
                return $response;
            }
        )->setName("cities");

        $app->post(
            '/admin/cities',
            Cities::class . ":postCity",
            function (Request $request, Response $response, $args) {
                return $response;
            }
        );

        $app->get(
            '/admin/services',
            Services::class . ":getService",
            function (Request $request, Response $response, $args) {
                return $response;
            }
        )->setName("services");

        $app->post(
            '/admin/services',
            Services::class . ":postService",
            function (Request $request, Response $response, $args) {
                return $response;
            }
        );
    }
}