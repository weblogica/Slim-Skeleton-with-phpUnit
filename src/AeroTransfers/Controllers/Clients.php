<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 24/12/17
 * Time: 11:26
 */

namespace AeroTransfers\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use AeroTransfers\Infrastructure\Model\Clients as ClientModel;

class Clients extends BaseController
{
    protected $table = "clients";

    public function __construct(\Slim\Container $container)
    {
        parent::__construct($container);
    }

    public function findOne(Request $request, Response $response, $args)
    {
        $client = ClientModel::where("id", $args['id'])->first();

        $response = $this->view->render(
            $response,
            "app.twig"
        );

        return $response;
    }

    public function createNewClient (Request $request, Response $response, $args)
    {
        ClientModel::create([
            "id" => null,
            "name" => $args['name']
        ]);
    }
    
    public function getSignUp (Request $request, Response $response){
        $response = $this->view->render(
            $response,
            "signup.twig"
        );

        return $response;
    }

    public function postSignUp(Request $request, Response $response)
    {
        ClientModel::create([
            "id" => null,
            "name" => $args['name']
        ]);
    }

}