<?php

namespace Anax\Models;

class WeatherApiMock
{
    /**
     * model class for a 7 day weather forecast or 5 days history for a position
     * mock class for test purpose
     */

    // get city and country of location - using nominatim api
    public function getLocation()
    {
        if (!empty($this->coordinates)) {
            $this->location = [
                    "Malmö" ?? "odefinierad",
                    "Sverige" ?? " odefinierad"
                ];

            return $this->location;
        }
    }

    // check to see if input coordinates are valid, else return err
    public function validCoordinates($latitude, $longitude)
    {
        if ($latitude < 90 && $latitude > -90 && $longitude < 180 && $longitude > -180) {
            return true;
        } else {
            $this->weather = "Ogiltiga koordinater, försök igen.";
            $this->coordinates = [];
        }
    }

    // set coordinates from controller, to be able to get location info in this class
    public function setCoordinates($lat, $long)
    {
        $this->coordinates = [$lat, $long];
    }

    // give controller access to current coordinates
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    // fetch for 5 days past weather
    public function pastWeather($latitude, $longitude)
    {
        if ($this->validCoordinates($latitude, $longitude)) {
            $this->weather = [
                [
                    "date" => "2020-12-03",
                    "temp" => 1.02,
                    "description" => "mulet"
                ],
                [
                    "date" => "2020-12-02",
                    "temp" => 4.31,
                    "description" => "molnigt"
                ],
                [
                    "date" => "2020-12-01",
                    "temp" => 5,
                    "description" => "molnigt"
                ],
                [
                    "date" => "2020-11-30",
                    "temp" => 1.98,
                    "description" => "mulet"
                ],
                [
                    "date" => "2020-11-29",
                    "temp" => 0.71,
                    "description" => "klar himmel"
                ]
            ];
        }
        return $this->weather;
    }

    // fetch for 7 days coming weather
    public function comingWeather($latitude, $longitude)
    {
        if ($this->validCoordinates($latitude, $longitude)) {
            $this->weather = [
                [
                    "date" => "2020-12-03",
                    "temp" => "mellan 1.48 - 3.72",
                    "description" => "lätt snöfall"
                ],
                [
                    "date" => "2020-12-04",
                    "temp" => "mellan 2.73 - 6.29",
                    "description" => "mulet"
                ],
                [
                    "date" => "2020-12-05",
                    "temp" => "mellan 5.09 - 7.07",
                    "description" => "mulet"
                ],
                [
                    "date" => "2020-12-06",
                    "temp" => "mellan 6.75 - 8.84",
                    "description" => "lätt regn"
                ],
                [
                    "date" => "2020-12-07",
                    "temp" => "mellan 5.65 - 7.73",
                    "description" => "lätt regn"
                ],
                [
                    "date" => "2020-12-08",
                    "temp" => "mellan 4.99 - 6.1",
                    "description" => "molnigt"
                ],
                [
                    "date" => "2020-12-09",
                    "temp" => "mellan 3.83 - 4.58",
                    "description" => "lätt regn"
                ],
                [
                    "date" => "2020-12-10",
                    "temp" => "mellan 2.48 - 3.67",
                    "description" => "lätt regn"
                ]
            ];
        }

        return $this->weather;
    }
}
