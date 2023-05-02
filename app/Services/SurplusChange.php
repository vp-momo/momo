<?php

namespace App\Services;

use App\Models\Momo;

class SurplusChange{

    /**
     * @var SurplusChange
     */
    private static $instances;
    public $rsa;

    public static function getInstance(): SurplusChange
    {
        if (!isset(self::$instances)) {
            self::$instances = new SurplusChange();
        }
        return self::$instances;
    }

    public function load($data){
        $microtime = TimeService::get_microtime();
        $requestkeyRaw = generateRandom(32);
        $requestkey = $this->RSA_Encrypt($requestkeyRaw);
        $header = array(
            "agent_id: " . $data["agent_id"],
            "user_phone: " . $data["phone"],
            "sessionkey: " . $data["sessionkey"],
            "authorization: Bearer " . $data["authorization"],
            "userid: " . $data["phone"],
            "Host: api.momo.vn",
            'requestkey: ' . $requestkey
        );
        $Data = array(
            'requestId' => (string) $microtime,
            'offset' => 0,
            'limit' => 5,
            'appCode' => config('app.momo.code'),
            'appVer' => config('app.momo.version'),
            'lang' => 'vi',
            'deviceOS' => 'ANDROID',
            'channel' => 'APP',
            'buildNumber' => 1,
            'appId' => 'vn.momo.transactionhistory',
        );

        $httpClientServiceInstance = HttpClientService::getInstance();
        $url = MomoService::$url["QUERY_TRAN_HIS_MSG"];
        $resultTransactionHistory = $httpClientServiceInstance->curl($url, $Data, $header);

        if(isset($resultTransactionHistory["momoMsg"][0])){
            $balance = $resultTransactionHistory["momoMsg"][0]["postBalance"];
            Momo::where("phone", $data["phone"])->update(["sodu" => $balance]);
            return [
                "status" => 'success',
                "phone" => $data["phone"],
                "sodu" => $balance
            ];
        }
        return false;
    }

    public function RSA_Encrypt($content){
        return base64_encode(encrypt($content));
    }
}
