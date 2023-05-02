<?php

namespace App\Services;

use App\Models\History;
use Illuminate\Support\Facades\Log;

class HistoryTransactionService{

    /**
     * @var HistoryTransactionService
     */
    private static $instances;

    public static function getInstance(): HistoryTransactionService
    {
        if (!isset(self::$instances)) {
            self::$instances = new HistoryTransactionService();
        }
        return self::$instances;
    }

    public function check($data){
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
            'limit' => 10,
            'appCode' => config('app.momo.code'),
            'appVer' => config('app.momo.version'),
            'lang' => 'vi',
            'deviceOS' => 'ANDROID',
            'channel' => 'APP',
            'buildNumber' => 1,
            'appId' => 'vn.momo.transactionhistory',
        );
        $raw = CryptService::Encrypt_data($Data, $requestkeyRaw);
        $resHistory = HttpClientService::getInstance()->curl(MomoService::$url["QUERY_TRAN_HIS_MSG"], $raw, $header, $requestkeyRaw);
        $resultFindTrans = [];
        if(isset($resHistory["momoMsg"])){
            $historyList = $resHistory["momoMsg"];
            foreach ($historyList as $historyItem){
                $transactionID = $historyItem["transId"];
                $totalAmount = $historyItem["totalAmount"];
                $errorCode = $historyItem["errorCode"];
                $status = $historyItem["status"];
                $io = $historyItem["io"];
                if($totalAmount >= 1000 && $io == '1' && $errorCode == 0 && $status == 2){
                    $transactionValid = History::where('id_tran', $transactionID)->first();
                    if(!$transactionValid){
                        $resGetComment = CommentTransferService::getInstance()->check($data, $transactionID);
                        //chỉ lấy lịch sử nhận tiền
//                        Log::info("getResult CommentTransferService", [$resGetComment]);
                        if($resGetComment && $resGetComment["status"] == "success"){
//                            Log::info("start --- ".json_encode($historyItem));
                            $resultFindTrans[] = [
                                "phone" => $data['phone'],
                                "tranId"  => $historyItem["transId"],
                                "ID"  => $historyItem["id"],
                                "patnerID" => chuyendoiso($historyItem["sourceId"]),
                                "partnerName" => $historyItem["sourceName"] ?? '',
                                "comment" => $resGetComment["msg"] ?? '',
                                "amount" => $totalAmount,
                                "millisecond" => $historyItem["createdAt"],
                            ];
                        }
                    }

                }
            }
        }
        return $resultFindTrans;
    }
}
