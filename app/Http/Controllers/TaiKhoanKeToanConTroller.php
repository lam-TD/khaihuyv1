<?php

namespace App\Http\Controllers;

use App\san_pham;
use App\tai_khoan_ke_toan;
use Illuminate\Http\Request;

class TaiKhoanKeToanConTroller extends Controller
{
    public function get_all_tk_ke_toan()
    {
        $tk = tai_khoan_ke_toan::orderby('id','desc')->get();
        return json_encode($tk);
    }

    public function get_tk_ke_toan_paginate($limit)
    {
        $tk = tai_khoan_ke_toan::orderby('id','desc')->paginate($limit);
        return json_encode($tk);
    }

    public function add_tk_ke_toan(Request $requests)
    {
        try{
            if($this->check_ma_tk_ke_toan($requests->ma_tk) == 1) return 0;
            $tk = new tai_khoan_ke_toan();
            $tk->ma_tk = $requests->ma_tk;
            $tk->ten_tk = $requests->ten_tk;
            $tk->ghi_chu = $requests->ghi_chu;
            $tk->save();
            return 1;
        }
        catch(\Exception $e){
            return $e;
        }
    }

    public function check_ma_tk_ke_toan($ma_tk)
    {
        $tk = tai_khoan_ke_toan::where('ma_tk',$ma_tk)->get();
        (count($tk) == 0) ? $result = -1 : $result = 1;
        return $result;
    }

    public function edit_tk_ke_toan(Request $requests)
    {
        try{
            $tk = tai_khoan_ke_toan::find($requests->id);
            $tk->ten_tk = $requests->ten_tk;
            $tk->ghi_chu = $requests->ghi_chu;
            $tk->save();
            return 1;
        }
        catch(\Exception $e){
            return $e;
        }
    }

    public function delete_tk_ke_toan($id)
    {
        try{
            $tk = tai_khoan_ke_toan::find($id);
            if($this->check_tk_san_pham($tk->ma_tk) == 1) return 0;
            $tk->delete();
            return 1;
        }
        catch(\Exception $e){
            return $e;
        }
    }

    public function check_tk_san_pham($id)
    {
        $sp = san_pham::where('tk_ke_toan_id',$id)->get();
        (count($sp) == 0) ? $result = -1 : $result = 1;
        return $result;
    }

}
