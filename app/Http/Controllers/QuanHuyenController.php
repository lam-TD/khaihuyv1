<?php

namespace App\Http\Controllers;

use App\phuong_xa;
use Illuminate\Http\Request;
use App\quan_huyen;

class QuanHuyenController extends Controller
{
    public function get_all_quan_huyen($limit = 10)
    {
        $quanhuyen = quan_huyen::orderby('ma_quan_huyen','desc')->paginate($limit);
        return $quanhuyen;
    }

    //danh sach quan huyen
    public function get_list_quan_huyen($ma_tinh, $limit = 10)
    {
        $quanhuyen = quan_huyen::where('ma_tinh',$ma_tinh)->orderby('ma_quan_huyen','desc')->paginate($limit);
        return $quanhuyen;
    }

    public function get_list_search_quan_huyen($keyword, $ma_tinh, $limit = 10)
    {
        $quanhuyen = quan_huyen::where('ten_quan_huyen','LIKE', '%'.$keyword.'%')->where('ma_tinh',$ma_tinh)->orderby('ma_quan_huyen','desc')->paginate($limit);
        return $quanhuyen;
    }
    //them quan huyen
    public function add_quan_huyen(Request $request)
    {
        // kiem tra thông tin
//        $this->validate($request,
//            [
//                'ma_tinh' => 'required',
//                'ten_quan_huyen_url' => 'required',
//                'ten_quan_huyen' => 'required',
//                'trang_thai' => 'required',
//                'sap_xep' => 'required'
//            ],
//            [
//                'ma_tinh.required'=>'Hãy chọn Tỉnh/Thành phố',
//                'ten_quạn_huyen_url.required'=>'Bạn chưa chọn quan huyen url',
//                'ten_quan_huyen.required'=>'Bạn chưa nhập tên quan huyen',
//                'trang_thai.required'=>'bạn chưa nhập trạng thái',
//                'sap_xep.required'=>'Bạn chưa nhập sắp xếp'
//
//            ]);
        //them du lieu
        try{
            $quanhuyen = new quan_huyen();
            $quanhuyen->ma_tinh = $request->ma_tinh;
            $quanhuyen->ten_quan_huyen = $request->ten_quan_huyen;
            $quanhuyen->save();
            return 1;
        }
        catch (\Exception $e){
            return $e;
        }
    }
    //chinh sua phuong xa
    public function edit_quan_huyen(Request $request){
//        return $request;
        try{
            $quanhuyen = quan_huyen::where('ma_quan_huyen',$request->ma_quan_huyen)
            ->update(['ten_quan_huyen' => $request->ten_quan_huyen]);
            return 1;
        }
        catch (\Exception $e){
            return $e;
        }
    }
    //xoa phuong xa
    public function delete_quan_huyen($id)
    {
        try{
            if($this->check_phuong_xa_quan_huyen($id) == 1) return 0;
            $quanhuyen = quan_huyen::find($id);
            $quanhuyen->delete();
            return 1;
        }
        catch (\Exception $e){
            return $e;
        }
    }

    public function check_phuong_xa_quan_huyen($ma_quan_huyen){
        $px = phuong_xa::where('quanhuyen_id',$ma_quan_huyen)->get();
        (count($px) == 0) ? $result = -1: $result = 1;
        return $result;
    }
}
