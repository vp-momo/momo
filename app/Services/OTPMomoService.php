<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class OTPMomoService{

    protected $config = [];
    private $url = 'https://api.momo.vn/backend/otp-app/public/';

    public function __construct($config)
    {
        $this->setConfig($config);
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config): void
    {
        $this->config = $config;
    }

    public function invalid(): bool
    {
        return $this->config["MODELID"]
            && $this->config["rkey"]
            && $this->config["facture"]
            && $this->config["imei"]
            && $this->config["phone"]
            && $this->config["device"]
            && $this->config["hardware"]
            && $this->config["device"];
    }

    public function getBody(){
        return [
            "extra" => [
                "action" => "SEND",
                "SECUREID" => "",
                "MODELID" => $this->config["MODELID"],
                "REQUIRE_HASH_STRING_OTP" => true,
                "isVoice" => false,
                "rkey" => $this->config["rkey"],
                "IDFA" => "",
            ],
            "momoMsg" => [
                "cname" => "Vietnam",
                "manufacture" => $this->config["facture"],
                "icc" => "",
                "mcc" => "452",
                "_class" => "mservice.backend.entity.msg.RegDeviceMsg",
                "secure_id" => "",
                "mnc" => "04",
                "imei" => $this->config["imei"],
                "number" => $this->config["phone"],
                "ccode" => "084",
                "device_os" => "ios",
                "csp" => "Viettel",
                "firmware" => "15.5",
                "device" => $this->config["device"],
                "hardware" => $this->config["hardware"]
            ],
            "cmdId" => TimeService::get_microtime()."00000000",
            "channel" => "APP",
            "appId" => "vn.momo.platform",
            "appVer" => config('app.momo.version'),
            "time" => TimeService::get_microtime(),
            "msgType" => "SEND_OTP_MSG",
            "appCode" => config('app.momo.code'),
            "deviceOS" => "ios",
            "buildNumber" => 0,
            "lang" => "vi",
            "user" => $this->config["phone"]
        ];
    }

    public function SEND_OTP_MSG($headers = []){
        try {
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Accept: application/json';
            $httpClientInstance = HttpClientService::getInstance();

//            $resultSendOtp = $httpClientInstance->postRequest($this->url, json_encode($this->getBody()), $headers);

                return $httpClientInstance->testSend($this->config);
//            $resultSendOtp = $resultSendOtp->getBody()->getContents();
//                dd(json_decode($resultSendOtp));
//            return json_decode($resultSendOtp);
        }catch (\Exception $exception){
            Log::error("error SEND_OTP_MSG ", $this->config);
            Log::error($exception);
            return false;
        }


    }
}
