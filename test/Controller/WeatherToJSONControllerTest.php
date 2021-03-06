<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * test the IpToJSONController.
 */
class WeatherToJSONControllerTest extends TestCase
{
    // create variables for testing
    public $di;
    public $test;

    /**
     * setup for test
     */
    public function setUp()
    {
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $this->di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");

        // init the test class
        $this->test = new WeatherToJSONControllerMock();
        $this->test->setDI($this->di);
        // $this->test->init();
    }

    /**
     * test the weather api returning JSON
     */
    public function testSearchAction()
    {
        // var_dump("pre");
        $_GET["location"] = "127.0.0.1";
        $res = $this->test->searchAction();
        // var_dump("HELLOOOO");
        $this->assertIsArray($res);
    }

    public function test2SearchAction()
    {
        $res = $this->test->searchAction();
        $this->assertIsArray($res);
        // var_dump($res[0][0]["weather"]);
        $this->assertIsArray($res);
    }

    public function test3SearchAction()
    {
        $_GET["location"] = "59.40,13.51";
        $res = $this->test->searchAction();
        $this->assertEquals($res[0][0]["coordinates"][0], "59.40");
        $this->assertIsString($res[0][0]["location"][0]);
    }
}
