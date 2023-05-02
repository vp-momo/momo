<?php

namespace App\Services;

class TimeService{

    public static function get_microtime(){
        return round(microtime(true) * 1000);
    }
}
