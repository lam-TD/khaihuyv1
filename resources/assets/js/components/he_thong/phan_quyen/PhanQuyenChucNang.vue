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
                            <h4 class="card-title m-b-0">Phân quyền theo nhóm người dùng</h4>
                            <!--<h6 class="card-subtitle m-0 op-5">Tổng số bộ phận: {{total_nguoi_dung}}</h6>-->
                        </div>
                        <div class="card-body collapse show">
                            <div class="message-box contact-box">
                                <div class="message-widget contact-widget">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12" style="font-weight: 500;margin-bottom: 5px;">
                                                    <span style="margin-top: 8px;display: block">Danh sách nhóm người dùng</span>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <el-table highlight-current-row @current-change="click_chon_nhom" :data="list_nhom_nguoi_dung_paginate" border style="width: 100%">
                                                        <el-table-column prop="ma_nhom" label="Mã nhóm" class-name="no-center-text"></el-table-column>
                                                        <el-table-column prop="ten_nhom" label="Tên nhóm" class-name="no-center-text" show-overflow-tooltip></el-table-column>
                                                    </el-table>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row tb-row-hienthi">
                                                        <div class="col-md-7 col-sm-4 col-6" style="padding-left: 0px;">
                                                            <el-pagination small :page-size="limit" layout="prev, pager, next" :total="total_nhom_nguoi_dung" @current-change="get_nhom_nguoi_dung"></el-pagination>
                                                        </div>
                                                        <div class="col-md-5 col-sm-2 col-6 tb-label">
                                                            <span class="pull-right">Tổng: {{total_nhom_nguoi_dung}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-12" style="margin-bottom: 5px;">
                                                    <div class="row">
                                                        <div class="col-md-6"><span style="font-weight: 500;height: 100%;margin-top: 8px;display: block">Danh sách chức năng</span></div>
                                                        <div class="col-md-4 label-dd">
                                                            <el-select :disabled="flag_chon_nhom" v-model="nhom_chuc_nang" @change="change_nhom_chuc_nang" value-key="id" size="small" placeholder="Select" :loading="flag_nhom_chuc_nang" class="pull-right" style="width: 100%">
                                                                <el-option :label="'Tất cả nhóm chức năng'" :value="''"></el-option>
                                                                <el-option v-for="item in list_nhom_chuc_nang" :key="item.id" :label="item.ten_nhom" :value="item">
                                                                    <template>
                                                                        <span style="float: left"><i class="pr-2" :class="item.icon"></i>{{ item.ten_nhom }}</span>
                                                                    </template>
                                                                </el-option>
                                                            </el-select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button :disabled="flag_chon_nhom" @click="submit_phan_quyen" type="button" class="btn btn-sm btn-info pull-right" style="height: 100%;width: 100%"><i class="fa fa-save"></i> Lưu lại</button>
                                                            <!--<el-button type="primary" size="small"><i class="fa fa-save"></i> Lưu lại</el-button>-->
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-2">
                                                    <el-table :v-loading="'true'" @selection-change="check_chuc_nang" :data="list_chuc_nang" border max-height="530" empty-text="Vui lòng chọn nhóm người dùng" style="width: 100%">
                                                        <el-table-column prop="ten_chuc_nang" label="Tên chức năng" class-name="no-center-text"></el-table-column>
                                                        <el-table-column label="All" width="80" align="center" class-name="center-text">
                                                            <template slot-scope="scope">
                                                                <input @click="all_quyen" :id="'all' + scope.row.id" :checked="scope.row.all == 1" type="checkbox" class="form-control form-control-sm">
                                                            </template>
                                                        </el-table-column>
                                                        <el-table-column label="Xem" width="80" align="center" class-name="center-text">
                                                            <template slot-scope="scope">
                                                                <input type="checkbox" :id="'x' + scope.row.id" :value="scope.row.xem" :checked="scope.row.xem == 1" class="form-control form-control-sm">
                                                            </template>
                                                        </el-table-column>
                                                        <el-table-column label="Thêm"  width="80" align="center" class-name="center-text">
                                                            <template slot-scope="scope">
                                                                <input type="checkbox" :id="'t' + scope.row.id" :value="scope.row.them" :checked="scope.row.them == 1" class="form-control form-control-sm">
                                                            </template>
                                                        </el-table-column>
                                                        <el-table-column label="Sửa" width="80" align="center" class-name="center-text">
                                                            <template slot-scope="scope">
                                                                <input type="checkbox" :id="'s' + scope.row.id" :value="scope.row.sua" :checked="scope.row.sua == 1" class="form-control form-control-sm">
                                                            </template>
                                                        </el-table-column>
                                                        <el-table-column label="Xóa" width="80" align="center" class-name="center-text">
                                                            <template slot-scope="scope">
                                                                <input type="checkbox" :id="'de' + scope.row.id" :value="scope.row.xoa" :checked="scope.row.xoa == 1" class="form-control form-control-sm">
                                                            </template>
                                                        </el-table-column>
                                                    </el-table>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row tb-row-hienthi">
                                                        <!--<div class="col-md-7 col-sm-4 col-6" style="padding-left: 0px;">-->
                                                            <!--<el-pagination small :page-size="limit" :pager-count="4" layout="prev, pager, next" :total="total_nhom_nguoi_dung" @current-change="danh_sach_nhom_nguoi_dung"></el-pagination>-->
                                                        <!--</div>-->
                                                        <div class="col-md-12 col-sm-2 col-6 tb-label">
                                                            <span class="pull-right">Tổng: {{list_chuc_nang.length}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!--////-->
                                </div>
                            </div>
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
    import {api_get_all_danh_sach_nhom_nguoi_dung} from "../quan_ly_nhom/QuanLyNhom_helper";
    import {api_get_nhom_chuc_nang} from "./phan_quyen_chuc_nang";
    import {api_get_chuc_nang_theo_nhom} from "./phan_quyen_chuc_nang";
    import {api_get_chuc_nang_theo_nhom_nguoi_dung_va_nhom_chuc_nang} from "./phan_quyen_chuc_nang";
    import {api_save_phan_quyen} from "./phan_quyen_chuc_nang";

    export default {
        name: 'quanlynguoidung',
        mounted () {
            api_get_all_danh_sach_nhom_nguoi_dung(this);
            api_get_nhom_chuc_nang(this);
            // api_get_chuc_nang_theo_nhom(this,"all");
        },
        data () {
            return {
                list_nhom_nguoi_dung_paginate: [],
                list_nhom_chuc_nang: [],
                list_chuc_nang: [],
                list_chuc_nang_cua_nhom: [],
                nhom_nguoi_dung: '',
                nhom_chuc_nang: '',
                total_nhom_nguoi_dung: 0,
                chuc_nang: '',
                limit: 10,
                pager_count_nhom: 4,
                flag_nhom_chuc_nang: false,
                flag_chuc_nang: false,
                flag_chon_nhom: true

            }
        },
        methods: {
            get_nhom_nguoi_dung: function (page = 1) {
                api_get_all_danh_sach_nhom_nguoi_dung(this, page)
            },
            click_chon_nhom: function (nhom) {
                this.nhom_nguoi_dung = nhom;
                api_get_chuc_nang_theo_nhom(this,"all");
                this.flag_chon_nhom = false;
            },
            change_nhom_chuc_nang: function (ncn) {
                if(ncn == ''){
                    api_get_chuc_nang_theo_nhom(this,"all");
                }
                else{
                    console.log(this.nhom_nguoi_dung);
                    this.nhom_chuc_nang = ncn;
                    api_get_chuc_nang_theo_nhom_nguoi_dung_va_nhom_chuc_nang(this, this.nhom_nguoi_dung.id, ncn.id);
                }
            },
            check_chuc_nang: function () {

            },
            all_quyen: function () {
                
            },
            check_quyen_cho_nhom: function(data) {
                if(data.length > 0){
                    $.each(data, function(idx, obj){
                        (obj.all == 1)       ? $('#all' + obj.id).prop('checked', true)  : $('#all' + obj.id).prop('checked', false);
                        (obj.xem == 1)       ? $('#x' + obj.id).prop('checked', true)    : $('#x' + obj.id).prop('checked', false);
                        (obj.them == 1)      ? $('#t' + obj.id).prop('checked', true)    : $('#t' + obj.id).prop('checked', false);
                        (obj.sua == 1)       ? $('#s' + obj.id).prop('checked', true)    : $('#s' + obj.id).prop('checked', false);
                        (obj.xoa == 1)       ? $('#de' + obj.id).prop('checked',true)    : $('#de' + obj.id).prop('checked', false);
                    });
                }
                else{
                    $('input[type=checkbox]').prop('checked', false);
                }
            },
            submit_phan_quyen: function () {
                let arr = [];
                $.each(this.list_chuc_nang, function(idx, obj){
                    var all  = $('#all' + obj.id).prop('checked')  ? 1 : 0;
                    var xem  = $('#x' + obj.id).prop('checked')  ? 1 : 0;
                    var them = $('#t' + obj.id).prop('checked')  ? 1 : 0;
                    var sua  = $('#s' + obj.id).prop('checked')  ? 1 : 0;
                    var xoa  = $('#de' + obj.id).prop('checked') ? 1 : 0;
                    var item = {id: obj.id, all: all, xem: xem, them: them, sua: sua, xoa: xoa};
                    arr.push(item);
                });
                let phan_quyen = {
                    id_nhom_nguoi_dung: this.nhom_nguoi_dung.id,
                    arr_cn: arr
                }
                api_save_phan_quyen(this, phan_quyen);
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