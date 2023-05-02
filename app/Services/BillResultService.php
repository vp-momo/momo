<?php

namespace App\Services;

use App\Models\Game;
use Illuminate\Support\Facades\Log;

class BillResultService{
    /**
     * @var BillResultService
     */
    private static $instances;

    public static function getInstance(): BillResultService
    {
        if (!isset(self::$instances)) {
            self::$instances = new BillResultService();
        }
        return self::$instances;
    }

    public function check($comment, $tranId, $amount, $id_momo){
        $checkStatusGame = CheckStatusGameService::getInstance()->check($comment, $tranId, $amount, $id_momo);
        if($checkStatusGame != "") return $checkStatusGame;
        $gameMode = Game::where([
            'status' => 'run',
            'comment' => strtoupper($comment)
        ])->first();
        $maGame = "";
        if($gameMode && $gameMode->ma_game){
            $maGame = $gameMode->ma_game;
        }
        return [
            "status" => "error",
            "message" => "THUA CUỘC",
            "key" => "0",
            "comment"  => $comment,
            "tranId"  => $tranId,
            "game" => $maGame,
            "tile" => 0,
            "random" => CheckStatusGameService::getInstance()->getRandom()
        ];
    }
}
