<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sanpham_danhmuc;
use App\san_pham;

class SanPham_DanhMucController extends Controller
{
    public function get_danh_sach_san_pham_theo_danh_muc($danh_muc_id, $limit, $type_sort = 'manual')
    {
        $danh_sach_san_pham = [];
        switch ($type_sort) {
            case 'manual':
                $danh_sach_san_pham = san_pham::join('sanpham_danhmuc','san_pham.ma_sp','=','sanpham_danhmuc.ma_sp')
                    ->join('danh_muc_san_pham','sanpham_danhmuc.danh_muc_san_pham_id','=','danh_muc_san_pham.danh_muc_id')
                    ->where('danh_muc_san_pham.danh_muc_id',$danh_muc_id)
                    ->select('san_pham.id','san_pham.ten_sp','san_pham.ma_sp','san_pham.image','san_pham.created_at','sanpham_danhmuc.order_num','sanpham_danhmuc.danh_muc_san_pham_id','san_pham.full_vat_dealer','san_pham.full_vat_end_user')
                    ->orderby('order_num','asc')
                    ->paginate($limit);
                break;
            case 'a-z':
                $danh_sach_san_pham = san_pham::join('sanpham_danhmuc','san_pham.ma_sp','=','sanpham_danhmuc.ma_sp')
                    ->join('danh_muc_san_pham','sanpham_danhmuc.danh_muc_san_pham_id','=','danh_muc_san_pham.danh_muc_id')
                    ->where('danh_muc_san_pham.danh_muc_id',$danh_muc_id)
                    ->select('san_pham.id','san_pham.ten_sp','san_pham.ma_sp','san_pham.image','san_pham.created_at','sanpham_danhmuc.order_num','sanpham_danhmuc.danh_muc_san_pham_id','san_pham.full_vat_dealer','san_pham.full_vat_end_user')
                    ->orderby('san_pham.ten_sp','asc')
                    ->paginate($limit);
                break;
            case 'z-a':
                $danh_sach_san_pham = san_pham::join('sanpham_danhmuc','san_pham.ma_sp','=','sanpham_danhmuc.ma_sp')
                    ->join('danh_muc_san_pham','sanpham_danhmuc.danh_muc_san_pham_id','=','danh_muc_san_pham.danh_muc_id')
                    ->where('danh_muc_san_pham.danh_muc_id',$danh_muc_id)
                    ->select('san_pham.id','san_pham.ten_sp','san_pham.ma_sp','san_pham.image','san_pham.created_at','sanpham_danhmuc.order_num','sanpham_danhmuc.danh_muc_san_pham_id','san_pham.full_vat_dealer','san_pham.full_vat_end_user')
                    ->orderby('san_pham.ten_sp','desc')
                    ->paginate($limit);
                break;
            case 'created_desc':
                $danh_sach_san_pham = san_pham::join('sanpham_danhmuc','san_pham.ma_sp','=','sanpham_danhmuc.ma_sp')
                    ->join('danh_muc_san_pham','sanpham_danhmuc.danh_muc_san_pham_id','=','danh_muc_san_pham.danh_muc_id')
                    ->where('danh_muc_san_pham.danh_muc_id',$danh_muc_id)
                    ->select('san_pham.id','san_pham.ten_sp','san_pham.ma_sp','san_pham.image','san_pham.created_at','sanpham_danhmuc.order_num','sanpham_danhmuc.danh_muc_san_pham_id','san_pham.full_vat_dealer','san_pham.full_vat_end_user')
                    ->orderby('created_at','desc')
                    ->paginate($limit);
                break;
            case 'created_asc':
                $danh_sach_san_pham = san_pham::join('sanpham_danhmuc','san_pham.ma_sp','=','sanpham_danhmuc.ma_sp')
                    ->join('danh_muc_san_pham','sanpham_danhmuc.danh_muc_san_pham_id','=','danh_muc_san_pham.danh_muc_id')
                    ->where('danh_muc_san_pham.danh_muc_id',$danh_muc_id)
                    ->select('san_pham.id','san_pham.ten_sp','san_pham.ma_sp','san_pham.image','san_pham.created_at','sanpham_danhmuc.order_num','sanpham_danhmuc.danh_muc_san_pham_id')
                    ->orderby('created_at','asc')
                    ->paginate($limit);
                break;
            default:
                $danh_sach_san_pham = san_pham::join('sanpham_danhmuc','san_pham.ma_sp','=','sanpham_danhmuc.ma_sp')
                    ->join('danh_muc_san_pham','sanpham_danhmuc.danh_muc_san_pham_id','=','danh_muc_san_pham.danh_muc_id')
                    ->where('danh_muc_san_pham.danh_muc_id',$danh_muc_id)
                    ->select('san_pham.id','san_pham.ten_sp','san_pham.ma_sp','san_pham.image','san_pham.created_at','sanpham_danhmuc.order_num','sanpham_danhmuc.danh_muc_san_pham_id')
                    ->orderby('order_num','asc')
                    ->paginate($limit);
        }
        return $danh_sach_san_pham;
    }

    public function tim_kiem_san_pham_trong_danh_muc($keyword, $danh_muc_id, $limit)
    {
        $danh_sach_san_pham = san_pham::join('sanpham_danhmuc','san_pham.ma_sp','=','sanpham_danhmuc.ma_sp')
            ->join('danh_muc_san_pham','sanpham_danhmuc.danh_muc_san_pham_id','=','danh_muc_san_pham.danh_muc_id')
            ->where('danh_muc_san_pham.danh_muc_id',$danh_muc_id)
            ->where('san_pham.ten_sp','LIKE','%'.$keyword.'%')
            ->select('san_pham.id','san_pham.ten_sp','san_pham.image','san_pham.created_at','sanpham_danhmuc.order_num','sanpham_danhmuc.danh_muc_san_pham_id')
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

    public function get_danh_sach_san_pham_cung_danh_muc($id_san_pham, $limit)
    {
        $ma_sp = san_pham::where('id',$id_san_pham)->first()->ma_sp;
        $id_danh_muc = sanpham_danhmuc::where('ma_sp', $ma_sp)->first()->danh_muc_san_pham_id;

        $ds = san_pham::join('sanpham_danhmuc','san_pham.ma_sp','=','sanpham_danhmuc.ma_sp')
            ->where('sanpham_danhmuc.danh_muc_san_pham_id',$id_danh_muc)
            ->where('san_pham.id','<>',$id_san_pham)
            ->select('san_pham.id','san_pham.danh_muc_id','san_pham.ma_sp','san_pham.ten_sp',
                'san_pham.net','san_pham.get_danh_sach_san_pham_theo_danh_muc','san_pham.full_vat_end_user',
                'san_pham.created_at','san_pham.image')
            ->paginate($limit);
        return json_encode($ds);
    }
}
