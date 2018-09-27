<?php

namespace App\Http\Controllers;

use App\danh_muc_san_pham;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    public function get_category($table_row, &$category, $danhmuccha = 0, $level = "")
    {
        foreach ($table_row as $key => $row) {
            if ($row['danhmuccha'] == $danhmuccha) {
                $category[] = array(
                    'danhmuc_id' => $row['danhmuc_id'],
                    'tieude' => $row["tieude"],
                    'danhmuccha' => $row["danhmuccha"],
                    'tomtat' => $row["tomtat"],
                    'hienthi' => $row["hienthi"],
                    'thutu' => $row["thutu"],
                    'level' => $level
                );
                unset($table_row[$key]);
                $this->category($table_row, $category, $row['danhmuc_id'], $level . '&nbsp;&nbsp;&nbsp|__ ');
                //$synbold = "└";
            }
        }
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
            if ($row['danhmuccha'] == $danhmuccha) {
                $danhmuc_id_assoc_child = $danhmuc_id_assoc."," . $row["danhmuc_id"];
                $query .= "UPDATE danhmuctintuc SET danhmuc_id_assoc = '" . $danhmuc_id_assoc_child . "' WHERE danhmuc_id = " . $row["danhmuc_id"] . ";";
                unset($table_row[$key]);
                $this->update_child_listId($table_row, $query, $row['danhmuc_id'], $danhmuc_id_assoc_child);
            }
        }
    }
}
