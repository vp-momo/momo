<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameMode extends Model
{
    use HasFactory;
    protected $table = 'game_mode';
    protected $guarded = [];

    public function game(){
        return $this->hasMany(Game::class, "ma_game", "mode");
    }
}
