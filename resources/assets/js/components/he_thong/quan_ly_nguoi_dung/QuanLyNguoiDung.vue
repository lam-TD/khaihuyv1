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
                                                    <el-select v-model="nhom_nguoi_dung" value-key="ma_nhom" filterable placeholder="Tất cả nhóm người dùng" size="small" @change="change_nhom_nguoi_dung" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu" style="width:100%">
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
                                                    <button data-toggle="modal" data-target="#myModal" title="Thêm mới tài khoản" class="btn btn-success btn-sm pull-right" style="height: 32px;"><i class="fa fa-plus-circle"></i> Thêm mới</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <el-table :data="list_nguoi_dung" border style="width: 100%">
                                                <el-table-column label="#" width="90" align="center" class-name="center-text">
                                                    <template slot-scope="scope" align="center">
                                                        <div class="text-center">
                                                            <button @click="_nguoi_dung('edit', scope.row)" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm" title="Cập nhật thông tin bộ phận"> <i class="fa fa-edit"></i> </button>
                                                            <button @click="delete_nguoi_dung(scope.row)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                                        </div>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column type="index" label="TT" align="center" width="40" class-name="center-text"></el-table-column>
                                                <el-table-column prop="ho_ten" label="Họ tên" align="center" width="100" class-name="center-text"></el-table-column>
                                                <el-table-column prop="username" label="Tên đăng nhập(email)" class-name="no-center-text"></el-table-column>
                                                <el-table-column prop="ten_vi_tri" label="Vị trí" class-name="no-center-text"></el-table-column>
                                                <el-table-column prop="" label="Kích hoạt" align="center" class-name="center-text">
                                                    <template slot-scope="scope">
                                                        <div v-if="scope.row.active == 1">
                                                            <input type="checkbox" id="md_checkbox_26" class="filled-in chk-col-blue" checked />
                                                            <label for="md_checkbox_26"></label>
                                                        </div>
                                                        <div v-else>
                                                            <input type="checkbox" id="md_checkbox_" class="filled-in chk-col-blue"/>
                                                            <label for="md_checkbox_26"></label>
                                                        </div>
                                                    </template>
                                                </el-table-column>
                                            </el-table>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row tb-row-hienthi">
                                                <div class="col-md-1 col-sm-2 col-8 tb-label pr-0" style="padding-left: 15px;">
                                                    <span>Hiển thị</span>
                                                </div>
                                                <div class="col-md-1 col-sm-2 col-4 tb-hienthi" style="padding-left: 4px;">
                                                    <el-select v-model="limit" placeholder="10" size="small" @change="change_danh_sach_nguoi_dung">
                                                        <el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-md-8 col-sm-4 col-6" style="padding-left: 0px;">
                                                    <el-pagination :page-size="limit" layout="prev, pager, next" :total="total_nguoi_dung" @current-change="danh_sach_nguoi_dung"></el-pagination>
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-6 tb-label">
                                                    <span class="pull-right">Tổng: {{total_nguoi_dung}} BP</span>
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
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Bộ phận</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="bo_phan" filterable value-key="ma_bo_phan" size="small" placeholder="Chọn bộ phận" style="width: 100%" @change="select_bo_phan" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<template slot="prefix"><label class="prefix">{{nhan_vien.ma_nv}}</label></template>-->
                                                            <el-option
                                                                    v-for="item in list_bo_phan"
                                                                    :key="item.id"
                                                                    :label="item.ma_bo_phan"
                                                                    :value="item">
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
                                                        <el-select v-model="phong_ban" size="small" value-key="ma_phong" placeholder="Chọn phòng" style="width: 100%" @change="select_phong" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<template slot="prefix"><label class="prefix">{{nhan_vien.ma_nv}}</label></template>-->
                                                            <el-option
                                                                    v-for="item in list_change_phong"
                                                                    :key="item.id"
                                                                    :label="item.ma_phong"
                                                                    :value="item">
                                                                <span style="float: left">{{ item.ma_phong }}</span>
                                                                <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ten_phong }}</span>
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Vị trí</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="vi_tri" value-key="ma_vi_tri" filterable size="small" placeholder="Chọn phòng" style="width: 100%" @change="select_vi_tri" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<template slot="prefix"><label class="prefix">{{nhan_vien.ma_nv}}</label></template>-->
                                                            <el-option
                                                                    v-for="item in list_change_vi_tri"
                                                                    :key="item.ma_vi_tri"
                                                                    :label="item.ma_vi_tri"
                                                                    :value="item">
                                                                <span style="float: left">{{ item.ma_vi_tri }}</span>
                                                                <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ten_vi_tri }}</span>
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Mã bộ phận(*)</b></label>
                                                    <div class="col-md-9">
                                                        <input @input="validate_ma_bp" v-on:keypress="disable_spaces" v-bind:maxlength="7" v-model="nguoi_dung.ma_nguoi_dung" :disabled="flag_input_nguoi_dung" v-validate="'required'" :class="{'border-danger' : errors.has('txtmabophan')}" type="text" name="txtmabophan" class="form-control form-control-sm" id="txtmabophan" aria-describedby="" autofocus>
                                                        <small v-if="flag_input_ma_nguoi_dung" class="help text-muted is-danger">Mã bộ phận phải có 7 ký tự, bắt đầu bằng BP</small>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Tên bộ phận(*)</b></label>
                                                    <div class="col-md-9">
                                                        <input v-model="nguoi_dung.ten_nguoi_dung" v-validate="'required'" :class="{'border-danger' : errors.has('txttenbophan')}" type="text" name="txttenbophan" class="form-control form-control-sm" id="txttenbophan" placeholder="">
                                                        <small v-show="errors.has('txttenbophan')" class="help text-muted is-danger">Vui lòng nhập tên bộ phận</small>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Diễn giải</b></label>
                                                    <div class="col-md-9">
                                                        <textarea v-model="nguoi_dung.dien_giai" type="text" name="txtdiengiai" class="form-control form-control-sm" id="txtdiengiai"></textarea>
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

    import {api_get_all_bo_phan} from "../../nhan_su/bophan/bo_phan";
    import {api_get_all_phong_ban_no_paginate} from "../../nhan_su/phongban/phong_ban";
    import {api_get_all_vi_tri_no_pa} from "../../nhan_su/vitri/vi_tri";

    import {api_get_danh_sach_nhom_nguoi_dung_no_paginate} from "./quan_ly_nguoi_dung";
    import {api_get_all_danh_sach_nguoi_dung} from "./quan_ly_nguoi_dung";

    export default {
        name: 'quanlynguoidung',
        mounted () {
            api_get_all_bo_phan(this);
            api_get_all_phong_ban_no_paginate(this);
            api_get_all_vi_tri_no_pa(this);
            api_get_danh_sach_nhom_nguoi_dung_no_paginate(this);
            api_get_all_danh_sach_nguoi_dung(this,1);
        },
        updated () {
            $(document).ready(function() {
                $('.select2').select2();
            });
        },
        data () {
            return {
                list_nhom_nguoi_dung: [],
                nhom_nguoi_dung: '',
                loading_nguoi_dung: true,
                list_nguoi_dung: [],
                total_nguoi_dung: 0,
                nguoi_dung: { id: 0, ma_nguoi_dung: '', ten_nguoi_dung: '', dien_giai: '' },
                flag_btn: true,
                flag_submit_nguoi_dung: true,
                flag_input_nguoi_dung: false,
                flag_body_modal: false,
                flag_btn_save: true,
                flag_disabled_submit: false,
                flag_input_ma_nguoi_dung: false,
                options_display: [10,20,30],
                limit: 10,
                keyword: '',
                list_bo_phan: [],
                list_phong_ban: [],
                list_vi_tri: [],
                bo_phan: '',
                phong_ban: '',
                vi_tri: '',
                list_change_phong: [],
                list_change_vi_tri: [],
            }
        },
        methods: {
            select_bo_phan: function (bd) {
                this.list_change_phong = this.list_phong_ban.filter(function(item){
                    return (item['id_bo_phan'] == bd.ma_bo_phan);
                })
            },
            select_phong: function (phong) {
                this.list_change_vi_tri = this.list_vi_tri.filter(function(item){
                    return (item['id_phong_ban'] == phong.ma_phong);
                })
                // this.ttcv.phong_ma = phong.ma_phong;
            },
            select_vi_tri: function (vt) {
                // this.ttcv.vi_tri_ma = vt.ma_vi_tri;
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
            change_nhom_nguoi_dung: function () {

            },
            change_danh_sach_nguoi_dung: function () {
                
            },
            danh_sach_nguoi_dung: function (page) {
                api_bophan_get(this, page);
            },
            _nguoi_dung: function (state, bophan = null) {
                if(state == 'add') {
                    console.log('add nhom');
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_nguoi_dung = true;
                    this.flag_input_nguoi_dung = false;
                    this.nguoi_dung = { id: 0, ma_nguoi_dung: '', ten_nguoi_dung: '', dien_giai: '' }
                    api_bophan_get_ma_nguoi_dung(this);
                }
                else {
                    // this.nguoi_dung = bophan;
                    this.nguoi_dung.id = bophan.id;
                    this.nguoi_dung.ma_nguoi_dung = bophan.ma_nguoi_dung;
                    this.nguoi_dung.ten_nguoi_dung = bophan.ten_nguoi_dung;
                    this.nguoi_dung.dien_giai = bophan.dien_giai;
                    this.flag_submit_nguoi_dung = false;
                    this.flag_input_nguoi_dung = true;
                }
            },
            submit_nguoi_dung: function () {
                this.change_bnt_save();
                if(this.flag_submit_nguoi_dung) {
                    this.flag_input_nguoi_dung = false;
                    this.add_nguoi_dung();
                }
                else {
                    this.nhom = this.nhom_selected;
                    this.flag_input_nguoi_dung = true;
                    this.edit_nguoi_dung();
                }
            },
            submit_search: function () {

            },
            add_nguoi_dung: function () {
                api_add_nguoi_dung(this);
            },
            edit_nguoi_dung: function() {
                console.log(this.nguoi_dung);
                api_edit_nguoi_dung(this);
            },
            delete_nguoi_dung: function(bp) {
                this.nguoi_dung = bp;
                if(this.nguoi_dung.id <= 0) return -1;
                api_delete_nguoi_dung(this);
            },
            change_bnt_save: function () {
                this.flag_btn_save = false;
                $('#save').attr('disabled', 'disabled');
            },
            un_change_bnt_save: function () {
                this.flag_btn_save = true;
                $('#save').removeAttr('disabled');
            },
            // scroll_card: function () {
            //     $('#thunho').closest('.card').find('[data-action="collapse"] i').toggleClass('ti-minus ti-plus');
            //     $('#thunho').closest('.card').children('.card-body').collapse('toggle');
            // },
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

    .center-text {
        text-align: center;
    }

    [type="checkbox"] + label {
        paddimg: 0;
        margin:0;
        height: 14px !important;
    }
</style>