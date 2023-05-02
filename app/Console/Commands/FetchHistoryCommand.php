<?php

namespace App\Console\Commands;

use App\Models\History;
use App\Models\Momo;
use App\Models\Setting;
use App\Services\BillResultService;
use App\Services\HistoryTransactionService;
use App\Services\MomoService;
use App\Services\Telegram\SendMessageService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchHistoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:fetchHistory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        while (true){
//            Log::info("start loadBill");
            $setting = Setting::first();
            if($setting){
                if($setting->loadBill == 1){
//                    Log::info("start loadBill on");
                    $this->startCommand();
                    sleep(3);
                }else{
//                    Log::info("start loadBill off");
                    sleep(30);
                }
            }else{
//                Log::info("start loadBill off");
                sleep(30);
            }

        }

    }

    protected function startCommand(){
        $i = 0;
        try {
            $historyList = [];
            $momoList = Momo::where([
                    ["try", "<=", 3],
                    ["trangthai", "=", 'run'],
                ])
//                ->whereRaw('gd_day < max_day AND gd_month < max_month')
                ->get();
            foreach ($momoList as $momo){
                $dataSendMomo = MomoService::getDataSendMomo($momo->phone);
                $result = (new HistoryTransactionService)->check($dataSendMomo);
                $historyList[] = $result;
            }
            foreach ($historyList as $historyListByPhone){
                foreach ($historyListByPhone as $historyItem){
//                Log::debug("start get History Item--".json_encode($historyItem));
                    $phone = $historyItem["phone"];
                    $tranID = $historyItem["tranId"];
                    $partnerName = $historyItem["partnerName"];
                    $comment = $historyItem["comment"];
                    $amount = $historyItem["amount"];
                    $id_momo = $historyItem["patnerID"];

                    $detailMomo = Momo::select(["min", "max"])->where("phone", $historyItem["phone"])->first();
                    $transIsset = History::where('id_tran', $tranID)->first();
                    if($tranID && !$transIsset){
                        $i++;
                        $status = 0;
                        $amount_paid = 0;
                        $id_game = "";
                        $random = null;
                        if($comment == ""){
                            $status = 4;
                        }else if($amount > $detailMomo->max || $amount < $detailMomo->min){
                            $status = 5;
                        }else{
                            $KQv = BillResultService::getInstance()->check($comment, $tranID, $amount, $id_momo);
                            $amount_paid = so_nguyen($amount * $KQv['tile']);
                            $status = $KQv["key"];
                            $id_game = $KQv["game"];
                            $random = $KQv["random"];
                            $sub = (int) $random - (int) $tranID;
                            $statusText = $this->getStatusText($status);
                            $phoneHidden = $this->getPhoneHidden($id_momo);
                            $amountFormat = number_format($amount)."đ";
                            $amountPaidFormat = number_format($amount_paid)."đ";
                            $now = now()->format("H:m");
                            $messageSendTelegram = "┏━━━━━━━━━━━━━┓
┣➤<b>Mã GD Momo:</b> $tranID
┣➤<b>Mã Random:</b> <span class='tg-spoiler'>$sub</span>
┣➤<b>MGD NEW:</b> <span class='tg-spoiler'>$random</span>
┣➤<b>Nội Dung:</b> <span class='tg-spoiler'>$comment</span>
┣➤<b>Tiền Chơi:</b> <span class='tg-spoiler'>$amountFormat</span>
┣➤<b>Time Nhận Bill:</b> <span class='tg-spoiler'>$now</span>
┣➤<b>Số Điện Thoại:</b> $phoneHidden
┗━━━━━━━━━━━━━┛";
                            SendMessageService::getInstance()->send($messageSendTelegram);
                        }
//                    Log::debug("start create History $tranID", $KQv);
                        History::create([
                            "phone" => $phone,
                            "id_momo" => $id_momo,
                            "id_tran" => $tranID,
                            "info" => json_encode($historyItem),
                            "status" => $status,
                            "amount" => $amount,
                            "amount_paid" => $amount_paid,
                            "comment" => $comment,
                            "id_game" => $id_game,
                            "sys_ran" => $random
                        ]);
                    }
                }
            }
        }catch (\Exception $exception){
            Log::error("_____CÓ LỖI KHI LẤY LỊCH SỬ GIAO DỊCH_____CHECK_LOG");
            Log::error($exception);
        }

        Log::info("-----------------TÌM KIẾM ĐƯỢC $i ĐƠN-----------------");
    }

    protected function getStatusText($status){
        if($status == 1 || $status == 2) return 'Chiến Thắng';
        if($status == 6) return 'Lỗi Thanh Toán!';
        if($status == 4) return 'Sai Nội Dung';
        return 'Thua Cuộc';
    }
    protected function getPhoneHidden($phone){
        $start = substr($phone, 0,4);
        $end = substr($phone, -3);
        return $start."***".$end;
    }
}
