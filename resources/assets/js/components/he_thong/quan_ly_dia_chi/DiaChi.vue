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
                                <!--<a @click="scroll_card" id="thunho" class="" data-action="collapse"><i class="ti-minus"></i></a>-->
                                <a @click="scroll_card_full_creem" id="phongto" class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                            </div>
                            <h4 class="card-title m-b-0">Danh sách tỉnh thành</h4>
                        </div>
                        <div class="card-body collapse show">
                            <div class="row" style="padding-bottom:6px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <form @submit.prevent="search_tinh" id="formttcv_t">
                                            <input v-model="keyword_tinh" type="text" id="timkiem" class="form-control" placeholder="Nhập từ khóa để tìm kiếm...">
                                            <button type="submit" class="btn btn-info btn-sm btntimkiem" name="button">Tìm kiếm</button>
                                            <!--<button v-if="flag_search" @click="tat_ca_danh_sach" type="button" class="btn btn-primary btn-sm btntatca" name="button">Tất cả</button>-->
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button @click="_tinh('add')" title="Thêm mới bộ phận" type="button" data-toggle="modal" data-target="#myModalTinh" class="btn btn-success waves-effect waves-dark pull-right">
                                        <i class="fa fa-plus-circle"></i> Thêm mới
                                    </button>
                                </div>
                            </div>
                            <div class="message-box contact-box">
                                <!--<h2 class="add-ct-btn">-->

                                <!--</h2>-->
                                <div class="message-widget contact-widget">
                                    <div class="row">
                                        <div v-show="loading_tinh" class="col-md-12"><i>Đang tải danh sách tỉnh...</i></div>
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <el-table :data="list_tinh_thanh_pa" border style="width: 100%">
                                                <el-table-column label="#" width="90" align="center" class-name="center-text">
                                                    <template slot-scope="scope" class="text-center" style="width: 100%">
                                                        <button @click="_tinh('edit', scope.row)" data-toggle="modal" data-target="#myModalTinh" class="btn btn-info btn-sm" title="Cập nhật thông tin cá nhân"> <i class="fa fa-edit"></i> </button>
                                                        <button @click="delete_tinh(scope.row)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column type="index" label="TT" align="center" class-name="center-text"></el-table-column>
                                                <el-table-column prop="ma_tinh" label="Mã tỉnh" width="180" class-name="no-center-text"></el-table-column>
                                                <el-table-column prop="ten_tinh" label="Tên Tỉnh" class-name="no-center-text"></el-table-column>
                                            </el-table>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row tb-row-hienthi">
                                                <div class="col-md-1 tb-label">
                                                    <span>Hiển thị</span>
                                                </div>
                                                <div class="col-md-1 tb-hienthi">
                                                    <el-select v-model="hienthi_tinh" placeholder="10" size="small" @change="change_hien_thi_tinh">
                                                        <el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-md-8">
                                                    <el-pagination :page-size="limit_tinh" layout="prev, pager, next" :total="total_tinh" @current-change="get_list_tinh"></el-pagination>
                                                </div>
                                                <div class="col-md-2 tb-label">
                                                    <span class="pull-right">Tổng: {{total_tinh}} Tỉnh</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAL THONG TIN CON VIEC-->
                            <div class="modal" id="myModalTinh">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form @submit.prevent="submit_tinh" id="form_bophan">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Thông tin tỉnh thành</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div :disabled="flag_body_modal" class="modal-body">
                                                <div class="form-group row">
                                                    <!--<label class="label-form col-md-3 col-form-label">Mã tỉnh(*)</label>-->
                                                    <!--<div class="col-md-9">-->
                                                        <!--<div class="row">-->
                                                            <!--<div class="col-md-6">-->
                                                                <!--<input v-model="tinh_thanh.ma_tinh" type="text" class="form-control form-control-sm" readonly>-->
                                                            <!--</div>-->
                                                        <!--</div>-->
                                                    <!--</div>-->
                                                    <label class="label-form col-md-3 col-form-label">Tên tỉnh(*)</label>
                                                    <div class="col-md-9">
                                                        <input v-model="tinh_thanh_new.ten_tinh" type="text" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('txttentinh')}" name="txttentinh">
                                                        <small v-show="errors.has('txttentinh')" class="help text-muted is-danger">Vui lòng nhập tên tỉnh</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                                <!--<button id="save" type="submit" class="btn btn-primary">Lưu lại</button>-->
                                                <button :disabled="errors.has('txttentinh')" id="save" type="submit" class="btn btn-primary">
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

    import {api_get_tinh} from "./dia_chi";

    import {api_get_tinh_thanh_paginate} from "./dia_chi";
    import {api_add_tinh_thanh} from "./dia_chi";
    import {api_edit_tinh_thanh} from "./dia_chi";
    import {api_delete_tinh_thanh} from "./dia_chi";
    import {api_get_search_tinh_thanh_paginate} from "./dia_chi";


    export default {
        name: 'bophan',
        mounted () {
            api_get_tinh_thanh_paginate(this,1,10);
        },
        updated () {

        },
        data () {
            return {
                list_tinh_thanh: [],
                flag_search_tinh: false,
                keyword_tinh: '',
                loading_tinh: false,
                flag_submit_tinh: true,
                list_tinh_thanh_pa: [],
                tinh_thanh_new: {ma_tinh: '', ten_tinh: ''},
                total_tinh: 0,
                limit_tinh: 10,
                hienthi_tinh: 10,
                index_ttcv: 1,
                options_display: [10,20,30],
                flag_body_modal: false,
                flag_btn_save: true,
            }
        },
        methods: {
            get_list_tinh: function (page) {
                this.loading_tinh = true;
                if(this.flag_search_tinh){
                    api_get_search_tinh_thanh_paginate(this,1,this.limit_tinh);
                }
                else{
                    api_get_tinh_thanh_paginate(this,page,this.limit_tinh);
                }
            },
            change_hien_thi_tinh: function (limit) {
                this.limit_tinh = limit;
                api_get_tinh_thanh_paginate(this,1,limit);
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
            _tinh: function (state, t = null) {
                if(state == 'add'){
                    this.flag_submit_tinh = true;
                    this.tinh_thanh_new.ma_tinh = '';
                    this.tinh_thanh_new.ten_tinh = '';
                }
                else{
                    this.flag_submit_tinh= false;
                    this.tinh_thanh_new.ma_tinh = t.ma_tinh;
                    this.tinh_thanh_new.ten_tinh = t.ten_tinh;
                }
            },
            search_tinh: function () {
                if (this.keyword_tinh == null || this.keyword_tinh == '')  api_get_tinh_thanh_paginate(this,1,this.limit_tinh);
                else{
                    api_get_search_tinh_thanh_paginate(this,1,this.limit_tinh);
                }
            },
            submit_tinh: function () {
                if(this.flag_submit_tinh){
                    api_add_tinh_thanh(this);
                }
                else{
                    api_edit_tinh_thanh(this);
                }
            },
            delete_tinh: function (n) {
                this.tinh_thanh_new.ma_tinh = n.ma_tinh;
                api_delete_tinh_thanh(this);

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