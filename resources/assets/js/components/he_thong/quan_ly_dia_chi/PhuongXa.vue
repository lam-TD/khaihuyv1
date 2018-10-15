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
                            <h4 class="card-title m-b-0">Danh sách phường xã</h4>
                        </div>
                        <div class="card-body collapse show">
                            <div class="row" style="padding-bottom:6px;">
                                <div class="col-md-3">
                                    <el-select v-model="tinh_thanh_2" value-key="ma_tinh" filterable size="small" placeholder="Chọn tỉnh thành phố" @change="load_quan_huyen" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu" style="width: 100%">
                                        <el-option :label="'Tất cả Tỉnh'" :value="''"></el-option>
                                        <el-option v-for="item in list_tinh_thanh" :key="item.ma_tinh" :label="item.ten_tinh" :value="item"> </el-option>
                                    </el-select>
                                </div>

                                <div class="col-md-3">
                                    <el-select v-model="quan_huyen_2" value-key="ma_quan_huyen" filterable size="small" placeholder="Chọn quận huyện" @change="load_quan_phuong_xa" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu" style="width: 100%">
                                        <el-option :label="'Tất cả quận huyện'" :value="''"> </el-option>
                                        <el-option v-for="item in list_change_quan_huyen" :key="item.ma_quan_huyen" :label="item.ten_quan_huyen" :value="item"> </el-option>
                                    </el-select>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <form @submit.prevent="search_px" id="formttcv_px">
                                            <input v-model="keyword_px" type="text" id="timkiem_px" class="form-control form-control-sm" placeholder="Nhập từ khóa để tìm kiếm..." style="height: 32px;">
                                            <button type="submit" class="btn btn-info btn-sm btntimkiem-sm" name="button">Tìm kiếm</button>
                                            <!--<button v-if="flag_search" @click="tat_ca_danh_sach" type="button" class="btn btn-primary btn-sm btntatca" name="button">Tất cả</button>-->
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button v-if="flag_cn.add" @click="_px('add')" title="Thêm mới bộ phận" type="button" data-toggle="modal" data-target="#myModalquan" class="btn btn-success btn-sm waves-effect waves-dark pull-right" style="32px;">
                                        <i class="fa fa-plus-circle"></i> Thêm mới
                                    </button>
                                </div>
                            </div>
                            <div class="message-box contact-box">
                                <!--<h2 class="add-ct-btn">-->

                                <!--</h2>-->
                                <div class="message-widget contact-widget">
                                    <div class="row">
                                        <div v-show="loading_px" class="col-md-12"><i>Đang tải danh sách...</i></div>
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <el-table :data="list_px" border style="width: 100%">
                                                <el-table-column v-if="flag_cn.edit || flag_cn.delete" label="#" width="90" align="center"  class-name="center-text">
                                                    <template slot-scope="scope" class="text-center" style="width: 100%">
                                                        <button v-if="flag_cn.edit" @click="_px('edit', scope.row)" data-toggle="modal" data-target="#myModalquan" class="btn btn-info btn-sm" title="Cập nhật thông tin cá nhân"> <i class="fa fa-edit"></i> </button>
                                                        <button v-if="flag_cn.delete" @click="delete_px(scope.row)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column type="index" label="TT" :index="indexMethod" align="center" class-name="center-text"></el-table-column>
                                                <el-table-column prop="phuongxa_id" label="Mã phường xã" width="180" class-name="no-center-text"></el-table-column>
                                                <el-table-column prop="ten_phuong_xa" label="Tên phường xã" class-name="no-center-text"></el-table-column>
                                            </el-table>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row tb-row-hienthi">
                                                <div class="col-md-1 tb-label">
                                                    <span>Hiển thị</span>
                                                </div>
                                                <div class="col-md-1 tb-hienthi">
                                                    <el-select v-model="hienthi_px" placeholder="10" size="small" @change="change_hien_thi_px">
                                                        <el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-md-7">
                                                    <el-pagination :current-page.sync="currentPage" :page-size="limit_px" layout="prev, pager, next" :total="total_px" @current-change="get_list_px"></el-pagination>
                                                </div>
                                                <div class="col-md-3 tb-label">
                                                    <span class="pull-right">Tổng: {{total_px}} phường xã</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MODAL px -->
                            <div class="modal" id="myModalquan">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form @submit.prevent="submit_px" id="form_quan">
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
                                                        <el-select v-model="tinh_thanh" value-key="ma_tinh" filterable size="small" placeholder="Chọn tỉnh thành phố" @change="load_quan_huyen" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu" style="width: 100%">
                                                            <el-option v-for="item in list_tinh_thanh" :key="item.ma_tinh" :label="item.ten_tinh" :value="item"> </el-option>
                                                        </el-select>
                                                    </div>

                                                    <label class="label-form col-md-3 col-form-label">Tỉnh thành(*)</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="quan_huyen" value-key="ma_quan_huyen" filterable size="small" placeholder="Chọn quận huyện" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu" style="width: 100%">
                                                            <el-option v-for="item in list_change_quan_huyen" :key="item.ma_quan_huyen" :label="item.ten_quan_huyen" :value="item"> </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Tên phường xã(*)</label>
                                                    <div class="col-md-9">
                                                        <input v-model="phuong_xa_new.ten_phuong_xa" name="tenpx" type="text" v-validate="'required'" :class="{'border-danger' : errors.has('tenpx')}" class="form-control form-control-sm">
                                                        <small v-show="errors.has('tenpx')" class="help text-muted is-danger">Vui lòng nhập tên quận huyện</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                                <!--<button id="save" type="submit" class="btn btn-primary">Lưu lại</button>-->
                                                <button :disabled="phuong_xa_new.ten_phuong_xa == '' || errors.has('tenpx')" id="save" type="submit" class="btn btn-primary">
                                                    <span v-if="flag_btn_save"><i class="fa fa-save"></i> Lưu lại</span>
                                                    <span v-if="!flag_btn_save"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- END MODAL px -->
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
    import {api_get_tinh_cua_phuong_xa} from "./dia_chi";
    import {api_get_quan_huyen} from "../../../helper/tinh_thanh";
    import {api_get_all_phuong_xa} from "./dia_chi";
    import {api_get_phuong_xa_theo_quan_huyen_paginate} from "./dia_chi";
    import {api_get_search_phuong_xa_theo_quan_huyen} from "./dia_chi";
    import {api_add_phuong_xa} from "./dia_chi";
    import {api_edit_phuong_xa} from "./dia_chi";
    import {api_delete_phuong_xa} from "./dia_chi";
    import {sweetalert} from "../../../helper/sweetalert";

    export default {
        name: 'quanhuyen',
        beforeCreate(){
            check_url_phan_quyen(this);
        },
        mounted () {
            check_quyen_chuc_nang(this);

            api_get_tinh(this);
            api_get_quan_huyen(this);
            api_get_all_phuong_xa(this,1);
            // api_get_tinh_cua_phuong_xa(this);
        },
        updated () {
            $(document).ready(function() {
                $('.select2').select2();
            });
        },
        data () {
            return {
                list_tinh_thanh: [],
                list_quan_huyen: [],
                list_change_quan_huyen: [],
                flag_search_tinh: false,
                keyword_px: '',
                loading_px: false,
                flag_submit_px: true,
                list_px: [],
                total_px: 0,
                limit_px: 10,
                hienthi_px: 10,
                tinh_thanh: '',
                tinh_thanh_2: '',
                quan_huyen:'',
                quan_huyen_2:'',
                phuong_xa_new: {ma_quan_id: '', ten_phuong_xa: '', phuongxa_id: ''},
                options_display: [10,20,30],
                flag_body_modal: false,
                flag_btn_save: true,
                flag_disabled_submit: true,
                flag_cn: {add: false, edit: false, delete: false},
                currentPage: 1
            }
        },
        methods: {
            change_hien_thi_px: function (limit) {
                this.limit_px = limit;
                // api_get_phuong_xa_theo_quan_huyen_paginate(this, this.quan_huyen.ma_quan_huyen, 1);
            },
            load_quan_huyen: function (tinh) {
                if(tinh == null || tinh == ''){
                }
                else{
                    this.list_change_quan_huyen = this.list_quan_huyen.filter(function(item){
                        return (item['ma_tinh'] == tinh.ma_tinh);
                    })
                }
                this.quan_huyen_2 = '';
                api_get_all_phuong_xa(this,1);
            },
            load_quan_phuong_xa: function (qh) {
                if(qh == null || qh == ''){
                    api_get_all_phuong_xa(this,1);
                    this.currentPage = 1;
                }
                else{
                    api_get_phuong_xa_theo_quan_huyen_paginate(this, this.quan_huyen_2.ma_quan_huyen, 1);
                    this.currentPage = 1;
                }
                // api_get_phuong_xa_theo_quan_huyen_paginate(this, this.quan_huyen.ma_quan_huyen, 1);
            },
            get_list_px: function (page) {
                this.loading_tinh = true;
                if(this.flag_search_tinh){
                    api_get_search_phuong_xa_theo_quan_huyen(this,this.quan_huyen_2.ma_quan_huyen,1);
                }
                else{
                    if(this.quan_huyen_2 == null || this.quan_huyen_2 == ''){
                        api_get_all_phuong_xa(this,page);
                    }
                    else{
                        api_get_phuong_xa_theo_quan_huyen_paginate(this, this.quan_huyen_2.ma_quan_huyen, page);
                    }

                }
            },
            search_px: function () {
                if(this.quan_huyen_2 == '' || this.quan_huyen_2 == null) {
                    alert("Chọn quận huyện để tìm kiếm")
                    return 1;
                }
                if(this.keyword_px == '' || this.keyword_px == null) {
                    this.flag_search_tinh = false;
                    this.get_list_px();
                }
                else{
                    this.flag_search_tinh = true;
                    api_get_search_phuong_xa_theo_quan_huyen(this,this.quan_huyen_2.ma_quan_huyen,1);
                }
            },
            _px: function (state, c = null) {
                if(state == 'add') {
                    this.flag_submit_px = true;
                    this.phuong_xa_new.phuongxa_id = '';
                    this.phuong_xa_new.ten_phuong_xa = '';
                }
                else {
                    this.flag_submit_px = false;
                    this.phuong_xa_new.quanhuyen_id = c.quanhuyen_id;
                    this.phuong_xa_new.ten_phuong_xa = c.ten_phuong_xa;
                    this.phuong_xa_new.phuongxa_id = c.phuongxa_id;
                }
            },
            submit_px: function () {
                this.phuong_xa_new.quanhuyen_id = this.quan_huyen.ma_quan_huyen;
                this.change_bnt_save();
                if(this.flag_submit_px) {
                    api_add_phuong_xa(this);
                }
                else {
                    api_edit_phuong_xa(this);
                }
            },
            delete_px: function(bh) {
                this.phuong_xa_new.quanhuyen_id = bh.quanhuyen_id;
                this.phuong_xa_new.phuongxa_id = bh.phuongxa_id;
                api_delete_phuong_xa(this);
            },
            indexMethod(index) {
                return (index + 1);
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
            scroll_card_px: function () {
                $('#thunho_px').closest('.card').find('[data-action="collapse"] i').toggleClass('ti-minus ti-plus');
                $('#thunho_px').closest('.card').children('.card-body').collapse('toggle');
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