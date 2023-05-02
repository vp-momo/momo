<?php

namespace App\Console\Commands;

use App\Models\Momo;
use App\Services\LoadBalanceService;
use App\Services\LoginMomoService;
use App\Services\MomoService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LoadBalanceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:loadBalance';

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
        $this->startCommand();
//        while (true){
//            $this->startCommand();
//            sleep(150);
//        }
//        Log::info("huihu");


    }
    protected function startCommand(){

        $momoList = Momo::where([
            ["try", "<=", 3],
            ["trangthai", "!=", "stop"],
            ["trangthai", "!=", "walt"],
        ])->get();
        Log::info("-----BẮT ĐẦU LOAD SỐ DƯ-----COUNT_MOMO:".count($momoList));
        foreach ($momoList as $momo){
            $phone = $momo->phone;
            try {
                $dataSendMomo = MomoService::getDataSendMomo($phone);
                $loadBalanceServiceInstance = new LoadBalanceService();
                $resultLoadBalance = $loadBalanceServiceInstance->load($dataSendMomo);
                //Log::info("get Result LoadBalance PHONE--$phone", [$resultLoadBalance]);
                if(!isset($resultLoadBalance["status"]) || $resultLoadBalance["status"] == "success"){
                    $loginMomoServiceInstance = new LoginMomoService();
                    $loginMomoServiceInstance->login($phone);
                    //Log::info("get Result LoginMomo ",[$resultLogin]);
                }
            }catch (\Exception $exception){
                Log::error("_____LOAD SỐ DƯ THẤT BẠI_____PHONE $phone");
                continue;
            }
        }
    }
}
