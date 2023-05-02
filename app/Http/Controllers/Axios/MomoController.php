<?php

namespace App\Http\Controllers\Axios;

use App\Console\Commands\LoadBalanceCommand;
use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Momo;
use App\Models\Setting;
use App\Services\CryptService;
use App\Services\LoginMomoService;
use App\Services\MomoService;
use App\Services\OTPMomoService;
use App\Services\ResponseService;
use App\Services\VerifyOTPService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MomoController extends AxiosController
{
    public function create(Request $request){
        $otp = $request->otp;
        $phone = $request->phone;
        $pass = $request->pass;
//        Log::info("start MomoController create --PHONE-- $phone");
        if(!$phone) return ResponseService::jsonResponse([], false, 'Vui lòng nhập Số điện thoại!', 404);
        if(!preg_match('/(84|0[3|5|7|8|9])+([0-9]{8})\b/', $phone)) return ResponseService::jsonResponse([], false, 'Số điện thoại không đúng định dạng!', 404);

        if(!$pass) return ResponseService::jsonResponse([], false, 'Vui lòng nhập Mật khẩu!', 404);

        if(!$otp) return ResponseService::jsonResponse([], false, 'Vui lòng nhập OTP!', 404);
        $dataSendMomo = MomoService::getDataSendMomo($phone, $pass);

        if(!$dataSendMomo) {
            MomoService::deleteMomo($phone);
            return ResponseService::jsonResponse([], false, 'Có lỗi vui lòng thử lại!', 404);
        }

        $verifyOTPMomo = new VerifyOTPService($dataSendMomo);
        if(!$verifyOTPMomo->invalid()) {
            MomoService::deleteMomo($phone);
            return ResponseService::jsonResponse([], false, 'Thiếu dữ liệu momo!', 404);
        }
        $verifyOTPMomo->setOhash($otp);
        $resultVerifyOTP = $verifyOTPMomo->verifyOTP();

        if(!$resultVerifyOTP) {
            MomoService::deleteMomo($phone);
            return ResponseService::jsonResponse([], false, 'Loi!', 404);
        }
        Log::info("get response verifyOTP --PHONE-- $phone", $resultVerifyOTP);
        if($resultVerifyOTP["resultType"] == "SUCCESS"){
            $setupKey = $resultVerifyOTP["extra"]["setupKey"];
            $dataSendMomo["setupKeyDecrypt"] = $verifyOTPMomo->get_setupKey($setupKey);
            $dataSendMomo["setupKey"] = $setupKey;

            Momo::where('phone', $phone)->update([
                'info' => json_encode($dataSendMomo)
            ]);
//            Log::info("success MomoController create --PHONE--$phone");
            return ResponseService::jsonResponse();
        }
        MomoService::deleteMomo($phone);
        return ResponseService::jsonResponse([], false, 'Hết thời gian đăng nhập vui lòng tải lại trang!', 404);
    }
    public function update(Request $request){
        $id = $request->id;

        $type = $request->type ?? "status";

        if($type === "status"){
            $status = $request->status;
            if(!in_array($status, ["walt", "run"])) return ResponseService::jsonResponse([], false, 'Hết thời gian đăng nhập vui lòng tải lại trang!', 404);

            Momo::where("id", $id)->update(["trangthai" => $status]);
            return ResponseService::jsonResponse();
        }
        if($type === "hanmuc"){
            $max_day = (int) $request->max_day;
            $max_month = (int) $request->max_month;
            $min = (int) $request->min;
            $max = (int) $request->max;
            $gd = (int) $request->gd;

            Momo::where("id", $id)->update([
                "max_day" => $max_day,
                "max_month" => $max_month,
                "min" => $min,
                "max" => $max,
                "gd" => $gd
            ]);
            return ResponseService::jsonResponse();
        }

        return ResponseService::jsonResponse([], false, 'Không tìm thấy yêu cầu!', 404);
    }
    public function delete(Request $request){
        $id = $request->id;

        Momo::where("id", $id)->delete();
        return ResponseService::jsonResponse();
    }

    public function sendOTP(Request $request){
        $phone = $request->phone;
        $pass = $request->pass;
//        Log::info("start sendOTP $phone");
        if(!$phone) return ResponseService::jsonResponse([], false, 'Vui lòng nhập Số điện thoại!', 404);
        if(!preg_match('/(84|0[3|5|7|8|9])+([0-9]{8})\b/', $phone)) return ResponseService::jsonResponse([], false, 'Số điện thoại không đúng định dạng!', 404);

        $momoAccount = Momo::where('phone', $phone)->count();
        if($momoAccount > 0) return ResponseService::jsonResponse([], false, 'Số điện thoại đã tồn tại, nếu bị đăng xuất vui lòng nhấn "Đăng Nhập Lại"!', 404);

        if(!$pass) return ResponseService::jsonResponse([], false, 'Vui lòng nhập Mật khẩu!', 404);

        $dataSendMomo = MomoService::getDataSendMomo($phone, $pass);

        if(!$dataSendMomo) {
            MomoService::deleteMomo($phone);
            return ResponseService::jsonResponse([], false, 'Có lỗi vui lòng thử lại!', 404);
        }

//        Log::info("Get Result SendOTP ", $dataSendMomo);
        $checkUser = MomoService::CHECK_USER_BE_MSG($dataSendMomo);

        if(!$checkUser) {
            MomoService::deleteMomo($phone);
            return ResponseService::jsonResponse([], false, 'Số điện thoại chưa đăng ký momo!', 404);
        }
        $OTPMomo = new OTPMomoService($dataSendMomo);
        if(!$OTPMomo->invalid()) {
            MomoService::deleteMomo($phone);
            return ResponseService::jsonResponse([], false, 'Thiếu dữ liệu momo!', 404);
        }
        $resultSendOTPMomo = $OTPMomo->SEND_OTP_MSG([
            "sessionkey:",
            "userid:",
            "user_phone:",
            "authorization: Bearer",
            "msgtype: SEND_OTP_MSG",
            "Host: owa.momo.vn",
            "app_version: ".config('app.momo.version'),
            "app_code: ".config('app.momo.code'),
            "user-agent: Ktor client",
        ]);
//        Log::debug("Get Result SEND_OTP_MSG ", $resultSendOTPMomo);
        if(!$resultSendOTPMomo) {
            MomoService::deleteMomo($phone);
            return ResponseService::jsonResponse([], false, 'Loi!', 404);
        }
        if($resultSendOTPMomo["resultType"] == "USER_ERROR") {
            MomoService::deleteMomo($phone);
            return ResponseService::jsonResponse([], false, $resultSendOTPMomo["errorDesc"], 404);
        }

//        Log::info("success sendOTP $phone");

        if($resultSendOTPMomo["resultType"] == "SUCCESS") return ResponseService::jsonResponse();
        MomoService::deleteMomo($phone);
        return ResponseService::jsonResponse([], false, "Có lỗi! Vui lòng thử lại", 404);
    }

    public function login(Request $request){
        $phone = $request->phone;
        $phone = chuyendoiso($phone);

        $momo = Momo::where("phone", $phone)->first();

        if(!$momo) return ResponseService::jsonResponse([], false, "Không tìm thấy số momo", 404);

        $resultLogin = LoginMomoService::getInstance()->login($phone);
        if(!$resultLogin) return ResponseService::jsonResponse([], false, "Login thất bại. Vui lòng xoá và thêm lại!", 404);
        if($resultLogin["status"] == "error") return ResponseService::jsonResponse([], false, $resultLogin["message"], 404);
        return ResponseService::jsonResponse();
    }

    public function loadBalance(Request $request){
        try {
            $loadBalanceCommand = new LoadBalanceCommand();
            $loadBalanceCommand->handle();
            return ResponseService::jsonResponse();
        }catch (\Exception $exception){
            Log::error("error loadBalance");
            Log::error($exception);
            return ResponseService::jsonResponse([], false, "Có lỗi vui lòng thử lại!", 404);
        }
    }
    public function startJobSend(Request $request){
        $setting = Setting::first();
        if($setting){
            $sendMoney = $setting->sendMoney;
            if($sendMoney == 0){
                $setting->update(['sendMoney' => 1]);
            }else{
                $setting->update(['sendMoney' => 0]);
            }
            return ResponseService::jsonResponse();
        }
        return ResponseService::jsonResponse([], false, 'Vui lòng setting web trước');
    }
    public function startJobSendError(Request $request){
        $setting = Setting::first();
        if($setting){
            $sendMoney = $setting->sendError;
            if($sendMoney == 0){
                $setting->update(['sendError' => 1]);
            }else{
                $setting->update(['sendError' => 0]);
            }
            return ResponseService::jsonResponse();
        }
        return ResponseService::jsonResponse([], false, 'Vui lòng setting web trước');
    }
    public function startJobLoadBill(Request $request){
        $setting = Setting::first();
        if($setting){
            $loadBill = $setting->loadBill;
            if($loadBill == 0){
                $setting->update(['loadBill' => 1]);
            }else{
                $setting->update(['loadBill' => 0]);
            }
            return ResponseService::jsonResponse();
        }
        return ResponseService::jsonResponse([], false, 'Vui lòng setting web trước');
    }

}

