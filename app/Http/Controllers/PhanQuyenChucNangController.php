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
    public function get_list_chuc_nang()
    {
        $credentials = request(['user_id', 'id_nhom_nguoi_dung']);
        $nhom_ng = User::where('id', $credentials['user_id'])->where('id_nhom_nguoi_dung', $credentials['id_nhom_nguoi_dung'])->first();

        $mcn = nhom_phan_quyen::join('chuc_nang','nhom_phan_quyen.id_chuc_nang','=','chuc_nang.id')
            ->select('id_nhom_chuc_nang', 'ten_nhom', 'nhom_chuc_nang.icon', 'nhom_chuc_nang.thu_tu')
            ->join('nhom_chuc_nang','nhom_chuc_nang.id','=','chuc_nang.id_nhom_chuc_nang')
            ->where('id_nhom_nguoi_dung',$nhom_ng->id_nhom_nguoi_dung)
            ->groupBy('id_nhom_chuc_nang', 'ten_nhom', 'nhom_chuc_nang.icon', 'nhom_chuc_nang.thu_tu')
            ->orderBy('nhom_chuc_nang.thu_tu','asc')
            ->get();

        $list_chuc_nang = [];

        if(count($mcn) > 0){
            foreach ($mcn as $value) {
                $query = "SELECT pq.id_chuc_nang, pq.ten_chuc_nang, pq.link, pq.thu_tu_chuc_nang, pq.allaction, pq.xem, pq.them, pq.sua, pq.xoa FROM phan_quyen as pq WHERE pq.id_nhom_chuc_nang =";
                $chucnang = nhom_phan_quyen::join('chuc_nang','nhom_phan_quyen.id_chuc_nang','=','chuc_nang.id')
                    ->select('id_chuc_nang', 'ten_chuc_nang', 'link', 'chuc_nang.thu_tu', 'allaction', 'xem', 'them', 'sua', 'xoa')
                    ->join('nhom_chuc_nang','nhom_chuc_nang.id','=','chuc_nang.id_nhom_chuc_nang')
                    ->where('id_nhom_chuc_nang',$value->id_nhom_chuc_nang)
                    ->orderBy('chuc_nang.thu_tu','asc')
                    ->get();
                $nhom = array(
                    "id_nhom"   => $value->id_nhom_chuc_nang,
                    "ten_nhom"  => $value->ten_nhom,
                    "icon"      => $value->icon,
                    "chuc_nang" => $chucnang
                );
                $list_chuc_nang[] = $nhom;
            }
        }
        return $list_chuc_nang;
    }

    public static function get_list_chuc_nang2($user_id){
        $nhom_ng = User::where('id', $user_id)->where('id_nhom_nguoi_dung', $user_id)->first();
        $mcn = nhom_phan_quyen::join('chuc_nang','nhom_phan_quyen.id_chuc_nang','=','chuc_nang.id')
            ->select('id_nhom_chuc_nang', 'ten_nhom', 'nhom_chuc_nang.icon', 'nhom_chuc_nang.thu_tu')
            ->join('nhom_chuc_nang','nhom_chuc_nang.id','=','chuc_nang.id_nhom_chuc_nang')
            ->where('id_nhom_nguoi_dung',$nhom_ng->id_nhom_nguoi_dung)
            ->groupBy('id_nhom_chuc_nang', 'ten_nhom', 'nhom_chuc_nang.icon', 'nhom_chuc_nang.thu_tu')
            ->orderBy('nhom_chuc_nang.thu_tu','asc')
            ->get();

        $list_chuc_nang = [];

        if(count($mcn) > 0){
            foreach ($mcn as $value) {
                $query = "SELECT pq.id_chuc_nang, pq.ten_chuc_nang, pq.link, pq.thu_tu_chuc_nang, pq.allaction, pq.xem, pq.them, pq.sua, pq.xoa FROM phan_quyen as pq WHERE pq.id_nhom_chuc_nang =";
                $chucnang = nhom_phan_quyen::join('chuc_nang','nhom_phan_quyen.id_chuc_nang','=','chuc_nang.id')
                    ->select('id_chuc_nang', 'ten_chuc_nang', 'link', 'chuc_nang.thu_tu', 'allaction', 'xem', 'them', 'sua', 'xoa')
                    ->join('nhom_chuc_nang','nhom_chuc_nang.id','=','chuc_nang.id_nhom_chuc_nang')
                    ->where('id_nhom_chuc_nang',$value->id_nhom_chuc_nang)
                    ->orderBy('chuc_nang.thu_tu','asc')
                    ->get();
                $nhom = array(
                    "id_nhom"   => $value->id_nhom_chuc_nang,
                    "ten_nhom"  => $value->ten_nhom,
                    "icon"      => $value->icon,
                    "chuc_nang" => $chucnang
                );
                $list_chuc_nang[] = $nhom;
            }
        }
        return $list_chuc_nang;
    }
}
