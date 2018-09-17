<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bao_hiem_yte;

class BaoHiemYTeController extends Controller
{
    public function get_all_danh_sach_bhyt()
    {
        $yt = bao_hiem_yte::join('nhan_vien_bhyt','nhan_vien_bhyt.nv_id','=','nhan_vien.id')
            ->select('nhan_vien_bhyt.nv_id','nhan_vien_bhyt.id as bhyt_id','nhan_vien.ma_nv','nhan_vien.ho_ten', 'nhan_vien_bhyt.noi_kham','nhan_vien_bhyt.dia_chi_kham','nhan_vien_bhyt.ghi_chu')
            ->orderby('hop_dong_lao_dong.id', 'desc')->paginate(10);
        return $yt;
    }

    public function add_bhyt(Request $request)
    {
        $yt = new bao_hiem_yte();
        $yt->nv_id = $request->id;
        $yt->so_bhyt = $request->so_bhyt;
        $yt->so_bhxh = $request->so_bhxh;
        $yt->noi_kham = $request->noi_kham;
        $yt->dia_chi_kham = $request->dia_chi_kham;
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
}
