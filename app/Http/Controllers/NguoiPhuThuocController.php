<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nguoi_phu_thuoc;

class NguoiPhuThuocController extends Controller
{
    public function get_danh_sach_npt_theo_nhan_vien($ma_nv)
    {
        $npt = nguoi_phu_thuoc::where('ma_nv',$ma_nv)->paginate(10);
        return $npt;
    }

    public function add_nhan_vien_npt(Request $request)
    {
        $npt = new nguoi_phu_thuoc();
        $npt->ma_nv = $request->ma_nv;
        $npt->ho_ten_npt = $request->ho_ten_npt;
        $npt->ngay_sinh_npt = $request->ngay_sinh_npt;
        $npt->so_cmnd_npt = $request->so_cmnd_npt;
        $npt->mst_npt = $request->mst_npt;
        $npt->ma_quoc_tich_npt = $request->ma_quoc_tich_npt;
        $npt->quoc_tich_npt = $request->quoc_tich_npt;
        $npt->ma_quan_he_nnt = $request->ma_quan_he_nnt;
        $npt->quan_he_nnt = $request->quan_he_nnt;
        $npt->tg_giam_tru_tu = $request->tg_giam_tru_tu;
        $npt->tg_giam_tru_den = $request->tg_giam_tru_den;
        $npt->ghi_chu = $request->ghi_chu;
        $npt->save();
        return 1;
    }

    public function edit_nhan_vien_npt(Request $request)
    {
        $npt = nguoi_phu_thuoc::find($request->id);
        $npt->ho_ten_npt = $request->ho_ten_npt;
        $npt->ngay_sinh_npt = $request->ngay_sinh_npt;
        $npt->so_cmnd_npt = $request->so_cmnd_npt;
        $npt->mst_npt = $request->mst_npt;
        $npt->ma_quoc_tich_npt = $request->ma_quoc_tich_npt;
        $npt->quoc_tich_npt = $request->quoc_tich_npt;
        $npt->ma_quan_he_nnt = $request->ma_quan_he_nnt;
        $npt->quan_he_nnt = $request->quan_he_nnt;
        $npt->tg_giam_tru_tu = $request->tg_giam_tru_tu;
        $npt->tg_giam_tru_den = $request->tg_giam_tru_den;
        $npt->ghi_chu = $request->ghi_chu;
        $npt->save();
        return 1;
    }

    public function delete_nhan_vien_npt($id_npt)
    {
        $npt = nguoi_phu_thuoc::find($id_npt);
        $npt->delete();
        return 1;
    }
}
