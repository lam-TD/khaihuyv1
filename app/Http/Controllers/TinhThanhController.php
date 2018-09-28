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

    public function get_tinh_thanh_paginate($limit = 10)
    {
        $t = tinh_thanh::orderby('ma_tinh','desc')->paginate($limit);
        return json_encode($t);
    }

    public function get_search_tinh_thanh($keyword, $limit = 10)
    {
        $t = tinh_thanh::where('ten_tinh','LIKE','%'.$keyword.'%')->paginate($limit);
        return $t;
    }

    public function add_tinh_thanh(Request $request){
        $t = new tinh_thanh();
        $t->ten_tinh = $request->ten_tinh;
        $t->save();
        return 1;
    }

    public function edit_tinh_thanh(Request $request){
        $t = tinh_thanh::find($request->ma_tinh);
        $t->ten_tinh = $request->ten_tinh;
        $t->save();
        return 1;
    }

    public function delete_tinh_thanh($ma_tinh){
        if($this->check_tinh_thanh($ma_tinh) == 1) return 0;
        $t = tinh_thanh::find($ma_tinh);
        $t->delete();
        return 1;
    }

    public function check_tinh_thanh($ma_tinh){
        $t = quan_huyen::where('ma_tinh',$ma_tinh)->get();
        (count($t) == 0) ? $result = -1: $result = 1;
        return $result;
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
