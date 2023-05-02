<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = 'game';

    protected $guarded = [];
    protected $appends = ["array_ket_qua"];

    public function getArrayKetQuaAttribute(){
        return explode("|", $this->KQ);
    }
}
