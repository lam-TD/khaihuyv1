<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nhom_chuc_nang;
use App\chuc_nang;
use App\nhom_phan_quyen;
use App\nhom_nguoi_dung;
use App\User;
use Illuminate\Support\Facades\DB;

class PhanQuyenChucNangController extends Controller
{
    public function get_list_chuc_nang() {
        $credentials = request(['user_id', 'id_nhom_nguoi_dung']);

        $nhom_ng = User::where('id', $credentials['user_id'])->where('id_nhom_nguoi_dung',$credentials['id_nhom_nguoi_dung'])->first();
        $nhom_cn_user = DB::select('SELECT pq.id_nhom_chuc_nang, pq.ten_nhom, pq.icon, pq.thu_tu_nhom FROM phan_quyen as pq WHERE pq.id_nhom_nguoi_dung ='.$nhom_ng->id_nhom_nguoi_dung.' GROUP BY pq.id_nhom_chuc_nang ORDER BY pq.thu_tu_nhom ASC');
        $list_chuc_nang = [];
        if($nhom_cn_user) {
            foreach ($nhom_cn_user as $value) {
                $query = "SELECT pq.id_chuc_nang, pq.ten_chuc_nang, pq.link, pq.thu_tu_chuc_nang, pq.allaction, pq.xem, pq.them, pq.sua, pq.xoa FROM phan_quyen as pq WHERE pq.id_nhom_chuc_nang =";
                $chucnang = (array)DB::select($query.$value->id_nhom_chuc_nang." ORDER BY pq.thu_tu_chuc_nang ASC");
                $nhom = array(
                    "id_nhom"   => $value->id_nhom_chuc_nang,
                    "ten_nhom"  => $value->ten_nhom,
                    "icon"      => $value->icon,
                    "chuc_nang" => $chucnang
                );
                $list_chuc_nang[] = $nhom;
            }
        }
        return ($list_chuc_nang);
    }
}
