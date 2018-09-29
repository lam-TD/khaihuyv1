<?php

namespace App\Http\Controllers;

use App\don_vi_tinh;
use Illuminate\Http\Request;

class DonViTinhController extends Controller
{
    public function get_dvt()
    {
        return don_vi_tinh::all();
    }
}
