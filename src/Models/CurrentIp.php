<?php

namespace Anax\Models;

class CurrentIp
{
    /**
     * class to find current users ip address if available
     */
    public function findIp()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $userIP = [$_SERVER['HTTP_X_FORWARDED_FOR']];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $userIP = [$_SERVER['REMOTE_ADDR']];
        } else {
            // only for testing
            $userIP = ["127.0.0.1"];
        }

        return $userIP;
    }
}
