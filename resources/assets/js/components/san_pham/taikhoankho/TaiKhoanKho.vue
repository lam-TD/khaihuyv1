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
                                <a @click="_tk_kho('add')" title="Thêm mới bộ phận" data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-dark btn-white" style="color: white"><i class="fa fa-plus-circle"></i> Thêm mới</a>
                                <!--<a @click="scroll_card" id="thunho" class="" data-action="collapse"><i class="ti-minus"></i></a>-->
                                <a @click="scroll_card_full_creem" id="phongto" class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                <!--<a class="btn-close" data-action="close"><i class="ti-close"></i></a>-->
                            </div>
                            <h4 class="card-title m-b-0">Danh sách tài khoản kho</h4>
                            <!--<h6 class="card-subtitle m-0 op-5">Tổng số bộ phận: {{total_tk_kho}}</h6>-->
                        </div>
                        <div class="card-body collapse show">
                            <div class="message-box contact-box">
                                <!--<dic class="add-ct-btn">-->
                                <!---->
                                <!--</dic>-->
                                <div class="message-widget contact-widget">
                                    <div class="row">
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <el-table :data="list_tk_kho" border style="width: 100%">
                                                <el-table-column label="#" width="90" align="center"  class-name="center-text">
                                                    <template slot-scope="scope" class="text-center" style="width: 100%">
                                                        <button @click="_tk_kho('edit', scope.row)" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm" title="Cập nhật thông tin bộ phận"> <i class="fa fa-edit"></i> </button>
                                                        <button @click="delete_tk_kho(scope.row)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                                    </template>
                                                </el-table-column>

                                                <el-table-column type="index" label="TT" align="center" class-name="center-text"></el-table-column>

                                                <el-table-column prop="ma_tk" label="Mã tài khoản" class-name="no-center-text"></el-table-column>

                                                <el-table-column prop="ten_tk" label="Tên tài khoản" class-name="no-center-text"></el-table-column>

                                                <el-table-column prop="ghi_chu" label="Ghi chú" class-name="no-center-text"></el-table-column>
                                            </el-table>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row tb-row-hienthi">
                                                <div class="col-md-1 col-sm-2 col-8 tb-label pr-0" style="padding-left: 15px;">
                                                    <span>Hiển thị</span>
                                                </div>
                                                <div class="col-md-1 col-sm-2 col-4 tb-hienthi" style="padding-left: 4px;">
                                                    <el-select v-model="limit" placeholder="10" size="small" @change="change_danh_sach_tk_kho">
                                                        <el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-md-8 col-sm-4 col-6" style="padding-left: 0px;">
                                                    <el-pagination :page-size="limit" layout="prev, pager, next" :total="total_tk_kho" @current-change="danh_sach_tk_kho"></el-pagination>
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-6 tb-label">
                                                    <span class="pull-right">Tổng: {{total_tk_kho}} mẫu tin</span>
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
                                        <form @submit.prevent="submit_tk_kho" id="form_bophan">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Thông tin tài khoản kho</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div :disabled="flag_body_modal" class="modal-body">
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Mã TK(*)</b></label>
                                                    <div class="col-md-9">
                                                        <input v-model="tk_kho.ma_tk" :disabled="flag_input_tk_kho" v-validate="'required'" :class="{'border-danger' : errors.has('txtmabophan')}" type="text" name="txtmabophan" class="form-control form-control-sm" id="txtmabophan" aria-describedby="" autofocus>
                                                        <small v-if="flag_input_ma_tk_kho" class="help text-muted is-danger">Vui lòng nhập mã tài khoản</small>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Tên TK(*)</b></label>
                                                    <div class="col-md-9">
                                                        <input v-model="tk_kho.ten_tk" v-validate="'required'" :class="{'border-danger' : errors.has('txttenbophan')}" type="text" name="txttenbophan" class="form-control form-control-sm" id="txttenbophan" placeholder="">
                                                        <small v-show="errors.has('txttenbophan')" class="help text-muted is-danger">Vui lòng nhập tên tài khoản</small>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Ghi chú</b></label>
                                                    <div class="col-md-9">
                                                        <textarea v-model="tk_kho.ghi_chu" type="text" name="txtdiengiai" class="form-control form-control-sm" id="txtdiengiai"></textarea>
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
    import {api_tk_kho_get_paginate} from "./tai_khoan_kho";
    import {api_add_tk_kho} from "./tai_khoan_kho";
    import {api_edit_tk_kho} from "./tai_khoan_kho";
    import {api_delete_tk_kho} from "./tai_khoan_kho";
    // import {api_bophan_get_ma_tk_kho} from "./tk_kho";

    export default {
        name: 'bophan',
        mounted () {
            api_tk_kho_get_paginate(this, 1);
        },
        updated () {
            $(document).ready(function() {
                $('.select2').select2();
            });
        },
        data () {
            return {
                loading_tk_kho: true,
                list_tk_kho: [],
                total_tk_kho: 0,
                tk_kho: { id: 0, ma_tk: '', ten_tk: '', ghi_chu: '' },
                flag_btn: true,
                flag_submit_tk_kho: true,
                flag_input_tk_kho: false,
                flag_body_modal: false,
                flag_btn_save: true,
                flag_disabled_submit: false,
                flag_input_ma_tk_kho: false,
                options_display: [10,20,30],
                limit: 10
            }
        },
        methods: {
            change_danh_sach_tk_kho: function () {
                api_tk_kho_get_paginate(this, 1);
            },
            danh_sach_tk_kho: function (page) {
                api_tk_kho_get_paginate(this, page);
            },
            _tk_kho: function (state, tk_kho = null) {
                if(state == 'add') {
                    this.flag_btn = true;
                    this.flag_submit_tk_kho = true;
                    this.flag_input_tk_kho = false;
                    this.tk_kho = { id: 0, ma_tk: '', ten_tk: '', ghi_chu: '' }
                }
                else {
                    this.tk_kho.id = tk_kho.id;
                    this.tk_kho.ma_tk = tk_kho.ma_tk;
                    this.tk_kho.ten_tk = tk_kho.ten_tk;
                    this.tk_kho.ghi_chu = tk_kho.ghi_chu;
                    this.flag_submit_tk_kho = false;
                    this.flag_input_tk_kho = true;
                }
            },
            submit_tk_kho: function () {
                this.change_bnt_save();
                if(this.flag_submit_tk_kho) {
                    this.flag_input_tk_kho = false;
                    api_add_tk_kho(this);
                }
                else {
                    this.nhom = this.nhom_selected;
                    this.flag_input_tk_kho = true;
                    api_edit_tk_kho(this);
                }
            },
            delete_tk_kho: function(bp) {
                this.tk_kho = bp;
                if(this.tk_kho.id <= 0) return -1;
                api_delete_tk_kho(this);
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

    .modal {
        transition: 1s ease-out;
    }
</style>