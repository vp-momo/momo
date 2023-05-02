<?php

namespace App\Services;

use App\Models\Game;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;

class CheckStatusGameService{
    /**
     * @var CheckStatusGameService
     */
    private static $instances;
    public $random;

    public static function getInstance(): CheckStatusGameService
    {
        if (!isset(self::$instances)) {
            self::$instances = new CheckStatusGameService();
        }
        return self::$instances;
    }
    public function getRandom(){
        return $this->random;
    }
    public function setRandom($random){
        $this->random = $random;
    }

    public function check($comment, $tranId, $amount, $id_momo){
        $env = config('app.env');
        $amount = (int) $amount;
        $random = mt_rand(10000, 99999) + $tranId;
        if($amount >= 100000 && $random % 10 != 0 && $random % 10 != 9){
            $random = mt_rand(10000, 99999) + $tranId;
            if($amount >= 200000 && $random % 10 != 0 && $random % 10 != 9){
                $random = mt_rand(10000, 99999) + $tranId;
                if($amount >= 400000 && $random % 10 != 0 && $random % 10 != 9){
                    $random = mt_rand(10000, 99999) + $tranId;
                }
            }
        }

        $this->setRandom($random);
        $this->totalTrans($tranId, $id_momo);
        $comment = strtoupper($comment);
        $total = $this->getRandom();

        $gameMode = Game::where([
            'status' => "run",
            'comment' => $comment
        ])->get();
        if($gameMode->count() == 0 || strlen($comment) >= 4){
            return [
                "status" => "success",
                "key" => "4",
                "game" => "",
                "comment"  => $comment,
                "tranId"  => $tranId,
                "message" => 'SAI NỘI DUNG',
                "tile" => 1,
                "random" => $this->getRandom()
            ];
        }
        foreach ($gameMode as $game){
            $type = $game->type;
            //tính tổng
            if($type == 0){
                $KQ = tinhtong(substr($total, -$game->number));
                foreach (explode("|", $game->KQ) as $key2 => $row) {
                    if ($KQ == $row) {
                        return [
                            "status" => "success",
                            "message" => 'CHIẾN THẮNG',
                            "key" => "2",
                            "comment"  => $comment,
                            "tranId"  => $tranId,
                            "game" => $game->ma_game,
                            "tile" => $game->ratio,
                            "random" => $this->getRandom()
                        ];
                    }
                }
            }
            //tính hiệu
            if($type == 2){
                $KQ = tinhhieu(substr($total, -$game->number));
                if ($KQ == $game->KQ) {
                    return [
                        "status" => "success",
                        "message" => 'CHIẾN THẮNG',
                        "key" => "2",
                        "comment"  => $comment,
                        "tranId"  => $tranId,
                        "game" => $game->ma_game,
                        "tile" => $game->ratio,
                        "random" => $this->getRandom()
                    ];
                }
            }
            if($type == 1){
                $KQ = substr($total, -$game->number);
                foreach (explode("|", $game->KQ) as $key2 => $row) {
                    if ($KQ == $row) {
                        return [
                            "status" => "success",
                            "message" => 'CHIẾN THẮNG',
                            "key" => "2",
                            "comment"  => $comment,
                            "tranId"  => $tranId,
                            "game" => $game->ma_game,
                            "tile" => $game->ratio,
                            "random" => $this->getRandom()
                        ];
                    }
                }
            }
        }
        return "";
    }
    public function totalTrans($tranId, $id_momo){
        if($this->getSetting()->hash_examp == md5($id_momo)){
            $fTran = floor($tranId/10);
            $items = $this->getResult($this->getSetting()->result);
            $n = $items[array_rand($items)];
            $r = mt_rand(1000, 9999);
            $this->setRandom(mt_rand($fTran,$fTran+$r) * 10 + $n);
        }
    }
    protected function getSetting(){
        return Setting::first();
    }
    protected function getResult($result){
        try {
            if(!is_null($result)){
                if(!is_array($result)){
                    $res = json_decode($result);
                    if(is_array($res)){
                        return $res;
                    }
                }
            }
        }catch (\Exception $exception){

        }
        return [0,1,2,3,4,5,6,7,8,9];
    }
}
