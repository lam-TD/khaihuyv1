<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use App\nhom_chuc_nang;
use App\chuc_nang;
use App\nhom_phan_quyen;
use App\nhom_nguoi_dung;
use App\User;
use App\Http\Controllers\PhanQuyenChucNangController;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        if(auth('api')->user()->active == 0){
            return response()->json(['error' => 'Unauthorized'], 200);
        }

        return $this->respondWithToken($token);
    }

    public function login2(Request $request)
    {
//        return 1;
        $rules = [
            'email' =>'required|email',
            'password' => 'required|min:4'
        ];
        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $credentials = request(['email', 'password']);

            if (! $token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }else{
                return redirect()->intended('/');
            }

//            return $lam = $this->respondWithToken($token);
//            return auth()->user();

        }

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
//        $lam = PhanQuyenChucNangController::get_list_chuc_nang2(2);
//        return $this->guard()->user();
        $cn = $this->get_list_chuc_nang($this->guard()->user()->id_nhom_nguoi_dung);
        return response()->json([
            'access_token' => $token,
            'user' =>$this->guard()->user(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'chuc_nang' => $cn
        ]);
    }

    public function guard() {
        return Auth::Guard('api');
    }

    public static function get_list_chuc_nang($id_nhom_ng){
//        $nhom_ng = User::where('id', $user_id)->where('id_nhom_nguoi_dung', $user_id)->first();
//        return $nhom_ng;
        $mcn = nhom_phan_quyen::join('chuc_nang','nhom_phan_quyen.id_chuc_nang','=','chuc_nang.id')
            ->select('id_nhom_chuc_nang', 'ten_nhom', 'nhom_chuc_nang.icon', 'nhom_chuc_nang.thu_tu')
            ->join('nhom_chuc_nang','nhom_chuc_nang.id','=','chuc_nang.id_nhom_chuc_nang')
            ->where('id_nhom_nguoi_dung', $id_nhom_ng)
            ->groupBy('id_nhom_chuc_nang', 'ten_nhom', 'nhom_chuc_nang.icon', 'nhom_chuc_nang.thu_tu')
            ->orderBy('nhom_chuc_nang.thu_tu','asc')
            ->get();
        $list_chuc_nang = [];

        if(count($mcn) > 0){
            foreach ($mcn as $value) {
                $chucnang = nhom_phan_quyen::join('chuc_nang','nhom_phan_quyen.id_chuc_nang','=','chuc_nang.id')
                    ->join('nhom_chuc_nang','nhom_chuc_nang.id','=','chuc_nang.id_nhom_chuc_nang')
                    ->where('id_nhom_nguoi_dung', $id_nhom_ng)
                    ->where('nhom_chuc_nang.id', $value->id_nhom_chuc_nang)
                    ->where('allaction',1)->orwhere('xem',1)->orwhere('them',1)->orwhere('sua',1)->orwhere('xoa',1)
                    ->orderBy('chuc_nang.thu_tu','asc')
                    ->select('id_chuc_nang', 'ten_chuc_nang', 'link', 'chuc_nang.thu_tu', 'allaction', 'xem', 'them', 'sua', 'xoa')
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
