<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 18/12/17
 * Time: 11:31
 */

namespace Tests\Functional;

use Calculator\CalculatorApp;
use Calculator\SlimTest\Domain\Text\Text;
use Tests\Base\BaseCalculatorTestCase;

class TextTests extends BaseCalculatorTestCase
{
    /** @var \Slim\App app */
    protected $app;

    public function setUp()
    {
        $this->app = (new CalculatorApp(null))->getApp();
    }

    public function testTodoGet() {
        $this->assertTrue(true);
    }

    public function testConcatenaOk()
    {
        /** @var \Slim\Http\Response $response */
        $response = parent::runApp("GET", "/concatena/a/b");

        $this->assertSame($response->getStatusCode(), 200);
        $this->assertEquals("ab", $response->getBody());
    }

    public function testConcatenaKo()
    {
        /** @var \Slim\Http\Response $response */
        $response = parent::runApp("GET", "/concatena/a/b");

        $this->assertSame($response->getStatusCode(), 200);
        $this->assertNotEquals("a", $response->getBody());
    }

    public function testConcatenaCharsOk()
    {
        $text = new Text($this->app->getContainer());

        // Create a mock environment for testing with
        $environment = \Slim\Http\Environment::mock(
            [
                'REQUEST_METHOD' => "GET",
                'REQUEST_URI' => "/"
            ]
        );

        // Set up a request object based on the environment
        $request = \Slim\Http\Request::createFromEnvironment($environment);

        // Process the application
        $response = new \Slim\Http\Response();

        /** @var \Slim\Http\Response $response */
        $response = $text->suma($request, $response, ["op1" => "a", "op2" => "b"]);

        $this->assertSame($response->getStatusCode(), 200);
        $this->assertEquals("ab", $response->getBody());
    }

    public function testSaludaOk()
    {
        $text = new Text($this->app->getContainer());

        // Create a mock environment for testing with
        $environment = \Slim\Http\Environment::mock(
            [
                'REQUEST_METHOD' => "GET",
                'REQUEST_URI' => "/"
            ]
        );

        // Set up a request object based on the environment
        $request = \Slim\Http\Request::createFromEnvironment($environment);

        // Process the application
        $response = new \Slim\Http\Response();

        /** @var \Slim\Http\Response $response */
        $response = $text->saluda($request, $response, []);

        $this->assertSame($response->getStatusCode(), 200);
        $this->assertEquals("Hello World", $response->getBody());
    }
}
