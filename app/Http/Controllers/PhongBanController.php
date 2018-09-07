<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phong_ban;
use App\nhan_vien;

class PhongBanController extends Controller
{
    public function get_phong_ban($id_bo_phan)
    {
//        $pb = phong_ban::join('bo_phan',)
//        return json_encode($pb);
    }

    public function get_phong_ban_theo_id_bo_phan($id_bo_phan)
    {
        $pb = phong_ban::where('id_bo_phan', $id_bo_phan)->orderby('id', 'desc')->paginate(10);
        return json_encode($pb);
    }

    public function add_phong_ban(Request $request)
    {
        if($this->check_ma_phong($request->ma_phong) == 1) return 0;
        else {
            $pb = new phong_ban();
            $pb->ma_phong  = $request->ma_phong;
            $pb->ten_phong = $request->ten_phong;
            $pb->dien_giai = $request->dien_giai;
            $pb->id_bo_phan = $request->id_bo_phan;
            $pb->save();
            return 1;
        }
    }

    public function check_ma_phong($ma_phong)
    {
        $pb = phong_ban::where('ma_phong', $ma_phong)->get();
        (count($pb) == 0) ? $result = -1 : $result = 1;
        return $result;
    }

    public function edit_phong_ban(Request $request)
    {
        $pb = phong_ban::find($request->id);
        $pb->ten_phong = $request->ten_phong;
        $pb->dien_giai = $request->dien_giai;
        $pb->save();
        return 1;
    }

    public function delete_phong_ban($id_phong)
    {
        if($this->check_nhan_vien_phong_ban($id_phong) == 1) return 0;
        else {
            $pb = phong_ban::find($id_phong);
            $pb->delete();
            return 1;
        }
    }

    public function check_nhan_vien_phong_ban($id_phong)
    {
        $nv = nhan_vien::where('id_phong', $id_phong)->get();
        (count($nv) == 0) ? $result = -1 : $result = 1;
        return $result;
    }
}
