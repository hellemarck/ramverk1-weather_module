<?php
/**
 * Configuration file to add as service in the Di container.
 * IpValidator
 */
return [
    // Services to add to the container.
    "services" => [
        "ipvalidator" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Models\IpValidator();
                return $obj;
            }
        ],
    ],
];
