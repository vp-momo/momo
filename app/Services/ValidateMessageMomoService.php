<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class ValidateMessageMomoService{

    /**
     * @var ValidateMessageMomoService
     */
    private static $instances;

    public static function getInstance(): ValidateMessageMomoService
    {
        if (!isset(self::$instances)) {
            self::$instances = new ValidateMessageMomoService();
        }
        return self::$instances;
    }

    public function M2M_VALIDATE_MSG($data, $phone, $message = ''){
//        Log::info("start M2M_VALIDATE_MSG", [$data, $phone, $message]);
        $microtime = TimeService::get_microtime();
        $requestkeyRaw = generateRandom(32);
        $requestkey = CryptService::RSA_Encrypt($requestkeyRaw, $data["RSA_PUBLIC_KEY"]);
        $header = array(
            "agent_id: " . $data["agent_id"],
            "user_phone: " . $data["phone"],
            "sessionkey: " . $data["sessionkey"],
            "authorization: Bearer " . $data["authorization"],
            "msgtype: M2M_VALIDATE_MSG",
            "userid: " . $data["phone"],
            "requestkey: " . $requestkey,
            "Host: owa.momo.vn"
        );
        $Data = '{
            "user":"' . $data['phone'] . '",
            "msgType":"M2M_VALIDATE_MSG",
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
                "partnerId":"' . $phone . '",
                "_class":"mservice.backend.entity.msg.ForwardMsg",
                "message":"' . $this->get_string($message) . '"
            },
            "extra":
            {
                "checkSum":"' . LoginMomoService::getInstance()->generateCheckSum('M2M_VALIDATE_MSG', $microtime, $data) . '"
            }
        }';
//        Log::info("end M2M_VALIDATE_MSG", [$data, $phone, $message]);
        $rawData = CryptService::Encrypt_data($Data, $requestkeyRaw);
        return HttpClientService::getInstance()->curl(MomoService::$url["M2M_VALIDATE_MSG"],$rawData, $header, $requestkeyRaw);
    }

    private function get_string($data)
    {
        return str_replace(array('<', "'", '>', '?', '/', "\\", '--', 'eval(', '<php', '-'), array('', '', '', '', '', '', '', '', '', ''), htmlspecialchars(addslashes(strip_tags($data))));
    }
}
