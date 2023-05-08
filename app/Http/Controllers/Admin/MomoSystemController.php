<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CodeHistory;
use App\Models\Game;
use App\Models\GameMode;
use App\Models\GiftCode;
use App\Models\History;
use App\Models\HistorySend;
use App\Models\Momo;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MomoSystemController extends Controller
{
    protected $_data = [];

    public function receiveMoney(Request $request){
        $limit = 20;
        $historyList = History::select(["*"]);
        $search = $request->search;
        if($search){
            $historyList->where("phone", $search)
                ->orWhere("id_tran", $search)
                ->orWhere("id_momo", $search);
        }
        $this->_data['list'] = $historyList->orderBy('id', 'DESC')->paginate($limit);
        $this->_data['total'] = $this->_data['list']->total();
        $this->_data['limit'] = $limit;
        $this->_data['search'] = $search;
        $this->_data["titlePage"] = "Lịch Sử Đánh";
        return view('admin.momo.receiveMoney', $this->_data);
    }
    public function transfer(Request $request){
        $limit = 20;
        $transferList = HistorySend::select(["*"]);
        $search = $request->search;

        if($search){
            $transferList->where("phone", $search)
                ->orWhere("id_momo", $search)
                ->orWhere("trans_id", $search);
        }

        $this->_data['list'] = $transferList->orderBy('id', "DESC")->paginate(20);
        $this->_data['total'] = $this->_data['list']->total();
        $this->_data['limit'] = $limit;
        $this->_data['search'] = $search;
        $this->_data["momoList"] = Momo::select(["id", "phone", "sodu"])
            ->where([
                ["trangthai", "=", "run"],
                ["try", "<", 3],
                ["gd", "<", 190],
            ])->whereRaw("gd_day < max_day and gd_month < max_month")->get();
        $this->_data["titlePage"] = "Gửi Tiền Đến Momo";
        return view('admin.momo.transfer', $this->_data);
    }
    public function manager(){
        $sendMoney = 0;
        $sendError = 0;
        $loadBill = 0;
        $setting = Setting::first();
        if($setting){
            $sendMoney = $setting->sendMoney;
            $sendError = $setting->sendError;
            $loadBill = $setting->loadBill;
        }
        $resSum = Momo::selectRaw('SUM(sodu) as sum')->first();
        $sum = $resSum->sum ?? 0;
        $this->_data["list"] = Momo::all();
        $this->_data["titlePage"] = "Danh Sách MoMo - Tổng Số Dư: ".number_format($sum)." đ";
        $this->_data["sendMoney"] = $sendMoney == 0 ? 'tắt' : 'bật';
        $this->_data["sendError"] = $sendError == 0 ? 'tắt' : 'bật';
        $this->_data["loadBill"] = $loadBill == 0 ? 'tắt' : 'bật';
        return view('admin.momo.manager', $this->_data);
    }
    public function ratio(){
        $chanleTaixiu = "CLTX";
        $chanleTaixiuV2 = "CLTX2";
        $tongbaso = "S";
        $motphanba = "1P3";
        $gapba = "G3";
        $lo = "LO";
        $hba = "H3";
        $xien = "XIEN";
        $vanmay = "VANMAY";
        $doanso = "DX";

        $this->_data["chanleTaixiu"] = Game::where("ma_game", $chanleTaixiu)->get();
        $this->_data["chanleTaixiuV2"] = Game::where("ma_game", $chanleTaixiuV2)->get();
        $this->_data["tongbaso"] = Game::where("ma_game", $tongbaso)->get();
        $this->_data["motphanba"] = Game::where("ma_game", $motphanba)->get();
        $this->_data["gapba"] = Game::where("ma_game", $gapba)->get();
        $this->_data["lo"] = Game::where("ma_game", $lo)->get();
        $this->_data["hba"] = Game::where("ma_game", $hba)->get();
        $this->_data["xien"] = Game::where("ma_game", $xien)->get();
        $this->_data["vanmay"] = Game::where("ma_game", $vanmay)->get();
        $this->_data["doanso"] = Game::where("ma_game", $doanso)->get();

        $this->_data["chanleTaixiuMode"] = GameMode::where("mode", $chanleTaixiu)->first();
        $this->_data["chanleTaixiuV2Mode"] = GameMode::where("mode", $chanleTaixiuV2)->first();
        $this->_data["tongbasoMode"] = GameMode::where("mode", $tongbaso)->first();
        $this->_data["motphanbaMode"] = GameMode::where("mode", $motphanba)->first();
        $this->_data["gapbaMode"] = GameMode::where("mode", $gapba)->first();
        $this->_data["loMode"] = GameMode::where("mode", $lo)->first();
        $this->_data["hbaMode"] = GameMode::where("mode", $hba)->first();
        $this->_data["xienMode"] = GameMode::where("mode", $xien)->first();
        $this->_data["vanmayMode"] = GameMode::where("mode", $vanmay)->first();
        $this->_data["doansoMode"] = GameMode::where("mode", $doanso)->first();
        $this->_data["titlePage"] = "Cài Đặt Tỉ lệ";
        return view('admin.momo.ratio', $this->_data);
    }
    public function giftCode(){
        $this->_data["list"] = GiftCode::all();
        $this->_data["listHistory"] = CodeHistory::paginate(50);
        $this->_data["momoList"] = Momo::select(["id", "phone", "sodu"])
            ->where([
                ["trangthai", "=", "run"],
                ["try", "<", 3],
                ["gd", "<", 190],
            ])->whereRaw("gd_day < max_day and gd_month < max_month")->get();
        $this->_data["titlePage"] = "Quản Lý Gifcode";
        return view('admin.momo.giftCode', $this->_data);
    }
    public function event(){
        return view('admin.momo.event', $this->_data);
    }
    public function show(Request $request){
        $id = $request->id;
        $momo = Momo::find($id);
        $phone = $momo->phone ?? '';
        $id = $momo->id ?? '';

        $this->_data["item"] = $momo;
        $this->_data["titlePage"] = "Cài Đặt Momo ".$phone;
        $this->_data["id"] = $id;
        return view('admin.momo.show', $this->_data);
    }
    public function transferError(Request $request){
        $limit = 20;
        $search = $request->search;
        $transferList = History::where("status", 2)
            ->whereNotIn("cron_status", [1,2]);
        if($search){
            $transferList->where("phone", $search)
                ->orWhere("id_momo", $search)
                ->orWhere("id_tran", $search);
        }
        $this->_data["list"] = $transferList->orderBy('id', "DESC")->paginate($limit);
        $this->_data["total"] = $this->_data["list"]->total();
        $this->_data["momoList"] = Momo::select(["id", "phone", "sodu"])
            ->where([
                ["trangthai", "=", "run"],
                ["try", "<", 3],
                ["gd", "<", 190],
            ])->whereRaw("gd_day < max_day and gd_month < max_month")->get();
        $this->_data["limit"] = $limit;
        $this->_data["search"] = $search;
        $this->_data["titlePage"] = "Bill Lỗi Thanh Toán";
        return view('admin.momo.transferError', $this->_data);
    }
}
