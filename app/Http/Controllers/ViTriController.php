<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vi_tri;
use App\nhan_vien;

class ViTriController extends Controller
{
    public function get_all_vi_tri()
    {
        $vt = vi_tri::orderby('id', 'desc')->paginate(10);
        return json_encode($vt);
    }

    public function get_vi_tri_theo_phong($id_phong_ban)
    {
        $vt = vi_tri::where('id_phong_ban', $id_phong_ban)->paginate(10);
        return json_encode($vt);
    }

    public function add_vi_tri(Request $request)
    {
        if($this->check_ma_vi_tri($request->ma_vi_tri) == 1) return 0;
        $vt = new vi_tri();
        $vt->ma_vi_tri = $request->ma_vi_tri;
        $vt->ten_vi_tri = $request->ten_vi_tri;
        $vt->dien_giai = $request->dien_giai;
        $vt->id_phong_ban = $request->id_phong_ban;
        $vt->an_hien = 1;
        $vt->save();
        return 1;
    }

    public function check_ma_vi_tri($ma_vi_tri)
    {
        $vt = vi_tri::where('ma_vi_tri', $ma_vi_tri)->get();
        (count($vt) == 0) ? $result = -1 : $result = 1;
        return $result;
    }

    public function edit_vi_tri(Request $request)
    {
        $vt = vi_tri::find($request->id);
        $vt->ten_vi_tri = $request->ten_vi_tri;
        $vt->dien_giai = $request->dien_giai;
        $vt->an_hien = 1;
        $vt->save();
        return 1;
    }

    public function delete_vi_tri($id_vi_tri)
    {
        if($this->check_nhan_vien_thuoc_vi_tri($id_vi_tri) == 1) return 0;
        $vt = vi_tri::find($id_vi_tri);
        $vt->delete();
        return 1;
    }

    public function check_nhan_vien_thuoc_vi_tri($id_vi_tri)
    {
        $nv = nhan_vien::where('id_vi_tri', $id_vi_tri)->get();
        (count($nv) == 0) ? $result = -1 : $result = 1;
        return $result;
    }
}
