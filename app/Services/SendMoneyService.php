<?php

namespace App\Services;

use App\Models\Momo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SendMoneyService{

    /**
     * @var SendMoneyService
     */
    private static $instances;
    private $send = [];

    public static function getInstance(): SendMoneyService
    {
        if (!isset(self::$instances)) {
            self::$instances = new SendMoneyService();
        }
        return self::$instances;
    }

    public function M2MU_INIT($data){
//        Log::info("start M2MU_INIT", [$data]);
        $microtime = TimeService::get_microtime();
        $requestkeyRaw = generateRandom(32);
        $requestkey = CryptService::RSA_Encrypt($requestkeyRaw, $data["RSA_PUBLIC_KEY"]);
        $header = array(
            "agent_id: " . $data["agent_id"],
            "user_phone: " . $data["phone"],
            "sessionkey: " . $data["sessionkey"],
            "authorization: Bearer " . $data["authorization"],
            "msgtype: M2MU_INIT",
            "userid: " . $data["phone"],
            "requestkey: " . $requestkey,
            "Host: owa.momo.vn"
        );
        $ipaddress = GetIPAddressService::getIPAddress();
        $Data = array(
            'user' => $data['phone'],
            'msgType' => 'M2MU_INIT',
            'cmdId' => (string) $microtime . '000000',
            'lang' => 'vi',
            'time' => (int) $microtime,
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
                    'clientTime' => (int) $microtime - 221,
                    'tranType' => 2018,
                    'comment' => $this->send['comment'],
                    'amount' => $this->send['amount'],
                    'partnerId' => $this->send['receiver'],
                    'partnerName' => $this->send['partnerName'],
                    'ref' => '',
                    'serviceCode' => 'transfer_p2p',
                    'serviceId' => 'transfer_p2p',
                    '_class' => 'mservice.backend.entity.msg.M2MUInitMsg',
                    'tranList' =>
                        array(
                            0 =>
                                array(
                                    'partnerName' => $this->send['partnerName'],
                                    'partnerId' => $this->send['receiver'],
                                    'originalAmount' => $this->send['amount'],
                                    'serviceCode' => 'transfer_p2p',
                                    'stickers' => '',
                                    'themeBackground' => '#f5fff6',
                                    'themeUrl' => 'https://cdn.mservice.com.vn/app/img/transfer/theme/Corona_750x260.png',
                                    'transferSource' => '',
                                    'socialUserId' => '',
                                    '_class' => 'mservice.backend.entity.msg.M2MUInitMsg',
                                    'tranType' => 2018,
                                    'comment' => $this->send['comment'],
                                    'moneySource' => 1,
                                    'partnerCode' => 'momo',
                                    'serviceMode' => 'transfer_p2p',
                                    'serviceId' => 'transfer_p2p',
                                    'extras' => '{"loanId":0,"appSendChat":false,"loanIds":[],"stickers":"","themeUrl":"https://cdn.mservice.com.vn/app/img/transfer/theme/Corona_750x260.png","hidePhone":false,"vpc_CardType":"SML","vpc_TicketNo":"' . $ipaddress . '","vpc_PaymentGateway":""}',
                                ),
                        ),
                    'extras' => '{"loanId":0,"appSendChat":false,"loanIds":[],"stickers":"","themeUrl":"https://cdn.mservice.com.vn/app/img/transfer/theme/Corona_750x260.png","hidePhone":false,"vpc_CardType":"SML","vpc_TicketNo":"' . $ipaddress . '","vpc_PaymentGateway":""}',
                    'moneySource' => 1,
                    'partnerCode' => 'momo',
                    'rowCardId' => '',
                    'giftId' => '',
                    'useVoucher' => 0,
                    'prepaidIds' => '',
                    'usePrepaid' => 0,
                ),
            'extra' =>
                array(
                    'checkSum' => LoginMomoService::getInstance()->generateCheckSum('M2MU_INIT', $microtime, $data),
                ),
        );
//        Log::info("start M2MU_INIT IP---$ipaddress---", [$data]);
        $raw = CryptService::Encrypt_data($Data, $requestkeyRaw);
        return HttpClientService::getInstance()->curl(MomoService::$url["M2MU_INIT"],$raw , $header, $requestkeyRaw);
    }
    public function M2MU_CONFIRM($data, $ID){
//        Log::info("start M2MU_CONFIRM ID $ID ", [$data]);
        $microtime = TimeService::get_microtime();
        $requestkeyRaw = generateRandom(32);
        $requestkey = CryptService::RSA_Encrypt($requestkeyRaw, $data["RSA_PUBLIC_KEY"]);
        $header = array(
            "agent_id: " . $data["agent_id"],
            "user_phone: " . $data["phone"],
            "sessionkey: " . $data["sessionkey"],
            "authorization: Bearer " . $data["authorization"],
            "msgtype: M2MU_INIT",
            "userid: " . $data["phone"],
            "requestkey: " . $requestkey,
            "Host: owa.momo.vn"
        );
        $ipaddress = GetIPAddressService::getIPAddress();
        $Data =  array(
            'user' => $data['phone'],
            'pass' => $data['password'],
            'msgType' => 'M2MU_CONFIRM',
            'cmdId' => (string) $microtime . '000000',
            'lang' => 'vi',
            'time' => (int) $microtime,
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
                    'ids' =>
                        array(
                            0 => $ID,
                        ),
                    'totalAmount' => $this->send['amount'],
                    'originalAmount' => $this->send['amount'],
                    'originalClass' => 'mservice.backend.entity.msg.M2MUConfirmMsg',
                    'originalPhone' => $data['phone'],
                    'totalFee' => '0.0',
                    'id' => $ID,
                    'GetUserInfoTaskRequest' => $this->send['receiver'],
                    'tranList' =>
                        array(
                            0 =>
                                array(
                                    '_class' => 'mservice.backend.entity.msg.TranHisMsg',
                                    'user' => $data['phone'],
                                    'clientTime' => (int) ($microtime - 211),
                                    'tranType' => 36,
                                    'amount' => (int) $this->send['amount'],
                                    'receiverType' => 1,
                                ),
                            1 =>
                                array(
                                    '_class' => 'mservice.backend.entity.msg.TranHisMsg',
                                    'user' => $data['phone'],
                                    'clientTime' => (int) ($microtime - 211),
                                    'tranType' => 36,
                                    'partnerId' => $this->send['receiver'],
                                    'amount' => 100,
                                    'comment' => '',
                                    'ownerName' => $data['Name'],
                                    'receiverType' => 0,
                                    'partnerExtra1' => '{"totalAmount":' . $this->send['amount'] . '}',
                                    'partnerInvNo' => 'borrow',
                                ),
                        ),
                    'serviceId' => 'transfer_p2p',
                    'serviceCode' => 'transfer_p2p',
                    'clientTime' => (int) ($microtime - 211),
                    'tranType' => 2018,
                    'comment' => '',
                    'ref' => '',
                    'amount' => $this->send['amount'],
                    'partnerId' => $this->send['receiver'],
                    'bankInId' => '',
                    'otp' => '',
                    'otpBanknet' => '',
                    '_class' => 'mservice.backend.entity.msg.M2MUConfirmMsg',
                    'extras' => '{"appSendChat":false,"vpc_CardType":"SML","vpc_TicketNo":"' . $ipaddress . '"","vpc_PaymentGateway":""}',
                ),
            'extra' =>
                array(
                    'checkSum' => LoginMomoService::getInstance()->generateCheckSum('M2MU_CONFIRM', $microtime, $data),
                ),
        );
//        Log::info("end M2MU_CONFIRM ID---$ID---IP---$ipaddress---", [$data]);
        $raw = CryptService::Encrypt_data($Data, $requestkeyRaw);
        return HttpClientService::getInstance()->curl(MomoService::$url["M2MU_INIT"], $raw, $header, $requestkeyRaw);
    }
    public function send($data, $to, $amount, $comment){
        $phone = $data["phone"] ?? "";
        $this->send = [
            "amount" => (int)$amount,
            "comment" => $comment,
            "receiver" => $to,
            "partnerName" => $to
        ];
        $checkUserPrivate = AuthUserMomoService::getInstance()->CHECK_USER_PRIVATE($data, $to);
//        Log::info("get Result CHECK_USER_PRIVATE", [$checkUserPrivate]);
        if(!empty($checkUserPrivate["errorCode"])){
            return [
                "status" => "error",
                "code"   => $checkUserPrivate["errorCode"],
                "message" => $checkUserPrivate["errorDesc"],
                "full" => json_encode($checkUserPrivate)
            ];
        }else if(is_null($checkUserPrivate)){
            return [
                "status" => "error",
                "code"   => -5,
                "message" => "Hết thời gian truy cập vui lòng đăng nhập lại"
            ];
        }
//        Log::info("pass case CHECK_USER_PRIVATE", [$checkUserPrivate]);
        $validateMessage = ValidateMessageMomoService::getInstance()->M2M_VALIDATE_MSG($data, $to, $comment);
//        Log::info("get Result M2M_VALIDATE_MSG", [$validateMessage]);
        if (!empty($validateMessage["errorCode"]) && $validateMessage["errorDesc"] != "Lỗi cơ sở dữ liệu. Quý khách vui lòng thử lại sau") {
            return [
                "status" => "error",
                "code"   => $validateMessage["errorCode"],
                "message" => $validateMessage["errorDesc"],
                "full" => json_encode($validateMessage)
            ];
        } else if(is_null($validateMessage)){
            return [
                "status" => "error",
                "code"   => -5,
                "message" => "Đã xảy ra lỗi ở " . $data["phone"]
            ];
        }
//        Log::info("pass case M2M_VALIDATE_MSG", [$validateMessage]);
        $initMomo = $this->M2MU_INIT($data);
//        Log::info("get Result M2MU_INIT", [$initMomo]);
        if (isset($initMomo["errorCode"]) && $initMomo["errorDesc"] != "Lỗi cơ sở dữ liệu. Quý khách vui lòng thử lại sau") {
            return array(
                "status" => "error",
                "code"   => $initMomo["errorCode"],
                "message" => $initMomo["errorDesc"]
            );
        } else if (is_null($initMomo)) {
            return array(
                "status" => "error",
                "code" => -5,
                "message" => "Đã xảy ra lỗi khí Chuyển tiền cho " . $to
            );
        }else{
            $ID = $initMomo["momoMsg"]["replyMsgs"]["0"]["id"];
            $confirmMomo = $this->M2MU_CONFIRM($data, $ID);
//            Log::info("get Result M2MU_CONFIRM", [$confirmMomo]);
            if (isset($confirmMomo['errorCode']) && $initMomo["errorDesc"] != "Lỗi cơ sở dữ liệu. Quý khách vui lòng thử lại sau") {
                return [
                    "status" => "error",
                    "code"   => $confirmMomo["errorCode"],
                    "message" => $confirmMomo["errorDesc"]
                ];
            }
            $balance = $confirmMomo["extra"]["BALANCE"];
            $tranHisMsg = $confirmMomo["momoMsg"]["replyMsgs"]["0"]["tranHisMsg"];
            if (isset($confirmMomo["errorDesc"]) && $confirmMomo["errorDesc"] == "Lỗi cơ sở dữ liệu. Quý khách vui lòng thử lại sau") {
                $tranHisMsg["desc"] = $tranHisMsg["desc"] ?: "Lỗi cơ sở dữ liệu. Quý khách vui lòng thử lại sau";
            }
            if ($tranHisMsg["status"] != 999 && $validateMessage["errorDesc"] != "Lỗi cơ sở dữ liệu. Quý khách vui lòng thử lại sau") {
                return [
                    "status"   => "error",
                    "message"  => $tranHisMsg["desc"],
                    "tranDList" => array(
                        "balance" => $balance,
                        "ID"   => $tranHisMsg["ID"],
                        "tranId" => $tranHisMsg["tranId"],
                        "partnerId" => $tranHisMsg["partnerId"],
                        "partnerName" => $tranHisMsg["partnerName"],
                        "amount"   => $tranHisMsg["amount"],
                        "comment"  => (empty($tranHisMsg["comment"])) ? "" : $tranHisMsg["comment"],
                        "status"   => $tranHisMsg["status"],
                        "desc"     => $tranHisMsg["desc"],
                        "ownerNumber" => $tranHisMsg["ownerNumber"],
                        "ownerName" => $tranHisMsg["ownerName"],
                        "millisecond" => $tranHisMsg["finishTime"]
                    ),
                    "full" => json_encode($confirmMomo)
                ];
            }else{
                Momo::where("phone", $data["phone"])->update([
                    "sodu" => $balance,
                    "gd_day" => DB::raw("gd_day + $amount"),
                    "gd_month" => DB::raw("gd_month + $amount"),
                    "gd" => DB::raw("gd + 1")
                ]);
                Log::info("-----CHUYỂN TIỀN THÀNH CÔNG-----PHONE $phone TO $to amount $amount");

                return [
                    "status" => "success",
                    "message" => $tranHisMsg["desc"],
                    "tranDList" => array(
                        "balance" => $balance,
                        "ID"    => $tranHisMsg["ID"],
                        "tranId" => $tranHisMsg["tranId"],
                        "partnerId" => $tranHisMsg["partnerId"],
                        "partnerName" => $tranHisMsg["partnerName"],
                        "amount"     => $tranHisMsg["amount"],
                        "comment"    => (empty($tranHisMsg["comment"])) ? "" : $tranHisMsg["comment"],
                        "status"     => $tranHisMsg["status"],
                        "desc"       => $tranHisMsg["desc"],
                        "ownerNumber" => $tranHisMsg["ownerNumber"],
                        "ownerName"  => $tranHisMsg["ownerName"],
                        "millisecond" => $tranHisMsg["finishTime"]
                    ),
                    "full" => json_encode($checkUserPrivate)
                ];
            }
        }
    }
}
