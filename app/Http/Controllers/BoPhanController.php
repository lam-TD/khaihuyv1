<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\bo_phan;
use App\phong_ban;

class BoPhanController extends Controller
{

    public function get_all_bo_phan()
    {
        $ds_bo_phan = bo_phan::all();
        return json_encode($ds_bo_phan);
    }

    public function get_danh_sach_bo_phan($limit=10)
    {
        $ds_bo_phan = bo_phan::orderby('id','desc')->paginate($limit);
        return json_encode($ds_bo_phan);
    }

    public function add_bo_phan(Request $request)
    {
        if($this->check_ma_bo_phan($request->ma_bo_phan) == 1) return 0;
        else {
            try{
                $bo_phan = new bo_phan();
                //
                $bo_phan->ma_bo_phan = $request->ma_bo_phan;
                //
                $bo_phan->ten_bo_phan = $request->ten_bo_phan;
                $bo_phan->dien_giai = $request->dien_giai;
                $bo_phan->an_hien = 1;
                $bo_phan->created_at = Carbon::now()->toDateString('d-m-Y');
                $bo_phan->save();
                return 1;
            }catch (\Exception $e) {
                return $e;
            }
        }
    }
//    public function check_ma_bo_phan($string){
//        //kiem tra format
//
//        //kiem tra gia tri
//        $string = substr($string,2);
//        $num = (int)$string;
//        $id = bo_phan::orderBy('created_at', 'desc')->first()->id;
//        return ($num <= $id) ? 1 : 0 ;
//    }
    public function get_ma_bo_phan()
    {
        $bo_phan_first = bo_phan::orderBy('ma_bo_phan', 'desc')->first();
        $ma_bo_phan_first = $bo_phan_first->ma_bo_phan;
        $so = (int)substr($ma_bo_phan_first,2) + 1;
        $str = 'BP';
        if($so > 99999) return 0;
        if($so < 10){
            $str .= "0000" . $so;
        }
        else if ($so < 100){
            $str .= "000" . $so;
        }
        else if($so < 1000){
            $str .= "00" . $so;
        }
        else if($so < 10000){
            $str .= "0" . $so;
        }
        else{
            $str .= $so;
        }
        return $str;

//        for ($i = 1 ; $i < ( (int)substr($ma_bo_phan_first,2) + 1) ; $i++)
//        {
//            for($j=0 ;$j<(6-strlen((string)$i)); $j++ )
//            {
//                $str  = $str . '0';
//            }
//            $str = $str . (string)$i;
//            if(bo_phan::where($str,'ma_bo_phan').count == 0)
//            {
//                return $str;
//            }
//        }
    }

    public function edit_bo_phan(Request $request)
    {
        try {
            $bo_phan = bo_phan::find($request->id);
            $bo_phan->ten_bo_phan = $request->ten_bo_phan;
            $bo_phan->dien_giai = $request->dien_giai;
            $bo_phan->an_hien = 1;
            $bo_phan->updated_at = Carbon::now()->toDateString('d-m-Y');
            $bo_phan->save();
            return 1;
        } catch (\Exception $e) {
            return $e;
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
