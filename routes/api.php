<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login')->name('login');
    Route::get('chucnang', 'AuthController@get_list_chuc_nang');
    Route::get('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::post('chuc-nang', 'PhanQuyenChucNangController@get_list_chuc_nang');
});

// ================= NHAN SU =====================

// BO PHAN
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('get-all-bo-phan', 'BoPhanController@get_all_bo_phan');
    Route::get('get-bo-phan/{limit}', 'BoPhanController@get_danh_sach_bo_phan');
    Route::post('add-bo-phan', 'BoPhanController@add_bo_phan');
    Route::post('edit-bo-phan', 'BoPhanController@edit_bo_phan');
    Route::get('delete-bo-phan/{id}', 'BoPhanController@delete_bo_phan');
//    Route::get('get-phong-theo-bo-phan/{id_bo_phan}', 'PhongBanController@get_phong_ban_theo_id_bo_phan');
    Route::get('get-ma-bo-phan', 'BoPhanController@get_ma_bo_phan');
});

// PHONG BAN
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('get-all-phong-ban-no-paginate', 'PhongBanController@get_all_phong_ban_no_paginate');
    Route::get('get-all-phong-ban/{limit}', 'PhongBanController@get_all_phong_ban');
    Route::post('add-phong-ban', 'PhongBanController@add_phong_ban');
    Route::post('edit-phong-ban', 'PhongBanController@edit_phong_ban');
    Route::get('delete-phong-ban/{id}', 'PhongBanController@delete_phong_ban');
    Route::get('get-phong-theo-bo-phan/{id_bo_phan}/{limit}', 'PhongBanController@get_phong_ban_theo_id_bo_phan');
    Route::get('group-all-phong-theo-bo-phan', 'PhongBanController@group_all_phong_ban_theo_bo_phan');
    Route::get('get-ma-phong-ban', 'PhongBanController@get_ma_phong_ban');
});

// VI TRI
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('get-all-vi-tri/{limit}', 'ViTriController@get_all_vi_tri');
    Route::get('get-vi-tri-theo-phong/{id_phong}/{limit}', 'ViTriController@get_vi_tri_theo_phong');
    Route::post('add-vi-tri', 'ViTriController@add_vi_tri');
    Route::post('edit-vi-tri', 'ViTriController@edit_vi_tri');
    Route::get('delete-vi-tri/{id}', 'ViTriController@delete_vi_tri');
    Route::get('get-ma-vi-tri', 'ViTriController@get_ma_vi_tri');
});

// NHAN VIEN
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('get-all-nhan-vien-no-pa','NhanVienController@get_nhan_vien_no_pa');
    Route::get('get-nhan-vien-all-thong-tin', 'NhanVienController@get_all_thong_tin_nhan_vien');
    Route::get('nhan-vien/{limit}', 'NhanVienController@get_all');
    Route::post('add-nhan-vien-thong-tin-ca-nhan', 'NhanVienController@add_nhan_vien_thong_tin_ca_nhan');
    Route::post('edit-nhan-vien-thong-tin-ca-nhan', 'NhanVienController@edit_nhan_vien_thong_tin_ca_nhan');
    Route::post('image-upload', 'NhanVienController@upload_image');


//    Thong Tin Lao Dong
    Route::post('add-nhan-vien-thong-tin-lao-dong', 'NhanVienController@add_nhan_vien_thong_tin_lao_dong');
    Route::post('edit-nhan-vien-thong-tin-lao-dong', 'NhanVienController@edit_nhan_vien_thong_tin_lao_dong');
    Route::get('get-nhan-vien-thong-tin-lao-dong/{nv_id}', 'NhanVienController@get_thong_tin_lao_dong_theo_nhan_vien');
    Route::get('get-nhan-vien-thong-tin-lao-dong-moi-nhat/{nv_id}', 'HopDongLaoDongController@get_thong_tin_lao_dong_theo_nhan_vien_moi_nhat');

//    Thong Tin Cong Viec
    Route::get('get-nhan-vien-thong-tin-cong-viec/{nv_id}', 'NhanVienController@get_thong_tin_cong_viec_theo_nhan_vien');
    Route::post('add-nhan-vien-thong-tin-cong-viec', 'NhanVienController@add_nhan_vien_thong_tin_cong_viec');
    Route::post('add-nhan-vien-thong-tin-cong-viec', 'NhanVienController@edit_nhan_vien_thong_tin_cong_viec');

//    Tim Kiem
    Route::get('search-thong-tin-nhan-vien/{keyword}', 'NhanVienController@search_thong_tin_nhan_vien');

//    Xoa All Thong Tin Nhan Vien
    Route::get('delete-all-thong-tin-nhan-vien/{id_nhan_vien}', 'NhanVienController@delete_all_thong_tin_nhan_vien');

//    Route::get('get-ma-nhan-vien', 'NhanVienController@get_ma_nhan_vien');
});

// HOP DONG LAO DONG
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('get-all-hdld/{limit}', 'HopDongLaoDongController@get_all_hop_dong_lao_dong_pa');
    Route::post('add-hdld', 'HopDongLaoDongController@add_hop_dong_lao_dong');
    Route::post('edit-hdld', 'HopDongLaoDongController@edit_hop_dong_lao_dong');
    Route::get('delete-hdld/{id}', 'HopDongLaoDongController@delete_hop_dong_lao_dong');
    Route::get('search-hdld/{keyword}', 'HopDongLaoDongController@search_hop_dong_lao_dong');

//    Route::get('get-ma-hdld', 'HopDongLaoDongController@get_ma_hdld');
});

// BAO HIEM Y TE
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('get-all-bhyt/{limit}', 'BaoHiemYTeController@get_all_danh_sach_bhyt');
    Route::post('add-bhyt', 'BaoHiemYTeController@add_bhyt');
    Route::post('edit-bhyt', 'BaoHiemYTeController@edit_bhyt');
    Route::get('delete-bhyt/{id}', 'BaoHiemYTeController@delete_bhyt');
    Route::get('search-bhyt/{keyword}/{limit}', 'BaoHiemYTeController@search_danh_sach_bhyt');
    Route::get('get-bhyt-moi-nhat-theo-nv/{keyword}', 'BaoHiemYTeController@get_bhyt_theo_nhan_vien_moi_nhat');
//    Route::get('get-ma-bhyt', 'HopDongLaoDongController@get_ma_bhyt');
});

// THONG TIN CONG VIEC
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('get-all-ttcv/{limit}', 'ThongTinCongViecController@get_all_thong_tin_cong_viec');
    Route::post('add-ttcv', 'ThongTinCongViecController@add_thong_tin_cong_viec');
    Route::post('edit-ttcv', 'ThongTinCongViecController@edit_thong_tin_cong_viec');
    Route::get('delete-ttcv/{id}', 'ThongTinCongViecController@delete_thong_tin_cong_viec');
    Route::get('search-ttcv/{keyword}/{limit}', 'ThongTinCongViecController@search_thong_tin_cong_viec');
    Route::get('get-vi-tri-all-theo-phong/{id_phong}', 'ThongTinCongViecController@get_vi_tri_all_theo_phong');
    Route::get('get-ttcv-hien-tai-theo-nhan-vien/{manv}', 'ThongTinCongViecController@get_ttcv_hien_tai_theo_nhan_vien');
});

// NGUOI PHU THUOC
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('get-all-npt/{limit}', 'NguoiPhuThuocController@get_all_danh_sach_npt');
    Route::get('get-npt-theo-nhan-vien/{ma_nv}/{limit}', 'NguoiPhuThuocController@get_danh_sach_npt_theo_nhan_vien');
    Route::post('add-npt', 'NguoiPhuThuocController@add_nhan_vien_npt');
    Route::post('edit-npt', 'NguoiPhuThuocController@edit_nhan_vien_npt');
    Route::get('delete-npt/{id}', 'NguoiPhuThuocController@delete_nhan_vien_npt');
//    Route::get('search-ttcv/{keyword}', 'NguoiPhuThuocController@search_hop_dong_lao_dong');
//    Route::get('get-vi-tri-all-theo-phong/{id_phong}', 'ThongTinCongViecController@get_vi_tri_all_theo_phong');
    //nguoi phu thuoc con han theo nhan vien
    Route::get('get_npt_con_thoi_han_theo_nhan_vien/{nv_ma}', 'NguoiPhuThuocController@get_npt_con_thoi_han_theo_nhan_vien');
});

// ================= SAN PHAM =====================
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    //    --- Danh Muc San Pham ---
    Route::get('get-danh-muc-san-pham', 'DanhMucController@get_all_danh_muc_san_pham');
    Route::get('get-danh-muc-san-pham-pa/{limit}', 'DanhMucController@get_all_danh_muc_pa');
    Route::get('get-danh-muc/{id_danh_muc}', 'DanhMucController@get_danh_muc');
    Route::post('add-danh-muc', 'DanhMucController@add_danh_muc');
    Route::post('edit-danh-muc/{danh_muc_id}', 'DanhMucController@edit_danh_muc');
    Route::post('xoa-danh-muc/{danh_muc_id}', 'DanhMucController@xoa_danh_muc');

    //    --- San Pham ---
    Route::get('get-danh-muc-san-pham', 'DanhMucController@get_all_danh_muc_san_pham');
    Route::get('get-all-san-pham-paginate/{limit}', 'SanPhamController@get_list_san_pham_paginate');
    Route::get('get-san-pham-theo-id/{id_sp}', 'SanPhamController@get_thong_tin_san_pham_theo_id');
    Route::post('add-san-pham', 'SanPhamController@add_san_pham');
    Route::post('edit-san-pham', 'SanPhamController@edit_san_pham');
    Route::get('delete-san-pham/{id_sanpham}', 'SanPhamController@delete_san_pham');
    Route::post('upload-img/{id}', 'UploadImageController@multi_upload_img');
    Route::post('delete-img-san-pham/{id}', 'UploadImageController@delete_img');

    //    --- Tai Khoan Kho ---
    Route::get('get-tk-kho-paginate/{limit}', 'TaiKhoanKeToanConTroller@get_tk_ke_toan_paginate');
    Route::post('add-tk-kho', 'TaiKhoanKeToanConTroller@add_tk_ke_toan');
    Route::post('edit-tk-kho', 'TaiKhoanKeToanConTroller@edit_tk_ke_toan');
    Route::get('delete-tk-kho/{tk_id}', 'TaiKhoanKeToanConTroller@delete_tk_ke_toan');
});

// ============== TAI KHOAN KE TOAN ==============
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('get-all-tk-ke-toan', 'TaiKhoanKeToanConTroller@get_all_tk_ke_toan');
    Route::post('add-tk-ke-toan', 'TaiKhoanKeToanConTroller@add_san_pham');
    Route::post('edit-tk-ke-toan', 'TaiKhoanKeToanConTroller@add_san_pham');
    Route::post('delete-tk-ke-toan', 'TaiKhoanKeToanConTroller@add_san_pham');
});

// ================= HE THONG =====================
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('danh-sach-nhom-nguoi-dung', 'HeThongController@get_danh_sach_nhom_nguoi_dung');
    Route::post('nhom-nguoi-dung-them', 'HeThongController@add_nhom');
    Route::post('edit-nhom-nguoi-dung', 'HeThongController@edit_nhom');
    Route::get('delete-nhom-nguoi-dung/{id_nhom}', 'HeThongController@delete_nhom');
    Route::get('danh-sach-nguoi-dung-theo-nhom/{id_nhom}', 'HeThongController@get_danh_sach_nguoi_dung_theo_nhom');
});

// ================= TINH THANH QUAN HUYEN THI XA =============
Route::get('get-tinh-thanh', 'TinhThanhController@get_tinh_thanh');
Route::get('get-quan-huyen', 'TinhThanhController@get_quan_huyen');
Route::get('get-phuong-xa', 'TinhThanhController@get_phuong_xa');
Route::get('get-duong', 'TinhThanhController@get_duong');

Route::get('get-qh/{ma_tinh}', 'TinhThanhController@quan_huyen_theo_tinh');

Route::get('nhan-vien-pa/{page}&{limit}', 'NhanVienController@nhan_vien_paginate');


// ========== TINH THANH ==========
Route::get('get-tinh-thanh-paginate/{limit}', 'TinhThanhController@get_tinh_thanh_paginate');
Route::get('get-search-tinh-thanh-paginate/{keyword}&{limit}', 'TinhThanhController@get_search_tinh_thanh');
Route::post('add-tinh-thanh', 'TinhThanhController@add_tinh_thanh');
Route::post('edit-tinh-thanh', 'TinhThanhController@edit_tinh_thanh');
Route::get('delete-tinh-thanh/{ma_tinh}', 'TinhThanhController@delete_tinh_thanh');

// ========== QUAN HUYEN ==========
Route::get('get-list-quan-huyen/{ma_tinh}&{limit}', 'QuanHuyenController@get_list_quan_huyen');
Route::get('get-list-search-quan-huyen/{keyword}&{ma_tinh}&{limit}', 'QuanHuyenController@get_list_search_quan_huyen');
Route::post('add-quan-huyen', 'QuanHuyenController@add_quan_huyen');
Route::post('edit-quan-huyen', 'QuanHuyenController@edit_quan_huyen');
Route::get('delete-quan-huyen/{id}', 'QuanHuyenController@delete_quan_huyen');
// ===========PHUONG XA ============
Route::get('get-list-phuong-xa-theo-quan-huyen-paginate/{ma_quan_huyen}&{limit}', 'PhuongXaController@get_list_phuong_xa_theo_quan_huyen_paginate');
Route::post('add-phuong-xa', 'PhuongXaController@add_phuong_xa');
Route::post('edit-phuong-xa/{id}', 'PhuongXaController@edit_phuong_xa');
Route::get('delete-phuong-xa/{id}', 'PhuongXaController@delete_phuong_xa');

// ======== DON VI TINH ===========
Route::get('get-dvt', 'DonViTinhController@get_dvt');

// ====== TEST ======

