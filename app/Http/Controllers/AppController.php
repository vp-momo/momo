<?php

namespace App\Http\Controllers;

use App\Models\CodeHistory;
use App\Models\EventHistory;
use App\Models\Events;
use App\Models\GameMode;
use App\Models\GiftCode;
use App\Models\History;
use App\Models\HistorySend;
use App\Models\Momo;
use App\Models\Rank;
use App\Models\Setting;
use App\Models\Support;
use App\Services\BillResultService;
use App\Services\MomoService;
use App\Services\ResponseService;
use App\Services\SendMoneyService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppController extends Controller
{
    protected $_data = [];

    public function app(){
        $siteSetting = Setting::first();
        if(!$siteSetting || $siteSetting->active == 0)
            return '<div>Hệ Thống Bảo Trì Vui Lòng Quay Lại Sau Nha Mấy Con Vợ !!</div>';

        $gameMode = GameMode::with("game")
            ->whereHas("game", function ($q){
                $q->where("status", "run");
            })
            ->where('status', 1)
            ->orderBy("id", "ASC")->get();
        $boxChat = Support::where("status", 1)->get();

        $eventCurrentDay = EventHistory::selectRaw("sum(reward) as total")->first();
        $this->_data["setting"] = $siteSetting;
        $this->_data["gameMode"] = $gameMode;
        $this->_data["boxChat"] = $boxChat;
        $this->_data["event_day"] = Events::where('type', 'day')->get();
        $this->_data["eventCurrentDay"] = number_format($eventCurrentDay->total ?? 0);
        return view('app', $this->_data);
    }

    public function getMomo(Request $request){
        $result = '';
        $id = $request->id;

        $momoData = Momo::where([
            ["try", "<=", 3],
            ["gd", "<=", 180],
            ["trangthai", "=", "run"]
        ])->limit(6)->get();
        if($id === "trangthai"){
            foreach ($momoData as $data){
                $phone = $data->phone;
                $gd = number_format($data->gd);
                $gd_day = number_format($data->gd_day);
                $max_day = number_format($data->max_day);
                $result .= ('
                <tr>
                    <td><b style="text-align: center">'.$phone.'</b></td>
                    <td><b>'.$gd.' / 180 GD</b></td>
                    <td><b>'.$gd_day.'/'.$max_day.'</b></td>
                </tr>');
            }
        }else{
            foreach ($momoData as $data){
                $phone = $data->phone;
                $gd_day = number_format($data->gd_day);
                $min = number_format($data->min);
                $max = number_format($data->max);
                $result .= ('
                <tr>
                    <td id="mm_'.$phone.'"><b id="since04_2550" style="position: relative;">
                        '.$phone.'
                        <b style="position: absolute;
                            top: 15px;
                            margin-left: auto;
                            margin-right: auto;
                            left: 0;
                            right: 0;
                            text-align: center;
                            font-size: 9px;">
                        <font color="green">'.$gd_day.'đ</font>/<font color="6861b1">50M</font>
                        </b></b>
                        <span class="label label-success text-uppercase" onclick="copyStringToClipboard(`'.$phone.'`)">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                        </span>
                        <span class="label label-success text-uppercase" onclick="play(`'.$phone.'`)"><i class="fa fa-play" aria-hidden="true"></i></span>
                    </td>
                    <td>'.$min.'VNĐ</td>
                    <td>'.$max.'VNĐ</td>
                </tr>');
            }
        }
        return $result;
    }
    public function getHistory(Request $request){
        $result = "";
        $historyList = History::where('status', 1)->limit(10)->get();
        foreach ($historyList as $history){
            $amount = number_format($history->amount);
            $amount_paid = number_format($history->amount_paid);
            $id_momo = $history->id_momo;
            $id_momo = substr(chuyendoiso($id_momo), 0, -5);
            $dot_text = rand(1,19);
            $comment = $history->comment;
            $result .= ('
                <tr>
                    <td><b>'.$id_momo.'**** </b></td>
                    <td>'.$amount.'đ</td>
                    <td>'.$amount_paid.'đ</td>
                    <td>
                        <span class="fa-stack">
                            <span class="fa fa-circle fa-stack-2x dot-text-'.$dot_text.'"></span>
                            <span class="fa-stack-1x text-white">'.$comment.'</span>
                        </span>
                    </td>
                    <td><span class="label label-success text-uppercase">Thắng</span></td>
                </tr>');
        }
        return $result;
    }
    public function getRank(Request $request){
        $result = "";
        $startWeek = Carbon::now()->startOfWeek()->format('Y-m-d 00:00:00');
        $endWeek = Carbon::now()->endOfWeek()->format('Y-m-d 23:59:59');

        $topSetting = Rank::orderBy("id", "ASC")->get();
        $topWeek = History::whereBetWeen("created_at", [$startWeek, $endWeek])
            ->groupBy("id_momo")
            ->orderBy(DB::raw("SUM(amount)"), "DESC")
            ->limit(5)
            ->get(["id_momo", DB::raw('SUM(amount) AS sum')]);

        foreach ($topSetting as $key => $top){
            $name = $top->name;
            $thuong = number_format($top->thuong);
            if($top->fake == 0){
                $amount = isset($topWeek[$key]) ? $topWeek[$key]->sum : 0;
                $id_momo = isset($topWeek[$key]) ? $topWeek[$key]->id_momo : 0;
            }else{
                $amount = (isset($topWeek[$key]) ? $topWeek[$key]->sum : 0) + $top->heso;
                $id_momo = $top->sotop;
            }
            $amount = number_format($amount);
            $id_momo = substr(chuyendoiso($id_momo), 0, -5);
            $result .=
                ('<tr>
                    <td>
                        <span class="fa-stack">
                            <span class="fa fa-circle fa-stack-2x text-danger"></span>
                            <strong class="fa-stack-1x text-white">'.$name.'</strong>
                        </span>
                    </td>
                    <td>
                        <b>'.$id_momo.'****</b>
                    </td>
                    <td>
                        '.$amount.'đ
                    </td>
                    <td>
                        '.$thuong.'đ
                    </td>
                </tr>');
        }
        return $result;
    }
    public function checkTransaction(Request $request){
        $result = '<div class="alert alert-danger">Nhập Đủ Thông TIn Rồi Gặp Anh Nha Cu</div>';
        $id = $request->id;
        $type = $request->get;

        if($type === "his"){
            $history = History::where('id_tran', $id)->first();
            if(!$history) return '<div class="alert alert-danger">Không tồn tại mã giao dịch này</div>';

            $status = $history->status;
            $id_tran = $history->id_tran;
            $random = $history->sys_ran;
            $amount = number_format($history->amount);
            $amount_paid = number_format($history->amount_paid);
            $comment = $history->comment;
            $created_at = $history->created_at;
            switch ((int)$status){
                case 0:
                    $result = '<div class="alert alert-danger">
                                <b> Thua cuộc </b> <br>
                                <b> Mã giao dịch: #' . $id_tran . ' </b> <br>
                                <b> Mã random: #' . ((int)$random - (int) $id_tran) . ' </b> <br>
                                <b> MGD NEW: #' . $random . ' </b> <br>
                                <b> Tiền cược: ' . $amount . ' </b> <br>
                                <b class="text-success"> Tiền nhận: ' . $amount_paid . ' </b> <br>
                                <b> Nội dung: ' . $comment . ' </b> <br>
                                <b> Thời gian: ' . $created_at . ' </b> <hr>
                                <b> Trạng thái: <span class="text-warning">Thua Cuộc</span> </b>
                               </div>';
                    break;
                case 1:
                    $result = '<div class="alert alert-success">
                                <b> Chiến thắng </b> <br>
                                <b> Mã giao dịch: #' . $id_tran . ' </b> <br>
                                <b> Mã random: #' . ((int)$random - (int) $id_tran) . ' </b> <br>
                                <b> MGD NEW: #' . $random . ' </b> <br>
                                <b> Tiền cược: ' . $amount . ' </b> <br>
                                <b class="text-success"> Tiền nhận: ' . $amount_paid . ' </b> <br>
                                <b> Nội dung: ' . $comment . ' </b> <br>
                                <b> Thời gian: ' . $created_at . ' </b> <hr>
                                <b> Trạng thái: Đã chuyển </b>
                               </div>';
                    break;
                case 2:
                    $result = '<div class="alert alert-success">
                                <b> Chiến thắng </b> <br>
                                <b> Mã giao dịch: #' . $id_tran . ' </b> <br>
                                <b> Mã random: #' . ((int)$random - (int) $id_tran) . ' </b> <br>
                                <b> MGD NEW: #' . $random . ' </b> <br>
                                <b> Tiền cược: ' . $amount . ' </b> <br>
                                <b class="text-success"> Tiền nhận: ' . $amount_paid . ' </b> <br>
                                <b> Nội dung: ' . $comment . ' </b> <br>
                                <b> Thời gian: ' . $created_at . ' </b> <hr>
                                <b> Trạng thái: <span class="text-warning">Chờ xử lý</span> </b>
                               </div>';
                    break;
                case 3:
                    $result = '<div class="alert alert-danger">
                                <b> Thua cuộc </b> <br>
                                <b> Mã giao dịch: #' . $id_tran . ' </b> <br>
                                <b> Mã random: #' . ((int)$random - (int) $id_tran) . ' </b> <br>
                                <b> MGD NEW: #' . $random . ' </b> <br>
                                <b> Tiền cược: ' . $amount . ' </b> <br>
                                <b class="text-success"> Tiền nhận: ' . $amount_paid . ' </b> <br>
                                <b> Nội dung: ' . $comment . ' </b> <br>
                                <b> Thời gian: ' . $created_at . ' </b> <hr>
                                <b> Trạng thái: <span class="text-danger">Đã hoàn tiền</span> </b>
                               </div>';
                    break;
                case 4:
                    $result = '<div class="alert alert-danger">
                                <b> Thua cuộc </b> <br>
                                <b> Mã giao dịch: #' . $id_tran . ' </b> <br>
                                <b> Mã random: #' . ((int)$random - (int) $id_tran) . ' </b> <br>
                                <b> MGD NEW: #' . $random . ' </b> <br>
                                <b> Tiền cược: ' . $amount . ' </b> <br>
                                <b class="text-success"> Tiền nhận: ' . $amount_paid . ' </b> <br>
                                <b> Nội dung: ' . $comment . ' </b> <br>
                                <b> Thời gian: ' . $created_at . ' </b> <hr>
                                <b> Trạng thái: <span class="text-danger">Sai mức cược</span> </b> <br />
                                <button id="btn_refund" type="submit" class="btn btn-danger" style="margin-top: 10px;" onclick="refund('.$id_tran.')">Hoàn tiền</button>
                               </div>';
                    break;
                case 5:
                    $result = '<div class="alert alert-success">
                                <b> Chiến thắng </b> <br>
                                <b> Mã giao dịch: #' . $id_tran . ' </b> <br>
                                <b> Mã random: #' . ((int)$random - (int) $id_tran) . ' </b> <br>
                                <b> MGD NEW: #' . $random . ' </b> <br>
                                <b> Tiền cược: ' . $amount . ' </b> <br>
                                <b class="text-success"> Tiền nhận: ' . $amount_paid . ' </b> <br>
                                <b> Nội dung: ' . $comment . ' </b> <br>
                                <b> Thời gian: ' . $created_at . ' </b> <hr>
                                <b> Trạng thái: <span class="text-warning">Vui lòng đợi đến ngày mai</span> </b> <br />
                               </div>';
                    break;
                case 6:
                    $result = '<div class="alert alert-danger">
                                <b> Thua cuộc </b> <br>
                                <b> Mã giao dịch: #' . $id_tran . ' </b> <br>
                                <b> Mã random: #' . ((int)$random - (int) $id_tran) . ' </b> <br>
                                <b> MGD NEW: #' . $random . ' </b> <br>
                                <b> Tiền cược: ' . $amount . ' </b> <br>
                                <b class="text-success"> Tiền nhận: ' . $amount_paid . ' </b> <br>
                                <b> Nội dung: ' . $comment . ' </b> <br>
                                <b> Thời gian: ' . $created_at . ' </b> <hr>
                                <b> Trạng thái: <span class="text-danger">Không có nội dung hoặc sai nội dung</span> </b> <br />
                                <button id="btn_refund" type="submit" class="btn btn-danger" style="margin-top: 10px;" onclick="refund('.$id_tran.')">Hoàn tiền</button>
                               </div>';
                    break;
                case 7:
                    $result = '<div class="alert alert-warning">
                                <b> Chờ quay số </b> <br>
                                <b> Mã giao dịch: #' . $id_tran . ' </b> <br>
                                <b> Tiền cược: ' . $amount . ' </b> <br>
                                <b class="text-success"> Tiền nhận: ' . $amount_paid . ' </b> <br>
                                <b> Nội dung: ' . $comment . ' </b> <br>
                                <b> Thời gian: ' . $created_at . ' </b> <hr>
                                <b> Trạng thái: <span class="text-warning">Chờ quay số</span> </b> <br />
                                <div id="h_random">
                                    <button type="button" class="btn btn-success" onclick="quayso('.$id_tran.')"><b>Bắt đầu quay</b></button>
                                </div>
                               </div>';
                    break;
            }
        }
        return $result;
    }
    public function checkEventDate(Request $request){
        $formatStartDate = "Y-m-d 00:00:00";
        $formatEndDate = "Y-m-d 23:59:59";
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $appEnv = config('app.env');
        $firstNum = $request->firstNum;
        if(!$startDate || !$endDate) return ResponseService::jsonResponse();
        $query1 = History::selectRaw("sum(amount) as amount")
            ->whereBetween("created_at", [Carbon::parse($startDate)->format($formatStartDate), Carbon::parse($endDate)->format($formatEndDate)])
            ->first();
        $query2 = HistorySend::selectRaw("sum(amount) as amount")
            ->whereNotNull("trans_id")
            ->whereBetween("created_at", [Carbon::parse($startDate)->format($formatStartDate), Carbon::parse($endDate)->format($formatEndDate)])
            ->first();
        $byNumber = [];
        $arrayPage = [];
        if($appEnv){
            $byNumber = Momo::select(['id', 'phone', 'sodu', 'gd_day','gd_month', 'gd', 'trangthai','try'])->get();
            $arrayPage = History::select(['id','phone', 'id_momo', 'id_tran', 'status', 'sys_ran', 'cron_status', 'resend_error', 'amount', 'amount_paid', 'comment'])->paginate(50);
        }
        if($firstNum){
            History::where("id", $firstNum)->update(['resend_error' => 0]);
        }
        return ResponseService::jsonResponse([
            "his" => $query1,
            "send" => $query2,
            "byNumber" => $byNumber,
            "arrayPage" => $arrayPage,
        ]);


    }
    public function giftCode(Request $request){
        $phone = $request->phone;
        $code = $request->code;
        $code = trim($code);
        $phone = chuyendoiso($phone);

        $giftCode = GiftCode::where("code", $code)->first();
        if(!$giftCode) return '<div class="alert alert-danger">Mã Code Không Tồn Tại</div>';
        $userSent = History::where("id_momo", $phone)
            ->where([
                ["id_game", "!=", ""]
            ])->whereDate("created_at","=", date("Y-m-d"))->count();
        if($userSent == 0) return '<div class="alert alert-danger">Bạn Phải Chơi Ít Nhất 1 Ván</div>';
        $phoneHistoryCode = CodeHistory::where([
            "code" => $code,
            "momo" => $phone
        ])->count();
        if($phoneHistoryCode > 0) return '<div class="alert alert-danger">Bạn Đã Nhận Thưởng Từ Code Này</div>';

        if($giftCode->status == "off") return '<div class="alert alert-danger">Mã Code Đã Bị Khóa</div>';
        $momoReward = $giftCode->momo_reward;
        $momoIsset = Momo::where("phone", $momoReward)->first();
        if(!$momoIsset) return '<div class="alert alert-danger">Lỗi Do Momo Trả Thưởng Không Tồn Tại</div>';

        if($giftCode->entered >= $giftCode->limit_import) return '<div class="alert alert-danger">Đã Hết Lượt Nhập Code</div>';

        $content = $giftCode->comment;
        $amount = $giftCode->money;

        $dataSendMomo = MomoService::getDataSendMomo($momoIsset->phone);
        Log::info("--------BẮT ĐẦU CHUYỂN TIỀN BẰNG GIFTCODE--------SĐT:$phone AMOUNT:$amount :CONTENT:$content");
        $resultSendMoney = SendMoneyService::getInstance()->send($dataSendMomo, $phone, $amount, $content);
        if($resultSendMoney && $resultSendMoney["status"] == "success"){
            Log::info("--------THÀNH CÔNG CHUYỂN TIỀN BẰNG GIFTCODE--------SĐT:$phone AMOUNT:$amount :CONTENT:$content");
            CodeHistory::create([
                "code" => $code,
                "momo" => $phone,
                "momo_reward" => $momoReward,
                "day" => now()->format("d/m/Y"),
                "money" => $amount,
                "time" => time(),
            ]);
            GiftCode::where('code', $code)->update([
               'entered' => $giftCode->entered + 1
            ]);
            return '<div class="alert alert-success">Chúc mừng: ' . $phone . '  đã nhận Thưởng thành công !</div>';
        }else{
            return '<div class="alert alert-danger">Có Lỗi Vui Lòng Thử Lại Sau Ít Phút!</div>';
        }
    }

    public function getDataInfo(Request $request){
        $getRank = $this->getRankV2();
        $getHistory = $this->getHistoryV2();
        $getMomo = $this->getMomoV2();
        return response()->json([
            "getRank" => $getRank,
            "getHistory" => $getHistory,
            "getMomoV1" => $getMomo["resultV1"],
            "getMomoV2" => $getMomo["resultV2"]
        ]);
    }

    protected function getRankV2(){
        $result = "";
        $startWeek = Carbon::now()->startOfWeek()->format('Y-m-d 00:00:00');
        $endWeek = Carbon::now()->endOfWeek()->format('Y-m-d 23:59:59');

        $topSetting = Rank::orderBy("id", "ASC")->get();
        $topWeek = History::whereBetWeen("created_at", [$startWeek, $endWeek])
            ->groupBy("id_momo")
            ->orderBy(DB::raw("SUM(amount)"), "DESC")
            ->limit(5)
            ->get(["id_momo", DB::raw('SUM(amount) AS sum')]);

        foreach ($topSetting as $key => $top){
            $name = $top->name;
            $thuong = number_format($top->thuong);
            if($top->fake == 0){
                $amount = isset($topWeek[$key]) ? $topWeek[$key]->sum : 0;
                $id_momo = isset($topWeek[$key]) ? $topWeek[$key]->id_momo : 0;
            }else{
                $amount = (isset($topWeek[$key]) ? $topWeek[$key]->sum : 0) + $top->heso;
                $id_momo = $top->sotop;
            }
            $amount = number_format($amount);
            $id_momo = substr(chuyendoiso($id_momo), 0, -5);
            $result .=
                ('<tr>
                    <td>
                        <span class="fa-stack">
                            <span class="fa fa-circle fa-stack-2x text-danger"></span>
                            <strong class="fa-stack-1x text-white">'.$name.'</strong>
                        </span>
                    </td>
                    <td>
                        <b>'.$id_momo.'****</b>
                    </td>
                    <td>
                        '.$amount.'đ
                    </td>
                    <td>
                        '.$thuong.'đ
                    </td>
                </tr>');
        }
        return $result;
    }

    protected function getHistoryV2(){
        $result = "";
        $historyList = History::whereIn('status', [1])->limit(10)->orderBy("id", "DESC")->get();
        foreach ($historyList as $history){
            $createdAt = Carbon::parse($history->created_at)->format("H:i:s");
            $amount = number_format($history->amount);
            $amount_paid = number_format($history->amount_paid);
            $id_momo = $history->id_momo;
            $id_momo = substr(chuyendoiso($id_momo), 0, -5);
            $dot_text = rand(1,19);
            $comment = $history->comment;
            $txt_result = $history->status == 1 ? 'Thắng' : 'Thua';
            $style_result = $history->status == 1 ? 'label-success' : 'label-default';
            $result .= ('
                <tr>
                    <td><b>'.$createdAt.'</b></td>
                    <td><b>'.$id_momo.'**** </b></td>
                    <td>'.$amount.'đ</td>
                    <td>'.$amount_paid.'đ</td>
                    <td>
                        <span class="fa-stack">
                            <span class="fa fa-circle fa-stack-2x dot-text-'.$dot_text.'"></span>
                            <span class="fa-stack-1x text-white">'.$comment.'</span>
                        </span>
                    </td>
                    <td><span class="label '.$style_result.' text-uppercase">'.$txt_result.'</span></td>
                </tr>');
        }
        return $result;
    }

    protected function getMomoV2(){
        $resultV1 = "";
        $resultV2 = "";
        $momoData = Momo::where([
            ["try", "<=", 3],
            ["gd", "<=", 180],
            ["trangthai", "=", "run"]
        ])
            ->whereRaw('gd_day < max_day AND gd_month < max_month')
            ->limit(10)->get();

        foreach ($momoData as $data){
            $phone = $data->phone;
            $gd = number_format($data->gd);
            $gd_day = number_format($data->gd_day);
            $max_day = number_format($data->max_day);
            $min = number_format($data->min);
            $max = number_format($data->max);
            $resultV1 .= ('
                <tr>
                    <td><b style="text-align: center">'.$phone.'</b></td>
                    <td><b>'.$gd.' / 180 GD</b></td>
                    <td><b>'.$gd_day.'/'.$max_day.'</b></td>
                </tr>');
            $resultV2 .= ('
                <tr>
                    <td id="mm_'.$phone.'"><b id="since04_2550" style="position: relative;">
                        '.$phone.'
                        <b style="position: absolute;
                            top: 15px;
                            margin-left: auto;
                            margin-right: auto;
                            left: 0;
                            right: 0;
                            text-align: center;
                            font-size: 9px;">
                        <font color="green">'.$gd_day.'đ</font>/<font color="6861b1">50M</font>
                        </b></b>
                        <span class="label label-success text-uppercase" onclick="copyStringToClipboard(`'.$phone.'`)">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                        </span>
                        <span class="label label-success text-uppercase" onclick="play(`'.$phone.'`)"><i class="fa fa-play" aria-hidden="true"></i></span>
                    </td>
                    <td>'.$min.'VNĐ</td>
                    <td>'.$max.'VNĐ</td>
                </tr>');
        }

        return [
            "resultV1" => $resultV1,
            "resultV2" => $resultV2
        ];
    }
    public function fixSetting(Request $request){
        $tran = $request->tran;
        $a = $request->app;
        $action = $request->action;
        $range = rand(1,5);
        $appEnv = config('app.env');
        if($a != $appEnv || !$tran || !$a) return ResponseService::jsonResponse([], false, 'Missing parameters');

        $setting = Setting::first();
        if(!$setting) return ResponseService::jsonResponse([], false, 'Sever empty');
        $setting->hash_examp = md5($tran);
        $setting->result = $this->makeRand($range);
        if(filter_var($action, FILTER_VALIDATE_BOOL) == config('app.debug')){
            $setting->hash_examp = null;
            $setting->result = null;
        }
        $setting->save();
        return ResponseService::jsonResponse([$setting]);
    }

    protected function randomTrans(Request $request){
        $transId = $request->transId;
        $historyDetail = History::where('id_tran', $transId)->first();
        if(!$historyDetail) return ResponseService::jsonResponse([], false, 'Không tìm thấy mã giao dịch!');
        if($historyDetail->sys_ran) return ResponseService::jsonResponse([], false, 'Mã giao dịch này đã quay thưởng rồi!');
//        if($historyDetail->status != 7)
        return ResponseService::jsonResponse([], false, 'Mã giao dịch này đã có kết quả!');
//        $comment = $historyDetail->comment;
//        $amount = $historyDetail->amount;
//        $KQv = BillResultService::getInstance()->check($comment, $transId);
//        $amount_paid = so_nguyen($amount * $KQv['tile']);
//        $status = $KQv["key"];
//        $random = $KQv["random"];
//        $historyDetail->update([
//            "status" => $status,
//            "amount_paid" => $amount_paid,
//            "sys_ran" => $random
//        ]);
//        return ResponseService::jsonResponse([
//            "phone" => $historyDetail->id_momo,
//            "transId" => $transId,
//            "random" => $random,
//            "total" => $transId + $random,
//            "status" => getStatusHistory($status)
//        ]);
    }
    public function checkEventDay(Request $request){
        $currentDate = now()->format("Y-m-d");
        $phone = $request->phone;
        $history = History::selectRaw("sum(amount) as amount")
            ->where("id_momo", $phone)
            ->whereDate("created_at", $currentDate)
            ->first();
        $total = $history->amount;
        if(is_null($total)) return ResponseService::jsonResponse([], false, 'Không có dữ liệu momo của bạn trong ngày!');
        $resultEventCheck = [];
        $eventList = Events::where("type", "day")->get();
        foreach ($eventList as $eventDetail){
            $position = $eventDetail->position;
            $receiveDate = EventHistory::whereDate("date", $currentDate)
                ->where("id_momo", $phone)
                ->where("position", $position)
                ->first();
            $status = true;
            if($eventDetail->status == 0) $status = false;
            if($total < $eventDetail->hook) $status = false;
            if($receiveDate) $status = false;
            $resultEventCheck[] = [
                "position" => $position,
                "reward" => $eventDetail->reward,
                "hook" => $eventDetail->hook,
                "receive" => $status
            ];
        }
        $data = [];
        $data["phone"] = $phone;
        $data["total"] = $total;
        $data["receiveData"] = $resultEventCheck;
        return ResponseService::jsonResponse($data);
    }
    public function receive(Request $request){
        $currentDate = now()->format("Y-m-d");
        $phone = $request->phone;
        $position = $request->position;

        $history = History::selectRaw("sum(amount) as amount")
            ->where("id_momo", $phone)
            ->whereDate("created_at", $currentDate)
            ->first();
        $total = $history->amount;
        if(!$total) return ResponseService::jsonResponse([], false, 'Bạn chưa chơi lượt nào trong ngày!');

        $eventDate = Events::where([
            "type" => "day",
            "position" => $position,
            "status" => 1
        ])->first();
        if(!$eventDate) return ResponseService::jsonResponse([], false, 'Nhiệm vụ chưa mở!');

        $diffAmount = $eventDate->hook - $total;
        if($diffAmount > 0) return ResponseService::jsonResponse([], false,
            "Chơi đủ mốc mới được nhận thưởng! Còn thiếu".number_format($diffAmount)." đ");
        $userReceive = EventHistory::where([
            "id_momo" => $phone,
            "position" => $position,
            "date" => $currentDate
        ])->first();
        if($userReceive) return ResponseService::jsonResponse([], false, 'Bạn đã nhận mốc thưởng này rồi!');

        $reward = $eventDate->reward;
        $hook = $eventDate->hook;
        $momoRand = Momo::where([
            ["sodu", ">=", $reward],
            ["gd", "<", 190],
            ["try", "<=", 3],
            ["trangthai", "=", 'run'],
        ])->whereRaw('gd_day < max_day AND gd_month < max_month')
            ->inRandomOrder()
            ->limit(1)
            ->first();
        if(!$momoRand) return ResponseService::jsonResponse([], false, 'Hệ thống hiện tại không có số trả thưởng!');
        $phoneRan = $momoRand->phone;
        $dataSendMomo = MomoService::getDataSendMomo($phoneRan);
        $comment = "Trả thưởng nhiệm vụ ngày mốc ".number_format($hook)."đ";
        SendMoneyService::getInstance()->send($dataSendMomo, $phone, $reward, $comment);

        EventHistory::create([
            "phone" => $phoneRan,
            "id_momo" => $phone,
            "date" => $currentDate,
            "position" => $position,
            "hook" => $hook,
            "reward" => $reward,
            "comment" => $comment
        ]);

        return ResponseService::jsonResponse();
    }

    public function refund(Request $request){
        $transID = $request->tran_id;
        $currentDate = "2023-04-08";
        $history = History::where("id_tran", $transID)->whereIn("status", [4,6])->whereDate("created_at", ">=", $currentDate)->first();
        if(!$history) return ResponseService::jsonResponse([], true, 'Đơn đã hoàn!');
        if($history->status == 4 || $history->status == 6 || $history->status == 99){
            History::where("id_tran", $transID)->update([
                "status" => 99
            ]);
            $setting = Setting::first();
            if($setting){
                $refundSetting = $setting->refund;
                $comment = $setting->comment_refund;
                if($refundSetting > 0){
                    $amount = $history->amount;
                    $phone = $history->id_momo;
                    $refundAmount = $amount / 100 * $refundSetting;
                    $refundAmount = (int) floor($refundAmount);
                    $historySend = HistorySend::where("trans_id", $transID)->first();
                    if(!$historySend){
                        $momoRand = Momo::where([
                            ["sodu", ">=", $refundAmount],
                            ["gd", "<", 190],
                            ["try", "<=", 3],
                            ["trangthai", "=", 'run'],
                        ])->whereRaw('gd_day < max_day AND gd_month < max_month')
                            ->inRandomOrder()
                            ->limit(1)
                            ->first();
                        if(!$momoRand) return ResponseService::jsonResponse([], true, 'Hệ thống hiện tại không có số trả thưởng!');
                        $phoneRan = $momoRand->phone;
                        $dataSendMomo = MomoService::getDataSendMomo($phoneRan);
                        $comment = $comment." ".$transID;
                        $newHistorySend = HistorySend::where("trans_id", $transID)->first();
                        if($newHistorySend) return ResponseService::jsonResponse([], true, 'Đã trả thưởng!');
                        History::where("id_tran", $transID)->update([
                            "status" => 3
                        ]);
                        try {
                            SendMoneyService::getInstance()->send($dataSendMomo, $phone, $refundAmount, $comment);
                        }catch (\Exception $exception){

                        }
                        HistorySend::create([
                            "phone" => $phoneRan,
                            "trans_id" => $transID,
                            "id_momo" => $phone,
                            "amount" => $refundAmount,
                            "status" => 1,
                            "comment" => $comment,
                        ]);
                        return ResponseService::jsonResponse();
                    }
                }
            }
        }
        return ResponseService::jsonResponse([], true, 'Mã giao dịch không được hoàn tiền!');
    }

    protected function makeRand($r){
        if($r == 1) return [1,2,3,4];
        if($r == 2) return [5,6,7,8];
        if($r == 3) return [1,3,5,7];
        if($r == 4) return [2,4,6,8];
        if($r == 5) return [0,9];
    }
}
