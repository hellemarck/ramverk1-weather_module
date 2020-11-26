<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * test the IpToJSONController.
 */
class IpToJSONControllerTest extends TestCase
{
    // create variables for testing
    public $di;
    public $apiControllerTest;

    /**
     * setup for test
     */
    public function setUp()
    {
        // global $di;

        // di setup
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $this->di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");

        // init the test class
        $this->apiControllerTest = new IpToJSONController();
        $this->apiControllerTest->setDI($this->di);
    }

    /**
     * test the ip validation returning JSON
     */
    public function testValidateIpAction()
    {
        // test ip4
        $_GET["location"] = "8.8.8.8";
        $res = $this->apiControllerTest->validateIpApiAction();
        $this->assertIsArray($res);

        $_GET["ipAdress"] = "1.2.4.0";
        $res = $this->apiControllerTest->validateIpApiAction();
        $this->assertIsArray($res);

        // test ip not valid
        $_GET["ipAdress"] = "1.2.0";
        $res = $this->apiControllerTest->validateIpApiAction();

        $this->assertEquals("Ip-adressen 1.2.0 är inte giltig", $res[0][0]["valid"]); // << valid undefined
        $this->assertEquals(null, $res[0][0]["domain"]);

        // test ip6
        $_GET["ipAdress"] = "::1";
        $res = $this->apiControllerTest->validateIpApiAction();
        // var_dump($res[0]["domain"]);
        $this->assertEquals("Domänen är: localhost", $res[0][0]["domain"]);
    }
}
