<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class VerifyOTPService{

    protected $config = [];
    private $url = 'https://api.momo.vn/backend/otp-app/public/';

    public function __construct($config)
    {
        $this->setConfig($config);
    }

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
    public function setOhash($code){
        $this->config["ohash"] = hash('sha256', $this->config["phone"] . $this->config["rkey"] . $code);
    }

    public function getBody(){
        return [
            "extra" => [
                "ohash" => $this->config["ohash"],
                "SECUREID" => "",
                "MODELID" => $this->config["MODELID"],
                "TOKEN" => $this->config["TOKEN"],
                "SIMULATOR" => false,
                "ONESIGNAL_TOKEN" => $this->config["TOKEN"],
                "IDFA" => "",
                "DEVICE_TOKEN" => "",
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
            "msgType" => "REG_DEVICE_MSG",
            "appCode" => config('app.momo.code'),
            "deviceOS" => "ios",
            "buildNumber" => 0,
            "lang" => "vi",
            "user" => $this->config["phone"]
        ];
    }

    public function verifyOTP(){
        try {
            $headers = [
                'Host: api.momo.vn',
                'Content-Type: application/json'
            ];
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($this->getBody()),
                CURLOPT_HTTPHEADER => $headers
            ));
            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response,true);
        }catch (\Exception $exception){
            Log::error("_____LỖI KHI XÁC THỰC OTP ");
            Log::error($exception);
            return false;
        }

    }

    public function get_setupKey($setUpKey)
    {
        $passphrase = $this->config["ohash"];
        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return openssl_decrypt(base64_decode($setUpKey), 'AES-256-CBC', $passphrase, OPENSSL_RAW_DATA, $iv);
    }
}
