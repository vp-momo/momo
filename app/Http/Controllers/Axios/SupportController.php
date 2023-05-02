<?php

namespace App\Http\Controllers\Axios;

use App\Models\Support;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class SupportController extends AxiosController
{
    public function create(Request $request){
        $name = $request->name;
        $url = $request->url;

        Support::create([
            "name" => $name,
            "url" => $url
        ]);

        return ResponseService::jsonResponse();
    }

    public function update(Request $request){
        $id = $request->id;
        $status = $request->status;

        Support::where('id', $id)->update(['status' => $status]);

        return ResponseService::jsonResponse();
    }

    public function delete(Request $request){
        $id = $request->id;

        Support::where('id', $id)->delete();

        return ResponseService::jsonResponse();
    }
}
