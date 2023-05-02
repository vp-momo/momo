<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rank;
use Illuminate\Http\Request;

class RankController extends Controller
{
    protected $_data = [];

    public function one(){
        $this->_data["titlePage"] = "Tốp 1";
        $this->_data['item'] = Rank::find(1);
        return view('admin.rank.one', $this->_data);
    }
    public function two(){
        $this->_data["titlePage"] = "Tốp 2";
        $this->_data['item'] = Rank::find(2);
        return view('admin.rank.two', $this->_data);
    }
    public function three(){
        $this->_data["titlePage"] = "Tốp 3";
        $this->_data['item'] = Rank::find(3);
        return view('admin.rank.three', $this->_data);
    }
    public function four(){
        $this->_data["titlePage"] = "Tốp 4";
        $this->_data['item'] = Rank::find(4);
        return view('admin.rank.four', $this->_data);
    }
    public function five(){
        $this->_data["titlePage"] = "Tốp 5";
        $this->_data['item'] = Rank::find(5);
        return view('admin.rank.five', $this->_data);
    }
}
