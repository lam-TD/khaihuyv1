<template>
    <div class="page-wrapper" style="min-height: 291px;">
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-lg-12 col-md-12 lamlam">
                    <!-- Column -->
                    <div class="card content-lam">
                        <div class="card-header">
                            <div class="card-actions">
                                <a @click="scroll_card_full_creem" id="phongto" class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                            </div>
                            <h4 class="card-title m-b-0">Thông tin công việc</h4>
                        </div>
                        <div class="card-body">
                            <div class="row" style="padding-bottom:6px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <form @submit.prevent="search_ttcv" id="formttcv">
                                            <input v-model="keyword" type="text" id="timkiem" class="form-control" placeholder="Nhập từ khóa để tìm kiếm...">
                                            <button type="submit" class="btn btn-info btn-sm btntimkiem" name="button">Tìm kiếm</button>
                                            <!--<button v-if="flag_search" @click="tat_ca_danh_sach" type="button" class="btn btn-primary btn-sm btntatca" name="button">Tất cả</button>-->
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button @click="_ttcv('add')" title="Thêm mới bộ phận" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-dark pull-right">
                                        <i class="fa fa-plus-circle"></i> Thêm mới
                                    </button>
                                </div>
                            </div>
                            <div class="message-box contact-box">
                                <!--<h2 class="add-ct-btn">-->

                                <!--</h2>-->
                                <div class="message-widget contact-widget">
                                    <div class="row">
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <el-table :data="list_ttcv" border style="width: 100%">
                                                <el-table-column label="#" width="90" align="center">
                                                    <template slot-scope="scope" class="text-center" style="width: 100%">
                                                        <button @click="_ttcv('edit', scope.row)" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm" title="Cập nhật thông tin cá nhân"> <i class="fa fa-edit"></i> </button>
                                                        <button @click="delete_ttcv(scope.row)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column type="index" label="TT" :index="indexMethod" align="center"></el-table-column>
                                                <el-table-column prop="ma_nv" label="Mã NV" width="180"></el-table-column>
                                                <el-table-column prop="ho_ten" label="Tên NV"></el-table-column>
                                                <el-table-column prop="tinh_trang" label="Tình trạng"></el-table-column>
                                                <el-table-column prop="ghi_chu" label="Ghi chú"></el-table-column>
                                            </el-table>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row tb-row-hienthi">
                                                <div class="col-md-2 tb-label">
                                                    Tổng: 100 TTCV
                                                </div>
                                                <div class="col-md-1 tb-label">
                                                    <span>Hiển thị</span>
                                                </div>
                                                <div class="col-md-1 tb-hienthi">
                                                    <el-select v-model="value" placeholder="10" size="small">
                                                        <el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-md-8">
                                                    <el-pagination :page-size="10" layout="prev, pager, next" :total="total_ttcv" @current-change="danh_sach_ttcv"></el-pagination>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAL THONG TIN CON VIEC-->
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form @submit.prevent="submit_ttcv" id="form_bophan">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Thông tin công việc</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div :disabled="flag_body_modal" class="modal-body">
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Nhân viên(*)</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input v-model="ttcv.nv_ma" type="text" id="txtnhanvien-sua" class="form-control form-control-sm" readonly>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <el-select v-model="nhan_vien" @change="select_nv" :disabled="flag_disable_manv" value-key="ma_nv" filterable size="small" placeholder="Chọn nhân viên" style="width: 100%" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                                    <!--<template slot="prefix"><label class="prefix">{{nhan_vien.ma_nv}}</label></template>-->
                                                                    <el-option  v-for="item in list_nhan_vien"
                                                                                :key="item.ma_nv"
                                                                                :label="item.ho_ten"
                                                                                :value="item">
                                                                        <span style="float: left">{{ item.ma_nv }}</span>
                                                                        <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ho_ten }}</span>
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Ngày</label>
                                                    <div class="col-md-9">
                                                        <input v-model="ttcv.ngay" name="so_ttcv" type="date" class="form-control form-control-sm">
                                                        <small v-show="errors.has('so_ttcv')" class="help text-muted is-danger">Vui lòng nhập số bảo hiểm y tết</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Tình trạng</label>
                                                    <div class="col-md-9">
                                                        <select v-model="ttcv.tinh_trang" name="" id="" class="form-control form-control-sm" style="width:100%">
                                                            <option value="0">Thử việc</option>
                                                            <option value="1">Chính thức</option>
                                                            <option value="2">Thôi việc</option>
                                                        </select>
                                                        <!--<small v-show="errors.has('so_bhxh')" class="help text-muted is-danger">Vui lòng nhập số bảo hiểm xã hội</small>-->
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Bộ phận LV</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="bo_phan" filterable size="small" placeholder="Chọn bộ phận" style="width: 100%" @change="select_bo_phan" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<template slot="prefix"><label class="prefix">{{nhan_vien.ma_nv}}</label></template>-->
                                                            <el-option
                                                                    v-for="item in list_bo_phan"
                                                                    :key="item.id"
                                                                    :label="item.ma_bo_phan"
                                                                    :value="item.ma_bo_phan">
                                                                <span style="float: left">{{ item.ma_bo_phan }}</span>
                                                                <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ten_bo_phan }}</span>
                                                            </el-option>
                                                        </el-select>
                                                        <small v-show="errors.has('so_bhxh')" class="help text-muted is-danger">Vui lòng nhập số bảo hiểm xã hội</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Phòng</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="phong_ban" size="small" placeholder="Chọn phòng" style="width: 100%" @change="select_phong" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<template slot="prefix"><label class="prefix">{{nhan_vien.ma_nv}}</label></template>-->
                                                            <el-option
                                                                    v-for="item in list_change_phong"
                                                                    :key="item.id"
                                                                    :label="item.ma_phong"
                                                                    :value="item.ma_phong">
                                                                <span style="float: left">{{ item.ma_phong }}</span>
                                                                <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ten_phong }}</span>
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Vị trí</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="ttcv.vi_tri_ma" filterable size="small" placeholder="Chọn phòng" style="width: 100%" @change="select_vi_tri" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<template slot="prefix"><label class="prefix">{{nhan_vien.ma_nv}}</label></template>-->
                                                            <el-option
                                                                    v-for="item in list_vi_tri"
                                                                    :key="item.ma_vi_tri"
                                                                    :label="item.ma_vi_tri"
                                                                    :value="item.ma_vi_tri">
                                                                <span style="float: left">{{ item.ma_vi_tri }}</span>
                                                                <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ten_vi_tri }}</span>
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Hệ số lương</label>
                                                    <div class="col-md-9">
                                                        <input v-on:keypress="only_number_input" v-model="ttcv.he_so_luong" name="txtngaykt" type="text" class="form-control form-control-sm">
                                                        <!--<vue-numeric class="form-control form-control-sm" separator="," v-model="ttcv.he_so_luong"></vue-numeric>-->
                                                        <!--<small v-show="errors.has('txtngaykt')" class="help text-muted is-danger">Vui lòng nhập ngày kết thúc</small>-->
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Lương cơ bản</label>
                                                    <div class="col-md-9">
                                                        <!--<vue-numeric class="form-control form-control-sm" separator="," v-model="ttcv.luong_co_ban"></vue-numeric>-->
                                                        <input v-on:keypress="only_number_input" v-model="ttcv.luong_co_ban" name="txtngaykt" type="text" class="form-control form-control-sm">
                                                        <!--<small v-show="errors.has('txtngaykt')" class="help text-muted is-danger">Vui lòng nhập ngày kết thúc</small>-->
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Lương HTCV</label>
                                                    <div class="col-md-9">
                                                        <input v-on:keypress="only_number_input" v-model="ttcv.htcv" name="htcv" type="text" class="form-control form-control-sm">
                                                        <!--<vue-numeric class="form-control form-control-sm" separator="," v-model="ttcv.htcv"></vue-numeric>-->
                                                        <!--<small v-show="errors.has('txtngaykt')" class="help text-muted is-danger">Vui lòng nhập ngày kết thúc</small>-->
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Chấm công</label>
                                                    <div class="col-md-9">
                                                        <el-radio-group v-model="cham_cong">
                                                            <el-radio :label="1">Có</el-radio>
                                                            <el-radio :label="0">Không</el-radio>
                                                        </el-radio-group>
                                                    </div>
                                                </div>

                                                <div v-show="cham_cong" class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Thời gian LV</label>
                                                    <div class="col-md-4">
                                                        <!--<input v-model="ttcv.thoi_gian_lv_bd" name="txtngaykt" type="time" class="form-control form-control-sm">-->
                                                        <el-time-select placeholder="Bắt đầu" v-model="ttcv.thoi_gian_lv_bd" :picker-options="{ start: '06:00', step: '00:30', end: '23:30' }" size="small">
                                                        </el-time-select>
                                                        <!--<small v-show="errors.has('txtngaykt')" class="help text-muted is-danger">Vui lòng nhập ngày kết thúc</small>-->
                                                    </div>
                                                    <label class="label-form col-md-1 col-form-label">-></label>
                                                    <div class="col-md-4">
                                                        <!--<input v-model="ttcv.thoi_gian_lv_kt" name="" type="time" class="form-control form-control-sm">-->
                                                        <el-time-select placeholder="Kết thúc" v-model="ttcv.thoi_gian_lv_kt" :picker-options="{ start: '06:00', step: '00:30', end: '23:30' }" size="small">
                                                        </el-time-select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Ghi chú</label>
                                                    <div class="col-md-9">
                                                        <textarea v-model="ttcv.ghi_chu" name="" id="" class="form-control form-control-sm"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                                <!--<button id="save" type="submit" class="btn btn-primary">Lưu lại</button>-->
                                                <button :disabled="flag_disabled_submit || errors.has('txttenbophan')" id="save" type="submit" class="btn btn-primary">
                                                    <span v-if="flag_btn_save"><i class="fa fa-save"></i> Lưu lại</span>
                                                    <span v-if="!flag_btn_save"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- END MODAL THONG TIN CON VIEC-->
                        </div>
                    </div>
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
    </div>
</template>

<script>
    import {api_get_all_ttcv} from './thong_tin_cong_viec';
    import {api_add_ttcv} from "./thong_tin_cong_viec";
    import {api_edit_ttcv} from "./thong_tin_cong_viec";
    import {api_delete_ttcv} from "./thong_tin_cong_viec";
    import {select_lam} from "../../helper/selectlam";
    import {api_search_all_ttcv} from "./thong_tin_cong_viec";
    import {api_nhan_vien_get_all_no_pa} from "../../helper/nhan_vien";

    import {api_get_all_bo_phan} from "../bophan/bo_phan";
    import {api_get_all_phong_ban_no_paginate} from "../phongban/phong_ban";
    import {api_get_vi_tri_all_theo_phong} from "./thong_tin_cong_viec";

    export default {
        name: 'bophan',
        mounted () {
            this.danh_sach_ttcv(1);
            api_nhan_vien_get_all_no_pa(this);
            api_get_all_bo_phan(this);
            api_get_all_phong_ban_no_paginate(this);
        },
        updated () {
            $(document).ready(function() {
                $('.select2').select2();
            });
        },
        data () {
            return {
                list_bo_phan: [],
                list_phong_ban: [],
                bo_phan: '',
                phong_ban: '',
                vi_tri: '',
                list_change_phong: [],
                list_vi_tri: [],
                nhan_vien: '',
                list_nhan_vien: '',
                flag_nhan_vien: true,
                loading_ttcv: true,
                flag_search: false,
                keyword: '',
                list_ttcv: [],
                total_ttcv: 0,
                ttcv: { id: 0, ngay: '', tinh_trang: '', he_so_luong: '', luong_co_ban: '', htcv:'', ghi_chu: '', nv_ma: '', bo_phan_ma: '', phong_ma: '', vi_tri_ma: '', thoi_gian_lv_bd: '', thoi_gian_lv_kt: '', cham_cong: 0 },
                cham_cong: 0,
                flag_btn: true,
                flag_submit_ttcv: true,
                flag_input_ttcv: false,
                flag_body_modal: false,
                flag_btn_save: true,
                flag_disabled_submit: false,
                flag_input_ma_ttcv: false,
                flag_disable_manv: false,
                index_ttcv: 1,
                options_display: [10,20,30]
            }
        },
        methods: {
            select_bo_phan: function (id_bp) {
                this.ttcv.bo_phan_ma = id_bp;
                this.list_change_phong = this.list_phong_ban.filter(function(item){
                    return (item['id_bo_phan'] == id_bp);
                })
            },
            select_phong: function (id_bp) {
                api_get_vi_tri_all_theo_phong(this, id_bp);
                this.ttcv.phong_ma = id_bp;
            },
            select_vi_tri: function (id_vt) {
                this.ttcv.vi_tri_ma = id_vt;
            },
            validate_ma_bp: function () {
                var length_nv = this.ttcv.ma_ttcv.length;
                var value_nv  = this.ttcv.ma_ttcv;
                if((length_nv > 8 || length_nv < 8) || value_nv.indexOf('BP') == -1 || value_nv.indexOf(' ') > -1){
                    this.flag_input_ma_ttcv = true;
                    this.flag_disabled_submit = true;
                }
                else{
                    this.flag_input_ma_ttcv = false;
                    this.flag_disabled_submit = false;
                }
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
            select_nv: function (nv) {
                this.ttcv.nv_ma = nv.ma_nv;
            },
            search_ttcv: function (page = 1) {
                if(this.keyword == '' || this.keyword == null) {this.flag_search = false; this.danh_sach_ttcv();}
                this.flag_search = true;
                api_search_all_ttcv(this, page);
            },
            tat_ca_danh_sach: function () {
                this.flag_search = false;
                api_get_all_ttcv(this, 1);
            },
            danh_sach_ttcv: function (page = 1) {
                this.loading_ttcv = true;
                if(this.flag_search){
                    api_search_all_ttcv(this, page);
                }
                else{
                    api_get_all_ttcv(this, page);
                }
            },
            format_ttcv: function(){
                this.ttcv = { id: 0, ngay: '', tinh_trang: '', he_so_luong: '', luong_co_ban: '', htcv:'', ghi_chu: '', nv_ma: '', bo_phan_ma: '', phong_ma: '', vi_tri_ma: '', thoi_gian_lv_bd: '', thoi_gian_lv_kt: '', cham_cong: 0 };
                this.cham_cong = 0;
                this.nhan_vien = '';
                this.bo_phan = this.phong_ban = this.vi_tri= '';
            },
            _ttcv: function (state, cv = null) {
                if(state == 'add') {
                    this.flag_nhan_vien = true;
                    this.flag_btn = true;
                    this.flag_submit_ttcv = true;
                    this.flag_input_ttcv = false;
                    this.flag_disable_manv = false;
                    this.format_ttcv();
                }
                else {
                    this.flag_nhan_vien = false;
                    this.bo_phan = cv.bo_phan_ma;
                    this.phong_ban = cv.phong_ma;
                    this.vi_tri = cv.vi_tri_ma;
                    this.cham_cong = cv.cham_cong;
                    this.nhan_vien = this.list_nhan_vien.filter(function(item){
                        return (item['ma_nv'] == cv.ma_nv);
                    })[0];
                    this.flag_disable_manv = true;
                    this.flag_submit_ttcv = false;
                    this.flag_input_ttcv = true;

                    this.ttcv.id = cv.cv_id;
                    this.ttcv.ngay = cv.ngay; this.ttcv.tinh_trang = cv.tinh_trang; this.ttcv.he_so_luong = cv.he_so_luong;
                    this.ttcv.luong_co_ban = cv.luong_co_ban; this.ttcv.htcv = cv.htcv; this.ghi_chu = cv.ghi_chu;
                    this.ttcv.nv_ma = cv.nv_ma; this.ttcv.bo_phan_ma; this.ttcv.phong_ma = cv.phong_ma;this.ttcv.vi_tri_ma = cv.vi_tri_ma;
                    this.ttcv.thoi_gian_lv_bd = cv.thoi_gian_lv_bd; this.ttcv.thoi_gian_lv_kt = cv.thoi_gian_lv_kt; this.ttcv.cham_cong = cv.cham_cong;
                }
            },
            submit_ttcv: function () {
                this.change_bnt_save();
                this.ttcv.cham_cong = this.cham_cong;
                if(this.flag_submit_ttcv) {
                    this.flag_input_ttcv = false;
                    this.add_ttcv();
                }
                else {
                    // this.ttcv.cham_cong = this.cham_cong;
                    this.ttcv.bo_phan_ma = this.bo_phan;
                    this.ttcv.phong_ma = this.phong_ban;
                    this.ttcv.vi_tri_ma = this.vi_tri;
                    this.flag_input_ttcv = true;
                    this.edit_ttcv();
                }
            },
            click_ttcv: function (bp) {
                $('.row-nhom').removeClass("active-click-row");
                $('#n' + bp.id).addClass("active-click-row");
            },
            add_ttcv: function () {
                api_add_ttcv(this);
            },
            edit_ttcv: function() {
                api_edit_ttcv(this);
            },
            delete_ttcv: function(bh) {
                this.ttcv.id = bh.cv_id;
                if(this.ttcv.id <= 0) return -1;
                api_delete_ttcv(this);
            },
            change_bnt_save: function () {
                this.flag_btn_save = false;
                $('#save').attr('disabled', 'disabled');
            },
            un_change_bnt_save: function () {
                this.flag_btn_save = true;
                $('#save').removeAttr('disabled');
            },
            scroll_card_full_creem: function () {
                $('#phongto').closest('.card').find('[data-action="expand"] i').toggleClass('mdi-arrow-expand mdi-arrow-compress');
                $('#phongto').closest('.card').toggleClass('card-fullscreen');
            }
        }
    }
</script>

<style scoped>
    .row-nhom:hover {
        cursor: pointer;
        color: black;
    }

    .row-phong:hover {
        cursor: pointer;
        color: black;
    }

    .demo-checkbox label, .demo-radio-button label{
        min-width: 0px !important;
        height: 0;
    }

    .body-table::before {
        background-color: black;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .bg-inverse {
        background-color: white;
        padding-bottom: 0;
    }

    .card-body {
        padding-top: 10px;
    }

    .card-title {
        font-weight: 600;
    }

    .row-title {
        padding-top: 6px;
    }

    .form-group {
        margin-bottom: 5px;
    }

    .prefix {
        margin-top: 5px;
    }

    @media (min-width: 576px){
        .modal-dialog {
            max-width: 600px;
        }
    }

    .el-radio-group {
        padding-top: 8px;
    }

    .el-date-editor.el-input, .el-date-editor.el-input__inner {
        width: 100% !important;
    }

    th.thutu {
        max-width: 50px !important;
    }

    /*table {*/
        /*border-collapse: collapse;*/
        /*width: 100%;*/
        /*overflow-x: auto;*/
        /*display: block;*/
    /*}*/
    /*thead {*/
        /*!*background-color: #EFEFEF;*!*/
    /*}*/
    /*thead, tbody {*/
        /*display: block;*/
    /*}*/
    /*tbody {*/
        /*overflow-y: auto;*/
        /*overflow-x: hidden;*/
        /*height: 300px;*/
    /*}*/
    /*td{*/
        /*!*border: dashed 1px lightblue;*!*/
        /*overflow:hidden;*/
        /*white-space: nowrap;*/
        /*text-overflow: ellipsis;*/
    /*}*/

</style>