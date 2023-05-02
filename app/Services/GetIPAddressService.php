<?php

namespace App\Services;

class GetIPAddressService{

    public static function getIPAddress(){
        if(php_sapi_name() !== 'cli') {
            $isValid = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
            if (!empty($isValid)) {
                return $_SERVER['REMOTE_ADDR'];
            }
        }
        try {
            $isIpv4 = json_decode(file_get_contents('https://api.ipify.org?format=json'), true);
            return $isIpv4['ip'];
        } catch (\Exception $e) {
            return '115.77.26.235';
        }
    }
}
