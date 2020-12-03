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
    /**
     * init mock objects
     */
    public function init()
    {
        $this->weatherObj = new WeatherApiMock();
        $this->geoObj = new GeoApiMock();
    }
}
