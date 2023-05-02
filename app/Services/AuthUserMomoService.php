<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use phpseclib3\Crypt\RSA;
use phpseclib3\Crypt\PublicKeyLoader;

class AuthUserMomoService{
    /**
     * @var AuthUserMomoService
     */
    private static $instances;

    public static function getInstance(): AuthUserMomoService
    {
        if (!isset(self::$instances)) {
            self::$instances = new AuthUserMomoService();
        }
        return self::$instances;
    }

    public function CHECK_USER_PRIVATE($data, $receiver){

//        Log::info("start CHECK_USER_PRIVATE receiver: $receiver", [$data]);
        $microtime = TimeService::get_microtime();
        $requestkeyRaw = generateRandom(32);
        $requestkey =  CryptService::RSA_Encrypt($requestkeyRaw, $data["RSA_PUBLIC_KEY"]);
        $checkSum = LoginMomoService::getInstance()->generateCheckSum('CHECK_USER_PRIVATE', $microtime, $data);
        $header = array(
            "agent_id: " . $data["agent_id"],
            "user_phone: " . $data["phone"],
            "sessionkey: " . $data["sessionkey"],
            "authorization: Bearer " . $data["authorization"],
            "msgtype: CHECK_USER_PRIVATE",
            "userid: " . $data["phone"],
            "requestkey: " . $requestkey,
            "Host: owa.momo.vn"
        );
        $Data = '{
            "user":"' . $data['phone'] . '",
            "msgType":"CHECK_USER_PRIVATE",
            "cmdId":"' . $microtime . '000000",
            "lang":"vi",
            "time":' . (int) $microtime . ',
            "channel":"APP",
            "appVer": ' . config('app.momo.version') . ',
            "appCode": "' . config('app.momo.code') . '",
            "deviceOS":"ANDROID",
            "buildNumber":1916,
            "appId":"vn.momo.transfer",
            "result":true,
            "errorCode":0,
            "errorDesc":"",
            "momoMsg":
            {
                "_class":"mservice.backend.entity.msg.LoginMsg",
                "getMutualFriend":false
            },
            "extra":
            {
                "CHECK_INFO_NUMBER":"' . $receiver . '",
                "checkSum":"' . $checkSum . '"
            }
        }';
//        Log::info("end CHECK_USER_PRIVATE receiver: $receiver", [$data]);

        $rawData = CryptService::Encrypt_data($Data, $requestkeyRaw);

        return HttpClientService::getInstance()->curl(MomoService::$url["CHECK_USER_PRIVATE"], $rawData, $header, $requestkeyRaw);
    }

}
