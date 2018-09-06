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
    Route::get('get-bo-phan', 'BoPhanController@get_danh_sach_bo_phan');
    Route::post('add-bo-phan', 'BoPhanController@add_bo_phan');
    Route::post('edit-bo-phan', 'BoPhanController@edit_bo_phan');
    Route::get('delete-bo-phan/{id}', 'BoPhanController@delete_bo_phan');
    Route::get('get-phong-theo-bo-phan/{id_bo_phan}', 'PhongBanController@get_phong_ban_theo_id_bo_phan');
});

// PHONG BAN
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('get-bo-phan', 'BoPhanController@get_danh_sach_bo_phan');
    Route::post('add-phong-ban', 'PhongBanController@add_phong_ban');
    Route::post('edit-phong-ban', 'PhongBanController@edit_phong_ban');
    Route::get('delete-phong-ban/{id}', 'PhongBanController@delete_phong_ban');
    Route::get('get-phong-theo-bo-phan/{id_bo_phan}', 'PhongBanController@get_phong_ban_theo_id_bo_phan');
});


Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('nhan-vien', 'NhanVienController@get_all');
});

// ================= HE THONG =====================
Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::get('danh-sach-nhom-nguoi-dung', 'HeThongController@get_danh_sach_nhom_nguoi_dung');
    Route::post('nhom-nguoi-dung-them', 'HeThongController@add_nhom');
    Route::post('edit-nhom-nguoi-dung', 'HeThongController@edit_nhom');
    Route::get('delete-nhom-nguoi-dung/{id_nhom}', 'HeThongController@delete_nhom');

    Route::get('danh-sach-nguoi-dung-theo-nhom/{id_nhom}', 'HeThongController@get_danh_sach_nguoi_dung_theo_nhom');
});