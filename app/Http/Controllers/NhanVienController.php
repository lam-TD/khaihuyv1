<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nhan_vien;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class NhanVienController extends Controller
{
    public function get_all()
    {
        $nv = nhan_vien::orderby('id','desc')->paginate(10);
        return json_encode($nv);
    }

    public function add_nhan_vien_thong_tin_ca_nhan(Request $request) {
//        return $request->all();
        $avatar = '';
        if($request->get('image'))
        {
            $image = $request->get('image');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('image'))->save(public_path('/image_nhan_vien/').$name);
            $avatar = $name;
        }
        if($this->check_ma_nhan_vien($request->ma_nv) == 1) return 0;
        $nv = new nhan_vien();
        $nv->ma_nv = $request->ma_nv;
        $nv->ho_ten = $request->ho_ten;
        $nv->gioi_tinh = $request->gioi_tinh;
        $nv->ngay_sinh = $request->ngay_sinh;
        $nv->noi_sinh = $request->noi_sinh;
        $nv->quoc_tich = $request->quoc_tich;
        $nv->so_cmnd = $request->so_cmnd;
        $nv->scmnd_noi_cap = $request->scmnd_noi_cap;
        $nv->scmnd_ngay_cap = $request->scmnd_ngay_cap;
        $nv->thuong_tru = $request->thuong_tru;
        $nv->tam_tru = $request->tam_tru;
        $nv->di_dong_1 = $request->di_dong_1;
        $nv->di_dong_2 = $request->di_dong_2;
        $nv->dt_ban = $request->dt_ban;
        $nv->mst_cn = $request->mst_cn;
        $nv->mst_cn_noi_cap = $request->mst_cn_noi_cap;
        $nv->cc_thue_cap = $request->cc_thue_cap;
        $nv->avatar = $avatar;
        $nv->save();
        return 1;
    }

    public function edit_nhan_vien_thong_tin_ca_nhan(Request $request) {
        $avatar = '';
        if($request->get('image'))
        {
            $image = $request->get('image');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('image'))->save(public_path('/image_nhan_vien/').$name);
            $avatar = $name;
        }
        $nv = nhan_vien::find($request->id);
        $nv->ho_ten = $request->ho_ten;
        $nv->gioi_tinh = $request->gioi_tinh;
        $nv->ngay_sinh = $request->ngay_sinh;
        $nv->noi_sinh = $request->noi_sinh;
        $nv->quoc_tich = $request->quoc_tich;
        $nv->so_cmnd = $request->so_cmnd;
        $nv->scmnd_noi_cap = $request->scmnd_noi_cap;
        $nv->scmnd_ngay_cap = $request->scmnd_ngay_cap;
        $nv->thuong_tru = $request->thuong_tru;
        $nv->tam_tru = $request->tam_tru;
        $nv->di_dong_1 = $request->di_dong_1;
        $nv->di_dong_2 = $request->di_dong_2;
        $nv->dt_ban = $request->dt_ban;
        $nv->mst_cn = $request->mst_cn;
        $nv->mst_cn_noi_cap = $request->mst_cn_noi_cap;
        $nv->cc_thue_cap = $request->cc_thue_cap;
        $nv->avatar = $avatar;
        $nv->save();
        return 1;
    }

    public function check_ma_nhan_vien($ma_nv)
    {
        $nv = nhan_vien::where('ma_nv', $ma_nv)->get();
        (count($nv) == 0) ? $result = -1 : $result = 1;
        return $result;
    }

    public function upload_image(Request $request)
    {
        return $request->all();
        if($request->get('image'))
        {
            $image = $request->get('image');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('image'))->save(public_path('/image_nhan_vien/').$name);
            $nv = nhan_vien::where('ma_nv',$request->ma_nv)->update(['avatar' => $name]);
            return 1;
        }
        else{
            return -1;
        }

    }
}
