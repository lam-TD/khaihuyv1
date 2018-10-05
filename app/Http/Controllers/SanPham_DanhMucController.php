<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sanpham_danhmuc;
use App\san_pham;

class SanPham_DanhMucController extends Controller
{
    public function tim_kiem_san_pham_trong_danh_muc($keyword, $danh_muc_id, $limit)
    {
        $danh_sach_san_pham = san_pham::join('sanpham_danhmuc','san_pham.ma_sp','=','sanpham_danhmuc.ma_sp')
            ->join('danh_muc_san_pham','sanpham_danhmuc.danh_muc_san_pham_id','=','danh_muc_san_pham.danh_muc_id')
            ->where('danh_muc_san_pham.danh_muc_id',$danh_muc_id)
            ->where('san_pham.ten_sp','LIKE','%'.$keyword.'%')
            ->orderby('order_num','asc')
            ->paginate($limit);
        return $danh_sach_san_pham;
    }

    public function delete_san_pham_khoi_danh_muc($ma_sp, $danh_muc_id)
    {
        $sp = sanpham_danhmuc::where('ma_sp',$ma_sp)->where('danh_muc_san_pham_id',$danh_muc_id)->delete();
        return 1;
    }

    public function sap_xep_thu_tu_san_pham_trong_sanh_muc(Request $request)
    {
        // array bao gom san pham - danh muc - thu tu
        // currentpage * limit
        $dem = ($request->currentPage - 1) * $request->limit;
        foreach ($request->list_san_pham as $sp){
            $item_sp = sanpham_danhmuc::where('danh_muc_san_pham_id',$sp['danh_muc_san_pham_id'])
                ->where('ma_sp',$sp['ma_sp'])
                ->update(['order_num' => $dem++]);
        }
        return 1;
    }
}
