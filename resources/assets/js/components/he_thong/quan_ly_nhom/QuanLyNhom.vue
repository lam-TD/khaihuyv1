<template>
    <div class="page-wrapper" style="min-height: 291px;">
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12 lamlam">
                    <div class="card content-lam">
                        <div class="card-header">
                            <div class="card-actions">
                                <!--<a @click="_nguoi_dung('add')" title="Thêm mới bộ phận" data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-dark btn-white" style="color: white"><i class="fa fa-plus-circle"></i> Thêm mới</a>-->
                                <!--<a @click="scroll_card" id="thunho" class="" data-action="collapse"><i class="ti-minus"></i></a>-->
                                <a @click="scroll_card_full_creem" id="phongto" class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                <!--<a class="btn-close" data-action="close"><i class="ti-close"></i></a>-->
                            </div>
                            <h4 class="card-title m-b-0">Danh sách nhóm tài khoản</h4>
                            <!--<h6 class="card-subtitle m-0 op-5">Tổng số bộ phận: {{total_nguoi_dung}}</h6>-->
                        </div>
                        <div class="card-body collapse show">
                            <div class="message-box contact-box">
                                <div class="message-widget contact-widget">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <form @submit.prevent="submit_search">
                                                        <el-input placeholder="Tìm kiếm tài khoản" size="small" suffix-icon="el-icon-search" v-model="keyword"></el-input>
                                                    </form>
                                                </div>
                                                <div class="col-md-7">
                                                    <button @click="_nhom_nguoi_dung('add')" data-toggle="modal" data-target="#myModaladd" title="Thêm mới nhóm người dùng" class="btn btn-success btn-sm pull-right" style="height: 32px;"><i class="fa fa-plus-circle"></i> Thêm mới</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <el-table :data="list_nhom_nguoi_dung_paginate" border style="width: 100%">
                                                <el-table-column label="#" width="90" align="center" class-name="center-text">
                                                    <template slot-scope="scope" align="center">
                                                        <div class="text-center">
                                                            <button @click="_nhom_nguoi_dung('edit', scope.row)" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm" title="Cập nhật thông tin bộ phận"> <i class="fa fa-edit"></i> </button>
                                                            <button @click="delete_nhom_nguoi_dung(scope.row)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                                        </div>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column type="index" label="TT" align="center" width="40" class-name="center-text">
                                                    <template slot-scope="scope">
                                                        {{count_tt(scope.row)}}
                                                    </template>
                                                </el-table-column>
                                                <el-table-column prop="ma_nhom" label="Mã nhóm" width="200" class-name="no-center-text"></el-table-column>
                                                <el-table-column prop="ten_nhom" label="Tên nhóm" width="250" class-name="no-center-text"></el-table-column>
                                                <el-table-column prop="ghi_chu" label="Ghi chú" class-name="no-center-text"></el-table-column>
                                            </el-table>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row tb-row-hienthi">
                                                <div class="col-md-1 col-sm-2 col-8 tb-label pr-0" style="padding-left: 15px;">
                                                    <span>Hiển thị</span>
                                                </div>
                                                <div class="col-md-1 col-sm-2 col-4 tb-hienthi" style="padding-left: 4px;">
                                                    <el-select v-model="limit" placeholder="10" size="small" @change="danh_sach_nhom_nguoi_dung(1)">
                                                        <el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-md-8 col-sm-4 col-6" style="padding-left: 0px;">
                                                    <el-pagination :page-size="limit" layout="prev, pager, next" :total="total_nhom_nguoi_dung" @current-change="danh_sach_nhom_nguoi_dung"></el-pagination>
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-6 tb-label">
                                                    <span class="pull-right">Tổng: {{total_nhom_nguoi_dung}} nhóm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--////-->
                                </div>
                            </div>

                            <!--Modal add-->
                            <div class="modal" id="myModaladd">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form @submit.prevent="submit_add_nhom_nguoi_dung" id="form_bop">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Thông tin nhóm người dùng</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div v-if="flag_submit_nguoi_dung" class="form-group row">
                                                    <label class="col-md-2 col-form-label label-dd">Mã nhóm</label>
                                                    <div class="col-md-4 col-dd">
                                                        <!--<el-input v-validate="'required'" v-model="nhom_nguoi_dung.ma_nhom" size="small"></el-input>-->
                                                        <input name="txtmanhom" v-validate="'required'" v-bind:maxlength="10" v-model="nhom_nguoi_dung.ma_nhom" type="text" class="form-control form-control-sm">
                                                        <small v-show="nhom_nguoi_dung.ma_nhom == ''" class="help text-muted is-danger">Vui lòng nhập mã nhóm</small>
                                                    </div>

                                                    <label class="col-md-2 col-form-label label-dd">Tên nhóm</label>
                                                    <div class="col-md-4 col-dd">
                                                        <!--<el-input v-model="nhom_nguoi_dung.ten_nhom" size="small"></el-input>-->
                                                        <input name="txtmanhom" v-validate="'required'" v-bind:maxlength="100" v-model="nhom_nguoi_dung.ten_nhom" type="text" class="form-control form-control-sm">
                                                        <small v-show="nhom_nguoi_dung.ten_nhom == ''" class="help text-muted is-danger">Vui lòng nhập tên nhóm</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 col-form-label label-dd">Ghi chú</label>
                                                    <div class="col-md-10 col-dd">
                                                        <!--<el-input v-model="nhom_nguoi_dung.ghi_chu" size="small"></el-input>-->
                                                        <input name="txtmanhom" v-validate="'required'" v-bind:maxlength="200" v-model="nhom_nguoi_dung.ghi_chu" type="text" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-12 col-form-label label-dd">Danh sách tài khoản chưa có nhóm</label>
                                                    <div class="col-md-12">
                                                        <el-table ref="multipleTable" :data="list_tai_khoan_chua_co_nhom" @selection-change="select_tk_vao_nhom" border style="width: 100%" height="300">
                                                            <el-table-column type="selection" align="center" width="55" class-name="center-text table-pa"></el-table-column>
                                                            <el-table-column type="index" label="TT" align="center" width="40" class-name="center-text table-pa"></el-table-column>
                                                            <el-table-column prop="ma_nv" label="Mã NV" align="center" width="200" class-name="center-text table-pa"></el-table-column><el-table-column prop="username" label="Tên đăng nhập" width="250" class-name="no-center-text table-pa"></el-table-column>
                                                            <el-table-column prop="ten_vi_tri" label="Vị trí" class-name="no-center-text table-pa"></el-table-column>
                                                        </el-table>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                                <!--<button id="save" type="submit" class="btn btn-primary">Lưu lại</button>-->
                                                <button :disabled="nhom_nguoi_dung.ma_nhom == '' || nhom_nguoi_dung.ten_nhom == ''" id="save_add" type="submit" class="btn btn-primary">
                                                    <span v-if="flag_btn_save"><i class="fa fa-save"></i> Lưu lại</span>
                                                    <span v-if="!flag_btn_save"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End Modal add-->

                            <el-dialog title="Cập nhật thông tin nhóm người dùng" top="8vh" custom-class="modal_new" :visible.sync="flag_modal_">
                                <el-dialog width="60%" title="Danh sách tài khoản chưa có nhóm" :visible.sync="flag_add_tk_vao_nhom" append-to-body>
                                    <el-table ref="multipleTable" top="8vh" :data="list_tai_khoan_chua_co_nhom" @selection-change="select_tk_vao_nhom" border style="width: 100%" height="300">
                                        <el-table-column type="selection" align="center" width="55" class-name="center-text table-pa"></el-table-column>
                                        <el-table-column type="index" label="TT" align="center" width="40" class-name="center-text table-pa"></el-table-column>
                                        <el-table-column prop="ma_nv" label="Mã NV" align="center" width="200" class-name="center-text table-pa"></el-table-column><el-table-column prop="username" label="Tên đăng nhập" width="250" class-name="no-center-text table-pa"></el-table-column>
                                        <el-table-column prop="ten_vi_tri" label="Vị trí" class-name="no-center-text table-pa"></el-table-column>
                                    </el-table>

                                    <div slot="footer" class="dialog-footer">
                                        <!--<el-button @click="flag_modal_ = false">Cancel</el-button>-->
                                        <button type="button" class="btn btn-danger" @click="flag_add_tk_vao_nhom = false">Hủy</button>
                                        <button type="button" class="btn btn-primary" @click="add_tk_vao_nhom_">Thêm vào nhóm</button>
                                    </div>
                                </el-dialog>
                                <template>
                                    <form id="form_bops">
                                        <div v-if="flag_submit_nguoi_dung" class="form-group row">
                                            <label class="col-md-2 col-form-label label-dd">Mã nhóm</label>
                                            <div class="col-md-4 col-dd">
                                                <!--<el-input v-validate="'required'" v-model="nhom_nguoi_dung.ma_nhom" size="small"></el-input>-->
                                                <input name="txtmanhom" v-validate="'required'" v-bind:maxlength="10" v-model="nhom_nguoi_dung.ma_nhom" type="text" class="form-control form-control-sm">
                                                <small v-show="nhom_nguoi_dung.ma_nhom == ''" class="help text-muted is-danger">Vui lòng nhập mã nhóm</small>
                                            </div>

                                            <label class="col-md-2 col-form-label label-dd">Tên nhóm</label>
                                            <div class="col-md-4 col-dd">
                                                <!--<el-input v-model="nhom_nguoi_dung.ten_nhom" size="small"></el-input>-->
                                                <input name="txtmanhom" v-validate="'required'" v-bind:maxlength="100" v-model="nhom_nguoi_dung.ten_nhom" type="text" class="form-control form-control-sm">
                                                <small v-show="nhom_nguoi_dung.ten_nhom == ''" class="help text-muted is-danger">Vui lòng nhập tên nhóm</small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label label-dd">Ghi chú</label>
                                            <div class="col-md-10 col-dd">
                                                <!--<el-input v-model="nhom_nguoi_dung.ghi_chu" size="small"></el-input>-->
                                                <input name="txtmanhom" v-validate="'required'" v-bind:maxlength="200" v-model="nhom_nguoi_dung.ghi_chu" type="text" class="form-control form-control-sm">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-12 mb-2">
                                                <label class="col-form-label label-dd">Danh sách tài khoản trong nhóm</label>
                                                <button type="button" @click="flag_add_tk_vao_nhom = true" class="btn btn-info btn-sm pull-right">Thêm tài khoản vào nhóm</button>
                                            </div>
                                            <div class="col-md-12">
                                                <el-table :data="list_tk_theo_nhom" border style="width: 100%">
                                                    <el-table-column align="center" width="49" class-name="center-text table-pa button-pa">
                                                        <template slot-scope="scope">
                                                            <button title="Loại bỏ tài khoản khỏi nhóm" @click="" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
                                                        </template>
                                                    </el-table-column>
                                                    <el-table-column type="index" label="TT" align="center" width="40" class-name="center-text table-pa"></el-table-column>
                                                    <el-table-column prop="ma_nv" label="Mã NV" align="center" class-name="center-text table-pa"></el-table-column>
                                                    <el-table-column prop="username" label="Tên đăng nhập" class-name="no-center-text table-pa"></el-table-column>
                                                    <el-table-column prop="ten_vi_tri" label="Vị trí" class-name="no-center-text table-pa"></el-table-column>
                                                </el-table>
                                            </div>
                                        </div>
                                    </form>
                                </template>
                                <div slot="footer" class="dialog-footer">
                                    <!--<el-button @click="flag_modal_ = false">Cancel</el-button>-->
                                    <button type="button" class="btn btn-danger" @click="flag_modal_ = false">Hủy</button>
                                    <!--<button id="save" type="submit" class="btn btn-primary">Lưu lại</button>-->
                                    <button @click="submit_edit_nhom_nguoi_dung" :disabled="nhom_nguoi_dung.ma_nhom == '' || nhom_nguoi_dung.ten_nhom == ''" id="save_edit" type="submit" class="btn btn-primary">
                                        <span v-if="flag_btn_save"><i class="fa fa-save"></i> Lưu lại</span>
                                        <span v-if="!flag_btn_save"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</span>
                                    </button>
                                </div>
                            </el-dialog>

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

    import {api_get_danh_sach_nhom_nguoi_dung_no_paginate} from "../quan_ly_nguoi_dung/quan_ly_nguoi_dung";
    import {api_get_all_danh_sach_nhom_nguoi_dung} from "./QuanLyNhom_helper";
    import {api_get_all_danh_sach_tai_khoan_theo_nhom} from "./QuanLyNhom_helper";
    import {api_get_all_danh_sach_tai_khoan_chua_co_nhom} from "./QuanLyNhom_helper";

    import {api_add_nhom_nguoi_dung} from "./QuanLyNhom_helper";
    import {api_add_tai_khoan_vao_nhom_nguoi_dung} from "./QuanLyNhom_helper";
    import {api_edit_nhom_nguoi_dung} from "./QuanLyNhom_helper";
    import {api_delete_nhom_nguoi_dung} from "./QuanLyNhom_helper";

    export default {
        name: 'quanlynguoidung',
        mounted () {
            api_get_all_danh_sach_nhom_nguoi_dung(this);
            api_get_danh_sach_nhom_nguoi_dung_no_paginate(this);
            api_get_all_danh_sach_tai_khoan_chua_co_nhom(this);
        },
        updated () {
            $(document).ready(function() {
                $('.select2').select2();
            });
        },
        data () {
            return {
                list_tai_khoan_chua_co_nhom: [],
                list_nhom_nguoi_dung: [],
                list_nhom_nguoi_dung_paginate: [],
                nhom_nguoi_dung_1: '',
                nhom_nguoi_dung: {id: '', ma_nhom:'', ten_nhom: '', ghi_chu: '', arr_tk: []},
                loading_nguoi_dung: true,
                list_nguoi_dung: [],
                total_nhom_nguoi_dung: 0,
                nguoi_dung: { id: 0, username: '', password: '', password_xn: '', id_nhan_vien: '', id_nhom_nguoi_dung: '', active:0 },
                flag_btn: true,
                flag_submit_nguoi_dung: true,
                flag_input_nguoi_dung: false,
                flag_body_modal: false,
                flag_btn_save: true,
                flag_disabled_submit: false,
                flag_input_ma_nguoi_dung: false,
                options_display: [10,20,30],
                limit: 10,
                currentPage: 1,
                flag_search: false,
                keyword: '',
                list_nguoi_dung_chua_co_tk: [],
                list_vi_tri: [],
                vi_tri: '',
                nhan_vien: '',
                list_change_phong: [],
                list_change_vi_tri: [],
                flag_doi_mk: false,
                centerDialogVisible: false,
                flag_question_khoa_tk: '',
                gia_tri_kich_hoat: 0,
                id_checkbox_khoa: '',
                flag_modal_: false,
                flag_add_tk_vao_nhom: false,
                limit_tk_theo_nhom: 10,
                list_tk_theo_nhom: [],
                total_tk_theo_nhom: 0
            }
        },
        methods: {
            select_nhan_vien: function (bd) {
                this.vi_tri = bd.ten_vi_tri;
            },
            validate_ma_bp: function () {
                var length_nv = this.nguoi_dung.ma_nguoi_dung.length;
                var value_nv  = this.nguoi_dung.ma_nguoi_dung;
                if((length_nv > 7 || length_nv < 7) || value_nv.indexOf('BP') == -1 || value_nv.indexOf(' ') > -1){
                    this.flag_input_ma_nguoi_dung = true;
                    this.flag_disabled_submit = true;
                }
                else{
                    this.flag_input_ma_nguoi_dung = false;
                    this.flag_disabled_submit = false;
                }
            },
            disable_spaces: function (evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode == 32) {
                    evt.preventDefault();;
                } else {
                    return true;
                }
            },
            select_tk_vao_nhom: function (val) {
                this.nhom_nguoi_dung.arr_tk = val;
            },
            change_nhom_nguoi_dung_1: function (mnd) {
                if(this.nhom_nguoi_dung_1 == ''){
                    api_get_all_danh_sach_nhom_nguoi_dung(this,1);
                }
                else{
                    this.nhom_nguoi_dung_2 = this.list_nhom_nguoi_dung.filter(function (item) {
                        return (item['ma_nhom'] == mnd.ma_nhom);
                    })[0];
                    api_get_danh_sach_nhom_nguoi_dung_theo_nhom(this,1,mnd.id);
                }
            },
            danh_sach_nhom_nguoi_dung: function (page=1) {
                if(this.flag_search){
                    api_get_search_nguoi_dung(this);
                }
                else{
                    api_get_all_danh_sach_nhom_nguoi_dung(this,page);
                }
            },
            _nhom_nguoi_dung: function (state, nd = null) {
                if(state == 'add') {
                    this.nhom_nguoi_dung = {id: '', ma_nhom:'', ten_nhom: '', ghi_chu: '', arr_tk: []}
                }
                else {
                    this.flag_modal_ = true;
                    this.nhom_nguoi_dung.id = nd.id;
                    this.nhom_nguoi_dung.ma_nhom = nd.ma_nhom;
                    this.nhom_nguoi_dung.ten_nhom = nd.ten_nhom;
                    this.nhom_nguoi_dung.ghi_chu = nd.ghi_chu;
                    api_get_all_danh_sach_tai_khoan_theo_nhom(this);
                }
            },
            add_tk_vao_nhom_: function () {
                api_add_tai_khoan_vao_nhom_nguoi_dung(this);
            },
            submit_add_nhom_nguoi_dung: function () {
                if(this.nhom_nguoi_dung.ma_nhom == '' || this.nhom_nguoi_dung.ten_nhom == ''){
                    return 1;
                }
                this.change_bnt_save('save_add')
                api_add_nhom_nguoi_dung(this);
            },

            submit_edit_nhom_nguoi_dung: function () {
                if(this.nhom_nguoi_dung.ma_nhom == '' || this.nhom_nguoi_dung.ten_nhom == ''){
                    return 1;
                }
                this.change_bnt_save('save_add')
                api_edit_nhom_nguoi_dung(this);
            },
            submit_search: function () {
                if(this.keyword == '' || this.keyword == null)
                {
                    this.flag_search = false;
                    api_get_all_danh_sach_nhom_nguoi_dung(this,1);
                }
                else{
                    this.flag_search = true;
                    api_get_search_nguoi_dung(this);
                }
            },
            submit_khoa_tk: function (state) {
                if(state == "ok"){
                    // console.log('gitri: ' + this.gia_tri_kich_hoat)
                    // console.log('id: ' + this.id_checkbox_khoa);
                    var em = false;
                    var em_ = 0;
                    if(this.gia_tri_kich_hoat == 1)
                    {
                        em = false;
                        em_ = 0;
                    }
                    else {
                        em = true;
                        em_ = 1;
                    }
                    $("#" + this.id_checkbox_khoa).prop("checked", em);
                    api_kich_hoat_tk_nguoi_dung(this,this.id_checkbox_khoa,em_);
                }
                else{
                    // console.log('huy: ' + this.gia_tri_kich_hoat)
                    if(this.gia_tri_kich_hoat == 1) { em = true; } else{ em = false; }
                    $("#" + this.id_checkbox_khoa).prop("checked", em);
                    // api_kich_hoat_tk_nguoi_dung(this,this.id_checkbox_khoa,em);
                }
                this.centerDialogVisible = false;

            },
            delete_nhom_nguoi_dung: function(nhom) {
                this.nhom_nguoi_dung = nhom;
                api_delete_nhom_nguoi_dung(this);
            },
            khoa_tai_khoan: function (event) {
                this.id_checkbox_khoa = event.target.id;
                console.log(this.id_checkbox_khoa);
                var khoa = event.target.value;
                console.log(khoa);
                if(khoa == 1){
                    this.flag_question_khoa_tk = 'Bạn muốn khóa tài khoản này?';
                    this.gia_tri_kich_hoat = khoa;
                    this.centerDialogVisible = true;
                }
                else{
                    this.flag_question_khoa_tk = 'Bạn muốn kích hoạt tài khoản này?';
                    this.gia_tri_kich_hoat = khoa;
                    this.centerDialogVisible = true;
                }
            },
            change_bnt_save: function (id) {
                this.flag_btn_save = false;
                $('#' + id).attr('disabled', 'disabled');
            },
            un_change_bnt_save: function (id) {
                this.flag_btn_save = true;
                $('#' + id).removeAttr('disabled');
            },
            scroll_card_full_creem: function () {
                $('#phongto').closest('.card').find('[data-action="expand"] i').toggleClass('mdi-arrow-expand mdi-arrow-compress');
                $('#phongto').closest('.card').toggleClass('card-fullscreen');
            },
            count_tt: function (row) {
                var index = this.list_nhom_nguoi_dung_paginate.indexOf(row) + 1;
                return ((this.currentPage - 1) * this.limit) + index;
            },
            doi_mk: function () {
                this.flag_doi_mk = true;
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

    .center-text {
        text-align: center;
    }

    [type="checkbox"] + label {
        margin:0;
        height: 14px !important;
    }

    [type="checkbox"]:not(:checked), [type="checkbox"]:checked {
        position: absolute;
        left: 0px;
        top:30%;
        opacity: 1;
    }

    @media (min-width: 992px){
        .modal-lg {
            max-width: 800px !important;
        }

        .label-dd {
            padding-right: 0;
        }

        .col-dd {
            padding-left: 0;
        }
    }

    .col-form-label {
        font-size: 13px;
        font-weight: 500;
    }

</style>