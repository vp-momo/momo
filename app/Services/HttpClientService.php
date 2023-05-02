<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class HttpClientService{

    protected $client;
    private static $instances;

    public function __construct()
    {
        $this->client = new Client();
    }

    public static function getInstance(): HttpClientService
    {
        if (!isset(self::$instances)) {
            self::$instances = new HttpClientService();
        }
        return self::$instances;
    }

    public function postRequest($uri, $body, $headers = []): \Psr\Http\Message\ResponseInterface
    {
        $Data = is_array($body) ? json_encode($body) : $body;
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'accept: application/json';
        $headers[] = 'Content-Length: ' . strlen($Data);
        return $this->client->post($uri, [
            'headers' => $headers,
            'body' => $Data
        ]);
    }

    public function test($url, $data, $header){
        $Data = is_array($data) ? json_encode($data) : $data;
        $curl = curl_init();
        // echo strlen($Data); die;
        $header[] = 'Content-Type: application/json';
        $header[] = 'accept: application/json';
//        $header[] = 'Content-Length: ' . strlen($Data);
        $opt = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => $header
        );

        curl_setopt_array($curl, $opt);

        $body = curl_exec($curl);

        // echo strlen($body); die;
        if (is_object(json_decode($body))) {
            return json_decode($body, true);
        }

        return json_decode(CryptService::Decrypt_data($body), true);
    }

    public function testSend($data){

        $curl = curl_init();
        $headers = array(
            "sessionkey:",
            "userid:",
            "user_phone:",
            "authorization: Bearer",
            "msgtype: SEND_OTP_MSG",
            "Host: owa.momo.vn",
            "app_version: ".config('app.momo.version'),
            "app_code: ".config('app.momo.code'),
            "user-agent: Ktor client",
            "Content-Type: application/json",
            "Accept: application/json",
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.momo.vn/backend/otp-app/public/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode((new OTPMomoService($data))->getBody()),
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response,true);
    }

    public function REG_DEVICE_MSG($data, $code)
    {
        $data['ohash'] = hash('sha256', $data["phone"] . $data["rkey"] . $code);



        $microtime = $this->get_microtime();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.momo.vn/backend/otp-app/public/REG_DEVICE_MSG',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
            "extra": {
                "ohash": "' . $data['ohash'] . '",
                "SECUREID": "",
                "MODELID": "' . $data["SECUREID"] . '",
                "TOKEN": "' . $data["TOKEN"] . '",
                "SIMULATOR": false,
                "ONESIGNAL_TOKEN": "' . $data["TOKEN"] . '",
                "IDFA": "",
                "DEVICE_TOKEN": ""
            },
            "momoMsg": {
                "cname": "Vietnam",
                "manufacture": "' . $data["facture"] . '",
                "icc": "",
                "mcc": "452",
                "_class": "mservice.backend.entity.msg.RegDeviceMsg",
                "secure_id": "",
                "mnc": "04",
                "imei": "' . $data["imei"] . '",
                "number": "' . $data["phone"] . '",
                "ccode": "084",
                "device_os": "ios",
                "csp": "Viettel",
                "firmware": "15.5",
                "device": "' . $data["device"] . '",
                "hardware": "' . $data["hardware"] . '"
            },
            "cmdId": "' . $microtime . '00000000",
            "channel": "APP",
            "appId": "vn.momo.platform",
            "appVer": '.config('app.momo.version').',
            "time": "' . $microtime . '",
            "msgType": "REG_DEVICE_MSG",
            "appCode": "'.config('app.momo.code').'",
            "deviceOS": "ios",
            "buildNumber": 0,
            "lang": "vi",
            "user": "' . $data['phone'] . '"
        }',
            CURLOPT_HTTPHEADER => array(
                'Host: api.momo.vn',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response,true);

        if (!empty($result["errorCode"])) {
            return array(
                "status" => "error",
                "message" => $result["errorDesc"]
            );
        } else if (is_null($result)) {
            return array(
                "status" => "error",
                "message" => "Hết thời gian truy cập vui lòng đăng nhập lại"
            );
        }
        $data['setupKeyDecrypt'] = $this->get_setupKey($result["extra"]["setupKey"], $data);
        $data['setupKey'] = $result["extra"]["setupKey"];
        $this->connect->query("UPDATE momos SET `info` = '" . json_encode($data, true) . "' WHERE `phone` = '" . $data["phone"] . "'");
        return array(
            "status"  => "success",
            "message" => "Thành công",
        );
    }

    public function curl($url, $data, $header, $key = ""){
//        Log::info("start curlRequest $url");
        $Data = is_array($data) ? json_encode($data) : $data;
        $curl = curl_init();

        $header[] = 'Content-Type: application/json';
        $header[] = 'accept: application/json';
        $header[] = 'Content-Length: ' . strlen($Data);
        $opt = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POST => TRUE,
            CURLOPT_POSTFIELDS => $Data,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_ENCODING => "",
            CURLOPT_HEADER => FALSE,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_TIMEOUT => 20,
        );
        curl_setopt_array($curl, $opt);
        $body = curl_exec($curl);
//        Log::info("end curlRequest $url");
        if (is_object(json_decode($body))) {
            return json_decode($body, true);
        }
        return json_decode(CryptService::Decrypt_data($body, $key), true);
    }

}
