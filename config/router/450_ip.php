<?php
/**
 * route to validate ip
 */
 return [
     "routes" => [
         [
             "info" => "IP validator.",
             "mount" => "ip",
             "handler" => "\Anax\Controller\IpController",
         ],
         [
             "info" => "IP validator JSON format.",
             "mount" => "ipApi",
             "handler" => "\Anax\Controller\IpToJSONController",
         ],
     ]
 ];
