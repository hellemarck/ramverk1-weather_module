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
    public function init()
    {
        // global $di;
        $geoObj = new GeoApiMock();
    }
}
