<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 18/12/17
 * Time: 11:31
 */

namespace Tests\Functional;

use Calculator\CalculatorApp;
use Tests\Base\BaseCalculatorTestCase;

class MathTests extends BaseCalculatorTestCase
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

    public function testSumaOk()
    {
        /** @var \Slim\Http\Response $response */
        $response = parent::runApp("GET", "/suma/10/10");

        $this->assertSame($response->getStatusCode(), 200);
        $this->assertEquals("20", (string)$response->getBody());
    }

    public function testSumaKo()
    {
        /** @var \Slim\Http\Response $response */
        $response = parent::runApp("GET", "/suma/14/5");

        $this->assertSame($response->getStatusCode(), 200);
        $this->assertNotEquals("9", (string)$response->getBody());
    }
}
