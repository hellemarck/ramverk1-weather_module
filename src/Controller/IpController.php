<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Models\IpValidator;
use Anax\Models\GeoApi;
use Anax\Models\CurrentIp;

/**
 * Controllerclass for IP validation
 */
class IpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * rendering index page for user to type ip address
     * with current ip as default value
     */
    public function indexAction()
    {
        $page = $this->di->get("page");
        $title = "Validera IP-adress";

        $userIP = $this->di->get("currentip");

        $page->add("ip/index", $userIP);
        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * ip validation function - using the model ipValidator and geoApi
     * for better testing move page rendering out of function
     */
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
            "location" => $ipAndLocation->findGeoLocation($ipAdress) ?? null
        ];

        $title = "Resultat";
        $page->add("ip/result", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
