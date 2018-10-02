<?php

namespace App\Http\Controllers;

use App\tai_khoan_ke_toan;
use Illuminate\Http\Request;

class TaiKhoanKeToanConTroller extends Controller
{
    public function get_all_tk_ke_toan()
    {
        $tk = tai_khoan_ke_toan::orderby('id','desc')->get();
        return json_encode($tk);
    }

}
