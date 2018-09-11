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

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login')->name('login');
    Route::get('chucnang', 'AuthController@get_list_chuc_nang');
    Route::post('logout', 'AuthController@logout');
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
    Route::get('get-bo-phan', 'BoPhanController@get_danh_sach_bo_phan');
    Route::post('add-bo-phan', 'BoPhanController@add_bo_phan');
    Route::post('edit-bo-phan', 'BoPhanController@edit_bo_phan');
    Route::get('delete-bo-phan/{id}', 'BoPhanController@delete_bo_phan');
//    Route::get('get-phong-theo-bo-phan/{id_bo_phan}', 'PhongBanController@get_phong_ban_theo_id_bo_phan');
});

// PHONG BAN
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('get-all-phong-ban-no-paginate', 'PhongBanController@get_all_phong_ban_no_paginate');
    Route::get('get-all-phong-ban', 'PhongBanController@get_all_phong_ban');
    Route::post('add-phong-ban', 'PhongBanController@add_phong_ban');
    Route::post('edit-phong-ban', 'PhongBanController@edit_phong_ban');
    Route::get('delete-phong-ban/{id}', 'PhongBanController@delete_phong_ban');
    Route::get('get-phong-theo-bo-phan/{id_bo_phan}', 'PhongBanController@get_phong_ban_theo_id_bo_phan');
});

// VI TRI
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('get-all-vi-tri', 'ViTriController@get_all_vi_tri');
    Route::get('get-vi-tri-theo-phong/{id_phong}', 'ViTriController@get_vi_tri_theo_phong');
    Route::post('add-vi-tri', 'ViTriController@add_vi_tri');
    Route::post('edit-vi-tri', 'ViTriController@edit_vi_tri');
    Route::get('delete-vi-tri/{id}', 'ViTriController@delete_vi_tri');
});

// NHAN VIEN
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('get-nhan-vien-all-thong-tin', 'NhanVienController@get_all_thong_tin_nhan_vien');
    Route::get('nhan-vien', 'NhanVienController@get_all');
    Route::post('add-nhan-vien-thong-tin-ca-nhan', 'NhanVienController@add_nhan_vien_thong_tin_ca_nhan');
    Route::post('edit-nhan-vien-thong-tin-ca-nhan', 'NhanVienController@edit_nhan_vien_thong_tin_ca_nhan');
    Route::post('image-upload', 'NhanVienController@upload_image');

//    Thong Tin Lao Dong
    Route::post('add-nhan-vien-thong-tin-lao-dong', 'NhanVienController@add_nhan_vien_thong_tin_lao_dong');
    Route::post('edit-nhan-vien-thong-tin-lao-dong', 'NhanVienController@edit_nhan_vien_thong_tin_lao_dong');
    Route::get('get-nhan-vien-thong-tin-lao-dong/{nv_id}', 'NhanVienController@get_thong_tin_lao_dong_theo_nhan_vien');

//    Thong Tin Cong Viec
    Route::get('get-nhan-vien-thong-tin-cong-viec/{nv_id}', 'NhanVienController@get_thong_tin_cong_viec_theo_nhan_vien');
    Route::post('add-nhan-vien-thong-tin-cong-viec', 'NhanVienController@add_nhan_vien_thong_tin_cong_viec');
    Route::post('add-nhan-vien-thong-tin-cong-viec', 'NhanVienController@edit_nhan_vien_thong_tin_cong_viec');

//    Tim Kiem
    Route::get('search-thong-tin-nhan-vien/{keyword}', 'NhanVienController@search_thong_tin_nhan_vien');

//    Xoa All Thong Tin Nhan Vien
    Route::get('delete-all-thong-tin-nhan-vien/{id_nhan_vien}', 'NhanVienController@delete_all_thong_tin_nhan_vien');
});

// ================= HE THONG =====================
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('danh-sach-nhom-nguoi-dung', 'HeThongController@get_danh_sach_nhom_nguoi_dung');
    Route::post('nhom-nguoi-dung-them', 'HeThongController@add_nhom');
    Route::post('edit-nhom-nguoi-dung', 'HeThongController@edit_nhom');
    Route::get('delete-nhom-nguoi-dung/{id_nhom}', 'HeThongController@delete_nhom');

    Route::get('danh-sach-nguoi-dung-theo-nhom/{id_nhom}', 'HeThongController@get_danh_sach_nguoi_dung_theo_nhom');
});