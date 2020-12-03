<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
// use Anax\Models\IpValidatorMock;
use Anax\Models\GeoApiMock;

// use Anax\Models\CurrentIp;

/**
 * Mock Controllerclass for IP validation
 */
class IpControllerMock extends IpController
{
    // init object of mock class
    public function init()
    {
        $this->ipAndLocation = new GeoApiMock();
    }
}
