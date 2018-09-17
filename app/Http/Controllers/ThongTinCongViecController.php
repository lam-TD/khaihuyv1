<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nhan_vien_cong_viec;
use App\vi_tri;

class ThongTinCongViecController extends Controller
{
    public function get_all_thong_tin_cong_viec()
    {
        $cv = nhan_vien_cong_viec::join('nhan_vien','nhan_vien_cong_viec.nv_id','=','nhan_vien.id')
            ->select('nhan_vien_cong_viec.nv_id','nhan_vien_cong_viec.id as cv_id','nhan_vien.ma_nv','nhan_vien.ho_ten', 'nhan_vien_cong_viec.ngay', 'nhan_vien_cong_viec.tinh_trang','nhan_vien_cong_viec.bo_phan_ma','nhan_vien_cong_viec.phong_ma','nhan_vien_cong_viec.vi_tri_ma','nhan_vien_cong_viec.he_so_luong','nhan_vien_cong_viec.luong_co_ban','nhan_vien_cong_viec.htcv','nhan_vien_cong_viec.cham_cong','nhan_vien_cong_viec.thoi_gian_lv_bd','nhan_vien_cong_viec.thoi_gian_lv_kt','nhan_vien_cong_viec.ghi_chu')
            ->orderby('nhan_vien_cong_viec.id', 'desc')->paginate(10);
        return $cv;
    }

    public function add_thong_tin_cong_viec(Request $request)
    {
        try{
            $cv = new nhan_vien_cong_viec();
            $cv->nv_id = $request->nv_id;
            $cv->tinh_trang = $request->tinh_trang;
            $cv->he_so_luong = $request->he_so_luong;
            $cv->luong_co_ban = $request->luong_co_ban;
            $cv->htcv = $request->htcv;
            $cv->cham_cong = $request->cham_cong;
            $cv->thoi_gian_lv_bd = $request->thoi_gian_lv_bd;
            $cv->thoi_gian_lv_kt = $request->thoi_gian_lv_kt;
            $cv->bo_phan_ma = $request->bo_phan_ma;
            $cv->phong_ma = $request->phong_ma;
            $cv->vi_tri_ma = $request->vi_tri_ma;
            $cv->ghi_chu = $request->ghi_chu;
            $cv->save();
            return 1;
        }
        catch (\Exception $e){
            return $e;
        }

    }

    public function edit_thong_tin_cong_viec(Request $request)
    {
        $cv = nhan_vien_cong_viec::find($request->id);
        $cv->tinh_trang = $request->tinh_trang;
        $cv->he_so_luong = $request->he_so_luong;
        $cv->luong_co_ban = $request->luong_co_ban;
        $cv->htcv = $request->htcv;
        $cv->cham_cong = $request->cham_cong;
        $cv->thoi_gian_lv_bd = $request->thoi_gian_lv_bd;
        $cv->thoi_gian_lv_kt = $request->thoi_gian_lv_kt;
        $cv->bo_phan_ma = $request->bo_phan_ma;
        $cv->phong_ma = $request->phong_ma;
        $cv->vi_tri_ma = $request->vi_tri_ma;
        $cv->ghi_chu = $request->ghi_chu;
        $cv->save();
        return 1;
    }

    public function delete_thong_tin_cong_viec($id_thong_tin_cong_viec)
    {
        $cv = nhan_vien_cong_viec::find($id_thong_tin_cong_viec);
        $cv->delete();
        return 1;
    }

    public function get_vi_tri_all_theo_phong($id_phong)
    {
        $vt = vi_tri::where('id_phong_ban',$id_phong)->get();
        return $vt;
    }
}
