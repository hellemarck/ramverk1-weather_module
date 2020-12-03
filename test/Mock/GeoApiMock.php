<?php

namespace Anax\Models;

class GeoApiMock extends IpValidator
{
    /**
     * mocking for tests - returning info based in ip address
     */
    public function findGeoLocation()
    {
        // global $di;

        $data = [
            "city" => "Malmö" ?? "-",
            "country_name" => "Sweden" ?? "-",
            "longitude" => "12.983590126038" ?? "-",
            "latitude" => "55.594860076904" ?? "-"
        ];

        return $data;
    }
}
