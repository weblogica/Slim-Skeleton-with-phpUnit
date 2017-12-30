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
use AeroTransfers\Infrastructure\Model\Users as UsersModel;

class Users extends BaseController
{
    protected $table = "clients";

    public function __construct(\Slim\Container $container)
    {
        parent::__construct($container);
    }

    public function getSignOut (Request $request, Response $response)
    {
        $this->auth->logOut();

        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function getSignIn (Request $request, Response $response){
        $response = $this->view->render($response, "signin.twig");

        return $response;
    }

    public function postSignIn(Request $request, Response $response)
    {
        // todo implementation
        $auth = $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );

        if (!$auth) {
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }

        return $response->withRedirect($this->router->pathFor('home'));
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
        /** @var \AeroTransfers\Validation\Validator $validation */
        $validation = $this->validator->validate($request, [
            "name"          => Validator::notEmpty()->alpha(),
            "email"         => Validator::noWhitespace()->notEmpty()->email()->EmailAvailable(),
            "password"      => Validator::noWhitespace()->notEmpty()
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor("auth.signup"));
        }

        UsersModel::create([
            "name"      => $request->getParam("name"),
            "email"     => $request->getParam("email"),
            "password"  => password_hash($request->getParam("password"), PASSWORD_DEFAULT)
        ]);

        return $response->withRedirect($this->router->pathFor("home"));
    }

}