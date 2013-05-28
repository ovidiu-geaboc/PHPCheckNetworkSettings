<?php

class NetSettingsValidator
{
    static function isIpAddressValid($ip)
    {
        return(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4));
    }


    static function isNetmaskValid($netmask)
    {
        return(self::isIpAddressValid($netmask));
    }

    static function settingsAreValid($ip, $netmask, $gateway, $dns1, $dns2)
    {
        $valuesValid = true;

        $valuesValid = $valuesValid && (self::isIpAddressValid($ip)) && (self::isIpAddressValid($netmask)) && (self::isIpAddressValid($gateway));
        if(!empty($dns1))
        {
            $valuesValid = $valuesValid && (self::isIpAddressValid($dns1));
        }
        if(!empty($dns2))
        {
            $valuesValid = $valuesValid && (self::isIpAddressValid($dns2));
        }
        $ipBinary = ip2long($ip);
        $netmaskBinary = ip2long($netmask);
        $gatewayBinary = ip2long($gateway);
        //check (IP & NETMASK) = (GATEWAY & NETMASK)
        $isSameSubNet = (($ipBinary & $netmaskBinary) == ($gatewayBinary & $netmaskBinary)) ;

        return($valuesValid && $isSameSubNet);
    }
 }

