<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hop_dong_lao_dong;

class HopDongLaoDongController extends Controller
{
    public function get_all_hop_dong_lao_dong_pa()
    {
        $hd = hop_dong_lao_dong::join('nhan_vien','hop_dong_lao_dong.nv_ma','=','nhan_vien.ma_nv')
            ->select('hop_dong_lao_dong.nv_ma','hop_dong_lao_dong.id as hd_id','nhan_vien.ma_nv','nhan_vien.ho_ten', 'hop_dong_lao_dong.so_hdld','hop_dong_lao_dong.thoi_han_hd','hop_dong_lao_dong.ngay_ky','hop_dong_lao_dong.ngay_kt','hop_dong_lao_dong.ghi_chu')
            ->orderby('hop_dong_lao_dong.id', 'desc')->paginate(10);
        return ($hd);
    }

    public function search_hop_dong_lao_dong($keyword)
    {
        $hd = hop_dong_lao_dong::join('nhan_vien','hop_dong_lao_dong.nv_id','=','nhan_vien.id')
            ->select('hop_dong_lao_dong.nv_id','hop_dong_lao_dong.id as hd_id','nhan_vien.ma_nv','nhan_vien.ho_ten', 'hop_dong_lao_dong.so_hdld','hop_dong_lao_dong.thoi_han_hd','hop_dong_lao_dong.ngay_ky','hop_dong_lao_dong.ngay_kt','hop_dong_lao_dong.ghi_chu')
            ->where('hop_dong_lao_dong.so_hdld','like',"%.$keyword.%")
//            ->orwhere('nhan_vien.ho_ten','like',"%.$keyword.%")
//            ->orwhere('nhan_vien.ma_nv','like',"%.$keyword.%")
//            ->orwhere('hop_dong_lao_dong.so_hdld','like',"%.$keyword.%")
            ->orderby('hop_dong_lao_dong.id', 'desc')->paginate(10);
        return ($hd);
    }

    public function add_hop_dong_lao_dong(Request $request)
    {
        $hd = new hop_dong_lao_dong();
        $hd->nv_ma = $request->nv_id;
        $hd->so_hdld = $request->so_hdld;
        $hd->thoi_han_hd = $request->thoi_han_hd;
        $hd->ngay_ky = $request->ngay_ky;
        $hd->ngay_kt = $request->ngay_kt;
        $hd->ghi_chu = $request->ghi_chu;
        $hd->save();
        return 1;
    }

    public function edit_hop_dong_lao_dong(Request $request)
    {
        $hd = hop_dong_lao_dong::find($request->id);
        $hd->so_hdld = $request->so_hdld;
        $hd->thoi_han_hd = $request->thoi_han_hd;
        $hd->ngay_ky = $request->ngay_ky;
        $hd->ngay_kt = $request->ngay_kt;
        $hd->ghi_chu = $request->ghi_chu;
        $hd->save();
        return 1;
    }

    public function delete_hop_dong_lao_dong($id_hd)
    {
        $hd = hop_dong_lao_dong::find($id_hd);
        $hd->delete();
        return 1;
    }
}
