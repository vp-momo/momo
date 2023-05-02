<?php

namespace App\Services;

use App\Models\History;
use Illuminate\Support\Facades\Log;

class HistoryTransactionServiceV2{
    /**
     * @var HistoryTransactionServiceV2
     */
    private static $instances;

    public static function getInstance(): HistoryTransactionServiceV2
    {
        if (!isset(self::$instances)) {
            self::$instances = new HistoryTransactionServiceV2();
        }
        return self::$instances;
    }

    public function check($data,$day = 1){
        $begin =  (time() - (3600 *24* $day)) * 1000;
        $microtime = TimeService::get_microtime();
        $header = array(
            "authorization: Bearer " . $data["authorization"],
            "user_phone: " . $data["phone"],
            "sessionkey: " . $data["sessionkey"],
            "agent_id: " . $data["agent_id"],
            'app_version: ' . config('app.momo.version'),
            'app_code: ' . config('app.momo.code'),
            "Host: m.mservice.io"
        );
        $Data = '{
            "userId": "' . $data['phone'] . '",
            "fromTime": ' . $begin . ',
            "toTime": ' . $microtime . ',
            "limit": 50,
            "cursor": "",
            "cusPhoneNumber": ""
        }';

        $resHistory = HttpClientService::getInstance()->curl(MomoService::$url["QUERY_TRAN_HIS_MSG_NEW"], $Data, $header);

        if (!is_array($resHistory)) {
            return [
                "status" => "error",
                "code" => -5,
                "message" => "Hết thời gian truy cập vui lòng đăng nhập lại"
            ];
        }
        Log::debug(json_encode($resHistory));
        $tranHisMsg =  $resHistory["message"]["data"]["notifications"];
        $return = array();
        foreach ($tranHisMsg as $value) {
//            Log::debug("start ----====----".json_encode($value));
            $amount = $value['caption'];
            $name = explode("từ", $amount) ?: "";

            if (strpos($amount, "Nhận") !== false && isset($name[1])) {
                preg_match('#Nhận (.+?)đ#is', $amount, $amount);
                $amount = str_replace(".", "", $amount[1]) > 0 ? str_replace(".", "", $amount[1]) : '0';
                //Cover body to comment
                $comment = $value['body'];
                $comment = ltrim($comment, '"');
                $comment = explode('"', $comment);
                $comment = $comment[0];
                $transactionID = $value["tranId"];
                if ($comment == "Nhấn để xem chi tiết.") {
                    $comment = "";
                }

                if ($transactionID != 0 && $amount >= 1000) {
                    $transactionValid = History::where('id_tran', $transactionID)->first();
                    if (!$transactionValid) {
                        $partnerId = json_decode($value["extra"])->partnerId;
                        $return[] = array(
                            "phone" => $data['phone'],
                            "tranId"  => $value["tranId"],
                            "ID"  => $value["ID"],
                            "patnerID" => chuyendoiso($partnerId),
                            "partnerName" => $name[1],
                            "comment" => $comment,
                            "amount" => (int)$amount,
                            "millisecond" => $value["time"]
                        );
                    }
                }
            }
        }
        return $return;
    }
}
