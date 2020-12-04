<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Models\GeoApiMock;
use Anax\Models\WeatherApiMock;

/**
 * Mock controllerclass for weather forecast and history
 * TEST PURPOSE
 */
class WeatherControllerMock extends WeatherController
{
    // construct
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
        // var_dump("I MOCK SEARCHACTION");
        $page = $this->di->get("page");
        $search = $_GET["location"];

        // $type = $this->di->get("request")->getGet("type");
        // $search = str_replace(' ', '', $search);

        $weatherObj = $this->di->get("weatherapi");
        // $geoObj = $this->di->get("geoapi");

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
        // var_dump($weather);

        $data = [
            "weather" => $weather ?? null,
            "coordinates" => $weatherObj->getCoordinates() ?? null,
            "location" => $weatherObj->getLocation() ?? null
        ];

        // var_dump($data);

        $title = "Resultat";
        $page->add("weather/result", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
