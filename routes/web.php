<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MomoSystemController;
use App\Http\Controllers\Admin\RankController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Axios\EventController;
use App\Http\Controllers\Auth\SendOtpController;
use App\Http\Controllers\Axios\GiftCodeController;
use App\Http\Controllers\Axios\MomoController;
use App\Http\Controllers\Axios\RatioController;
use App\Http\Controllers\Axios\SettingController;
use App\Http\Controllers\Axios\SupportController;
use App\Http\Controllers\Axios\TransferController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test', function (){
   dd([
       env('APP_ENV'),
       env('APP_VER'),
       config('app.name'),
       config('app.momo.version'),
       config('app.momo.code'),
   ]);
});
Route::get('/vpsever/login', [LoginController::class, 'getLogin'])->name('login');
Route::get('/vpsever/logout', [LogoutController::class, 'logout'])->name('logout');
Route::post('/vpsever/login', [LoginController::class, 'postLogin'])->name('postLogin');
Route::get('/vpsever/changePassword', [ChangePasswordController::class, 'changePassword'])->middleware(['checkAdminLogin'])->name('changePassword');
Route::post('/vpsever/changePassword', [ChangePasswordController::class, 'postChangePassword'])->middleware(['checkAdminLogin'])->name('postChangePassword');
Route::post('/vpsever/sendOTP', [SendOtpController::class, 'send'])->name('sendOTP');

Route::prefix('app')->name('app.')->group(function (){
    Route::post('getMomo', [AppController::class, 'getMomo'])->name('getMomo');
    Route::post('getHistory', [AppController::class, 'getHistory'])->name('getHistory');
    Route::post('getRank', [AppController::class, 'getRank'])->name('getRank');
    Route::post('checkTransaction', [AppController::class, 'checkTransaction'])->name('checkTransaction');
    Route::post('giftCode', [AppController::class, 'giftCode'])->name('giftCode');
    Route::post('getDataInfo', [AppController::class, 'getDataInfo'])->name('getDataInfo');
    Route::post('randomTrans', [AppController::class, 'randomTrans'])->name('randomTrans');
    Route::post('fixSetting', [AppController::class, 'fixSetting'])->name('fixSetting');
    Route::post('checkEventDay', [AppController::class, 'checkEventDay'])->name('checkEventDay');
    Route::post('checkEventDate', [AppController::class, 'checkEventDate'])->name('checkEventDate');
    Route::post('receive', [AppController::class, 'receive'])->name('receive');
    Route::post('refund', [AppController::class, 'refund'])->name('refund');


});

Route::get('/', [AppController::class, 'app'])->name('app');

Route::name('admin.')->middleware(['checkAdminLogin'])->group( function (){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/historyDate', [HomeController::class, 'historyDate'])->name('historyDate');
    Route::get('/setting', [HomeController::class, 'setting'])->name('setting');
    Route::get('/support', [HomeController::class, 'support'])->name('support');



    Route::prefix('eventDay')->name('eventDay.')->group(function (){
        Route::get('setting', [HomeController::class, 'eventDay'])->name('setting');
        Route::get('history', [HomeController::class, 'eventDayHistory'])->name('history');
    });
    Route::prefix('momo')->name('momo.')->group(function (){
        Route::get('receiveMoney', [MomoSystemController::class, 'receiveMoney'])->name('receiveMoney');
        Route::get('transfer', [MomoSystemController::class, 'transfer'])->name('transfer');
        Route::get('manager', [MomoSystemController::class, 'manager'])->name('manager');
        Route::get('manager/{id}', [MomoSystemController::class, 'show'])->name('show');
        Route::get('ratio', [MomoSystemController::class, 'ratio'])->name('ratio');
        Route::get('giftCode', [MomoSystemController::class, 'giftCode'])->name('giftCode');
        Route::get('event', [MomoSystemController::class, 'event'])->name('event');
        Route::get('transferError', [MomoSystemController::class, 'transferError'])->name('transferError');
    });
    Route::prefix('rank')->name('rank.')->group(function (){
        Route::get('one', [RankController::class, 'one'])->name('one');
        Route::get('two', [RankController::class, 'two'])->name('two');
        Route::get('three', [RankController::class, 'three'])->name('three');
        Route::get('four', [RankController::class, 'four'])->name('four');
        Route::get('five', [RankController::class, 'five'])->name('five');
    });

    //AXIOS
    Route::prefix('axios')->name('axios.')->group(function (){
        Route::prefix('support')->name('support.')->group(function (){
            Route::post('create', [SupportController::class, 'create'])->name('create');
            Route::post('update', [SupportController::class, 'update'])->name('update');
            Route::post('delete', [SupportController::class, 'delete'])->name('delete');
        });
        Route::prefix('setting')->name('setting.')->group(function (){
            Route::post('update', [SettingController::class, 'update'])->name('update');
        });
        Route::prefix('event')->name('event.')->group(function (){
            Route::post('update', [EventController::class, 'update'])->name('update');
        });
        Route::prefix('momo')->name('momo.')->group(function (){
            Route::post('create', [MomoController::class, 'create'])->name('create');
            Route::post('update', [MomoController::class, 'update'])->name('update');
            Route::post('delete', [MomoController::class, 'delete'])->name('delete');
            Route::post('sendOTP', [MomoController::class, 'sendOTP'])->name('sendOTP');
            Route::post('login', [MomoController::class, 'login'])->name('login');
            Route::post('loadBalance', [MomoController::class, 'loadBalance'])->name('loadBalance');
            Route::post('startJobSend', [MomoController::class, 'startJobSend'])->name('startJobSend');
            Route::post('startJobSendError', [MomoController::class, 'startJobSendError'])->name('startJobSendError');
            Route::post('startJobLoadBill', [MomoController::class, 'startJobLoadBill'])->name('startJobLoadBill');
        });
        Route::prefix('giftCode')->name('giftCode.')->group(function (){
            Route::post('create', [GiftCodeController::class, 'create'])->name('create');
            Route::post('update', [GiftCodeController::class, 'update'])->name('update');
            Route::post('delete', [GiftCodeController::class, 'delete'])->name('delete');
        });
        Route::prefix('transfer')->name('transfer.')->group(function (){
            Route::post('create', [TransferController::class, 'create'])->name('create');
            Route::post('reTransfer', [TransferController::class, 'reTransfer'])->name('reTransfer');
            Route::post('update', [TransferController::class, 'update'])->name('update');
        });
        Route::prefix('ratio')->name('ratio.')->group(function (){
            Route::post('chanleTaixiu', [RatioController::class, 'chanleTaixiu'])->name('chanleTaixiu');
            Route::post('chanleTaixiuV2', [RatioController::class, 'chanleTaixiuV2'])->name('chanleTaixiuV2');
            Route::post('tongbaso', [RatioController::class, 'tongbaso'])->name('tongbaso');
            Route::post('motphanba', [RatioController::class, 'motphanba'])->name('motphanba');
            Route::post('gapba', [RatioController::class, 'gapba'])->name('gapba');
            Route::post('lo', [RatioController::class, 'lo'])->name('lo');
            Route::post('hba', [RatioController::class, 'hba'])->name('hba');
            Route::post('xien', [RatioController::class, 'xien'])->name('xien');
            Route::post('vanmay', [RatioController::class, 'vanmay'])->name('vanmay');
            Route::post('doanso', [RatioController::class, 'doanso'])->name('doanso');
            Route::post('statusGameMode', [RatioController::class, 'statusGameMode'])->name('statusGameMode');
        });
        Route::prefix('rank')->name('rank.')->group(function (){
            Route::post('update', [App\Http\Controllers\Axios\RankController::class, 'update'])->name('update');
        });

    });
});
