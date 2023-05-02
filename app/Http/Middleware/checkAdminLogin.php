<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class checkAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // nếu user đã đăng nhập
        if (Auth::check()){
            $user = Auth::user();
            // nếu level = 1 (admin), status = 1 thì cho qua.
            if ($user->level == 1 && $user->status == 1 )
            {
                $setting = Setting::first();
                View::share('setting', $setting);
                return $next($request);
            }
            else
            {
                Auth::logout();
                return redirect()->route('login');
            }
        }
        return redirect()->route('login');
    }
}
