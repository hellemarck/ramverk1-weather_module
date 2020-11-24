<?php

/**
 * EXAMPLE: config-file for api-keys - create one for each api
 * ipstack (geolocation)
 * openweather (weather)
 *
 * USAGE -------------------------
 * 1 change the apiKey to your personal one
 * 2 change the name of this file depending on your API
 *    - api_key_ip.php
 *    - api_key_weather.php
 */

return [
    // using the example "ipStack", if weather write "openWeather"
    "ipStack" => [
        "apiKey" => "xxxxxxxxxxxxxxxxxx"
    ]
];
