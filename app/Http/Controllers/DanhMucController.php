<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    public function category($table_row, &$category, $danhmuccha = 0, $level = "")
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
    }
}
