<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin(){
        if(!Auth::check()) return view('auth.login');
        return redirect()->route('admin.dashboard');
    }

    public function postLogin(LoginRequest $request){
        $email = $request->email;
        $login = [
            'email' => $email,
            'password' => $request->password,
            'status' => 1,
            'level' => 1,
//            'remember_token' => md5($request->otp)
        ];
        $user = User::where('email', $email)->first();
        if(!$user) return redirect()->back()->with('status', 'Email không tồn tại!');

//        if(!$user->remember_token || !$user->token_expired) return redirect()->back()->with('status', 'Bạn cần lấy OTP trước!');
//        if(time() > strtotime($user->token_expired)) return redirect()->back()->with('status', 'OTP hết hạn vui lòng gửi lại!');
//        if(md5($request->otp) != $user->remember_token) return redirect()->back()->with('status', 'Mã OTP chưa chính xác!');

        if (Auth::attempt($login)) {
            $user->update([
                "remember_token" => null,
                "token_expired" => null
            ]);
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }
}
