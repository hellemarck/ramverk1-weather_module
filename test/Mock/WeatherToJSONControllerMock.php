<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Models\WeatherApiMock;
use Anax\Models\GeoApiMock;
use Anax\Models\CurrentIpMock;

// use Anax\Models\IpValidator;
// use Anax\Models\GeoApi;

/**
 * Controllerclass for the JSON-return of weather forecast
 */
class WeatherToJSONControllerMock implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * based on ip address or coordinates for a location
     * returning the forecast for 7 days
     */
    public function searchAction()
    {
        $search = $_GET["location"];
        $type = $this->di->get("request")->getGet("type");

        $weatherObj = new WeatherApiMock();
        $geoObj = new GeoApiMock();

        if (strpos($search, ",") == true) {
            $split = explode(",", $search);
            if (!ctype_alpha($split[0]) && !ctype_alpha($split[1])) {
                $weatherObj->setCoordinates($split[0], $split[1]);
                $weather = ($type == "coming") ? ($weatherObj->comingWeather($split[0], $split[1])) : $weatherObj->pastWeather($split[0], $split[1]);
            } else {
                $weather = "Felaktig söksträng, försök igen.";
            }
        } else {
            $res = $geoObj->findGeoLocation($search);
            if ($res["longitude"] !== "-") {
                $weatherObj->setCoordinates($res["latitude"], $res["longitude"]);
                $weather = ($type == "coming") ? ($weatherObj->comingWeather($res["latitude"], $res["longitude"])) : $weatherObj->pastWeather($res["latitude"], $res["longitude"]);
            } else {
                $weather = "Felaktig söksträng, försök igen.";
            }
        }

        $data = [
            "weather" => $weather ?? null,
            "coordinates" => $weatherObj->getCoordinates() ?? null,
            "location" => $weatherObj->getLocation() ?? null
        ];


        json_encode($data, true);

        return [[ $data ]];
    }
}
