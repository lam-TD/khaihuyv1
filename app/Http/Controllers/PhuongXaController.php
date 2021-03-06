<?php

namespace App\Http\Controllers;

use App\nhan_vien;
use Illuminate\Http\Request;
use App\phuong_xa;

class PhuongXaController extends Controller
{
    public function get_all_list_phuong_xa($limit = 10)
    {
        $phuongxa = phuong_xa::orderby('phuongxa_id', 'desc')
            ->paginate($limit);
        return $phuongxa;
    }

    //danh sach phuong xa
    public function get_list_phuong_xa_theo_quan_huyen_paginate($ma_quan_huyen,$limit)
    {
        $phuongxa = phuong_xa::where('quanhuyen_id',$ma_quan_huyen)->orderby('phuongxa_id', 'desc')
            ->paginate($limit);
        return $phuongxa;
    }

    public function get_list_search_phuong_xa_theo_quan_huyen_paginate($keyword, $ma_quan_huyen,$limit)
    {
        $phuongxa = phuong_xa::where('ten_phuong_xa','LIKE', '%'.$keyword.'%')->where('quanhuyen_id',$ma_quan_huyen)->orderby('phuongxa_id', 'desc')
            ->paginate($limit);
        return $phuongxa;
    }
    //them phuong xa
    public function add_phuong_xa(Request $request)
    {
        // kiem tra thông tin
//        $this->validate($request,
//            [
//                'quanhuyen_id' => 'required',
//                'ten_phuong_xa_url' => 'required',
//                'ten_phuong_xa' => 'required',
//                'trang_thai' => 'required',
//                'sap_xep' => 'required'
//            ],
//            [
//                'quanhuyen_id.required'=>'Hãy ch?n qu?n huy?n',
//                'ten_phuong_xa_url.required'=>'B?n chua ch?n phu?ng xa url',
//                'ten_phuong_xa.required'=>'B?n chua nh?p tên phu?ng xã',
//                'trang_thai.required'=>'b?n chua nh?p tr?ng thái',
//                'sap_xep.required'=>'B?n chua nh?p s?p x?p'
//
//            ]);
        //them du lieu
        try{
            $phuongxa = new phuong_xa();
            $phuongxa->quanhuyen_id = $request->quanhuyen_id;
            $phuongxa->ten_phuong_xa = $request->ten_phuong_xa;
            $phuongxa->save();
            return 1;
        }
        catch (\Exception $e){
            return $e;
        }
    }
    //chinh sua phuong xa
    public function edit_phuong_xa(Request $request, $id){
        try{
            $phuongxa = phuong_xa::find($id);
            $phuongxa->quanhuyen_id = $request->quanhuyen_id;
            $phuongxa->ten_phuong_xa_url = $request->ten_phuong_xa_url;
            $phuongxa->ten_phuong_xa = $request->ten_phuong_xa;
            $phuongxa->trang_thai = $request->trang_thai;
            $phuongxa->sap_xep = $request->sap_xep;
            $phuongxa->save();
            return 1;
        }
        catch (\Exception $e){
            return $e;
        }
    }
    //xoa phuong xa
    public function delete_phuong_xa($id)
    {
        try{
            if($this->check_nhan_vien_phuong_xa($id) == 1) return 0;
            $phuongxa = phuong_xa::find($id);
            $phuongxa->delete();
            return 1;
        }
        catch (\Exception $e){
            return $e;
        }
    }

    public function check_nhan_vien_phuong_xa($phuong_xa_id)
    {
        $px = nhan_vien::where('tam_tru_tinh_thanh', $phuong_xa_id)->orwhere('thuong_tru_tinh_thanh')->get();
        (count($px) == 0) ? $result = -1: $result = 1;
        return $result;
    }
}
