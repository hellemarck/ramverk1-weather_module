<?php

namespace Anax\Models;

class GeoApiMock extends GeoApi
{
    /**
     * mocking for tests - returning info based in ip address
     */
    public function findGeoLocation($ipAdress = "")
    {
        $this->data = [
            "city" => "Malmö" ?? "-",
            "country_name" => "Sweden" ?? "-",
            "longitude" => "12.983590126038" ?? "-",
            "latitude" => "55.594860076904" ?? "-"
        ];

        return $this->data;
    }
}
