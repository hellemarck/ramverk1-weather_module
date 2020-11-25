<?php
/**
 * route to validate ip
 */
 return [
     "routes" => [
         [
             "info" => "Weather.",
             "mount" => "weather",
             "handler" => "\Anax\Controller\WeatherController",
         ],
         [
             "info" => "Weather JSON format.",
             "mount" => "weatherApi",
             "handler" => "\Anax\Controller\WeatherToJSONController",
         ],
     ]
 ];
