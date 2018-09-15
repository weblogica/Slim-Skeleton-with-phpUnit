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
use Slim\Http\Request;
use Slim\Http\Response;

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
        )->setName("admin.cities");

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
        )->setName("admin.services");

        $app->post(
            '/admin/services',
            Services::class . ":postService",
            function (Request $request, Response $response, $args) {
                return $response;
            }
        );
    }
}