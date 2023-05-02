<?php

namespace App\Console\Commands;

use App\Models\Momo;
use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ResetLimitTransferCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:resetLimitTransfer';

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
//        $setting = Setting::first();
//        $lastTime = ($setting && $setting->created_at) ? strtotime($setting->created_at) : time();
//        if(time() - $lastTime > (60*60*24 - 10)){
//
//        }
        Momo::where("id", ">", 0)->update([
            "gd" => 0,
            "gd_day" => 0,
        ]);
        Log::info("-----RESET HẠN MỨC NGÀY THÀNH CÔNG-----");
        Setting::where("id", ">", 0)->update(["created_at" => now()]);
        if(date('d') == '01'){
            Momo::where("id", ">", 0)->update(["gd_month" => 0]);
            Log::info("-----RESET HẠN MỨC THÁNG THÀNH CÔNG-----");
        }
    }
}
