<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Models\IpValidatorMock;
use Anax\Models\GeoApiMock;

/**
 * Mock controllerclass for the JSON-return of IP validation
 */
class IpToJSONControllerMock extends IpToJSONController
{
    // init object of mock class
    public function init()
    {
        $this->ipAndLocation = new GeoApiMock();
    }
}
