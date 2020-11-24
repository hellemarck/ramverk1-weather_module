<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * test the IpController.
 */
class WeatherControllerTest extends TestCase
{
    // init di container and test variable
    protected $di;
    public $weatherTest;

    protected function setUp()
    {
        global $di;

        // di setup
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $this->di = $di;

        // init the test class
        // mos put this part in every test case
        $this->weatherTest = new WeatherController();
        $this->weatherTest->setDI($this->di);
    }

    /**
     * test the index route
     */
    public function testIndexAction()
    {
        $res = $this->weatherTest->indexAction();
        $this->assertEquals($res === null, false);
    }

    /**
     * test ip, coordinates and incorrect user input
     */
    public function testSearchWrongAction()
    {
        $_GET["location"] = "hej,hej";
        $_GET["type"] = "coming";
        $res = $this->weatherTest->searchAction();
        $body = $res->getBody();
        $this->assertContains('Felaktig söksträng', $body);
    }

    public function testSearchWrongIpAction()
    {
        $_GET["location"] = "1.2.3";
        $_GET["type"] = "coming";
        $res = $this->weatherTest->searchAction();
        $body = $res->getBody();
        $this->assertContains('försök igen', $body);
    }

    public function testSearchComingAction()
    {
        $_GET["location"] = "55.6,13.2";
        $_GET["type"] = "coming";
        $res = $this->weatherTest->searchAction();
        $body = $res->getBody();
        $this->assertContains('Staffanstorps kommun', $body);
        $this->assertIsObject($res);
    }

    public function testSearchPastAction()
    {
        $_GET["location"] = "8.8.8.8";
        $_GET["type"] = "past";
        $res = $this->weatherTest->searchAction();
        $this->assertIsObject($res);
        $this->assertInstanceOf("Anax\Response\Response", $res);
    }

    public function testSearchWrongCoordAction()
    {
        $_GET["location"] = "444,44";
        $_GET["type"] = "past";
        $res = $this->weatherTest->searchAction();
        $this->assertIsObject($res);
    }
}
