<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nhom_nguoi_dung;
use App\nhom_phan_quyen;
use App\User;

class HeThongController extends Controller
{

//    ============== NHOM NGUOI DUNG =======================
    public function get_danh_sach_nhom_nguoi_dung ()
    {
        $ds_nhom = nhom_nguoi_dung::orderby('id','desc')->paginate(10);
        return json_encode($ds_nhom);
    }

    public function add_nhom (Request $request) {
        try{
            if($this->check_ma_nhom($request->ma_nhom) == 1) return 0;
            else{
                $n = new nhom_nguoi_dung();
                $n->ma_nhom = $request->ma_nhom;
                $n->ten_nhom = $request->ten_nhom;
                $n->save();
                return 1;
            }
        }
        catch(Exception $e){
            return -1;
        }
    }

    public function check_ma_nhom ($ma_nhom) {
        $n = nhom_nguoi_dung::where('ma_nhom', $ma_nhom)->get();
        if (count($n) == 1) {return 1;}
        else return -1;
    }

    public function edit_nhom(Request $request){
        try{
            $nhom = nhom_nguoi_dung::find($request->id_nhom);
            $nhom->ten_nhom = $request->ten_nhom;
            $nhom->save();
            return 1;
        }catch(\Exception $e) {
            return -1;
        }
    }

    public function delete_nhom($id_nhom) {
        $nhom = nhom_nguoi_dung::where('id',$id_nhom)->get();
        if(count($nhom) == 0) return -2;
        if($this->check_nhom_nguoi_dung_co_danh_sach($id_nhom) == -1){
            try{
                $nhom = nhom_nguoi_dung::find($id_nhom);
                $nhom->delete();
                return 1;
            }catch(\Exception $e){ return -1; }
        }
        else{
            return 0;
        }
    }

    public function check_nhom_nguoi_dung_co_danh_sach($id_nhom) {
        $ds_nguoi_dung_trong_nhom = User::where('id_nhom_nguoi_dung', $id_nhom)->get();
        if(count($ds_nguoi_dung_trong_nhom) == 0) return -1;
        else return 1;
    }

    public function get_danh_sach_nguoi_dung_theo_nhom ($id_nhom){
        $ds_nguoi_dung = User::select('id','username','active', 'id_nhom_nguoi_dung')
            ->where('id_nhom_nguoi_dung', $id_nhom)->orderby('id', 'desc')->paginate(10);
        return json_encode($ds_nguoi_dung);
    }
}
