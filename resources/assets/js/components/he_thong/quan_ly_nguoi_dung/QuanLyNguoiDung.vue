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
                            <h4 class="card-title m-b-0">Danh sách tài khoản</h4>
                            <!--<h6 class="card-subtitle m-0 op-5">Tổng số bộ phận: {{total_nguoi_dung}}</h6>-->
                        </div>
                        <div class="card-body collapse show">
                            <div class="message-box contact-box">
                                <div class="message-widget contact-widget">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <el-select v-model="nhom_nguoi_dung_1" value-key="ma_nhom" filterable placeholder="Tất cả nhóm người dùng" size="small" @change="change_nhom_nguoi_dung_1" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu" style="width:100%">
                                                        <el-option :key="''" :label="'Tất cả nhóm người dùng'" :value="''"></el-option>
                                                        <el-option v-for="item in list_nhom_nguoi_dung" :key="item.id" :label="item.ten_nhom" :value="item">
                                                            <span style="float: left">{{ item.ten_nhom }}</span>
                                                            <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ma_nhom }}</span>
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-md-5">
                                                    <form @submit.prevent="submit_search">
                                                        <el-input placeholder="Tìm kiếm tài khoản" size="small" suffix-icon="el-icon-search" v-model="keyword"></el-input>
                                                    </form>
                                                </div>
                                                <div class="col-md-4">
                                                    <button v-if="flag_cn.add" @click="_nguoi_dung('add')" data-toggle="modal" data-target="#myModal" title="Thêm mới tài khoản" class="btn btn-success btn-sm pull-right" style="height: 32px;"><i class="fa fa-plus-circle"></i> Thêm mới</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <el-table :data="list_nguoi_dung" border style="width: 100%">
                                                <el-table-column v-if="flag_cn.edit || flag_cn.delete" label="#" width="90" align="center" class-name="center-text">
                                                    <template slot-scope="scope" align="center">
                                                        <div class="text-center">
                                                            <button v-if="flag_cn.edit" @click="_nguoi_dung('edit', scope.row)" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm" title="Cập nhật thông tin bộ phận"> <i class="fa fa-edit"></i> </button>
                                                            <button v-if="flag_cn.delete" @click="delete_nguoi_dung(scope.row)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                                        </div>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column type="index" label="TT" align="center" width="40" class-name="center-text">
                                                    <template slot-scope="scope">
                                                        {{count_tt(scope.row)}}
                                                    </template>
                                                </el-table-column>
                                                <el-table-column prop="ho_ten" label="Họ tên" width="200" class-name="no-center-text"></el-table-column>
                                                <el-table-column prop="username" label="Tên đăng nhập(email)" width="250" class-name="no-center-text"></el-table-column>
                                                <el-table-column prop="ten_vi_tri" label="Vị trí" class-name="no-center-text"></el-table-column>
                                                <el-table-column prop="" label="Kích hoạt" align="center" width="100" class-name="center-text">
                                                    <template slot-scope="scope">
                                                        <input v-if="scope.row.active == 1" @click="khoa_tai_khoan" :id="scope.row.user_id" type="checkbox" :value="scope.row.active" checked class="form-control form-control-sm">
                                                        <input v-else @click="khoa_tai_khoan" :id="scope.row.user_id" :value="scope.row.active" type="checkbox" class="form-control form-control-sm">

                                                        <!--<div v-if="scope.row.active == 1">-->
                                                            <!--<input @click="khoa_tai_khoan" :id="'check' + scope.row.user_id" type="checkbox" value="1" checked class="form-control form-control-sm">-->
                                                            <!--&lt;!&ndash;<input @click="khoa_tai_khoan" type="checkbox" :id="'check' + scope.row.user_id" value="1" class="filled-in chk-col-blue" checked />&ndash;&gt;-->
                                                            <!--&lt;!&ndash;<label :for="'check' + scope.row.user_id"></label>&ndash;&gt;-->
                                                        <!--</div>-->
                                                        <!--<div v-else>-->
                                                            <!--<input @click="khoa_tai_khoan" :id="'check' + scope.row.user_id" value="0" type="checkbox" class="form-control form-control-sm">-->
                                                            <!--&lt;!&ndash;<input @click="khoa_tai_khoan" type="checkbox" :id="'check' + scope.row.user_id" value="0" class="filled-in chk-col-blue"/>&ndash;&gt;-->
                                                            <!--&lt;!&ndash;<label :for="'check' + scope.row.user_id"></label>&ndash;&gt;-->
                                                        <!--</div>-->
                                                    </template>
                                                </el-table-column>
                                            </el-table>
                                            <el-dialog title="Thông báo" :visible.sync="centerDialogVisible" width="30%" center>
                                                <h4 class="text-center">{{flag_question_khoa_tk}}</h4>
                                                <span slot="footer" class="dialog-footer">
                                                    <el-button @click="submit_khoa_tk('cancel')">Hủy</el-button>
                                                    <el-button type="primary" @click="submit_khoa_tk('ok')">Đồng ý</el-button>
                                                  </span>
                                            </el-dialog>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row tb-row-hienthi">
                                                <div class="col-md-1 col-sm-2 col-8 tb-label pr-0" style="padding-left: 15px;">
                                                    <span>Hiển thị</span>
                                                </div>
                                                <div class="col-md-1 col-sm-2 col-4 tb-hienthi" style="padding-left: 4px;">
                                                    <el-select v-model="limit" placeholder="10" size="small" @change="danh_sach_nguoi_dung">
                                                        <el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-md-8 col-sm-4 col-6" style="padding-left: 0px;">
                                                    <el-pagination :page-size="limit" layout="prev, pager, next" :total="total_nguoi_dung" @current-change="danh_sach_nguoi_dung"></el-pagination>
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-6 tb-label">
                                                    <span class="pull-right">Tổng: {{total_nguoi_dung}} tài khoản</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--////-->
                                </div>
                            </div>

                            <!--Modal Add-->
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form @submit.prevent="submit_nguoi_dung" id="form_bophan">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Thông tin tài khoản</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div :disabled="flag_body_modal" class="modal-body">
                                                <!-- Chon nhan vien -->
                                                <div v-if="flag_submit_nguoi_dung" class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Nhân viên</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="nhan_vien" v-validate="'required'" name="txtchonnhanvien" filterable value-key="ma_nv" size="small" placeholder="Chọn nhân viên chưa có tài khoản" style="width: 100%" @change="select_nhan_vien" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<template slot="prefix"><label class="prefix">{{nhan_vien.ma_nv}}</label></template>-->
                                                            <el-option v-for="item in list_nguoi_dung_chua_co_tk" :key="item.ma_nv" :label="item.ho_ten" :value="item">
                                                                <span style="float: left">{{ item.ho_ten }}</span>
                                                                <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ma_nv }}</span>
                                                            </el-option>
                                                        </el-select>
                                                        <small v-show="errors.has('txtchonnhanvien')" class="help text-muted is-danger">Vui lòng chọn nhân viên</small>
                                                    </div>
                                                </div>
                                                <div v-else class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Nhân viên</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="nhan_vien" disabled size="small" style="width: 100%">
                                                            <el-option v-for="item in nhan_vien" :key="item.ho_ten" :label="item.ho_ten" :value="item.ho_ten">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                                <!-- End chon nhan vien -->

                                                <div v-if="vi_tri !=''" class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Vị trí</label>
                                                    <div class="col-md-9">
                                                        <input v-model="vi_tri" type="text" class="form-control form-control-sm" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Email</label>
                                                    <div class="col-md-9">
                                                        <input v-bind:maxlength="50" v-model="nguoi_dung.username" :disabled="flag_input_nguoi_dung" v-validate="'required|email'" :class="{'border-danger' : errors.has('txtusername')}" type="text" name="txtusername" class="form-control form-control-sm" id="txtmabophan" aria-describedby="" autofocus placeholder="Tên đăng nhập">
                                                        <small v-show="errors.has('txtusername')" class="help text-muted is-danger">Email không đúng định dạng</small>
                                                    </div>
                                                </div>

                                                <!-- Mat khau -->
                                                <div v-if="!flag_doi_mk" class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Mật khẩu</label>
                                                    <div class="col-md-9">
                                                        <button type="button" @click="doi_mk" class="btn btn-sm btn-info">Đổi mật khẩu</button>
                                                    </div>
                                                </div>

                                                <div v-if="flag_doi_mk" class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Mật khẩu</label>
                                                    <div class="col-md-9">
                                                        <input v-model="nguoi_dung.password" v-on:keypress="disable_spaces" v-bind:maxlength="20" v-validate="'required|min:6|max:20'" :class="{'border-danger' : errors.has('txtmk')}" type="password" name="txtmk" class="form-control form-control-sm" id="txtmk" placeholder="">
                                                        <small v-show="errors.has('txtmk')" class="help text-muted is-danger">Mật khẩu phải có độ dài 6-20 ký tự</small>
                                                    </div>
                                                </div>

                                                <div v-if="flag_doi_mk" class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Xác nhận MK</label>
                                                    <div class="col-md-9">
                                                        <input v-model="nguoi_dung.password_xn" v-bind:maxlength="20" v-validate="'required|min:6|max:20'" :class="{'border-danger' : errors.has('txtxnmk')}" type="password" name="txtxnmk" class="form-control form-control-sm" id="txttenb" placeholder="">
                                                        <small v-show="nguoi_dung.password_xn != nguoi_dung.password" class="help text-muted is-danger">Mật khẩu không trùng khớp</small>
                                                    </div>
                                                </div>
                                                <!-- End Mat khau -->

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Nhóm ND</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="nhom_nguoi_dung_2" v-validate="'required'" name="txtnhomnguoidung" filterable value-key="ma_nhom" size="small" placeholder="Chọn nhóm người dùng" style="width: 100%" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<template slot="prefix"><label class="prefix">{{nhan_vien.ma_nv}}</label></template>-->
                                                            <el-option v-for="item in list_nhom_nguoi_dung" :key="item.ma_nhom" :label="item.ten_nhom" :value="item">
                                                                <span style="float: left">{{ item.ten_nhom }}</span>
                                                                <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ma_nhom }}</span>
                                                            </el-option>
                                                        </el-select>
                                                        <small v-show="errors.has('txtnhomnguoidung')" class="help text-muted is-danger">Vui lòng chọn nhóm người dùng</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Kích hoạt</label>
                                                    <div class="col-md-9">
                                                        <input v-model="nguoi_dung.active" type="checkbox" id="md_checkboxs_" class="filled-in chk-col-blue" style="opacity: 0"/>
                                                        <label for="md_checkboxs_"></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                                <!--<button id="save" type="submit" class="btn btn-primary">Lưu lại</button>-->
                                                <button :disabled="flag_disabled_submit || errors.has('txttenbophan') || nguoi_dung.password_xn != nguoi_dung.password" id="save" type="submit" class="btn btn-primary">
                                                    <span v-if="flag_btn_save"><i class="fa fa-save"></i> Lưu lại</span>
                                                    <span v-if="!flag_btn_save"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--End Modal Add-->
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
    import {check_url_phan_quyen} from "../../../helper/auth";
    import {check_quyen_chuc_nang} from "../../../helper/auth";

    import {api_get_danh_sach_nhom_nguoi_dung_no_paginate} from "./quan_ly_nguoi_dung";
    import {api_get_all_danh_sach_nguoi_dung} from "./quan_ly_nguoi_dung";
    import {api_get_search_nguoi_dung} from "./quan_ly_nguoi_dung";
    import {api_get_danh_sach_nhom_nguoi_dung_chua_co_tk} from "./quan_ly_nguoi_dung";

    import {api_add_nguoi_dung} from "./quan_ly_nguoi_dung";
    import {api_edit_nguoi_dung} from "./quan_ly_nguoi_dung";
    import {api_kich_hoat_tk_nguoi_dung} from "./quan_ly_nguoi_dung";
    import {api_delete_nguoi_dung} from "./quan_ly_nguoi_dung";
    import {api_get_danh_sach_nguoi_dung_theo_nhom} from "./quan_ly_nguoi_dung";

    export default {
        name: 'quanlynguoidung',
        beforeCreate(){
            check_url_phan_quyen(this);
        },
        mounted () {
            check_quyen_chuc_nang(this);
            api_get_danh_sach_nhom_nguoi_dung_no_paginate(this);
            api_get_all_danh_sach_nguoi_dung(this,1);
            api_get_danh_sach_nhom_nguoi_dung_chua_co_tk(this);
        },
        updated () {
            $(document).ready(function() {
                $('.select2').select2();
            });
        },
        data () {
            return {
                list_nhom_nguoi_dung: [],
                nhom_nguoi_dung_1: '',
                nhom_nguoi_dung_2: '',
                loading_nguoi_dung: true,
                list_nguoi_dung: [],
                total_nguoi_dung: 0,
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
                flag_cn: {add: false, edit: false, delete: false}
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
            change_nhom_nguoi_dung_1: function (mnd) {
                if(this.nhom_nguoi_dung_1 == ''){
                    api_get_all_danh_sach_nguoi_dung(this,1);
                }
                else{
                    this.nhom_nguoi_dung_2 = this.list_nhom_nguoi_dung.filter(function (item) {
                        return (item['ma_nhom'] == mnd.ma_nhom);
                    })[0];
                    api_get_danh_sach_nguoi_dung_theo_nhom(this,1,mnd.id);
                }
            },
            danh_sach_nguoi_dung: function (page=1) {
                if(this.flag_search){
                    api_get_search_nguoi_dung(this);
                }
                else{
                    api_get_all_danh_sach_nguoi_dung(this,1);
                }
                this.centerDialogVisible = false;
            },
            _nguoi_dung: function (state, nd = null) {
                if(state == 'add') {
                    this.nhan_vien = '';
                    this.vi_tri = '';
                    this.nhom_nguoi_dung_2 = '';

                    this.flag_submit_nguoi_dung = true;
                    this.flag_input_nguoi_dung = false;
                    this.flag_doi_mk = true;
                    this.nguoi_dung = { id: 0, username: '', password: '', password_xn: '', id_nhan_vien: '', id_nhom_nguoi_dung: '', active:0 }
                }
                else {
                    this.flag_doi_mk = false;

                    this.nhan_vien = nd.ho_ten;
                    this.vi_tri = nd.ten_vi_tri;

                    this.nhom_nguoi_dung_2 = this.list_nhom_nguoi_dung.filter(function (item) {
                        return (item['ma_nhom'] == nd.ma_nhom);
                    })[0];

                    this.nguoi_dung.id = nd.user_id;
                    this.nguoi_dung.username = nd.username;
                    this.nguoi_dung.active = nd.active;
                    this.nguoi_dung.password = '';
                    this.nguoi_dung.password_xn = '';
                    this.flag_submit_nguoi_dung = false;
                    this.flag_input_nguoi_dung = true;
                }
            },
            submit_nguoi_dung: function () {
                this.$validator.validateAll().then((result) => {
                    this.change_bnt_save();
                    if (result) {
                        if(this.flag_submit_nguoi_dung) {
                            this.flag_input_nguoi_dung = false;
                            this.nguoi_dung.id_nhan_vien = this.nhan_vien.ma_nv;
                            this.nguoi_dung.id_nhom_nguoi_dung = this.nhom_nguoi_dung_2.id;
                            // console.log(this.nguoi_dung);
                            api_add_nguoi_dung(this);
                        }
                        else {
                            this.nguoi_dung.id_nhom_nguoi_dung = this.nhom_nguoi_dung_2.id;
                            api_edit_nguoi_dung(this);
                            this.flag_input_nguoi_dung = true;
                        }
                    }
                    else{
                        this.un_change_bnt_save();
                    }
                })
            },
            submit_search: function () {
                if(this.keyword == '' || this.keyword == null)
                {
                    this.flag_search = false;
                    api_get_all_danh_sach_nguoi_dung(this,1);
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
            delete_nguoi_dung: function(bp) {
                this.nguoi_dung = bp;
                if(this.nguoi_dung.id <= 0) return -1;
                api_delete_nguoi_dung(this);
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
            },
            count_tt: function (row) {
                var index = this.list_nguoi_dung.indexOf(row) + 1;
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
</style>