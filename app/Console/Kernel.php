<?php

namespace App\Console;

use App\Console\Commands\FetchHistoryCommand;
use App\Console\Commands\LoadBalanceCommand;
use App\Console\Commands\ResetLimitTransferCommand;
use App\Console\Commands\SendMoneyCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Spatie\ShortSchedule\ShortSchedule;


class Kernel extends ConsoleKernel
{
    protected $commands = [
        LoadBalanceCommand::class,
        ResetLimitTransferCommand::class,
        FetchHistoryCommand::class,
        SendMoneyCommand::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('job:resetLimitTransfer')->dailyAt('00:01');
         $schedule->command('job:loadBalance')->everyFifteenMinutes();
         $schedule->command('job:sendBillError')->everyMinute();
//         $schedule->command('job:fetchHistory')->everyMinute();
//         $schedule->command('job:sendMoney')->everyMinute();
    }
    protected function shortSchedule(ShortSchedule $shortSchedule)
    {
//        $shortSchedule->command('job:fetchHistory')->everySeconds(10)->withoutOverlapping();
//        $shortSchedule->command('job:sendMoney')->everySeconds(10)->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
