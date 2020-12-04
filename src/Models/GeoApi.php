<?php

namespace Anax\Models;

class GeoApi extends IpValidator
{
    /**
     * model class for finding coordinates matching the ip adress
     * using the geolocation api 'ipstack'
     * child class to IpValidator
     */
    public function findGeoLocation($ipAdress)
    {
        global $di;
        var_dump("GEOAPI ANVÄNDS");

        // get the secret api key
        $config = $di->get("configuration")->load("api_keys.php") ?? null;
        $apiKey = $config["config"]["ipStack"]["apiKey"] ?? null;

        // make curl api call with ip address and api key
        $ch1 = curl_init('http://api.ipstack.com/'.$ipAdress.'?access_key='.$apiKey.'');
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch1);
        curl_close($ch1);

        /**
         * decode the json result
         * for usage in both view and rest-api controller
         */
        $result = json_decode($json, true);

        $data = [
            "city" => $result['city'] ?? "-",
            "country_name" => $result['country_name'] ?? "-",
            "longitude" => $result['longitude'] ?? "-",
            "latitude" => $result['latitude'] ?? "-"
        ];

        return $data;
    }
}
