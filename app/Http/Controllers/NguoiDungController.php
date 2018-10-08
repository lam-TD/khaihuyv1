<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;
use bryct;

class NguoiDungController extends Controller
{
    public function get_danh_sach_nguoi_dung_paginate($limit)
    {
        $nd = User::join('nhan_vien','users.id_nhan_vien','=','nhan_vien.ma_nv')
            ->join('nhom_nguoi_dung','users.id_nhom_nguoi_dung','=','nhom_nguoi_dung.id')
            ->join('nhan_vien_cong_viec','nhan_vien.ma_nv','=','nhan_vien_cong_viec.nv_ma')
            ->join('vi_tri','nhan_vien_cong_viec.vi_tri_ma','=','vi_tri.ma_vi_tri')
            ->select('users.id as user_id', 'username', 'users.active', 'nhan_vien.ma_nv','nhan_vien.ho_ten', 'vi_tri.ma_vi_tri','vi_tri.ten_vi_tri')
            ->orderby('users.id','desc')->paginate($limit);
        return json_encode($nd);
    }

    public function get_danh_sach_nhan_vien_chua_co_tai_khoan()
    {
        $nd = User::rightjoin('nhan_vien','users.id_nhan_vien','=','nhan_vien.ma_nv')
            ->join('nhan_vien_cong_viec','nhan_vien.ma_nv','=','nhan_vien_cong_viec.nv_ma')
            ->join('vi_tri','nhan_vien_cong_viec.vi_tri_ma','=','vi_tri.ma_vi_tri')
            ->select('users.id_nhan_vien', 'nhan_vien.ma_nv','nhan_vien.ho_ten', 'vi_tri.ma_vi_tri','vi_tri.ten_vi_tri')
            ->get();
        $arr_nd = [];
        if(count($nd) > 0){
            foreach ($nd as $item){
                if($item->id_nhan_vien == null){
                    $arr_nd[] = $item;
                }
            }
        }
        return json_encode($arr_nd);
    }

    public function add_nguoi_dung(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:6|max:50|email',
            'password' => 'required|min:6|max:20',
            'id_nhan_vien' => 'required',
            'id_nhom_nguoi_dung' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()
            ]);
        }

        if($this->check_username($request->username) == 1){
            return response()->json([
                'status' => 'error',
                'message' => 'Tên đăng nhập đã được sử dụng trước đó'
            ]);
        }

//        return 1;
        $nd = new User();
        $nd->username = $request->username;
        $nd->email = $request->username;
        $nd->password = bcrypt($request->password);
        $nd->active = $request->active;
        $nd->id_nhan_vien = $request->id_nhan_vien;
        $nd->id_nhom_nguoi_dung = $request->id_nhom_nguoi_dung;
        $nd->save();
        return response()->json([
            'status' => 'OK',
            'message' => 'Success'
        ]);
    }

    public function check_username($username)
    {
        $nd = User::where('username',$username)->get();
        (count($nd) == 0) ? $result = -1 : $result = 1;
        return $result;
    }

    public function edit_nguoi_dung(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|max:20',
            'id_nhom_nguoi_dung' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()
            ]);
        }

//        return 1;
        $nd = User::find($request->id);
        $nd->password           = bcrypt($request->password);
        $nd->active             = $request->active;
        $nd->id_nhom_nguoi_dung = $request->id_nhom_nguoi_dung;
        $nd->save();
        return response()->json([
            'status' => 'OK',
            'message' => 'Success'
        ]);
    }

    public function delete_nguoi_dung($id)
    {
        $nd = User::find($id);
        $nd->delete();
        return response()->json([
            'status' => 'OK',
            'message' => 'Success'
        ]);
    }
}
