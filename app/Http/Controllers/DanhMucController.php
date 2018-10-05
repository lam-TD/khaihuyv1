<?php

namespace App\Http\Controllers;

use App\danh_muc_san_pham;
use App\san_pham;
use Illuminate\Http\Request;
use DB;

class DanhMucController extends Controller
{
    protected $dm = null;
    protected $category = null;
    protected $query = null;

    function category($table_row, &$category, $danhmuccha = 0, $level = "")
    {
        foreach ($table_row as $key => $row) {
            if ($row['danh_muc_cha'] == $danhmuccha) {
                $category[] = array(
                    'danh_muc_id' => $row['danh_muc_id'],
                    'tieu_de' => $row["tieu_de"],
                    'danh_muc_cha' => $row["danh_muc_cha"],
                    'tomtat' => $row["tomtat"],
                    'hienthi' => $row["hienthi"],
                    'thu_tu' => $row["thutu"],
                    'level' => $level
                );
                unset($table_row[$key]);
                $this->category($table_row, $category, $row['danh_muc_id'], $level . '|__ ');
                //$synbold = "└";
            }
        }
    }

    public function get_all_danh_muc_pa($limit)
    {
        $dm = danh_muc_san_pham::orderBy('danh_muc_id', 'asc')->paginate($limit);
        return $dm;
    }
    //
    public function get_danh_muc_theo_id($id_danh_muc)
    {
        $dm = danh_muc_san_pham::find($id_danh_muc);
        return $dm;
    }

    public function get_all_danh_muc_san_pham()
    {
        $dm = danh_muc_san_pham::orderby('thutu','asc')->get()->toArray();
        $this->category($dm,$category);
        return $category;
    }

    public function get_danh_sach_san_pham_theo_danh_muc($danh_muc_id, $limit)
    {
        $danh_sach_san_pham = san_pham::join('sanpham_danhmuc','san_pham.ma_sp','=','sanpham_danhmuc.ma_sp')
            ->join('danh_muc_san_pham','sanpham_danhmuc.danh_muc_san_pham_id','=','danh_muc_san_pham.danh_muc_id')
            ->where('danh_muc_san_pham.danh_muc_id',$danh_muc_id)
            ->orderby('order_num','asc')
            ->paginate($limit);
        return $danh_sach_san_pham;
    }

    public function add_danh_muc(Request $request)
    {
        $dm = new danh_muc_san_pham();
        $dm->tieu_de      = $request->tieu_de;
        $dm->danh_muc_cha = $request->danh_muc_cha;
        $dm->tomtat      = $request->tomtat;
        $dm->hienthi     = $request->hienthi;
        $dm->ghi_chu = $request->ghi_chu;
        $dm->save();
        return 1;
    }

    //
    public function edit_danh_muc(Request $request, $danh_muc_id)
    {
        $dm = danh_muc_san_pham::find($danh_muc_id);
        $dm->tieu_de      = $request->tieu_de;
        $dm->danh_muc_cha = $request->danh_muc_cha;
        $dm->tomtat       = $request->tomtat;
        $dm->hienthi      = $request->hienthi;
        $dm->ghi_chu      = $request->ghi_chu;
        $dm->update();

        $dm_sp = danh_muc_san_pham::orderby('thutu','asc')->get()->toArray();
        $this->update_child_listId($dm_sp, $query);
        return 1;
    }

    public function update_child_listId($table_row, &$query, $danhmuccha = 0, $danhmuc_id_assoc = 0)
    {
//        return json_encode($table_row);
        foreach ($table_row as $key => $row) {
            if ($row['danh_muc_cha'] == $danhmuccha) {
                $danhmuc_id_assoc_child = $danhmuc_id_assoc."," . $row["danh_muc_id"];
                $dm = danh_muc_san_pham::find($row["danh_muc_id"]);
                $dm->danhmuc_id_assoc = $danhmuc_id_assoc_child;
                $dm->save();
//                $query .= "UPDATE danh_muc_san_pham SET danhmuc_id_assoc = '" . $danhmuc_id_assoc_child . "' WHERE danh_muc_id = " . $row["danh_muc_id"] . ";";
//                unset($table_row[$key]);
                $this->update_child_listId($table_row, $query, $row['danh_muc_id'], $danhmuc_id_assoc_child);
            }
        }
    }
    //xoa
    public function xoa_danh_muc($id_danh_muc)
    {
        //kiem tra thong tin
        $danh_muc = danh_muc_san_pham::find($id_danh_muc);
        //co san pham hay khong
        $san_pham = $danh_muc->san_pham;
        $danh_muc_kiem_tra = danh_muc_san_pham::where('danh_muc_cha',$id_danh_muc)->get();
        if((count($san_pham) > 0) || (count($danh_muc_kiem_tra) > 0)){
            //  khong xoa
            return 0;
        }else
            $danh_muc->delete();
        return 1;
    }
}
