<?php

namespace App\Console\Commands;

use App\Models\Momo;
use App\Services\LoginMomoService;
use App\Services\MomoService;
use App\Services\SurplusChange;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LoginMomoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:loginMomo';

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
            Log::info("test");
            sleep(5);
        }
    }
}
