<?php

namespace App\Http\Controllers\Axios;

use App\Http\Controllers\Controller;
use App\Models\GiftCode;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class GiftCodeController extends AxiosController
{
    public function create(Request $request){
        $momoReward = $request->momo_reward;
        $code = $request->code;
        $money = $request->money;
        $money = (int) $money;
        $limitImport = $request->limit_import;
        $limitImport = (int) $limitImport;
        $comment = $request->comment;

        $isUniqueCode = GiftCode::where("code", $code)->count();
        if($isUniqueCode > 0) return ResponseService::jsonResponse([], false, 'Mã Code đã tồn tại! Vui lòng nhập Mã Code khác!', 404);

        $validateMomoReward = $this->validateMomoReward($momoReward);
        if(!$validateMomoReward) return ResponseService::jsonResponse([], false, 'Momo không tồn tại', 404);

        if($money <= 0 || $money > 1000000) return ResponseService::jsonResponse([], false, 'Chỉ chấp nhận số tiền từ 1 đến 1000000!', 404);
        if($limitImport <= 0 || $limitImport > 100) return ResponseService::jsonResponse([], false, 'Số người từ 1 đến 100!', 404);

        GiftCode::create([
            "code" => $code,
            "momo_reward" => $momoReward,
            "money" => $money,
            "limit_import" => $limitImport,
            "entered" => 0,
            "comment" => $comment,
            "time" => time()
        ]);

        return ResponseService::jsonResponse();
    }

    public function update(Request $request){
        $id = $request->id;
        $status = $request->status;

        GiftCode::where("id", $id)->update(["status" => $status]);
        return ResponseService::jsonResponse();
    }

    public function delete(Request $request){
        $id = $request->id;

        GiftCode::where("id", $id)->delete();
        return ResponseService::jsonResponse();
    }

    private function validateMomoReward($momo){
        return true;
    }

}
