<?php

namespace Anax\Models;

class WeatherApi
{
    /**
     * model class for a 7 day weather forecast or 5 days history for a position
     * using the weather api 'openweather'
     * service container in $di
     */

    public function __construct(\Anax\DI\DIFactoryConfig $di = null, $apiKey = null, $wApi = null, $lApi = null)
    {
        $this->di = $di;
        $this->apiKey = $apiKey;
        $this->weatherApi = $wApi;
        $this->locationApi = $lApi;
        $this->weather = [];
        $this->coordinates = [];
        $this->location = [];
    }

    // get city and country of location - using nominatim api
    public function getLocation()
    {
        if (!empty($this->coordinates)) {
            // for test cases - no great solution i know
            if (!isset($_SERVER["HTTP_REFERER"])) {
                $server = "http://google.com";
            } else {
                $server = $_SERVER["HTTP_REFERER"];
            }

            $ch2 = curl_init($this->locationApi.'reverse?format=geocodejson&lat='.$this->coordinates[0].'&lon='.$this->coordinates[1].'');
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch2, CURLOPT_REFERER, $server);

            $json = curl_exec($ch2);
            curl_close($ch2);

            $result = json_decode($json, true);

            $this->location = [
                    $result["features"][0]["properties"]["geocoding"]["city"] ?? "odefinierad",
                    $result["features"][0]["properties"]["geocoding"]["country"] ?? " odefinierad"
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

    // get the past five days date in linux format
    public function pastFive()
    {
        $days = [];
        for ($i = 0; $i > -5; $i--) {
            $days[] = strtotime("$i days");
        }
        return $days;
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

    // for testing - set weather manually
    // public function setWeather($w)
    // {
    //     $this->weather = $w;
    // }

    // fetch for 5 days past weather
    public function pastWeather($latitude, $longitude)
    {
        if ($this->validCoordinates($latitude, $longitude)) {
            var_dump("PASTWEATHER ANVÄNDS");
            // var_dump($this->weather);
            // var_dump("^^^ väder");
            $pastFive = $this->pastFive();
            $fetch = $this->weatherApi.'data/2.5/onecall/timemachine?lat='.$latitude.'&lon='.$longitude.'&lang=sv&units=metric&dt=';

            $mcurl = curl_multi_init();
            $fiveDays = [];
            foreach ($pastFive as $day) {
                $ch3 = curl_init($fetch.$day.'&APPID='.$this->apiKey.'');
                curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
                curl_multi_add_handle($mcurl, $ch3);
                $fiveDays[] = $ch3;
            }

            $run = null;

            do {
                curl_multi_exec($mcurl, $run);
            } while ($run);

            foreach ($fiveDays as $curl) {
                curl_multi_remove_handle($mcurl, $curl);
            }

            curl_multi_close($mcurl);

            foreach ($fiveDays as $day) {
                $output = curl_multi_getcontent($day);
                $exploded = json_decode($output, true);

                $current = [
                    "date" => gmdate("Y-m-d", $exploded["current"]["dt"]),
                    "temp" => $exploded["current"]["temp"],
                    "description" => $exploded["current"]["weather"][0]["description"]
                ];
                $this->weather[] = $current;
            }
        }
        return $this->weather;
    }

    // fetch for 7 days coming weather
    public function comingWeather($latitude, $longitude)
    {
        if ($this->validCoordinates($latitude, $longitude)) {
            var_dump("COMINGWEATHER ANVÄNDS");
            $exclude = "current,minutely,hourly,alerts";

            $ch1 = curl_init($this->weatherApi.'data/2.5/onecall?lat='.$latitude.'&lon='.$longitude.'&cnt={}&exclude='.$exclude.'&units=metric&lang=sv&appid='.$this->apiKey.'');

            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

            $json = curl_exec($ch1);
            curl_close($ch1);

            $result = json_decode($json, true);

            $sevenDays = $result["daily"];

            foreach ($sevenDays as $value) {
                $current = [
                    "date" => gmdate("Y-m-d", $value["dt"]),
                    "temp" => "mellan ".$value["temp"]["min"] . " - " . $value["temp"]["max"],
                    "description" => $value["weather"][0]["description"]
                ];
                $this->weather[] = $current;
            }
        }
        return $this->weather;
    }
}
