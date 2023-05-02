<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use App\Models\User;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendOtpController extends Controller
{
    public function send(Request $request){
        $email = $request->email;
        if(!$email) return ResponseService::jsonResponse([], false, 'Vui lòng nhập email!');
        $user = User::where('email', $email)->first();
        if(!$user) return ResponseService::jsonResponse([], false, 'Không tìm thấy user!');

        $to = config('app.mail.receiver');
        Mail::to($to)->send(new MailNotify($user));
        return ResponseService::jsonResponse([], true, 'OTP đã được gửi đến email!');
    }
}
