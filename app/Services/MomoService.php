<?php

namespace App\Services;

use App\Models\Device;
use App\Models\Momo;
use Illuminate\Support\Facades\Log;

class MomoService{

    public static $url = [
        "CHECK_USER_PRIVATE" => 'https://owa.momo.vn/api/CHECK_USER_PRIVATE', // Check người dùng ẩn
        "CHECK_USER_BE_MSG" => "https://api.momo.vn/backend/auth-app/public/CHECK_USER_BE_MSG", //Check người dùng
        "SEND_OTP_MSG"      => "https://api.momo.vn/backend/otp-app/public/", //Gửi OTP
        "REG_DEVICE_MSG"    => "https://api.momo.vn/backend/otp-app/public/REG_DEVICE_MSG", // Xác minh OTP
        "QUERY_TRAN_HIS_MSG" => "https://api.momo.vn/sync/transhis/browse", // Check ls giao dịch
        "transid"            => "https://api.momo.vn/sync/transhis/details", //check nội dung giao dịch
        "USER_LOGIN_MSG"     => "https://owa.momo.vn/public/login", // Đăng Nhập
        "M2MU_INIT"         => "https://owa.momo.vn/api/M2MU_INIT", // Chuyển tiền
        "M2MU_CONFIRM"      => "https://owa.momo.vn/api/M2MU_CONFIRM", // Chuyển tiền
        "M2M_VALIDATE_MSG"  => 'https://owa.momo.vn/api/M2M_VALIDATE_MSG', // Ko rõ chức năng
        "QUERY_TRAN_HIS_MSG_NEW" => "https://m.mservice.io/hydra/v2/user/noti",
    ];

    public static function CHECK_USER_BE_MSG($data)
    {
        try {
            $phone = $data["phone"];
            $imei = $data["imei"];
            $device = $data["device"];
            $hardware = $data["hardware"];
            $facture = $data["facture"];
            $SECUREID = $data["SECUREID"];
            $microtime = TimeService::get_microtime();
            $header = array(
                "agent_id: undefined",
                "sessionkey: ",
                "user_phone: undefined",
                "authorization: Bearer undefined",
                "msgtype: CHECK_USER_BE_MSG",
                "Host: api.momo.vn",
                "User-Agent: okhttp/3.14.17",
                "device_os: ANDROID"
            );

            $Data = array(
                'user' => $phone,
                'msgType' => 'CHECK_USER_BE_MSG',
                'cmdId' => $microtime . '000000',
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
                        '_class' => 'mservice.backend.entity.msg.RegDeviceMsg',
                        'number' => $phone,
                        'imei' => $imei,
                        'cname' => 'Vietnam',
                        'ccode' => '084',
                        'device' => $device,
                        'firmware' => '23',
                        'hardware' => $hardware,
                        'manufacture' => $facture,
                        'csp' => 'Viettel',
                        'icc' => '',
                        'mcc' => '452',
                        'device_os' => 'Android',
                        'secure_id' => $SECUREID,
                    ),
                'extra' =>
                    array(
                        'checkSum' => '',
                    ),
            );
            return HttpClientService::getInstance()->curl(self::$url["CHECK_USER_BE_MSG"], $Data, $header);
        }catch (\Exception $exception){
            Log::error("error CHECK_USER_BE_MSG");
            Log::error($exception);
            return false;
        }
    }


    public static function getDataSendMomo($phone, $pass = null){
        $momo = Momo::where('phone', $phone)->first();

        if($momo){
            $data = json_decode($momo->info, true);
            $data["RSA_PUBLIC_KEY"] = $momo->RSA_PUBLIC_KEY;
            if($momo->trangthai == 'walt'){
                $data["password"] = $pass;
            }
        }else{
            $device = Device::inRandomOrder()->limit(1)->first();
            $data = [
                "phone" => $phone,
                "Name" => "",
                "password" => $pass,
                "imei" => generateImei(),
                "ohash" => "",
                "setupKey" => "",
                "setupKeyDecrypt" => "",
                "authorization"  => "",
                "RSA_PUBLIC_KEY" => "",
                "agent_id" => "",
                "sessionkey" => "",
                "refreshToken" => "",
                "balance" => "0",
                "SECUREID" => get_SECUREID(),
                "rkey" => generateRandom(20),
                "AAID" => generateImei(),
                "TOKEN" => get_TOKEN(),
                "device" => $device->device,
                "hardware" => $device->hardware,
                "facture" => $device->facture,
                "MODELID" => $device->MODELID
            ];
            Momo::create([
                "phone" => $phone,
                "info" => json_encode($data)
            ]);
        }
        return $data;
    }

    public static function deleteMomo($phone){
        Momo::where("phone", $phone)->delete();
    }

}
