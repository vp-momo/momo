<?php

namespace App\Http\Controllers\Axios;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\HistorySend;
use App\Models\Momo;
use App\Models\Setting;
use App\Services\MomoService;
use App\Services\ResponseService;
use App\Services\SendMoneyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransferController extends AxiosController
{
    public function create(Request $request){
        $phone = $request->phone;
        $id_momo = $request->id_momo;
        $amount = $request->amount;
        $comment = $request->comment;
        if(!$this->invalidMomoSend($phone)) return ResponseService::jsonResponse([], false, 'Momo gửi không tồn tại hoặc quá hạn mức vui lòng thử lại!', 404);

        if(!preg_match('/(84|0[3|5|7|8|9])+([0-9]{8})\b/', $id_momo)) return ResponseService::jsonResponse([], false, 'Momo nhận không đúng định dạng!', 404);
        if($amount < 100 || $amount >= 48000000) return ResponseService::jsonResponse([], false, 'Số tiền gửi >= 100 và < 48.000.000 !', 404);
        if(trim($comment) === "") return ResponseService::jsonResponse([], false, 'Lời nhắn không được để trống!', 404);

        $momo = Momo::where("phone", $phone)->first();
        if($momo->sodu < $amount) return ResponseService::jsonResponse([], false, 'Số dư trong tài khoản không đủ!', 404);

        $dataSendMomo = MomoService::getDataSendMomo($phone);

//        Log::info("admin start transfer FROM--$phone--TO--$id_momo");
        $resultSendMoney = SendMoneyService::getInstance()->send($dataSendMomo, $id_momo, $amount, $comment);
        if($resultSendMoney && $resultSendMoney["status"] == "success"){
            HistorySend::create([
                "phone" => $phone,
                "id_momo" => $id_momo,
                "amount" => $amount,
                "status" => 1,
                "comment" => $comment,
                "info" => json_encode($resultSendMoney["full"], true),
            ]);
            return ResponseService::jsonResponse();
        }
        return ResponseService::jsonResponse([], false, 'Chuyển thất bại vui lòng đăng nhập lại!', 404);
    }
    public function reTransfer(Request $request){
        $phone = $request->phone;
        $history_id = $request->id;
        if(!$phone || !$history_id) return ResponseService::jsonResponse([], false, 'Thiếu dữ liệu: history_id or phone', 404);

        $history = History::where("id", $history_id)->first();
        if(!$history) return ResponseService::jsonResponse([], false, 'Không tồn tại đơn này!', 404);

        $tranId = $history->id_tran;
        $id_momo = $history->id_momo;
        $amount = $history->amount_paid;

        $historySend = HistorySend::where("trans_id", $tranId)->first();
        if($historySend) {
            $history->update(["status" => 1]);
            return ResponseService::jsonResponse([], false, 'Đơn này đã thanh toán!');
        }

        $comment = '';
        $setting = Setting::first();
        if($setting) $comment = $setting->comment_back_money;

        $newComment = $comment. " " .$tranId;
        $dataSendMomo = MomoService::getDataSendMomo($phone);
        $resultSendMoney = SendMoneyService::getInstance()->send($dataSendMomo, $id_momo, $amount, $newComment);

        if($resultSendMoney && $resultSendMoney["status"] == "success"){
            HistorySend::create([
                "phone" => $phone,
                "trans_id" => $tranId,
                "id_momo" => $id_momo,
                "amount" => $amount,
                "status" => 1,
                "comment" => $newComment,
                "info" => json_encode($resultSendMoney["full"], true),
            ]);
            $history->update(["status" => 1]);
            return ResponseService::jsonResponse();
        }
        return ResponseService::jsonResponse([], false, 'Chuyển thất bại vui lòng đăng nhập lại!', 404);
    }
    public function update(Request $request){
        $id = $request->id;
        History::where("id", $id)->update(["status" => 1]);
        return ResponseService::jsonResponse([]);
    }
    protected function invalidMomoSend($phone){
        $momo = Momo::where("phone", $phone)
            ->where([
                ["trangthai", "=", "run"],
                ["try", "<", 3],
                ["gd", "<", 190],
            ])->whereRaw("gd_day < max_day and gd_month < max_month")->count();
        return $momo > 0;
    }
}
