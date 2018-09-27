<?php

namespace App\Http\Controllers;

use App\danh_muc_san_pham;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    protected $dm = null;
    protected $category = null;

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

    public function get_all_danh_muc_san_pham()
    {
        $dm = danh_muc_san_pham::orderby('thutu','asc')->get()->toArray();
        $this->category($dm,$category);
        return $category;
    }

    public function add_danh_muc(Request $request)
    {
        $dm = danh_muc_san_pham::find($request->danh_muc_id);
        $dm->tieu_de      = $request->tieu_de;
        $dm->danh_muc_cha = $request->danh_muc_cha;
        $dm->tom_tat      = $request->tom_tat;
        $dm->hien_thi     = $request->hien_thi;
        $dm->save();

        $id_dm_new = danh_muc_san_pham::max('danh_muc_id');
        return 1;
    }

    public function update_child_listId($table_row, &$query, $danhmuccha = 0, $danhmuc_id_assoc = 0)
    {
        foreach ($table_row as $key => $row) {
            if ($row['danh_muc_cha'] == $danhmuccha) {
                $danhmuc_id_assoc_child = $danhmuc_id_assoc."," . $row["danh_muc_id"];
                $query .= "UPDATE danhmuctintuc SET danhmuc_id_assoc = '" . $danhmuc_id_assoc_child . "' WHERE danhmuc_id = " . $row["danhmuc_id"] . ";";
                unset($table_row[$key]);
                $this->update_child_listId($table_row, $query, $row['danh_muc_id'], $danhmuc_id_assoc_child);
            }
        }
    }
}
