<?php

namespace App\Services;

use App\Models\Momo;
use Illuminate\Support\Facades\Log;

class LoadBalanceService{

    /**
     * @var LoadBalanceService
     */
    private static $instances;

    public static function getInstance(): LoadBalanceService
    {
        if (!isset(self::$instances)) {
            self::$instances = new LoadBalanceService();
        }
        return self::$instances;
    }

    public function load($data){
//        Log::info("start LoadBalanceService load", [$data]);
        $microtime = TimeService::get_microtime();
        $requestkeyRaw = generateRandom(32);
        $requestkey = CryptService::RSA_Encrypt($requestkeyRaw, $data["RSA_PUBLIC_KEY"]);
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
//        Log::info("end LoadBalanceService load", [$data]);
        $rawData = CryptService::Encrypt_data($Data, $requestkeyRaw);
        $resultLoadBalance = HttpClientService::getInstance()->curl(MomoService::$url["QUERY_TRAN_HIS_MSG"], $rawData, $header, $requestkeyRaw);
        if (isset($resultLoadBalance['momoMsg'][0])) {
            $phone = $data["phone"];
            $balance = $resultLoadBalance['momoMsg']['0']['postBalance'];
            Momo::where("phone", $phone)->update(["sodu" => $balance]);
            Log::info("-----LOAD SỐ DƯ THÀNH CÔNG-----$phone--$balance");
            return [
                'status' => 'success',
                'phone' => $phone,
                'sodu' => $balance
            ];
        }
        return $resultLoadBalance;
    }
}
