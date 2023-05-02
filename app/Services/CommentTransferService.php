<?php

namespace App\Services;

class CommentTransferService{

    /**
     * @var CommentTransferService
     */
    private static $instances;

    public static function getInstance(): CommentTransferService
    {
        if (!isset(self::$instances)) {
            self::$instances = new CommentTransferService();
        }
        return self::$instances;
    }

    public function check($data, $transid){
        $requestkeyRaw = generateRandom(32);
        $requestkey = CryptService::RSA_Encrypt($requestkeyRaw, $data["RSA_PUBLIC_KEY"]);
        $header = array(
            "sessionkey: " . $data["sessionkey"],
            "authorization: Bearer " . $data["authorization"],
            "requestkey: " . $requestkey,
            "Host: api.momo.vn",
            "user-agent: MoMoPlatform-Release/31100 CFNetwork/978.0.7 Darwin/18.7.0"
        );
        $microtime = TimeService::get_microtime();
        $Data = array(
            'transId' => $transid,
            'requestId' => $microtime,
            'appVer' => config('app.momo.version'),
            'appCode' => config('app.momo.code'),
            'lang' => "vi",
            'deviceOS' => 'ANDROID',
            'channel' => "APP",
            'buildNumber' => 0,
            "appId" => "vn.momo.platform",
        );
        $raw = CryptService::Encrypt_data($Data, $requestkeyRaw);
        $resCheckTransaction = HttpClientService::getInstance()->curl(MomoService::$url["transid"], $raw, $header, $requestkeyRaw);

        if (isset($resCheckTransaction['momoMsg']['serviceData'])) {
            $serviceData = json_decode($resCheckTransaction['momoMsg']['serviceData'], true);
            if (isset($serviceData['COMMENT_VALUE'])) {
                $result = $serviceData['COMMENT_VALUE'];
                return array(
                    "status"    =>  "success",
                    "data"   =>    $resCheckTransaction,
                    "msg" => $result
                );
            }
            return array(
                "status"    =>  "success",
                "msg"   =>    "",
                "data"   =>    $resCheckTransaction,
            );
        }
    }
}
