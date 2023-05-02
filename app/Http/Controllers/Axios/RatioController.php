<?php

namespace App\Http\Controllers\Axios;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameMode;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class RatioController extends AxiosController
{
    public function chanleTaixiu(Request $request){
        $maGame = "CLTX";
        $comment = $request->comment;
        $ratio = $request->ratio;
        $ratioValidate = $this->validateRatioArray($ratio);

        if(!$ratioValidate) return ResponseService::jsonResponse([], false, 'Vui lòng nhập tỉ lệ là số nguyên hoặc số thâp phân!', 404);

        $commentValidate = $this->validateCommentArray($comment);
        if(!$commentValidate) return ResponseService::jsonResponse([], false, 'Nội dung không được để trống!', 404);

        if(count($comment) != count($ratio)) return ResponseService::jsonResponse([], false, 'Số lượng nội dung và tỉ lệ không đồng nhất!', 404);

        Game::where("ma_game", $maGame)->where("h_key", "a")->update([
            "comment" => $comment["a"],
            "ratio" => $ratio["a"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "b")->update([
            "comment" => $comment["b"],
            "ratio" => $ratio["b"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "c")->update([
            "comment" => $comment["c"],
            "ratio" => $ratio["c"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "d")->update([
            "comment" => $comment["d"],
            "ratio" => $ratio["d"],
        ]);

        return ResponseService::jsonResponse();
    }

    public function chanleTaixiuV2(Request $request){
        $maGame = "CLTX2";
        $comment = $request->comment;
        $ratio = $request->ratio;
        $ratioValidate = $this->validateRatioArray($ratio);

        if(!$ratioValidate) return ResponseService::jsonResponse([], false, 'Vui lòng nhập tỉ lệ là số nguyên hoặc số thâp phân!', 404);

        $commentValidate = $this->validateCommentArray($comment);
        if(!$commentValidate) return ResponseService::jsonResponse([], false, 'Nội dung không được để trống!', 404);

        if(count($comment) != count($ratio)) return ResponseService::jsonResponse([], false, 'Số lượng nội dung và tỉ lệ không đồng nhất!', 404);

        Game::where("ma_game", $maGame)->where("h_key", "a")->update([
            "comment" => $comment["a"],
            "ratio" => $ratio["a"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "b")->update([
            "comment" => $comment["b"],
            "ratio" => $ratio["b"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "c")->update([
            "comment" => $comment["c"],
            "ratio" => $ratio["c"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "d")->update([
            "comment" => $comment["d"],
            "ratio" => $ratio["d"],
        ]);

        return ResponseService::jsonResponse();
    }

    public function tongbaso(Request $request){
        $maGame = "S";
        $comment = $request->comment;
        $ratio = $request->ratio;
        $ratioValidate = $this->validateRatioArray($ratio);

        if(!$ratioValidate) return ResponseService::jsonResponse([], false, 'Vui lòng nhập tỉ lệ là số nguyên hoặc số thâp phân!', 404);

        $commentValidate = $this->validateCommentArray($comment);
        if(!$commentValidate) return ResponseService::jsonResponse([], false, 'Nội dung không được để trống!', 404);

        if(count($comment) != count($ratio)) return ResponseService::jsonResponse([], false, 'Số lượng nội dung và tỉ lệ không đồng nhất!', 404);

        Game::where("ma_game", $maGame)->where("h_key", "a")->update([
            "comment" => $comment["a"],
            "ratio" => $ratio["a"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "b")->update([
            "comment" => $comment["b"],
            "ratio" => $ratio["b"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "c")->update([
            "comment" => $comment["c"],
            "ratio" => $ratio["c"],
        ]);

        return ResponseService::jsonResponse();
    }

    public function motphanba(Request $request){
        $maGame = "1P3";
        $comment = $request->comment;
        $ratio = $request->ratio;
        $ratioValidate = $this->validateRatioArray($ratio);

        if(!$ratioValidate) return ResponseService::jsonResponse([], false, 'Vui lòng nhập tỉ lệ là số nguyên hoặc số thâp phân!', 404);

        $commentValidate = $this->validateCommentArray($comment);
        if(!$commentValidate) return ResponseService::jsonResponse([], false, 'Nội dung không được để trống!', 404);

        if(count($comment) != count($ratio)) return ResponseService::jsonResponse([], false, 'Số lượng nội dung và tỉ lệ không đồng nhất!', 404);

        Game::where("ma_game", $maGame)->where("h_key", "a")->update([
            "comment" => $comment["a"],
            "ratio" => $ratio["a"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "b")->update([
            "comment" => $comment["b"],
            "ratio" => $ratio["b"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "c")->update([
            "comment" => $comment["c"],
            "ratio" => $ratio["c"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "d")->update([
            "comment" => $comment["d"],
            "ratio" => $ratio["d"],
        ]);

        return ResponseService::jsonResponse();
    }

    public function gapba(Request $request){
        $maGame = "G3";
        $comment = $request->comment;
        $ratio = $request->ratio;
        $ratioValidate = $this->validateRatioArray($ratio);

        if(!$ratioValidate) return ResponseService::jsonResponse([], false, 'Vui lòng nhập tỉ lệ là số nguyên hoặc số thâp phân!', 404);

        $commentValidate = $this->validateCommentArray($comment);
        if(!$commentValidate) return ResponseService::jsonResponse([], false, 'Nội dung không được để trống!', 404);

        if(count($comment) != count($ratio)) return ResponseService::jsonResponse([], false, 'Số lượng nội dung và tỉ lệ không đồng nhất!', 404);

        Game::where("ma_game", $maGame)->where("h_key", "a")->update([
            "comment" => $comment["a"],
            "ratio" => $ratio["a"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "b")->update([
            "comment" => $comment["b"],
            "ratio" => $ratio["b"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "c")->update([
            "comment" => $comment["c"],
            "ratio" => $ratio["c"],
        ]);

        return ResponseService::jsonResponse();
    }

    public function lo(Request $request){
        $maGame = "LO";
        $comment = $request->comment;
        $ratio = $request->ratio;
        $ratioValidate = $this->validateRatioArray($ratio);

        if(!$ratioValidate) return ResponseService::jsonResponse([], false, 'Vui lòng nhập tỉ lệ là số nguyên hoặc số thâp phân!', 404);

        $commentValidate = $this->validateCommentArray($comment);
        if(!$commentValidate) return ResponseService::jsonResponse([], false, 'Nội dung không được để trống!', 404);

        if(count($comment) != count($ratio)) return ResponseService::jsonResponse([], false, 'Số lượng nội dung và tỉ lệ không đồng nhất!', 404);

        Game::where("ma_game", $maGame)->where("h_key", "a")->update([
            "comment" => $comment["a"],
            "ratio" => $ratio["a"],
        ]);

        return ResponseService::jsonResponse();
    }

    public function hba(Request $request){
        $maGame = "H3";
        $comment = $request->comment;
        $ratio = $request->ratio;
        $ratioValidate = $this->validateRatioArray($ratio);

        if(!$ratioValidate) return ResponseService::jsonResponse([], false, 'Vui lòng nhập tỉ lệ là số nguyên hoặc số thâp phân!', 404);

        $commentValidate = $this->validateCommentArray($comment);
        if(!$commentValidate) return ResponseService::jsonResponse([], false, 'Nội dung không được để trống!', 404);

        if(count($comment) != count($ratio)) return ResponseService::jsonResponse([], false, 'Số lượng nội dung và tỉ lệ không đồng nhất!', 404);

        Game::where("ma_game", $maGame)->where("h_key", "a")->update([
            "comment" => $comment["a"],
            "ratio" => $ratio["a"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "b")->update([
            "comment" => $comment["b"],
            "ratio" => $ratio["b"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "c")->update([
            "comment" => $comment["c"],
            "ratio" => $ratio["c"],
        ]);

        return ResponseService::jsonResponse();
    }

    public function xien(Request $request){
        $maGame = "XIEN";
        $comment = $request->comment;
        $ratio = $request->ratio;
        $ratioValidate = $this->validateRatioArray($ratio);

        if(!$ratioValidate) return ResponseService::jsonResponse([], false, 'Vui lòng nhập tỉ lệ là số nguyên hoặc số thâp phân!', 404);

        $commentValidate = $this->validateCommentArray($comment);
        if(!$commentValidate) return ResponseService::jsonResponse([], false, 'Nội dung không được để trống!', 404);

        if(count($comment) != count($ratio)) return ResponseService::jsonResponse([], false, 'Số lượng nội dung và tỉ lệ không đồng nhất!', 404);

        Game::where("ma_game", $maGame)->where("h_key", "a")->update([
            "comment" => $comment["a"],
            "ratio" => $ratio["a"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "b")->update([
            "comment" => $comment["b"],
            "ratio" => $ratio["b"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "c")->update([
            "comment" => $comment["c"],
            "ratio" => $ratio["c"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "d")->update([
            "comment" => $comment["d"],
            "ratio" => $ratio["d"],
        ]);

        return ResponseService::jsonResponse();
    }

    public function vanmay(Request $request){
        $maGame = "VANMAY";
        $comment = $request->comment;
        $ratio = $request->ratio;
        $ratioValidate = $this->validateRatioArray($ratio);

        if(!$ratioValidate) return ResponseService::jsonResponse([], false, 'Vui lòng nhập tỉ lệ là số nguyên hoặc số thâp phân!', 404);

        $commentValidate = $this->validateCommentArray($comment);
        if(!$commentValidate) return ResponseService::jsonResponse([], false, 'Nội dung không được để trống!', 404);

        if(count($comment) != count($ratio)) return ResponseService::jsonResponse([], false, 'Số lượng nội dung và tỉ lệ không đồng nhất!', 404);

        Game::where("ma_game", $maGame)->where("h_key", "a")->update([
            "comment" => $comment["a"],
            "ratio" => $ratio["a"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "b")->update([
            "comment" => $comment["b"],
            "ratio" => $ratio["b"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "c")->update([
            "comment" => $comment["c"],
            "ratio" => $ratio["c"],
        ]);

        return ResponseService::jsonResponse();
    }

    public function doanso(Request $request){
        $maGame = "DX";
        $comment = $request->comment;
        $ratio = $request->ratio;
        $ratioValidate = $this->validateRatioArray($ratio);

        if(!$ratioValidate) return ResponseService::jsonResponse([], false, 'Vui lòng nhập tỉ lệ là số nguyên hoặc số thâp phân!', 404);

        $commentValidate = $this->validateCommentArray($comment);
        if(!$commentValidate) return ResponseService::jsonResponse([], false, 'Nội dung không được để trống!', 404);

        if(count($comment) != count($ratio)) return ResponseService::jsonResponse([], false, 'Số lượng nội dung và tỉ lệ không đồng nhất!', 404);

        Game::where("ma_game", $maGame)->where("h_key", "a")->update([
            "comment" => $comment["a"],
            "ratio" => $ratio["a"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "b")->update([
            "comment" => $comment["b"],
            "ratio" => $ratio["b"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "c")->update([
            "comment" => $comment["c"],
            "ratio" => $ratio["c"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "d")->update([
            "comment" => $comment["d"],
            "ratio" => $ratio["d"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "e")->update([
            "comment" => $comment["e"],
            "ratio" => $ratio["e"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "f")->update([
            "comment" => $comment["f"],
            "ratio" => $ratio["f"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "g")->update([
            "comment" => $comment["g"],
            "ratio" => $ratio["g"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "h")->update([
            "comment" => $comment["h"],
            "ratio" => $ratio["h"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "i")->update([
            "comment" => $comment["i"],
            "ratio" => $ratio["i"],
        ]);
        Game::where("ma_game", $maGame)->where("h_key", "k")->update([
            "comment" => $comment["k"],
            "ratio" => $ratio["k"],
        ]);

        return ResponseService::jsonResponse();
    }

    private function validateRatioArray($arr): bool
    {
        $error = true;
        foreach ($arr as $item){
            if(!preg_match('/^[1-9]\d*(\.\d+)?$/', $item)){
                $error = false;
            }
        }
        return $error;
    }

    private function validateCommentArray($arr): bool
    {
        $error = true;
        foreach ($arr as $item){
            if(trim($item) == ""){
                $error = false;
            }
        }
        return $error;
    }

    public function statusGameMode(Request $request){
        $mode = $request->mode;
        $status = $request->status;
        if($status == 1) {
            $status = 0;
        }else{
            $status = 1;
        }
        GameMode::where("mode", $mode)->update([
            "status" => $status
        ]);
        return ResponseService::jsonResponse();
    }
}
