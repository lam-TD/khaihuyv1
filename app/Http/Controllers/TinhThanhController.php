<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TinhThanhController extends Controller
{
    public function get_tinh_thanh()
    {
        $t = DB::table('tinh_thanh')->get();
        return json_encode($t);
    }

    public function get_quan_huyen()
    {
        $t = DB::table('quan_huyen')->get();
        return $t;
    }

    public function get_phuong_xa()
    {
        $t = DB::table('phuong_xa')->get();
        return $t;
    }

    public function get_duong()
    {
        $t = DB::table('duong')->get();
        return $t;
    }
}
