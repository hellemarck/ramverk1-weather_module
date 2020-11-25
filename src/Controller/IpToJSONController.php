<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Models\IpValidator;
use Anax\Models\GeoApi;

/**
 * Controllerclass for the JSON-return of IP validation
 */
class IpToJSONController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * validation of ip address and finding location based on ip
     * using the api model classes IpValidator and GeoApi
     */
    public function validateIpApiAction()
    {
        $ipAdress = $_GET["ipAdress"];

        // create instance of class GeoApi which inherits from IpValidator
        $ipAndLocation = $this->di->get("geoapi");

        $data = [
            "valid" => $ipAndLocation->validateIp($ipAdress)["res"],
            "domain" => $ipAndLocation->validateIp($ipAdress)["domain"] ?? null,
            "location" => $ipAndLocation->findGeoLocation($ipAdress) ?? null
        ];

        // rendering the result as formatted json
        json_encode($data, true);
        return [[ $data ]];
    }
}
