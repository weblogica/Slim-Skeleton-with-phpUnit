<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 18/12/17
 * Time: 19:30
 */

namespace Tests\Base;

abstract class BaseCalculatorTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Process the application given a request method and URI
     *
     * @param string $requestMethod the request method (e.g. GET, POST, etc.)
     * @param string $requestUri the request URI
     * @param array|object|null $requestData the request data
     * @return \Slim\Http\Response
     */
    public function runApp($requestMethod, $requestUri, $requestData = null)
    {
        /** @var \Calculator\CalculatorApp $app */
        $calculator = new \Calculator\CalculatorApp(null);
        $app = $calculator->getApp();

        // Create a mock environment for testing with
        $environment = \Slim\Http\Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );

        // Set up a request object based on the environment
        $request = \Slim\Http\Request::createFromEnvironment($environment);

        // Process the application
        $response = new \Slim\Http\Response();
        $response = $app->process($request, $response);

        // Return the response
        return $response;
    }
}
