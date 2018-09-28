<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\quan_huyen;

class QuanHuyenController extends Controller
{
    //danh sach quan huyen
    public function get_list_quan_huyen()
    {
        $quanhuyen = quan_huyen::paginate(10);
        return $quanhuyen;
    }
    //them quan huyen
    public function add_quan_huyen(Request $request)
    {
        // kiem tra thông tin
        $this->validate($request,
            [
                'ma_tinh' => 'required',
                'ten_quan_huyen_url' => 'required',
                'ten_quan_huyen' => 'required',
                'trang_thai' => 'required',
                'sap_xep' => 'required'
            ],
            [
                'ma_tinh.required'=>'Hãy chọn Tỉnh/Thành phố',
                'ten_quạn_huyen_url.required'=>'Bạn chưa chọn quan huyen url',
                'ten_quan_huyen.required'=>'Bạn chưa nhập tên quan huyen',
                'trang_thai.required'=>'bạn chưa nhập trạng thái',
                'sap_xep.required'=>'Bạn chưa nhập sắp xếp'

            ]);
        //them du lieu
        try{
            $quanhuyen = new quan_huyen();
            $quanhuyen->ma_tinh = $request->ma_tinh;
            $quanhuyen->ten_quan_huyen_url = $request->ten_quan_huyen_url;
            $quanhuyen->ten_quan_huyen = $request->ten_quan_huyen;
            $quanhuyen->trang_thai = $request->trang_thai;
            $quanhuyen->sap_xep = $request->sap_xep;
            $quanhuyen->save();
            return 1;
        }
        catch (\Exception $e){
            return $e;
        }
    }
    //chinh sua phuong xa
    public function edit_quan_huyen(Request $request, $id){
        try{
            $quanhuyen = quan_huyen::find($id);
            $quanhuyen->ma_tinh = $request->ma_tinh;
            $quanhuyen->ten_quan_huyen_url = $request->ten_quan_huyen_url;
            $quanhuyen->ten_quan_huyen = $request->ten_quan_huyen;
            $quanhuyen->trang_thai = $request->trang_thai;
            $quanhuyen->sap_xep = $request->sap_xep;
            $quanhuyen->save();
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
            $quanhuyen = quan_huyen::find($id);
            $quanhuyen->delete();
            return 1;
        }
        catch (\Exception $e){
            return $e;
        }
    }
}
