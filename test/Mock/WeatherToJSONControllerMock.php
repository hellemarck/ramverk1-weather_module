<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Models\GeoApiMock;
use Anax\Models\WeatherApiMock;

/**
 * Controllerclass for the JSON-return of weather forecast
 */
class WeatherToJSONControllerMock extends WeatherToJSONController
{

    /**
     * init mock objects
     */

    public function __construct()
    {
        $this->past = new WeatherApiMock();
        $this->past->pastWeatherMock();

        $this->coming = new WeatherApiMock();
        $this->coming->comingWeatherMock();

        $this->geoLocation = new GeoApiMock();
        $this->geoLocation->findGeoLocation();
    }

    public function searchAction()
    {
        // var_dump("I MOCK JSON SEARCHACTION");

        $search = $_GET["location"];
        $weatherObj = $this->di->get("weatherapi");

        if (strpos($search, ",") == true) {
            $split = explode(",", $search);
            if (!ctype_alpha($split[0]) && !ctype_alpha($split[1])) {
                $weatherObj->setCoordinates($split[0], $split[1]);
                $weather = $this->past->weather;
            } else {
                $weather = "Felaktig söksträng, försök igen.";
            }
        } else {
            $res = $this->geoLocation->data;
            if ($res["longitude"] !== "-") {
                $weatherObj->setCoordinates($res["latitude"], $res["longitude"]);
                $weather = $this->coming->weather;
            } else {
                $weather = "Felaktig söksträng, försök igen.";
            }
        }
        // var_dump("VÄDER EFTER SEARCHACTION");

        $data = [
            "weather" => $weather ?? null,
            "coordinates" => $weatherObj->getCoordinates() ?? null,
            "location" => $weatherObj->getLocation() ?? null
        ];

        json_encode($data, true);

        return [[ $data ]];
    }
}
