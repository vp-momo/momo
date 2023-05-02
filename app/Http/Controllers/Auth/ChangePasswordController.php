<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    protected $_data = [];

    public function changePassword(){
        $this->_data["titlePage"] = "Đổi mật khẩu";
        return view('auth.changePassword', $this->_data);
    }

    public function postChangePassword(ChangePasswordRequest $request){
        $auth = Auth::user();

        if($request->renew_password !== $request->new_password)
            return redirect()
                ->back()
                ->with('error', 'Nhập lại mật khẩu mới chưa khớp')
                ->withInput($request->all());

        if (!Hash::check($request->old_password, $auth->password))
            return back()->with('error', "Mật khẩu cũ chưa đúng");

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();

        return redirect()
            ->back()
            ->with('success', 'Đổi mật khẩu thành công!');
    }
}
