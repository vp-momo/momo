<?php

namespace App\Http\Controllers\Axios;

use App\Models\Setting;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class SettingController extends AxiosController
{
    public function update(Request $request){
        $arrInputs = [
            "title" => $request->title,
            "description" => $request->description,
            "keywords" => $request->keywords,
            "text_run" => $request->text_run,
            "comment_back_money" => $request->comment_back_money,
            "logo" => $request->logo,
            "color" => $request->color,
            "note" => $request->note,
            "active" => $request->active,
            "hu" => $request->hu,
            "refund" => $request->refund,
            "comment_refund" => $request->comment_refund,
        ];
        $setting = Setting::first();
        if(!$setting){
            Setting::create($arrInputs);
        }else{
            Setting::where('id', $setting->id)->update($arrInputs);
            Setting::where('id', '!=', $setting->id)->delete();
        }
        return ResponseService::jsonResponse();
    }
}
