<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hop_dong_lao_dong;

class HopDongLaoDongController extends Controller
{
    public function get_all_hop_dong_lao_dong_pa()
    {
        $hd = hop_dong_lao_dong::orderby('id', 'desc')->paginate(10);
        return json_encode($hd);
    }

    public function add_hop_dong_lao_dong_(Request $request)
    {
        $hd = new hop_dong_lao_dong();
        $hd->nv_id = $request->nv_id;
        $hd->so_hdld = $request->so_hdld;
        $hd->thoi_han_hd = $request->thoi_han_hd;
        $hd->ngay_ky = $request->ngay_ky;
        $hd->ngay_kt = $request->ngay_kt;
        $hd->ghi_chu = $request->ghi_chu;
        $hd->save();
        return 1;
    }
}
