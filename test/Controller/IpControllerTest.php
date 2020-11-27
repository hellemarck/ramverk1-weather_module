<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * test the IpController.
 */
class IpControllerTest extends TestCase
{
    // init di container and test variable
    public $di;
    public $controllerTest;

    public function setUp()
    {
        global $di;

        // funkar
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $this->controllerTest = new IpController();
        $this->controllerTest->setDi($di);
    }

    /**
     * test the index route
     */
    public function testIndexAction()
    {
        // global $di;
        $res = $this->controllerTest->indexAction();
        $this->assertIsObject($res);

        $this->assertInstanceOf(IpController::class, $this->controllerTest);
    }

    /**
     * test the ip validation
     */
    public function testValidateIpAction()
    {
        // test ip4
        // $req = $this->di->get("request");
        $_GET["ipAdress"] = "127.0.0.1";
        $res = $this->controllerTest->validateIpAction();
        // var_dump($res->getBody());
        $this->assertIsObject($res);

        // test ip6
        $_GET["ipAdress"] = "2001:db8::8a2e:370:7334";
        $res = $this->controllerTest->validateIpAction();
        $this->assertIsObject($res);

        // test not valid IP
        $_GET["ipAdress"] = "1.2.3";
        $res = $this->controllerTest->validateIpAction();
        $this->assertIsObject($res);
    }
}
