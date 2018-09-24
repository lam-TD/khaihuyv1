<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PhanQuyenChucNangController;
use Illuminate\Support\Facades\Auth;
use Session;

class HomeController extends Controller
{
    public function __construct() {

    }

    public function getIndex() {
        $lam = session()->get('token');
        return $lam;
//        $chuc_nang = PhanQuyenChucNangController::get_list_chuc_nang2($user_id);
        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            echo $e;
        }
    }
}
