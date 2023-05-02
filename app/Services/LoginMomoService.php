<?php

namespace App\Services;

use App\Models\Momo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoginMomoService{

    /**
     * @var LoginMomoService
     */
    private static $instances;
    protected $config = [];

    public static function getInstance(): LoginMomoService
    {
        if (!isset(self::$instances)) {
            self::$instances = new LoginMomoService();
        }
        return self::$instances;
    }

    public function setConfig($config){
        if(is_object($config)){
            $config = (array) $config;
        }
        $this->config = $config;
    }

    public function invalid(): bool
    {
        if(
            !isset($this->config["phone"]) ||
            !isset($this->config["authorization"]) ||
            !isset($this->config["phone"]) ||
            !isset($this->config["password"]) ||
            !isset($this->config["AAID"]) ||
            !isset($this->config["TOKEN"]) ||
            !isset($this->config["SECUREID"]) ||
            !isset($this->config["MODELID"]) ||
            !isset($this->config["imei"]) ||
            !isset($this->config["password"]) ||
            !isset($this->config["setupKeyDecrypt"]) ||
            !isset($this->config["sessionkey"]) ||
            !isset($this->config["AAID"])
        ) return false;
//        return $this->config["phone"]
//            && $this->config["authorization"]
//            && $this->config["phone"]
//            && $this->config["password"]
//            && $this->config["AAID"]
//            && $this->config["TOKEN"]
//            && $this->config["SECUREID"]
//            && $this->config["MODELID"]
//            && $this->config["imei"]
//            && $this->config["password"]
//            && $this->config["setupKeyDecrypt"]
//            && $this->config["sessionkey"]
//            && $this->config["AAID"];
        return true;
    }
    public function getHeader(): array
    {
        return [
            "agent_id: undefined",
            "user_phone: " . $this->config["phone"],
            "sessionkey: " . (!empty($this->config["sessionkey"])) ? $this->config["sessionkey"] : "",
            "authorization: Bearer " . $this->config["authorization"],
            "msgtype: USER_LOGIN_MSG",
            "Host: owa.momo.vn",
            "user_id: " . $this->config["phone"],
            "User-Agent: okhttp/3.14.17",
            "app_version: ".config('app.momo.version'),
            "app_code: ".config('app.momo.code'),
            "device_os: ANDROID"
        ];
    }
    private function get_pHash($user): string
    {
        $data = $user["imei"] . "|" . $user["password"];
        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return base64_encode(openssl_encrypt($data, 'AES-256-CBC', $user["setupKeyDecrypt"], OPENSSL_RAW_DATA, $iv));
    }

    public function generateCheckSum($type, $microtime, $user)
    {
        $Encrypt =   $user["phone"] . $microtime . '000000' . $type . ($microtime / 1000000000000.0) . 'E12';
        $iv = pack('C*', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        return base64_encode(openssl_encrypt($Encrypt, 'AES-256-CBC', $user["setupKeyDecrypt"], OPENSSL_RAW_DATA, $iv));
    }
    public function getBody(): array
    {
        $microtime = TimeService::get_microtime();
        return [
            'user' => $this->config['phone'],
            'msgType' => 'USER_LOGIN_MSG',
            'pass' => $this->config['password'],
            'cmdId' => $microtime. '000000',
            'lang' => 'vi',
            'time' => $microtime,
            'channel' => 'APP',
            'appVer' => config('app.momo.version'),
            'appCode' => config('app.momo.code'),
            'deviceOS' => 'ANDROID',
            'buildNumber' => 0,
            'appId' => 'vn.momo.platform',
            'result' => true,
            'errorCode' => 0,
            'errorDesc' => '',
            'momoMsg' =>
                array(
                    '_class' => 'mservice.backend.entity.msg.LoginMsg',
                    'isSetup' => false,
                ),
            'extra' =>
                array(
                    'pHash' => $this->get_pHash($this->config),
                    'AAID' => $this->config['AAID'],
                    'IDFA' => '',
                    'TOKEN' => $this->config['TOKEN'],
                    'SIMULATOR' => '',
                    'SECUREID' => $this->config['SECUREID'],
                    'MODELID' => $this->config['MODELID'],
                    'checkSum' => $this->generateCheckSum('USER_LOGIN_MSG', $microtime, $this->config),
                ),
        ];
    }

    public function login($phone){
//        Log::info("start login --MOMO--$phone");
        $accountInfo = Momo::where("phone", $phone)->first();
        $info = json_decode($accountInfo->info);
        $info = (array) $info;
        if(!$this->invalid()){
            $this->setConfig($info);
        }
        if(!$this->invalid()) return false;
        $resultLogin = HttpClientService::getInstance()->curl(MomoService::$url["USER_LOGIN_MSG"], $this->getBody(), $this->getHeader());
        if(!empty($resultLogin["errorCode"])){
            Log::info("_____ĐĂNG NHẬP THẤT BẠI_____PHONE: $phone __LẦN ".($accountInfo->try+1));
            Momo::where("phone", $phone)->update([
                "try" => DB::raw("try + 1")
            ]);
            return [
                "status" => "error",
                "code"   => $resultLogin["errorCode"],
                "message" => $resultLogin["errorDesc"],
            ];
        }else if(is_null($resultLogin)){
            Log::info("_____ĐĂNG NHẬP THẤT BẠI_____PHONE: $phone __LẦN ".($accountInfo->try+1));
            Momo::where("phone", $phone)->update([
                "try" => DB::raw("try + 1")
            ]);
            return [
                "status" => "error",
                "code"   => -5,
                "message" => "Hết thời gian truy cập vui lòng đăng nhập lại"
            ];
        }
        $extra = $resultLogin["extra"];
        $rsaPublicKey = $extra["REQUEST_ENCRYPT_KEY"];
        $sessionKey = $extra["SESSION_KEY"];
        $balance = $extra["BALANCE"];

        $info['Name'] = $resultLogin["momoMsg"]["name"];
        $info['authorization'] =  $extra["AUTH_TOKEN"];
        $info['TOKEN'] = $extra["TOKEN"];
        $info['agent_id'] = $resultLogin["momoMsg"]["agentId"];
        $info['RSA_PUBLIC_KEY'] = "";
        $info['sessionkey'] =  $extra["SESSION_KEY"];

        Momo::where("phone", $phone)->update([
            "timelogin" => time(),
            "trangthai" => "run",
            "pass" => $sessionKey,
            "sodu" => $balance,
            "try" => 0,
            "RSA_PUBLIC_KEY" => $rsaPublicKey,
            "info" => json_encode($info)
        ]);
        Log::info("------ĐĂNG NHẬP THÀNH CÔNG------SĐT: $phone");
        return [
            "status"  => "success",
            "message" => "Đăng Nhập Thành Công Momo $phone",
        ];
    }

}
