<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 24/12/17
 * Time: 11:26
 */

namespace AeroTransfers\Controllers;

use Respect\Validation\Validator;
use Slim\Http\Request;
use Slim\Http\Response;
use AeroTransfers\Infrastructure\Model\Cities as CitiesModel;

class Cities extends BaseController
{
    protected $table = "cities";

    public function __construct(\Slim\Container $container)
    {
        parent::__construct($container);
    }

    public function getCity(Request $request, Response $response){
        $response = $this->view->render(
            $response,
            "cities.twig"
        );

        return $response;
    }

    public function postCity(Request $request, Response $response)
    {
        /** @var \AeroTransfers\Validation\Validator $validation */
        $validation = $this->validator->validate($request, [
            "name"          => Validator::notEmpty()->alpha(),
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor("cities"));
        }

        CitiesModel::create([
            "name"      => $request->getParam("name")
        ]);

        return $response->withRedirect($this->router->pathFor("home"));
    }

}