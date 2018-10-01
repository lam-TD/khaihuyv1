<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bao_hiem_yte;

class BaoHiemYTeController extends Controller
{
    public function get_all_danh_sach_bhyt($limit)
    {
        $yt = bao_hiem_yte::join('nhan_vien','nhan_vien_bhyt.nv_ma','=','nhan_vien.ma_nv')
            ->select('nhan_vien_bhyt.nv_ma','nhan_vien_bhyt.phuong_xa_id','nhan_vien_bhyt.id as bhyt_id','nhan_vien.ma_nv','nhan_vien.ho_ten', 'nhan_vien_bhyt.so_bhyt', 'nhan_vien_bhyt.so_bhxh','nhan_vien_bhyt.noi_kham','nhan_vien_bhyt.dia_chi_kham','nhan_vien_bhyt.ghi_chu')
            ->orderby('nhan_vien_bhyt.id', 'desc')->paginate($limit);
        return $yt;
    }

    public function search_danh_sach_bhyt($keyword, $limit)
    {
        $yt = bao_hiem_yte::join('nhan_vien','nhan_vien_bhyt.nv_ma','=','nhan_vien.ma_nv')
            ->orwhere('nhan_vien.ho_ten','LIKE','%'. $keyword .'%')
            ->orwhere('nhan_vien.ma_nv','LIKE','%'. $keyword .'%')
            ->select('nhan_vien_bhyt.nv_ma','nhan_vien_bhyt.phuong_xa_id','nhan_vien_bhyt.id as bhyt_id','nhan_vien.ma_nv','nhan_vien.ho_ten', 'nhan_vien_bhyt.so_bhyt', 'nhan_vien_bhyt.so_bhxh','nhan_vien_bhyt.noi_kham','nhan_vien_bhyt.dia_chi_kham','nhan_vien_bhyt.ghi_chu')
            ->orderby('nhan_vien_bhyt.id', 'desc')->paginate($limit);
        return $yt;
    }

    public function add_bhyt(Request $request)
    {
        $yt = new bao_hiem_yte();
        $yt->nv_ma = $request->nv_ma;
        $yt->so_bhyt = $request->so_bhyt;
        $yt->so_bhxh = $request->so_bhxh;
        $yt->noi_kham = $request->noi_kham;
        $yt->dia_chi_kham = $request->dia_chi_kham;
        $yt->phuong_xa_id = $request->phuong_xa_id;
        $yt->ghi_chu = $request->ghi_chu;
        $yt->save();
        return 1;
    }

    public function edit_bhyt(Request $request)
    {
        $yt = bao_hiem_yte::find($request->id);
        $yt->so_bhyt = $request->so_bhyt;
        $yt->so_bhxh = $request->so_bhxh;
        $yt->noi_kham = $request->noi_kham;
        $yt->dia_chi_kham = $request->dia_chi_kham;
        $yt->phuong_xa_id = $request->phuong_xa_id;
        $yt->ghi_chu = $request->ghi_chu;
        $yt->save();
        return 1;
    }

    public function delete_bhyt($id_bhyt)
    {
        $yt = bao_hiem_yte::find($id_bhyt);
        $yt->delete();
        return 1;
    }

    public function get_bhyt_theo_nhan_vien_moi_nhat($ma_nv)
    {
        $yt = bao_hiem_yte::where('nv_ma',$ma_nv)->orderby('created_at','desc')->first();
        return $yt;
    }
}
