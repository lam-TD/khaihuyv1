<?php

namespace App\Http\Controllers;

use App\chuc_nang;
use App\nhom_chuc_nang;
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

    public function get_danh_sach_nhom_chuc_nang ()
    {
        $ncn = nhom_chuc_nang::orderby('id')->get();
        return json_encode($ncn);
    }

    public function get_chuc_nang_theo_nhom($id_nhom, $type)
    {
        if($type == "all"){
            $cn = chuc_nang::orderby('thu_tu','asc')
                ->get();
        }
        else{
            $cn = chuc_nang::join('nhom_phan_quyen','chuc_nang.id','=','nhom_phan_quyen.id_chuc_nang')
                ->join('nhom_nguoi_dung','nhom_phan_quyen.id_nhom_nguoi_dung','=','nhom_nguoi_dung.id')
                ->where('nhom_nguoi_dung.id',$id_nhom)
                ->select('chuc_nang.id', 'ten_chuc_nang', 'thu_tu','id_nhom_chuc_nang','allaction as all','xem','them','sua','xoa')
                ->orderby('id','asc')
                ->get();
        }
        return json_encode($cn);
    }

    public function get_chuc_nang_theo_nhom_nguoi_dung_va_nhom_chuc_nang($id_nhom_nd, $id_nhom_cn, $type)
    {
        if($type == "all"){
            $cn = chuc_nang::join('nhom_chuc_nang','chuc_nang.id_nhom_chuc_nang','=','nhom_chuc_nang.id')
                ->where('nhom_chuc_nang.id',$id_nhom_cn)
                ->select('chuc_nang.id', 'ten_chuc_nang', 'chuc_nang.thu_tu')
                ->orderby('chuc_nang.thu_tu','asc')->get();
        }
        else{
            $cn = chuc_nang::join('nhom_phan_quyen','chuc_nang.id','=','nhom_phan_quyen.id_chuc_nang')
                ->join('nhom_nguoi_dung','nhom_phan_quyen.id_nhom_nguoi_dung','=','nhom_nguoi_dung.id')
                ->join('nhom_chuc_nang','chuc_nang.id_nhom_chuc_nang','=','nhom_chuc_nang.id')
                ->where('nhom_chuc_nang.id',$id_nhom_cn)
                ->where('nhom_nguoi_dung.id',$id_nhom_nd)
                ->select('chuc_nang.id', 'ten_chuc_nang', 'chuc_nang.thu_tu','id_nhom_chuc_nang','allaction as all','xem','them','sua','xoa')
                ->get();
        }
        return json_encode($cn);
    }

    public function save_phan_quyen(Request $request)
    {
        if($request->arr_cn){
            foreach ($request->arr_cn as $item){
                if($item["all"] != 0 || $item["xem"] != 0 || $item["them"] != 0 || $item["sua"] != 0 || $item["xoa"] != 0){
                    $pq = nhom_phan_quyen::updateOrCreate(
                        ['id_nhom_nguoi_dung'    => $request->id_nhom_nguoi_dung, 'id_chuc_nang' => $item["id"]],
                        [
                            'id_nhom_nguoi_dung' => $request->id_nhom_nguoi_dung,
                            'id_chuc_nang'       => $item["id"],
                            'allaction'          => $item["all"],
                            'xem'                => $item["xem"],
                            'them'               => $item["them"],
                            'sua'                => $item["sua"],
                            'xoa'                => $item["xoa"]
                        ]
                    );
                }
                else{
                    nhom_phan_quyen::where('id_nhom_nguoi_dung', $request->id_nhom_nguoi_dung)
                        ->where('id_chuc_nang',$item["id"])->delete();
//                        ->update(
//                        [
//                            'allaction'          => $item["all"],
//                            'xem'                => $item["xem"],
//                            'them'               => $item["them"],
//                            'sua'                => $item["sua"],
//                            'xoa'                => $item["xoa"]
//                        ]);
                }
            }
        }
        return 1;
    }
}
