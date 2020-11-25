<?php
/**
 * Configuration file to add as service in the Di container.
 * GeoApi
 */
return [
    // Services to add to the container.
    "services" => [
        "geoapi" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Models\GeoApi();
                return $obj;
            }
        ],
    ],
];
