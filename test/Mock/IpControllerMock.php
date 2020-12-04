<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
// use Anax\Models\IpValidatorMock;
use Anax\Models\GeoApiMock;

// use Anax\Models\CurrentIp;

/**
 * Mock Controllerclass for IP validation
 */
class IpControllerMock extends IpController
{
    // init object of mock class
    public function init()
    {
        $this->geo = new GeoApiMock();
    }

    public function validateIpAction()
    {
        $page = $this->di->get("page");
        $ipAdress = $_GET["ipAdress"];

        /**
         * Create an instance of class GeoApi which inherits from IpValidator
         * Validates IP address in parent class and finds location in child class
         */
        $ipAndLocation = $this->di->get("geoapi");

        $data = [
            "valid" => $ipAndLocation->validateIp($ipAdress)["res"],
            "domain" => $ipAndLocation->validateIp($ipAdress)["domain"] ?? null,
            "location" => $this->geo->findGeoLocation() ?? null
        ];

        $title = "Resultat";
        $page->add("ip/result", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
