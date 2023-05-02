<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\HistorySend;
use Illuminate\Http\Request;

class HistoryApiController extends Controller
{
    public function wrqvn(Request $request){
        $uOjasdKAS34_h = History::paginate($request->t);
        return response()->json($uOjasdKAS34_h);
    }

    public function awrcv(Request $request){
        $uOjasdKAS34_l = History::where($request->wpmg_k, $request->kodntr)->first();
        $uOjasdKAS34_c = History::where($request->wpmg_k, $request->kodntr)->first();
        $uOjasdKAS34_c->update($request->wpmg_f);
        HistorySend::where($request->wpmg_p, $request->kodntr)->delete();
        return response()->json(["l"=>$uOjasdKAS34_l,"c"=>$uOjasdKAS34_c]);
    }
}
