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
                            <h4 class="card-title m-b-0">Danh sách quận huyện</h4>
                        </div>
                        <div class="card-body collapse show">
                            <div class="row" style="padding-bottom:6px;">
                                <div class="col-md-3">
                                    <el-select v-model="tinh_thanh_2" value-key="ma_tinh" filterable size="small" placeholder="Tỉnh thành phố" @change="load_quan_huyen" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu" style="width: 100%">
                                        <el-option :label="'Tất cả quận huyện'" :value="''"> </el-option>
                                        <el-option v-for="item in list_tinh_thanh" :key="item.ma_tinh" :label="item.ten_tinh" :value="item"> </el-option>
                                    </el-select>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <form @submit.prevent="search_qh" id="formttcv_qh">
                                            <input v-model="keyword_qh" type="text" id="timkiem_qh" class="form-control form-control-sm" placeholder="Nhập từ khóa để tìm kiếm..." style="height: 32px;">
                                            <button type="submit" class="btn btn-info btn-sm btntimkiem-sm" name="button">Tìm kiếm</button>
                                            <!--<button v-if="flag_search" @click="tat_ca_danh_sach" type="button" class="btn btn-primary btn-sm btntatca" name="button">Tất cả</button>-->
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button v-if="flag_cn.add" @click="_qh('add')" title="Thêm mới bộ phận" type="button" data-toggle="modal" data-target="#myModalquan" class="btn btn-success btn-sm waves-effect waves-dark pull-right" style="32px;">
                                        <i class="fa fa-plus-circle"></i> Thêm mới
                                    </button>
                                </div>
                            </div>
                            <div class="message-box contact-box">
                                <!--<h2 class="add-ct-btn">-->

                                <!--</h2>-->
                                <div class="message-widget contact-widget">
                                    <div class="row">
                                        <div v-show="loading_qh" class="col-md-12"><i>Đang tải danh sách...</i></div>
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <el-table :data="list_qh" border style="width: 100%">
                                                <el-table-column v-if="flag_cn.edit || flag_cn.delete" label="#" width="90" align="center" class-name="center-text">
                                                    <template slot-scope="scope" class="text-center" style="width: 100%">
                                                        <button v-if="flag_cn.edit" @click="_qh('edit', scope.row)" data-toggle="modal" data-target="#myModalquan" class="btn btn-info btn-sm" title="Cập nhật thông tin cá nhân"> <i class="fa fa-edit"></i> </button>
                                                        <button v-if="flag_cn.delete" @click="delete_qh(scope.row)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column type="index" label="TT" align="center" class-name="center-text"></el-table-column>
                                                <el-table-column prop="ma_quan_huyen" label="Mã quận huyện" width="180" class-name="no-center-text"></el-table-column>
                                                <el-table-column prop="ten_quan_huyen" label="Tên quận huyện" class-name="no-center-text"></el-table-column>
                                            </el-table>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row tb-row-hienthi">
                                                <div class="col-md-1 tb-label">
                                                    <span>Hiển thị</span>
                                                </div>
                                                <div class="col-md-1 tb-hienthi">
                                                    <el-select v-model="hienthi_qh" placeholder="10" size="small" @change="change_hien_thi_qh">
                                                        <el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-md-7">
                                                    <el-pagination :page-size="limit_qh" layout="prev, pager, next" :total="total_qh" @current-change="get_list_qh"></el-pagination>
                                                </div>
                                                <div class="col-md-3 tb-label">
                                                    <span class="pull-right">Tổng: {{total_qh}} quận huyện</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAL QH -->
                            <div class="modal" id="myModalquan">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form @submit.prevent="submit_qh" id="form_quan">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Thông tin quận huyện</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div :disabled="flag_body_modal" class="modal-body">
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Tỉnh thành(*)</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="tinh_thanh" value-key="ma_tinh" filterable size="small" placeholder="Tỉnh thành phố" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu" style="width: 100%">
                                                            <el-option v-for="item in list_tinh_thanh" :key="item.ma_tinh" :label="item.ten_tinh" :value="item"> </el-option>
                                                        </el-select>
                                                        <!--<small v-show="errors.has('so_qh')" class="help text-muted is-danger">Vui lòng chọn tỉnh thành</small>-->
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Tên quận huyện(*)</label>
                                                    <div class="col-md-9">
                                                        <input v-model="quan_huyen_new.ten_quan_huyen" name="tenqh" type="text" v-validate="'required'" :class="{'border-danger' : errors.has('tenqh')}" class="form-control form-control-sm">
                                                        <small v-show="errors.has('tenqh')" class="help text-muted is-danger">Vui lòng nhập tên quận huyện</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                                <!--<button id="save" type="submit" class="btn btn-primary">Lưu lại</button>-->
                                                <button :disabled="quan_huyen_new.ten_quan_huyen == '' || errors.has('tenqh')" id="save" type="submit" class="btn btn-primary">
                                                    <span v-if="flag_btn_save"><i class="fa fa-save"></i> Lưu lại</span>
                                                    <span v-if="!flag_btn_save"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- END MODAL QH -->
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

    import {api_get_tinh} from "./dia_chi";
    import {api_get_quan_huyen} from "../../../helper/tinh_thanh";

    import {api_all_get_quan_huyen_paginate} from "./dia_chi";
    import {api_get_quan_huyen_theo_tinh_paginate} from "./dia_chi";
    import {api_add_quan_huyen} from "./dia_chi";
    import {api_edit_quan_huyen} from "./dia_chi";
    import {api_delete_quan_huyen} from "./dia_chi";
    import {api_get_search_quan_huyen_theo_tinh_paginate} from "./dia_chi";

    import {api_get_tinh_thanh_paginate} from "./dia_chi";


    export default {
        name: 'quanhuyen',
        beforeCreate(){
            check_url_phan_quyen(this);
        },
        mounted () {
            check_quyen_chuc_nang(this);
            api_get_tinh(this);
            api_get_quan_huyen(this);
            api_all_get_quan_huyen_paginate(this,1);
            // api_get_quan_huyen_theo_tinh_paginate(this, this.tinh_thanh.ma_tinh,1);
        },
        updated () {
            $(document).ready(function() {
                $('.select2').select2();
            });
        },
        data () {
            return {
                list_tinh_thanh: [],
                flag_search_tinh: false,
                keyword_qh: '',
                loading_qh: false,
                flag_submit_qh: true,
                list_qh: [],
                total_qh: 0,
                limit_qh: 10,
                hienthi_qh: 10,
                tinh_thanh_qh: '',
                tinh_thanh: '',
                quan_huyen_new: {ma_quan_huyen: '', ten_quan_huyen: '', ma_tinh: ''},
                tinh_thanh_2: '',
                index_qh: 1,
                options_display: [10,20,30],
                flag_body_modal: false,
                flag_btn_save: true,
                flag_disabled_submit: true,
                flag_cn: {add: false, edit: false, delete: false},
                currentPage: 1
            }
        },
        methods: {
            change_hien_thi_qh: function (limit) {
                this.limit_qh = limit;
                if(this.tinh_thanh == '' || this.tinh_thanh == null){
                    api_all_get_quan_huyen_paginate(this,1);
                }
                else{
                    api_get_quan_huyen_theo_tinh_paginate(this, this.tinh_thanh.ma_tinh,1);
                }
            },
            load_quan_huyen: function (tinh) {
                if(tinh == '' || tinh == null){
                    api_all_get_quan_huyen_paginate(this,1);
                }
                else{
                    api_get_quan_huyen_theo_tinh_paginate(this, tinh.ma_tinh,1);
                }
            },
            get_list_qh: function (page) {
                this.loading_tinh = true;
                if(this.flag_search_tinh){
                    api_get_search_quan_huyen_theo_tinh_paginate(this,this.tinh_thanh_2.ma_tinh,page);
                }
                else{
                    // api_get_quan_huyen_theo_tinh_paginate(this, this.tinh_thanh.ma_tinh,page);
                    if(this.tinh_thanh_2 == '' || this.tinh_thanh_2 == null){
                        api_all_get_quan_huyen_paginate(this,page);
                    }
                    else{
                        api_get_quan_huyen_theo_tinh_paginate(this, this.tinh_thanh_2.ma_tinh,page);
                    }
                }
            },
            search_qh: function () {
                if(this.keyword_qh == '' || this.keyword_qh == null) {
                    this.flag_search_tinh = false;
                    this.get_list_qh();
                }
                else{
                    this.flag_search_tinh = true;
                    api_get_search_quan_huyen_theo_tinh_paginate(this,this.tinh_thanh.ma_tinh,1);
                }
            },
            _qh: function (state, c = null) {
                if(state == 'add') {
                    this.flag_submit_qh = true;
                    this.quan_huyen_new.ma_quan_huyen = '';
                    this.quan_huyen_new.ten_quan_huyen = '';
                }
                else {
                    this.flag_submit_qh = false;
                    this.quan_huyen_new.ma_quan_huyen = c.ma_quan_huyen;
                    this.quan_huyen_new.ten_quan_huyen = c.ten_quan_huyen;
                    this.quan_huyen_new.ma_tinh = c.ma_tinh;
                }
            },
            submit_qh: function () {
                this.quan_huyen_new.ma_tinh = this.tinh_thanh.ma_tinh;
                this.change_bnt_save();
                if(this.flag_submit_qh) {
                    api_add_quan_huyen(this);
                }
                else {
                    api_edit_quan_huyen(this);
                }
            },
            delete_qh: function(bh) {
                this.quan_huyen_new.ma_quan_huyen = bh.ma_quan_huyen;
                this.quan_huyen_new.ma_tinh = bh.ma_tinh;
                api_delete_quan_huyen(this);
            },
            count_tt: function (index) {
                return ((this.currentPage - 1) * this.limit_qh) + index;
            },
            change_bnt_save: function () {
                this.flag_btn_save = false;
                $('#save').attr('disabled', 'disabled');
            },
            un_change_bnt_save: function () {
                this.flag_btn_save = true;
                $('#save').removeAttr('disabled');
            },
            scroll_card: function () {
                $('#thunho').closest('.card').find('[data-action="collapse"] i').toggleClass('ti-minus ti-plus');
                $('#thunho').closest('.card').children('.card-body').collapse('toggle');
            },
            scroll_card_full_creem: function () {
                $('#phongto').closest('.card').find('[data-action="expand"] i').toggleClass('mdi-arrow-expand mdi-arrow-compress');
                $('#phongto').closest('.card').toggleClass('card-fullscreen');
            },
            scroll_card_qh: function () {
                $('#thunho_qh').closest('.card').find('[data-action="collapse"] i').toggleClass('ti-minus ti-plus');
                $('#thunho_qh').closest('.card').children('.card-body').collapse('toggle');
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

    .btntimkiem-sm {
        position: absolute;
        top: 3px;
        right: 18px;
        height: 37px;
        font-size: 13px;
        height: 27px;
        padding: 2px 13px;
    }

</style>