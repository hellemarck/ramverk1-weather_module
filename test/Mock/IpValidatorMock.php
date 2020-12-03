<?php

namespace Anax\Models;

class IpValidatorMock
{
    /**
     * model class for ip validation: parent class to GeoApi
     * used by IpController and IpToJSONController
     */
    public function validateIp($ipAdress)
    {
        if (filter_var($ipAdress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $res = "$ipAdress är en giltig IP4-adress.";
            $domain = "Domänen är: " . gethostbyaddr($ipAdress);
        } elseif (filter_var($ipAdress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $res = "$ipAdress är en giltig IP6-adress.";
            $domain = "Domänen är: " . gethostbyaddr($ipAdress);
        } else {
            $res = "Ip-adressen $ipAdress är inte giltig";
        }

        // returning the result to controller to send to view
        $data = [
            "res" => $res,
            "domain" => $domain ?? null
        ];

        return $data;
    }
}
