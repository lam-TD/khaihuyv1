<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\bo_phan;
use App\phong_ban;

class BoPhanController extends Controller
{
    public function get_danh_sach_bo_phan()
    {
        $ds_bo_phan = bo_phan::orderby('id','desc')->paginate(10);
        return json_encode($ds_bo_phan);
    }

    public function add_bo_phan(Request $request)
    {
        if($this->check_ma_bo_phan($request->ma_bo_phan) == 1) return 0;
        else {
            try{
                $bo_phan = new bo_phan();
                $bo_phan->ma_bo_phan = $request->ma_bo_phan;
                $bo_phan->ten_bo_phan = $request->ten_bo_phan;
                $bo_phan->dien_giai = $request->dien_giai;
                $bo_phan->an_hien = $request->an_hien;
                $bo_phan->created_at = Carbon::now()->toDateString('d-m-Y');
                $bo_phan->save();
                return 1;
            }catch (\Exception $e) {
                return $e;
            }
        }
    }

    public function edit_bo_phan(Request $request)
    {
        try {
            $bo_phan = bo_phan::find($request->id_bo_phan);
            $bo_phan->ten_bo_phan = $request->ten_bo_phan;
            $bo_phan->dien_giai = $request->dien_giai;
            $bo_phan->save();
            return 1;
        } catch (\Exception $e) {
            return -1;
        }
    }

    public function check_ma_bo_phan($ma_bo_phan)
    {
        $bo_phan = bo_phan::where('ma_bo_phan', $ma_bo_phan)->get();
        (count($bo_phan) == 0) ? $result = -1 : $result = 1;
        return $result;
    }

    public function delete_bo_phan($id_bo_phan)
    {
        if ($this->check_danh_sach_phong_ban_trong_bo_phan($id_bo_phan) == 1) return 0;
        else {
            $bo_phan = bo_phan::find($id_bo_phan);
            $bo_phan->delete();
            return 1;
        }
    }

    public function check_danh_sach_phong_ban_trong_bo_phan($id_bo_phan)
    {
        $pb = phong_ban::where('id_bo_phan', $id_bo_phan)->get();
        (count($pb) == 0) ? $result = -1: $result = 1;
        return $result;
    }
}
