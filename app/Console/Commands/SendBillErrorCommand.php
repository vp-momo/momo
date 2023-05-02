<?php

namespace App\Console\Commands;

use App\Models\History;
use App\Models\HistorySend;
use App\Models\Momo;
use App\Models\Setting;
use App\Services\MomoService;
use App\Services\SendMoneyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendBillErrorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:sendBillError';

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
        $setting = Setting::first();
        if($setting) {
            $comment = $setting->comment_back_money;
            if($setting->sendError == 1){
                $this->startCommand($comment);
            }
        }
    }
    public function startCommand($comment){

        $transactionItem = History::where("status", 2)
            ->whereNotIn("cron_status", [0,1,2]) //pending cron
            ->whereNotNull("sys_ran")
            ->where("resend_error", "<", 3)
            ->orderBy("id", "ASC")->first();
        if($transactionItem){
            $resendError = $transactionItem->resend_error;
            $tranId = $transactionItem->id_tran;
            $historySend = HistorySend::where("trans_id", $tranId)->first();
            if(!$historySend){
                $phone = $transactionItem->phone;
                $id_momo = $transactionItem->id_momo;
                $amount_paid = $transactionItem->amount_paid;
                $newComment = $comment. " " .$tranId;
                Log::info("-----BẮT ĐẦU TRẢ TIỀN CHO GD----- $tranId");
                try {
                    $momoRand = Momo::where([
                        ["sodu", ">=", $amount_paid],
                        ["gd", "<", 190],
                        ["try", "<=", 3],
                        ["trangthai", "=", 'run'],
                    ])->whereRaw('gd_day < max_day AND gd_month < max_month')
                        ->inRandomOrder()
                        ->limit(1)
                        ->first();

                    if($momoRand){
                        if($momoRand->gd >= 170 || $momoRand->gd_day > 40000000){
                            $newComment = 'sắp kịch hạn mức vui lòng đổi số '.$tranId;
                        }
                        $phone = $momoRand->phone;
                        $dataSendMomo = MomoService::getDataSendMomo($phone);
                        $resultSendMoney = SendMoneyService::getInstance()->send($dataSendMomo,$id_momo, $amount_paid, xoakhoangchong($newComment));
                        if(!empty($resultSendMoney) && $resultSendMoney["status"] == "success"){
                            $resultUpdateStatus = History::where("id_tran", $tranId)->update(["status" => 1]);
                            if($resultUpdateStatus){
                                Log::info("-----TRẢ TIỀN CHO GD THÀNH CÔNG----- $tranId");
                                HistorySend::create([
                                    "phone" => $phone,
                                    "trans_id" => $tranId,
                                    "id_momo" => $id_momo,
                                    "amount" => $amount_paid,
                                    "status" => 1,
                                    "comment" => $newComment,
                                    "info" => json_encode($resultSendMoney, true),
                                ]);
                                $transactionItem->update(["cron_status" => 1]); // success cron
                            }
                        }else{
                            $transactionItem->update(["resend_error" => $resendError+1]); // error cron
                        }
                    }else{
                        Log::info("_____KHÔNG CÓ SỐ MOMO NÀO ĐỂ CHUYỂN_____$tranId");
                        $transactionItem->update(["resend_error" => $resendError+1]); // error cron
                    }
                }catch (\Exception $exception){
                    Log::error("_____LỖI TRẢ TIỀN_____PHONE: $phone TRAN_ID: $tranId");
                    $transactionItem->update(["resend_error" => $resendError+1]); // error cron
                    Log::error($exception);
                }
            }
        }
    }
}
