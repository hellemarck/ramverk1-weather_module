<?php
/**
 * Configuration file to add as service in the Di container.
 * WeatherApi
 */
return [
    // Services to add to the container.
    "services" => [
        "weatherapi" => [
            "shared" => true,
            "callback" => function () {
                $config = $this->get("configuration")->load("api_keys.php");
                $apiKey = $config["config"]["openWeather"]["apiKey"];

                $wApi = 'https://api.openweathermap.org/';
                $lApi = 'https://nominatim.openstreetmap.org/';

                $obj = new \Anax\Models\WeatherApi($this, $apiKey, $wApi, $lApi);
                return $obj;
            }
        ],
    ],
];
