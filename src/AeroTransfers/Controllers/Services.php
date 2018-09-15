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
use AeroTransfers\Infrastructure\Model\Services as ServicesModel;

class Services extends BaseController
{
    protected $table = "services";

    public function __construct(\Slim\Container $container)
    {
        parent::__construct($container);
    }

    public function getService(Request $request, Response $response){
        $response = $this->view->render(
            $response,
            "services.twig"
        );

        return $response;
    }

    public function postService(Request $request, Response $response)
    {
        /** @var \AeroTransfers\Validation\Validator $validation */
        $validation = $this->validator->validate($request, [
            "name"          => Validator::notEmpty()->alpha(),
            "description"   => Validator::notEmpty()->alpha(),
            "price"         => Validator::notEmpty()->numeric(),
            "currency"      => Validator::notEmpty()
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor("admin.services"));
        }

        ServicesModel::create([
            "name"          => $request->getParam("name"),
            "description"   => $request->getParam("description"),
            "price"         => $request->getParam("price"),
            "currency"      => $request->getParam("currency")
        ]);

        return $response->withRedirect($this->router->pathFor("home"));
    }

}