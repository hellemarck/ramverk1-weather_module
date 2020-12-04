<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Models\GeoApi;
use Anax\Models\CurrentIp;
use Anax\Models\WeatherApi;

/**
 * Controllerclass for weather forecast and history
 */
class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * rendering index page for user to type ip address or coordinates
     * with current ip-address as default
     */
    public function indexAction()
    {
        $page = $this->di->get("page");
        $title = "Väderprognoser";

        $userIP = $this->di->get("currentip");

        $page->add("weather/index", $userIP);
        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * 7 day weather forecast / 5 days history - using the model WeatherAPI
     * takes user input as "search" and sends it to model, returns to view
     */
    public function searchAction()
    {
        $page = $this->di->get("page");
        $search = $_GET["location"];

        $type = $this->di->get("request")->getGet("type");
        $search = str_replace(' ', '', $search);

        $weatherObj = $this->di->get("weatherapi");
        $geoObj = $this->di->get("geoapi");

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
                $weather = ($type == "coming" && test == false) ? ($weatherObj->comingWeather($res["latitude"], $res["longitude"])) : $weatherObj->pastWeather($res["latitude"], $res["longitude"]);
            } else {
                $weather = "Felaktig söksträng, försök igen.";
            }
        }

        $data = [
            "weather" => $weather ?? null,
            "coordinates" => $weatherObj->getCoordinates() ?? null,
            "location" => $weatherObj->getLocation() ?? null
        ];

        $title = "Resultat";
        $page->add("weather/result", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
