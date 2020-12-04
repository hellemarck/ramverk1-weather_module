<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Models\IpValidatorMock;
use Anax\Models\GeoApiMock;

/**
 * Mock controllerclass for the JSON-return of IP validation
 */
class IpToJSONControllerMock extends IpToJSONController
{
    // init object of mock class
    public function init()
    {
        $this->geo = new GeoApiMock();
    }

    public function validateIpApiAction()
    {
        $ipAdress = $_GET["ipAdress"];

        // create instance of class GeoApi which inherits from IpValidator
        $ipAndLocation = $this->di->get("geoapi");

        $data = [
            "valid" => $ipAndLocation->validateIp($ipAdress)["res"],
            "domain" => $ipAndLocation->validateIp($ipAdress)["domain"] ?? null,
            "location" => $this->geo->findGeoLocation() ?? null
        ];

        // rendering the result as formatted json
        json_encode($data, true);
        return [[ $data ]];
    }
}
