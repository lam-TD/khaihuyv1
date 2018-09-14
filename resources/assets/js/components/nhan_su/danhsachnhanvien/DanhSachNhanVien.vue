<template id="danhsachnhanvien">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <form @submit.prevent="submit_search_thong_tin_nhan_vien">
                                    <input v-model="key_word" type="text" id="timkiem" class="form-control" placeholder="Nhập từ khóa để tìm kiếm...">
                                    <button type="submit" class="btn btn-info btn-sm btntimkiem" name="button">Tìm kiếm</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button @click="_nhan_vien('add')" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_nv_tt_ca_nhan"><i class="fa fa-plus-circle"></i> Thêm mới</button>
                            <!-- Modal thong tin ca nhan -->
                            <div class="modal" id="modal_nv_tt_ca_nhan"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel"><b>Thông tin cá nhân</b></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form @submit.prevent="submit_nhan_vien_thong_tin_ca_nhan" id="form_nhan_vien_thong_tin_ca_nhan" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">Mã NV</label>
                                                                <input :disabled="flag_input_nhan_vien_tt" v-model="nhan_vien.ma_nv" @input="validate_ma_nv" name="txtma_nv" type="text" class="form-control form-control-sm" id="manv" v-validate="'required'" :class="{'border-danger' : errors.has('txtma_nv')}">
                                                                <small v-show="errors.has('txtma_nv')" class="help text-muted is-danger">Vui lòng nhập mã NV</small>
                                                                <small v-if="flag_input_ma_nv" class="help text-muted is-danger">Mã NV phải có 7 ký tự, bắt đầu bằng KH</small>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="label-form">Họ tên</label>
                                                                <input v-model="nhan_vien.ho_ten" name="txthoten" type="text" class="form-control form-control-sm" id="txthoten" v-validate="'required'" :class="{'border-danger' : errors.has('txthoten')}">
                                                                <small v-show="errors.has('txthoten')" class="help text-muted is-danger">Vui lòng nhập tên nhân viên</small>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">Giới tính</label>
                                                                <select v-model="nhan_vien.gioi_tinh" name="" id="" class="form-control form-control-sm">
                                                                    <option value="0" :selected="true">Nữ</option>
                                                                    <option value="1">Nam</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="label-form">Nơi sinh</label>
                                                                <!--<input v-model="nhan_vien.noi_sinh" type="text" class="form-control form-control-sm" id="dd1" placeholder="">-->
                                                                <div class="row">
                                                                    <el-select v-model="tinh_thanh" value-key="tinh_thanh" filterable size="small" placeholder="Chọn tỉnh thành phố" @change="load_quan_huyen" class="col-md-6">
                                                                        <el-option
                                                                                v-for="item in list_tinh_thanh"
                                                                                :key="item.ma_tinh"
                                                                                :label="item.ten_tinh"
                                                                                :value="item.ma_tinh">
                                                                        </el-option>
                                                                    </el-select>

                                                                    <el-select v-model="quan_huyen" value-key="quan_huyen" filterable size="small" placeholder="Chọn tỉnh quận huyện" class="col-md-6">
                                                                        <el-option
                                                                                v-for="item in change_quan_huyen"
                                                                                :key="item.ma_quan_huyen"
                                                                                :label="item.ten_quan_huyen"
                                                                                :value="item.ma_quan_huyen">
                                                                        </el-option>
                                                                    </el-select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">Ngày sinh</label>
                                                                <input v-model="nhan_vien.ngay_sinh" type="date" class="form-control form-control-sm" id="sss" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">Quốc tịch</label>
                                                                <input v-model="nhan_vien.quoc_tich" type="text" class="form-control form-control-sm" id="1aaa" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="wizard-card" style="margin-top: -5px">
                                                            <div class="picture-container">
                                                                <div class="picture">
                                                                    <img style="height: 100%" src="https://cdn0.vox-cdn.com/images/verge/default-avatar.v9899025.gif" class="picture-src" id="wizardPicturePreview" title="" />
                                                                    <input name="image" type="file" id="wizard-picture" @change="onFileChange">
                                                                </div>
                                                                <button style="width: 106px;" class="btn btn-sm">Chọn ảnh</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">Số CMND</label>
                                                                <input v-model="nhan_vien.so_cmnd" v-on:keypress="only_number_input(event)" name="txtsocmnd" type="text" class="form-control form-control-sm" id="txtsocmnd" v-validate="'required'" :class="{'border-danger' : errors.has('txtsocmnd')}">
                                                                <small v-show="errors.has('txtsocmnd')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="label-form">Ngày cấp</label>
                                                                <input v-model="nhan_vien.scmnd_ngay_cap" name="scmnd_ngay_cap" type="date" class="form-control form-control-sm" id="scmnd_ngay_cap" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-5">
                                                                <label class="label-form">Nơi cấp</label>
                                                                <!--<input v-model="nhan_vien.scmnd_noi_cap" name="scmnd_noi_cap" type="text" class="form-control form-control-sm" id="scmnd_noi_cap" placeholder="">-->
                                                                <el-select v-model="nhan_vien.scmnd_noi_cap" filterable size="small" placeholder="Chọn tỉnh thành phố" style="width: 100%">
                                                                    <el-option
                                                                            v-for="item in list_tinh_thanh"
                                                                            :key="item.ma_tinh"
                                                                            :label="item.ten_tinh"
                                                                            :value="item.ten_tinh">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label class="label-form">Tạm trú</label>
                                                                <textarea v-model="nhan_vien.tam_tru" name="txttamtru" class="form-control form-control-sm" id="txttamtru"></textarea>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label class="label-form">Thường trú</label>
                                                                <input v-model="nhan_vien.thuong_tru" name="txtthuongtru" class="form-control form-control-sm" id="txtthuongtru"/>
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label class="label-form">ĐT bàn</label>
                                                                <input v-model="nhan_vien.dt_ban" name="txtdtban" type="text" class="form-control form-control-sm" id="txtdtban" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="label-form">Di động 1</label>
                                                                <input v-model="nhan_vien.di_dong_1" type="text" name="txtdd1" class="form-control form-control-sm" id="txtdd1" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="label-form">Di động 2</label>
                                                                <input v-model="nhan_vien.di_dong_2" type="text" class="form-control form-control-sm" name="txtdd2" id="txtdd2" placeholder="">
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">MST CN</label>
                                                                <input v-model="nhan_vien.mst_cn" type="text" name="txtmst_cn" class="form-control form-control-sm" id="txtmst_cn" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="label-form">Nơi cấp</label>
                                                                <input v-model="nhan_vien.mst_cn_noi_cap" type="text" name="txtmst_cn_noi_cap" class="form-control form-control-sm" id="txtmst_cn_noi_cap" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">C/C thuế cấp</label>
                                                                <input v-model="nhan_vien.cc_thue_cap" type="text" name="txtccthuecap" class="form-control form-control-sm" id="txtccthuecap" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                <button :disabled="flag_disabled_tt_ca_nhan" id="save" type="submit" class="btn btn-primary">
                                                    <span v-if="flag_xu_ly_tt_ca_nhan"><i class="fa fa-save"></i> Lưu lại</span>
                                                    <span v-if="!flag_xu_ly_tt_ca_nhan"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</span>
                                                </button>
                                                <!--<button @click="upload_img" id="anh" type="" class="btn btn-primary">Lưu ảnh</button>-->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal thong tin lao dong -->
                            <div class="modal" id="modal_nv_tt_lao_dong"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabe2"><b>Thông tin lao động</b></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form @submit.prevent="submit_nhan_vien_thong_tin_lao_dong" id="form_nhan_vien_thong_tin_lao_dong">
                                            <div v-loading="loading_lao_dong" class="modal-body modal-lao-dong">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Vào công ty</label>
                                                        <input v-model="lao_dong.vao_cty" name="txtvaocty" type="text" class="form-control form-control-sm" id="s" v-validate="'required'" :class="{'border-danger' : errors.has('txtvaocty')}">
                                                        <small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Thôi việc</label>
                                                        <input v-model="lao_dong.thoi_viec" name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" id="1" placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="label-form"></label>
                                                        <input readonly class="form-control form-control-sm" value="Tổng thời gian làm việc">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="label-form">Năm</label>
                                                        <input v-model="lao_dong.nam" name="scmnd_noi_cap" type="text" class="form-control form-control-sm" id="121" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label class="label-form">Tháng</label>
                                                        <input v-model="lao_dong.thang" name="scmnd_noi_cap" type="text" class="form-control form-control-sm" id="32" placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="label-form">Ngày</label>
                                                        <input v-model="lao_dong.ngay" name="scmnd_noi_cap" type="text" class="form-control form-control-sm" id="56" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Số HĐLĐ</label>
                                                        <input v-model="lao_dong.so_hdld" name="txtvaocty" type="text" class="form-control form-control-sm" id="txtv6r56aocty" v-validate="'required'" :class="{'border-danger' : errors.has('txtvaocty')}">
                                                        <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Ngày ký</label>
                                                        <input v-model="lao_dong.ngay_ky" name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" id="56544" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Thời hạn</label>
                                                        <input v-model="lao_dong.thoi_han" name="txtvaocty" type="text" class="form-control form-control-sm" id="txtvtaocty" v-validate="'required'" :class="{'border-danger' : errors.has('txtvaocty')}">
                                                        <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Hết hạn</label>
                                                        <input v-model="lao_dong.het_han" name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" id="tscmnd_ngay_cap" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Số BHXH</label>
                                                        <input v-model="lao_dong.so_bhxh" name="txtvaocty" type="text" class="form-control form-control-sm" id="txtvareeocty" v-validate="'required'" :class="{'border-danger' : errors.has('txtvaocty')}">
                                                        <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Số BHYT</label>
                                                        <input v-model="lao_dong.so_bhyt" name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" id="scmend_ngay_cap" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Nơi khám</label>
                                                        <input v-model="lao_dong.noi_kham" name="txtvaocty" type="text" class="form-control form-control-sm" id="t45xtvaocty" v-validate="'required'" :class="{'border-danger' : errors.has('txtvaocty')}">
                                                        <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Địa chỉ khám</label>
                                                        <input v-model="lao_dong.dia_chi_kham" name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" id="scmn545d_ngay_cap" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label class="label-form">Ghi chú</label>
                                                        <input v-model="lao_dong.ghi_chu" name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" id="scmnd545_ngay_cap" placeholder="">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                <button id="save2" type="submit" class="btn btn-primary">
                                                    <span v-if="flag_xu_ly_tt_ca_nhan"><i class="fa fa-save"></i> Lưu lại</span>
                                                    <span v-if="!flag_xu_ly_tt_ca_nhan"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</span>
                                                </button>
                                                <!--<button @click="upload_img" id="anh" type="" class="btn btn-primary">Lưu ảnh</button>-->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- END Modal thong tin lao dong -->

                            <!-- Modal thong tin cong viec -->
                            <div class="modal" id="modal_nv_tt_cong_viec"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 style="margin-right: 10px;" class="modal-title" id="exampleModalLabe3"><b>Thông tin công việc</b></h4>

                                            <button v-on:click="_cong_viec_show_hide('add')" class="btn btn-success btn-sm">Thêm mới</button>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="form_nhan_vien_thong_tin_cong_viec">
                                            <div v-loading="false" class="modal-body modal-cong-viec">
                                                <div v-if="flag_form_cong_viec" class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <form @submit.prevent="submit_nhan_vien_thong_tin_cong_viec('2')">
                                                                    <div class="row">
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">BPLV</label>
                                                                            <div class="select-lam">
                                                                                <input  v-model="cong_viec.id_bplv" id="id_bplv" name="id_eplv" type="text" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('id_eplv')}">
                                                                                <div class="body-select-lam" id="bplv">
                                                                                    <ul>
                                                                                        <li @click="show_select_lam(n,'id_bplv')" v-for="n in list_bo_phan">
                                                                                            <span>VT-001</span>
                                                                                            <span class="pull-right">{{n.ten_bo_phan}}</span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>

                                                                            <small v-show="errors.has('id_bplv')" class="help text-muted is-danger"></small>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form"></label>
                                                                            <input name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" id="1ss" placeholder="">
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Phòng</label>
                                                                            <input v-model="cong_viec.id_phong" class="form-control form-control-sm" value="">
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form"></label>
                                                                            <input name="scmnd_noi_cap" type="text" class="form-control form-control-sm" id="121d" placeholder="">
                                                                        </div>

                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Vị trí</label>
                                                                            <input v-model="cong_viec.id_vi_tri" name="id_vi_tri" type="text" class="form-control form-control-sm" id="id_vi_tri" placeholder="">
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form"></label>
                                                                            <input name="scmnd_noi_cap" type="text" class="form-control form-control-sm" id="5fv6" placeholder="">
                                                                        </div>

                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Hệ số lương</label>
                                                                            <input v-model="cong_viec.he_so" v-on:keypress="only_number_input(event)" name="he_so" type="text" class="form-control form-control-sm" id="he_so" v-validate="'required'" :class="{'border-danger' : errors.has('he_so')}">
                                                                            <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Lương cơ bản</label>
                                                                            <!--<input v-model="cong_viec.luong_co_ban" name="luong_co_ban" type="text" class="form-control form-control-sm" id="luong_co_ban" placeholder="">-->
                                                                            <vue-numeric v-model="cong_viec.luong_co_ban" class="form-control form-control-sm" separator=","></vue-numeric>
                                                                        </div>

                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Lương CVHT</label>
                                                                            <vue-numeric class="form-control form-control-sm" separator="," v-model="cong_viec.luong_cvht"></vue-numeric>
                                                                            <!--<input v-model="cong_viec.luong_cvht" name="luong_cvht" type="text" class="form-control form-control-sm" id="luong_cvht" v-validate="'required'" :class="{'border-danger' : errors.has('luong_cvht')}">-->
                                                                            <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Thời gian làm việc</label>
                                                                            <input v-model="cong_viec.thoi_gian_lam_viec" name="scmnd_thoi_gian_lam_viecngay_cap" type="text" class="form-control form-control-sm" id="thoi_gian_lam_viec" placeholder="">
                                                                        </div>

                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Tình trạng</label>
                                                                            <input v-model="cong_viec.tinh_trang" name="tinh_trang" type="text" class="form-control form-control-sm" id="tinh_trang" v-validate="'required'" :class="{'border-danger' : errors.has('tinh_trang')}">
                                                                            <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Chấm công</label>
                                                                            <input v-model="cong_viec.cham_cong" name="cham_cong" type="text" class="form-control form-control-sm" id="cham_cong" placeholder="">
                                                                        </div>

                                                                        <div class="form-group col-md-7">
                                                                            <label class="label-form">Ghi chú</label>
                                                                            <input v-model="cong_viec.ghi_chu" name="ghi_chu" type="text" class="form-control form-control-sm" id="ghi_chu">
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form"></label>
                                                                            <!--<button class="btn btn-success btn-sm">Lưu lại</button>-->
                                                                            <input type="submit" class="form-control form-control-sm btn-cong-viec-sub btn btn-primary btn-sm" value="Lưu lại">
                                                                        </div>
                                                                        <div class="form-group col-md-2">
                                                                            <label class="label-form"></label>
                                                                            <!--<button class="btn btn-success btn-sm">Lưu lại</button>-->
                                                                            <input @click="flag_form_cong_viec = false" type="button" class="form-control form-control-sm btn btn-danger btn-sm btn-cong-viec-cancel" value="Hủy">
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="!flag_form_cong_viec" class="row row-lao-dong">
                                                    <div class="col-md-12">
                                                        <h5>Danh sách công việc</h5>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <form @submit.prevent="submit_nhan_vien_thong_tin_cong_viec('1')">
                                                                    <div class="row">
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">BPLV</label>
                                                                            <input v-model="cong_viec.id_eplv" name="id_eplv" type="text" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('id_eplv')}">
                                                                            <small v-show="errors.has('id_bplv')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form"></label>
                                                                            <input name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" placeholder="">
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Phòng</label>
                                                                            <input v-model="cong_viec.id_phong" class="form-control form-control-sm" value="">
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form"></label>
                                                                            <input name="scmnd_noi_cap" type="text" class="form-control form-control-sm" placeholder="">
                                                                        </div>

                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Vị trí</label>
                                                                            <input v-model="cong_viec.id_vi_tri" name="id_vi_tri" type="text" class="form-control form-control-sm" placeholder="">
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form"></label>
                                                                            <input name="scmnd_noi_cap" type="text" class="form-control form-control-sm" placeholder="">
                                                                        </div>

                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Hệ số lương</label>
                                                                            <input v-model="cong_viec.he_so" name="he_so" type="text" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('he_so')}">
                                                                            <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Lương cơ bản</label>
                                                                            <input v-model="cong_viec.luong_co_ban" name="luong_co_ban" type="text" class="form-control form-control-sm" placeholder="">
                                                                        </div>

                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Lương CVHT</label>
                                                                            <input v-model="cong_viec.luong_cvht" name="luong_cvht" type="text" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('luong_cvht')}">
                                                                            <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Thời gian làm việc</label>
                                                                            <input v-model="cong_viec.thoi_gian_lam_viec" name="scmnd_thoi_gian_lam_viecngay_cap" type="text" class="form-control form-control-sm" placeholder="">
                                                                        </div>

                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Tình trạng</label>
                                                                            <input v-model="cong_viec.tinh_trang" name="tinh_trang" type="text" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('tinh_trang')}">
                                                                            <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form">Chấm công</label>
                                                                            <input v-model="cong_viec.cham_cong" name="cham_cong" type="text" class="form-control form-control-sm">
                                                                        </div>

                                                                        <div class="form-group col-md-9">
                                                                            <label class="label-form">Ghi chú</label>
                                                                            <input v-model="cong_viec.ghi_chu" name="ghi_chu" type="text" class="form-control form-control-sm">
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label class="label-form"></label>
                                                                            <!--<button class="btn btn-success btn-sm">Lưu lại</button>-->
                                                                            <input type="submit" class="form-control form-control-sm btn-cong-viec-sub btn btn-primary btn-sm" value="Lưu lại">
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- END Modal thong tin cong viec -->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="table_nhanvien">
                            <thead>
                                <tr style="border-top: 1px solid #ddd;">
                                    <th class="text-center">#</th>
                                    <th class="text-center">TT</th>
                                    <th style="">Mã</th>
                                    <th style="">Tên nhân viên</th>
                                    <th>G/T</th>
                                    <th>Ngày sinh</th>
                                    <th>Nơi sinh</th>
                                    <th>Số CMND</th>
                                    <th>Ngày cấp</th>
                                    <th>Nơi cấp</th>
                                    <th>Tạm trú</th>
                                    <th style="width:400px;">Thường trú</th>
                                    <th>ĐT bàn</th>
                                    <th>Di động 1</th>
                                    <th>Di động 2</th>
                                    <th>MST CN</th>
                                    <th>Ngày cấp</th>
                                    <th>Nơi cấp</th>
                                    <th class="text-center">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="loading_dsnv"><td colspan="17" class=""><b><i class="fa fa-spin fa-spinner"></i> Đang tải danh sách...</b></td></tr>
                                <tr v-if="flag"><td colspan="17" class=""><b class="error_load_nv">Lỗi không tải được danh sách vui lòng tải lại trang...</b></td></tr>
                                <tr v-if="dsnhanvien.length>0" v-for="(n, index) in dsnhanvien">
                                    <td class="text-nowrap">
                                        <button @click="_nhan_vien('edit', n)" data-toggle="modal" data-target="#modal_nv_tt_ca_nhan" class="btn btn-success btn-sm" title="Cập nhật thông tin cá nhân"> <i class="fa fa-edit"></i> </button>
                                        <button @click="_lao_dong(n)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_nv_tt_lao_dong" title="Thông tin lao động"><i class="fa fa-address-book-o"></i></button>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_nv_tt_cong_viec" title="Thông tin công việc hiện tại"><i class="fa fa-id-card-o"></i></button>
                                        <button @click="delete_all_thong_tin_nv(n.id)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                    </td>
                                    <td class="text-center">{{index + 1}}</td>
                                    <td style="width:100px;">{{n.ma_nv}}</td>
                                    <td>{{n.ho_ten}}</td>
                                    <td><span v-if="n.gioi_tinh">Nam</span><span v-else>Nữ</span></td>
                                    <td>{{n.ngay_sinh}}</td>
                                    <td>{{n.noi_sinh}}</td>
                                    <td>{{n.so_cmnd}}</td>
                                    <td>{{n.scmnd_ngay_cap}}</td>
                                    <td>{{n.scmnd_noi_cap}}</td>
                                    <td class="hidden-text" style="width:400px;">{{n.tam_tru}}</td>
                                    <td class="hidden-text" style="width:400px;">{{n.thuong_tru}}</td>
                                    <td>{{n.dt_ban}}</td>
                                    <td>{{n.di_dong_1}}</td>
                                    <td>{{n.di_dong_2}}</td>
                                    <td>{{n.mst_cn}}</td>
                                    <td>{{n.mst_cn_noi_cap}}</td>
                                    <td class="hidden-text">{{n.cc_thue_cap}}</td>
                                    <td class="text-center">Chính thức</td>
                                </tr>
                            </tbody>
                        </table>
                        <el-pagination
                                :page-size="10"
                                layout="prev, pager, next"
                                :total="dsnhanvien_total"
                                @current-change="getNhanVien">
                        </el-pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {api_add_nhan_vien_thong_tin_ca_nhan} from "./nhan_vien";
    import {api_get_nhan_vien} from "./nhan_vien";
    import {api_edit_nhan_vien_thong_tin_ca_nhan} from "./nhan_vien";
    import {api_add_nhan_vien_thong_tin_lao_dong} from "./nhan_vien";
    import {api_get_nhan_vien_thong_tin_lao_dong} from "./nhan_vien";
    import {api_search_thong_tin_nhan_vien} from "./nhan_vien";
    import {api_delete_all_thong_tin_nhan_vien} from "./nhan_vien";

    import {api_get_tinh} from "../../../helper/tinh_thanh";
    import {api_get_quan_huyen} from "../../../helper/tinh_thanh";
    import {api_get_phuong_xa} from "../../../helper/tinh_thanh";

    import {api_get_all_bo_phan} from "../bophan/bo_phan";

    export default {
        name: 'danhsachnhanvien',
        mounted (){
            this.getNhanVien();
            api_get_tinh(this);
            api_get_quan_huyen(this);
            api_get_phuong_xa(this);
        },
        computed: {
            danh_sach_nhan_vien() {
                return this.dsnhanvien;
            },
            total() {
                return this.dsnhanvien_total;
            }
        },
        data(){
            return {
                list_tinh_thanh: [],
                tinh_thanh: null,
                value: null,
                list_quan_huyen: [],
                change_quan_huyen: [],
                quan_huyen: '',
                list_phuong_xa: [],
                change_phuong_xa: [],
                phuong_xa: '',
                loading_bo_phan: true,
                flag_input_ma_nv: false,
                dsnhanvien: [],
                key_word: '',
                dsnhanvien_total: 0,
                loading_dsnv: false,
                flag: false,
                flag_submit_nhan_vien_tt_ca_nhan: true,
                flag_disabled_tt_ca_nhan: false,
                flag_input_nhan_vien_tt: false,
                flag_xu_ly_tt_ca_nhan: true,
                nhan_vien: {
                    id: 0,
                    ma_nv: '',
                    ho_ten: '',
                    ngay_sinh: '',
                    noi_sinh: '',
                    quoc_tich: '',
                    gioi_tinh: '',
                    so_cmnd: '',
                    scmnd_noi_cap: '',
                    scmnd_ngay_cap: '',
                    thuong_tru: '',
                    tam_tru: '',
                    di_dong_1: '',
                    di_dong_2: '',
                    dt_ban: '',
                    mst_cn: '',
                    mst_cn_noi_cap: '',
                    cc_thue_cap: '',
                    avatar: '',
                    image: ''
                },
                lao_dong:{
                    vao_cty: '',
                    nv_id: '',
                    thoi_viec: '',
                    nam: '',
                    thang: '',
                    ngay: '',
                    so_hdld: '',
                    ngay_ky: '',
                    thoi_han: '',
                    het_han: '',
                    so_bhxh: '',
                    so_bhyt: '',
                    noi_kham: '',
                    dia_chi_kham: '',
                    ghi_chu: ''
                },
                loading_lao_dong: true,
                flag_xu_ly_tt_lao_dong: true,
                cong_viec: {
                    id_bplv: '',
                    id_phong: '',
                    id_vi_tri: '',
                    he_so: 0,
                    luong_co_ban: 0,
                    luong_cvht: 0,
                    thoi_gian_lam_viec: '',
                    tinh_trang: '',
                    cham_cong: '',
                    ghi_chu: ''
                },
                flag_form_cong_viec: false,
                list_bo_phan: [],
                list_phong_ban: [],
                list_vi_tri: []
            }
        },
        methods: {
            load_quan_huyen: function (id_tinh) {
                this.change_quan_huyen = this.list_quan_huyen.filter(function(item){
                    return (item['ma_tinh'] == id_tinh);
                })
                console.log(this.change_quan_huyen);
            },
            show_select_lam: function (data_select, id_select) {
                $('#' + id_select).val(data_select.ten_bo_phan);
            },
            only_number_input: function (evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                    evt.preventDefault();;
                } else {
                    return true;
                }
            },
            validate_ma_nv: function () {
                console.log(this.nhan_vien.ma_nv);
                var length_nv = this.nhan_vien.ma_nv.length;
                var value_nv  = this.nhan_vien.ma_nv;
                if((length_nv > 7 || length_nv < 7) || value_nv.indexOf('KH') == -1){
                    this.flag_input_ma_nv = true;
                    this.flag_disabled_tt_ca_nhan = true;
                }
                else{
                    this.flag_input_ma_nv = false;
                    this.flag_disabled_tt_ca_nhan = false;
                }
            },
            onFileChange: function (e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length) return;
                this.createImage(files[0]);
                let reader = new FileReader();
            },
            createImage: function(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.nhan_vien.image = e.target.result;
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                    // console.log(vm.nhan_vien.image);
                };
                reader.readAsDataURL(file);
            },

            delete_all_thong_tin_nv: function (id_nhan_vien) {
                api_delete_all_thong_tin_nhan_vien(this, id_nhan_vien);
            },
            getNhanVien(page = 1) {
                this.loading_dsnv = true;
                api_get_nhan_vien(this, page);
            },
            add_nhan_vien_thong_tin_ca_nhan: function () {
                api_add_nhan_vien_thong_tin_ca_nhan(this);
            },
            edit_nhan_vien_thong_tin_ca_nhan: function () {
                api_edit_nhan_vien_thong_tin_ca_nhan(this);
            },
            _nhan_vien: function (state, nv= null) {
                if(state == 'add') {
                    this.flag_submit_nhan_vien_tt_ca_nhan = true;
                    this.flag_input_nhan_vien_tt = false;
                    $('#wizardPicturePreview').attr('src', 'https://cdn0.vox-cdn.com/images/verge/default-avatar.v9899025.gif').fadeIn('slow');
                    this.nhan_vien = {
                        id: 0,
                        ma_nv: '',
                        ho_ten: '',
                        ngay_sinh: '',
                        noi_sinh: '',
                        quoc_tich: '',
                        gioi_tinh: '',
                        so_cmnd: '',
                        scmnd_noi_cap: '',
                        scmnd_ngay_cap: '',
                        thuong_tru: '',
                        tam_tru: '',
                        di_dong_1: '',
                        di_dong_2: '',
                        dt_ban: '',
                        mst_cn: '',
                        mst_cn_noi_cap: '',
                        cc_thue_cap: '',
                        avatar: '',
                        image: ''
                    }
                }
                else {
                    var lma = this.list_tinh_thanh.filter(function (item) {
                        return (item['ma_tinh'] == nv.scmnd_noi_cap);
                    });
                    console.log(lma);
                    this.value = lma[0];
                    console.log(this.value);
                    this.nhan_vien = nv;
                    if (nv.avatar != null){
                        $('#wizardPicturePreview').attr('src', 'public/image_nhan_vien/' + nv.avatar).fadeIn('slow');
                    }else{$('#wizardPicturePreview').attr('src', 'https://cdn0.vox-cdn.com/images/verge/default-avatar.v9899025.gif').fadeIn('slow');}
                    this.flag_submit_nhan_vien_tt_ca_nhan = false;
                    this.flag_input_nhan_vien_tt = true;
                }
            },
            submit_nhan_vien_thong_tin_ca_nhan: function () {
                this.change_bnt_save('save');
                if(this.flag_submit_nhan_vien_tt_ca_nhan) {
                    this.flag_input_nhan_vien_tt = false;
                    this.add_nhan_vien_thong_tin_ca_nhan();
                }
                else {
                    this.change_bnt_save('save');
                    this.nhom = this.nhom_selected;
                    this.flag_input_nhan_vien_tt = true;
                    this.edit_nhan_vien_thong_tin_ca_nhan();
                }
            },
            change_bnt_save: function (id_btn) {
                this.flag_xu_ly_tt_ca_nhan = false;
                $('#' + id_btn).attr('disabled', 'disabled');
            },
            un_change_bnt_save: function (id_btn) {
                this.flag_xu_ly_tt_ca_nhan = true;
                $('#' + id_btn).removeAttr('disabled');
            },
            upload_img: function () {
                console.log(this.nhan_vien.image);
                axios({
                    method: 'POST',
                    url: 'api/image-upload',
                    headers: {'Authorization':'Bearer ' + this.$store.state.currentUser.token},
                    data: this.$data.nhan_vien
                })
                    .then((response) => {
                        console.log(response.data);
                    })
                    .catch((error) => {
                        return -1;
                    })
            },
            _lao_dong: function (nv) {
                this.loading_lao_dong = true;
                api_get_nhan_vien_thong_tin_lao_dong(this, nv.id);
            },
            submit_nhan_vien_thong_tin_lao_dong: function () {
                this.change_bnt_save('save2');
                api_add_nhan_vien_thong_tin_lao_dong(this);
            },
            _cong_viec_show_hide: function (state) {
                this.flag_form_cong_viec = true;
                api_get_all_bo_phan(this);
            },
            submit_nhan_vien_thong_tin_cong_viec: function (id) {
                console.log("Dang submit day" + id);
            },
            submit_search_thong_tin_nhan_vien: function () {
                this.loading_dsnv = true;
                api_search_thong_tin_nhan_vien(this, 1);
            }
        }
    }
</script>

<style media="screen" scoped>
    .m-t-40 {
    margin-top: 0px !important;
    }
    #timkiem{
        width: 100%;
        position: relative;
        padding-right: 87px;
        font-size: 13px;
    }

    .btntimkiem{
        position: absolute;
        top: 3px;
        right: 18px;
        height: 37px;
        font-size: 13px;
        height: 32px;
        padding: 5px 13px;
    }

    .error_load_nv{
        color: #ff7a6e;
    }

    .form-group {
        margin-bottom: 0px;
    }

    .label-form {
        font-weight: 500;
        font-size: 13px;
        margin-bottom: 0;
    }

    .wizard-card .picture-container {
        position: relative;
        cursor: pointer;
        text-align: center;
    }

    .wizard-card .picture {
        width: 106px;
        height: 106px;
        background-color: #999999;
        border: 4px solid #CCCCCC;
        color: #FFFFFF;
        border-radius: 1px;
        margin: 5px auto;
        overflow: hidden;
        transition: all 0.2s;
        -webkit-transition: all 0.2s;
    }

    .wizard-card .picture:hover {
        border-color: #2ca8ff;
    }

    .wizard-card.ct-wizard-azzure .picture:hover {
        border-color: #2CA8FF;
    }

    .wizard-card.ct-wizard-green .picture:hover {
        border-color: #05ae0e;
    }

    .wizard-card.ct-wizard-blue .picture:hover {
        border-color: #3472f7;
    }

    .wizard-card.ct-wizard-orange .picture:hover {
        border-color: #ff9500;
    }

    .wizard-card.ct-wizard-red .picture:hover {
        border-color: #ff3b30;
    }

    .wizard-card .picture input[type="file"] {
        cursor: pointer;
        display: block;
        height: 100%;
        left: 0;
        opacity: 0 !important;
        position: absolute;
        top: 0;
        width: 100%;
    }

    .wizard-card .picture-src {
        width: 100%;
    }

    wizard-card{
        margin-top: -5px;
    }

    #form_nhan_vien_thong_tin_lao_dong .modal-lao-dong {
        height: 100%;
        width: 100%;
        background-color: white;
    }

    #form_nhan_vien_thong_tin_lao_dong .modal-lao-dong::before {
        height: 100%;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }

    .modal-cong-viec{
        background-color: #ddddff;
        max-height: 480px;
        overflow: auto;
    }

    .btn-cong-viec-sub{
        color: #fff;
    }

    .btn-cong-viec-cancel {
        color: #fff;
    }

    .select-lam {
        position: relative !important;
    }
    .select-lam:hover .body-select-lam {
        display: block;
    }

    .body-select-lam {
        position: absolute;
        top: 33px;
        left: 0;
        width: 100%;
        z-index: 200;
        max-height: 200px;
        overflow-y: auto;
        display: none;
        transition: ease;
    }

    .body-select-lam ul {
        padding: 0;
        border: 1px solid #ddddff;
        background-color: #fff;
        font-size: 13px;
        color: black;
        font-weight: 500;
    }

    .body-select-lam ul li {
        list-style-type: none;
        padding: 5px;
        cursor: pointer;
    }

    .body-select-lam ul li:hover {
        background-color: #ddd;
    }

    .active-select-lamv {
        display: block;
    }

</style>
