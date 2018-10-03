<?php

namespace App\Http\Controllers;

use App\san_pham;
use Illuminate\Http\Request;
use App\UploadImageController;
use File;

class SanPhamController extends Controller
{
    public function get_list_san_pham_paginate($limit)
    {
        $sp = san_pham::join('don_vi_tinh', 'san_pham.dvt_id', '=', 'don_vi_tinh.id')
            ->join('danh_muc_san_pham','san_pham.danh_muc_id', '=', 'danh_muc_san_pham.danh_muc_id')
            ->select('san_pham.id','san_pham.danh_muc_id','danh_muc_san_pham.tieu_de','san_pham.ma_sp','san_pham.ten_sp','san_pham.dvt_id',
                'san_pham.net','san_pham.dien_giai','san_pham.full_vat_dealer','san_pham.full_vat_end_user',
                'san_pham.created_at','san_pham.image','don_vi_tinh.ten_dvt')
            ->orderby('id','desc')
            ->paginate($limit);
        return ($sp);
    }


    public function get_thong_tin_san_pham_theo_id($id)
    {
        $sp = san_pham::join('don_vi_tinh', 'san_pham.dvt_id', '=', 'don_vi_tinh.id')
            ->join('danh_muc_san_pham','san_pham.danh_muc_id', '=', 'danh_muc_san_pham.danh_muc_id')
            ->select('san_pham.id','san_pham.danh_muc_id','danh_muc_san_pham.tieu_de','san_pham.ma_sp','san_pham.ten_sp','san_pham.dvt_id',
                'san_pham.net','san_pham.dien_giai','san_pham.full_vat_dealer','san_pham.full_vat_end_user',
                'san_pham.created_at','san_pham.image','don_vi_tinh.ten_dvt','san_pham.tk_ke_toan_id', 'san_pham.deal_1','san_pham.deal_2','san_pham.deal_3','san_pham.deal_1_sl','san_pham.deal_2_sl','san_pham.deal_3_sl')
            ->where('san_pham.id',$id)
            ->first();
        return ($sp);
    }

    public function add_san_pham(Request $request)
    {
//        return $request->all();
        try{
            $sp = new san_pham();
            $sp->ma_sp           = $request->ma_sp;
            $sp->ten_sp          = $request->ten_sp;
            $sp->dvt_id          = $request->dvt_id;
            $sp->net             = $request->net;
            $sp->warranty        = $request->warranty;
            $sp->dien_giai       = $request->dien_giai;
            $sp->full_vat_dealer = $request->full_vat_dealer;
            $sp->full_vat_end_user = $request->full_vat_end_user;
            $sp->deal_1          = $request->deal_1;
            $sp->deal_2          = $request->deal_2;
            $sp->deal_3          = $request->deal_3;
            $sp->deal_1_sl       = $request->deal_1_sl;
            $sp->deal_2_sl       = $request->deal_2_sl;
            $sp->deal_3_sl       = $request->deal_3_sl;
            $sp->distri          = $request->distri;
            $sp->cong_dv         = $request->cong_dv;
            $sp->danh_muc_id     = $request->danh_muc_id;
            $sp->tk_ke_toan_id     = $request->tk_ke_toan_id;
            $sp->ghi_chu         = $request->ghi_chu;
            $sp->save();

            $id_sp_new = san_pham::max('id');
            return $id_sp_new;
        }
        catch (\Exception $e){
            return $e;
        }

    }

    public function edit_san_pham(Request $request)
    {
        try{
            $sp = san_pham::find($request->id);
            $sp->ten_sp          = $request->ten_sp;
            $sp->dvt_id          = $request->dvt_id;
            $sp->net             = $request->net;
            $sp->warranty        = $request->warranty;
            $sp->dien_giai       = $request->dien_giai;
            $sp->full_vat_dealer = $request->full_vat_dealer;
            $sp->full_vat_end_user = $request->full_vat_end_user;
            $sp->deal_1          = $request->deal_1;
            $sp->deal_2          = $request->deal_2;
            $sp->deal_3          = $request->deal_3;
            $sp->deal_1_sl       = $request->deal_1_sl;
            $sp->deal_2_sl       = $request->deal_2_sl;
            $sp->deal_3_sl       = $request->deal_3_sl;
            $sp->distri          = $request->distri;
            $sp->cong_dv         = $request->cong_dv;
            $sp->danh_muc_id     = $request->danh_muc_id;
            $sp->tk_ke_toan_id     = $request->tk_ke_toan_id;
            $sp->ghi_chu         = $request->ghi_chu;
            $sp->save();
            return 1;
        }
        catch (\Exception $e){
            return $e;
        }

    }

    public function delete_san_pham($id_sp)
    {
        try{
            $sp = san_pham::find($id_sp);
            $sp->delete();
            $this->delete_folder_image_san_pham($id_sp);
            return 1;
        }
        catch (\Exception $e){
            return $e;
        }
    }

    public function delete_folder_image_san_pham($id_sp)
    {
        $path = 'public/images/san_pham/'.$id_sp;
        if(File::exists($path)) {
            File::deleteDirectory($path);
        }
        return 1;
    }

    public function multi_upload_img_san_pham(Request $request, $id)
    {
        $ar_name = [];
        if ( $files =  $request->file('file')) {
            foreach ($request->file('file') as $key => $file) {
                $name = time() . $key . $file->getClientOriginalName();
                $ar_name[] = $name;
                $filename[] = $file->move('public/images/san_pham', $name);
            }
            return $ar_name;
        }
        else{
            return 2;
        }
    }
}
