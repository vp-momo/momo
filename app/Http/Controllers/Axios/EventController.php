<?php

namespace App\Http\Controllers\Axios;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function update(Request $request){
        $event_type = 'day';
        $list = $request->list;
        foreach ($list as $item){
            Events::updateOrCreate([
                'type' => $event_type,
                'position' => $item["position"]
            ], [
                'reward' => $item["reward"],
                'hook' => $item["hook"],
                'status' => $item["status"],
            ]);
        }
        return ResponseService::jsonResponse();
    }
}
