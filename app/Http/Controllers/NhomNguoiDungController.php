<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nhom_nguoi_dung;
use App\User;

class NhomNguoiDungController extends Controller
{
    public function get_danh_sach_nhom_nguoi_dung_no_paginate ()
    {
        $ds_nhom = nhom_nguoi_dung::orderby('id','desc')->get();
        return json_encode($ds_nhom);
    }

    public function get_danh_sach_nhom_nguoi_dung ($limit)
    {
        $ds_nhom = nhom_nguoi_dung::orderby('id','desc')->paginate($limit);
        return json_encode($ds_nhom);
    }

    public function get_danh_sach_tai_khoan_theo_nhom ($id_nhom, $limit)
    {
        $nd = User::join('nhan_vien','users.id_nhan_vien','=','nhan_vien.ma_nv')
            ->join('nhan_vien_cong_viec','nhan_vien.ma_nv','=','nhan_vien_cong_viec.nv_ma')
            ->join('vi_tri','nhan_vien_cong_viec.vi_tri_ma','=','vi_tri.ma_vi_tri')
            ->select('users.id as user_id', 'username', 'users.active', 'nhan_vien.ma_nv','nhan_vien.ho_ten', 'vi_tri.ma_vi_tri','vi_tri.ten_vi_tri')
            ->where('id_nhom_nguoi_dung',$id_nhom)->paginate($limit);
        return json_encode($nd);
    }

    public function get_danh_sach_tai_khoan_chua_co_nhom ()
    {
        $nd = User::join('nhan_vien','users.id_nhan_vien','=','nhan_vien.ma_nv')
            ->join('nhan_vien_cong_viec','nhan_vien.ma_nv','=','nhan_vien_cong_viec.nv_ma')
            ->join('vi_tri','nhan_vien_cong_viec.vi_tri_ma','=','vi_tri.ma_vi_tri')
            ->select('users.id as user_id', 'username', 'users.active', 'nhan_vien.ma_nv','nhan_vien.ho_ten', 'vi_tri.ma_vi_tri','vi_tri.ten_vi_tri')
            ->where('id_nhom_nguoi_dung','null')->get();
        return json_encode($nd);
    }

    public function add_nhom (Request $request) {
        try{
            if($this->check_ma_nhom($request->ma_nhom) == 1) return 0;
            else{
                $n = new nhom_nguoi_dung();
                $n->ma_nhom  = $request->ma_nhom;
                $n->ten_nhom = $request->ten_nhom;
                $n->ghi_chu  = $request->ghi_chu;
                if($n->save()){
                    $id_new = nhom_nguoi_dung::max('id');
                    if(count($request->arr_tk) > 0){
                        foreach ($request->arr_tk as $tk){
                            $u = User::find($tk['user_id']);
                            $u->id_nhom_nguoi_dung = $id_new;
                            $u->save();
                        }
                    }
                    return 1;
                }
                return -1;
            }
        }
        catch(Exception $e){
            return -1;
        }
    }

    public function add_tai_khoan_vao_nhom(Request $request)
    {
        if(count($request->arr_tk) > 0){
            foreach ($request->arr_tk as $tk){
                $u = User::find($tk['user_id']);
                $u->id_nhom_nguoi_dung = $request->id;
                $u->save();
            }
        }
        return 1;
    }

    public function edit_nhom(Request $request)
    {
        $n = nhom_nguoi_dung::find($request->id);
        $n->ten_nhom = $request->ten_nhom;
        $n->ghi_chu  = $request->ghi_chu;
        $n->save();
        if(count($request->arr_tk) > 0){
            foreach ($request->arr_tk as $tk){
                $u = User::find($tk['user_id']);
                $u->id_nhom_nguoi_dung = $request->id;
                $u->save();
            }
        }
        return 1;
    }

    public function check_ma_nhom ($ma_nhom) {
        $n = nhom_nguoi_dung::where('ma_nhom', $ma_nhom)->get();
        if (count($n) == 1) {return 1;}
        else return -1;
    }

    public function delete_nhom($id_nhom) {
        $tk = User::where('id_nhom_nguoi_dung',$id_nhom)->get();
        if(count($tk) == 0) return 0;

        try{
            $nhom = nhom_nguoi_dung::find($id_nhom);
            $nhom->delete();
            return 1;
        }catch(\Exception $e){ return -1; }
    }

    public function check_nhom_nguoi_dung_co_danh_sach($id_nhom) {
        $ds_nguoi_dung_trong_nhom = User::where('id_nhom_nguoi_dung', $id_nhom)->get();
        if(count($ds_nguoi_dung_trong_nhom) == 0) return -1;
        else return 1;
    }

    public function get_danh_sach_nguoi_dung_theo_nhom ($id_nhom){
        $ds_nguoi_dung = User::select('id','username','active', 'id_nhom_nguoi_dung')
            ->where('id_nhom_nguoi_dung', $id_nhom)->orderby('id', 'desc')->paginate(10);
        return json_encode($ds_nguoi_dung);
    }
}
