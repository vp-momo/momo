<?php

namespace App\Http\Controllers\Axios;

use App\Http\Controllers\Controller;
use App\Models\Rank;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class RankController extends AxiosController
{
    public function update(Request $request){
        $rank = $request->rank;
        $fake = $request->fake;
        $thuong = $request->thuong;
        $heso = $request->heso;
        $sotop = $request->sotop;

        if(in_array($rank, [1,2,3,4,5])){
            Rank::where("id", $rank)->update([
                "fake" => $fake,
                "thuong" => $thuong,
                "heso" => $heso,
                "sotop" => $sotop,
            ]);
            return ResponseService::jsonResponse();
        }
        return ResponseService::jsonResponse([], true, "Thiếu dữ liệu!");
    }
}
