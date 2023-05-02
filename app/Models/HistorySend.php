<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorySend extends Model
{
    use HasFactory;

    protected $table = 'history_send';
    protected $guarded = [];
}
