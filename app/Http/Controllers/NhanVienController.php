<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nhan_vien;

class NhanVienController extends Controller
{
    public function get_all()
    {
        $nv = nhan_vien::orderby('id','desc')->paginate(10);
        return json_encode($nv);
    }
}
