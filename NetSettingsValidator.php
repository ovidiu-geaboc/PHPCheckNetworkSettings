<?php

class NetSettingsValidator
{
    function isIpAddressValid($ip)
    {
        return(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4));
    }


    function isNetmaskValid($netmask)
    {
        return($this->isIpAddressValid($netmask));
    }



    function settingsAreValid($ip, $netmask, $gateway, $dns1, $dns2)
    {
        $valuesValid = true;

        $valuesValid = $valuesValid && ($this->isIpAddressValid($ip)) && ($this->isIpAddressValid($netmask)) && ($this->isIpAddressValid($gateway));
        if(!empty($dns1))
        {
            $valuesValid = $valuesValid && ($this->isIpAddressValid($dns1));
        }
        if(!empty($dns2))
        {
            $valuesValid = $valuesValid && ($this->isIpAddressValid($dns2));
        }
        $ipBinary = ip2long($ip);
        $netmaskBinary = ip2long($netmask);
        $gatewayBinary = ip2long($gateway);
        //check IP is in the same subnet with GATEWAY
        $isSameSubNet = (($ipBinary & $netmaskBinary) == ($gatewayBinary & $netmaskBinary)) ;

        return($valuesValid && $isSameSubNet);
    }
 }

