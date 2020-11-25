<?php
/**
 * Configuration file to add as service in the Di container.
 * find current IP
 */
return [
    // Services to add to the container.
    "services" => [
        "currentip" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Models\CurrentIp();
                return $obj->findIp();
            }
        ],
    ],
];
