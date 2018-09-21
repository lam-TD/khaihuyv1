<?php

namespace App\Http\Controllers;

use App\phuong_xa;
use App\quan_huyen;
use App\tinh_thanh;
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

    public function quan_huyen_theo_tinh($ma_tinh)
    {
//        $tinh = tinh_thanh::find($ma_tinh)->quan_huyen;
//        return $tinh;

//        $quan = phuong_xa::find($ma_tinh)->quan_huyen;
//        return $quan;
        $tinh_ = quan_huyen::find($ma_tinh)->tinh_thanh;
        return $tinh_;
    }
}
