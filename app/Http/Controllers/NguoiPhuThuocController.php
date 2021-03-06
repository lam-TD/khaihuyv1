<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\nguoi_phu_thuoc;

class NguoiPhuThuocController extends Controller
{
    public function get_all_danh_sach_npt($limit)
    {
        $npt = nguoi_phu_thuoc::join('nhan_vien','nhan_vien.ma_nv','=','nhan_vien_npt.ma_nv')
            ->select('nhan_vien.ma_nv','nhan_vien.ho_ten','nhan_vien_npt.ngay_sinh_npt','nhan_vien_npt.id','nhan_vien_npt.ho_ten_npt', 'nhan_vien_npt.so_cmnd_npt','nhan_vien_npt.mst_npt','nhan_vien_npt.ma_quoc_tich_npt','nhan_vien_npt.quoc_tich_npt','nhan_vien_npt.ma_quan_he_nnt','nhan_vien_npt.quan_he_nnt','nhan_vien_npt.tg_giam_tru_tu','nhan_vien_npt.tg_giam_tru_den','nhan_vien_npt.ghi_chu')
            ->paginate($limit);
        return $npt;
    }
    public function get_danh_sach_npt_theo_nhan_vien($ma_nv, $limit)
    {
        $npt = nguoi_phu_thuoc::join('nhan_vien','nhan_vien.ma_nv','=','nhan_vien_npt.ma_nv')
            ->where('nhan_vien.ma_nv',$ma_nv)
            ->select('nhan_vien.ma_nv','nhan_vien.ho_ten','nhan_vien_npt.ngay_sinh_npt','nhan_vien_npt.id', 'nhan_vien_npt.ho_ten_npt', 'nhan_vien_npt.so_cmnd_npt','nhan_vien_npt.mst_npt','nhan_vien_npt.ma_quoc_tich_npt','nhan_vien_npt.quoc_tich_npt','nhan_vien_npt.ma_quan_he_nnt','nhan_vien_npt.quan_he_nnt','nhan_vien_npt.tg_giam_tru_tu','nhan_vien_npt.tg_giam_tru_den','nhan_vien_npt.ghi_chu')
            ->paginate($limit);
        return $npt;
    }

    public function add_nhan_vien_npt(Request $request)
    {
//        $this->validate($request,
//        [
//            'tg_giam_tru_tu' => 'required'
//        ],
//        [
//            'tg_giam_tru_tu.required'=>'Hãy chọn Tỉnh/Thành phố'
//        ]);

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
//        $npt = nguoi_phu_thuoc::find($request->id);
//
//        $npt->ho_ten_npt = $request->ho_ten_npt;
//        $npt->ngay_sinh_npt = $request->ngay_sinh_npt;
//        $npt->so_cmnd_npt = $request->so_cmnd_npt;
//        $npt->mst_npt = $request->mst_npt;
//        $npt->ma_quoc_tich_npt = $request->ma_quoc_tich_npt;
//        $npt->quoc_tich_npt = $request->quoc_tich_npt;
//        $npt->ma_quan_he_nnt = $request->ma_quan_he_nnt;
//        $npt->quan_he_nnt = $request->quan_he_nnt;
//        $npt->tg_giam_tru_tu = $request->tg_giam_tru_tu;
//        $npt->tg_giam_tru_den = $request->tg_giam_tru_den;
//        $npt->ghi_chu = $request->ghi_chu;
//        $npt->save();

        $np = nguoi_phu_thuoc::where('id', $request->id)
            ->update([
                'ho_ten_npt' => $request->ho_ten_npt,
                'ngay_sinh_npt' => $request->ngay_sinh_npt,
                'so_cmnd_npt' => $request->so_cmnd_npt,
                'mst_npt' => $request->mst_npt,
                'ma_quoc_tich_npt' => $request->ma_quoc_tich_npt,
                'quoc_tich_npt' => $request->quoc_tich_npt,
                'ma_quan_he_nnt' => $request->ma_quan_he_nnt,
                'quan_he_nnt' => $request->quan_he_nnt,
                'tg_giam_tru_tu' => $request->tg_giam_tru_tu,
                'tg_giam_tru_den' => $request->tg_giam_tru_den,
                'ghi_chu' => $request->ghi_chu
            ]);
        return $np;
    }

    public function delete_nhan_vien_npt($id_npt)
    {
        $npt = nguoi_phu_thuoc::find($id_npt);
        $npt->delete();
        return 1;
    }

    public function get_npt_con_thoi_han_theo_nhan_vien($nv_ma)
    {
        $current_day = Carbon::now();
        $npt = nguoi_phu_thuoc::where('ma_nv', $nv_ma)
            ->where('tg_giam_tru_tu', '<=', $current_day)
            ->where('tg_giam_tru_den', '>=', $current_day)
            ->get();
        return $npt;
    }
}
