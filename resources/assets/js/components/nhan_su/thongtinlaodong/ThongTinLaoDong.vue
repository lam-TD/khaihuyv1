<template>
    <div class="page-wrapper" style="min-height: 291px;">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!--<div class="row page-titles">-->
            <!--<div class="col-md-5 align-self-center">-->
                <!--<h3 class="text-themecolor">Thông tin hợp đồng lao động</h3>-->
            <!--</div>-->
            <!--<div class="col-md-7 align-self-center">-->
                <!--<ol class="breadcrumb">-->
                    <!--<li class="breadcrumb-item"><a href="javascript:void(0)">Nhân sự</a></li>-->
                    <!--<li class="breadcrumb-item">Hợp đồng lao động</li>-->
                <!--</ol>-->
            <!--</div>-->
        <!--</div>-->
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
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
                            <h4 class="card-title m-b-0">Hợp đồng lao động</h4>
                        </div>
                        <div class="card-body">
                            <div class="row" style="padding-top: 10px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <form @submit.prevent="search_lao_dong">
                                            <input v-model="keyword" type="text" id="timkiem" class="form-control" placeholder="Nhập từ khóa để tìm kiếm...">
                                            <button type="submit" class="btn btn-info btn-sm btntimkiem" name="button">Tìm kiếm</button>
                                            <!--<button v-if="flag_search" @click="tat_ca_danh_sach" type="button" class="btn btn-primary btn-sm btntatca" name="button">Tất cả</button>-->
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button v-if="flag_cn.add" @click="_lao_dong('add')" title="Thêm mới bộ phận" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-dark pull-right">
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
                                            <el-table :data="list_lao_dong" border style="width: 100%">
                                                <el-table-column v-if="flag_cn.edit || flag_cn.delete" label="#" width="90" align="center" class-name="center-text">
                                                    <template slot-scope="scope" class="text-center" style="width: 100%">
                                                        <button v-if="flag_cn.edit" @click="_lao_dong('edit', scope.row)" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm" title="Cập nhật thông tin hợp đồng lao động"> <i class="fa fa-edit"></i> </button>
                                                        <button v-if="flag_cn.delete" @click="delete_lao_dong(scope.row)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column type="index" label="TT" align="center" class-name="center-text"></el-table-column>
                                                <el-table-column prop="ma_nv" label="Mã NV" align="center" width="100" class-name="center-text"></el-table-column>
                                                <el-table-column prop="ho_ten" label="Tên NV" width="150" class-name="no-center-text"></el-table-column>
                                                <el-table-column prop="so_hdld" label="Số HĐ" class-name="no-center-text"></el-table-column>
                                                <el-table-column prop="thoi_han_hd" label="Thời hạn" align="center" class-name="center-text"></el-table-column>
                                                <el-table-column label="Ngày ký" align="center" class-name="center-text">
                                                    <template slot-scope="scope">
                                                        {{short_date(scope.row.ngay_ky)}}
                                                    </template>
                                                </el-table-column>
                                                <el-table-column label="Ngày kết thúc" align="center" class-name="center-text">
                                                    <template slot-scope="scope">
                                                        {{short_date(scope.row.ngay_kt)}}
                                                    </template>
                                                </el-table-column>
                                                <el-table-column prop="ghi_chu" label="Ghi chú" class-name="no-center-text"></el-table-column>
                                            </el-table>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row tb-row-hienthi">
                                                <div class="col-md-1 col-sm-2 col-8 tb-label pr-0" style="padding-left: 15px;">
                                                    <span>Hiển thị</span>
                                                </div>
                                                <div class="col-md-1 col-sm-2 col-4 tb-hienthi" style="padding-left: 4px;">
                                                    <el-select v-model="limit" placeholder="10" size="small" @change="danh_sach_lao_dong_limit">
                                                        <el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-md-8 col-sm-4 col-6" style="padding-left: 0px;">
                                                    <el-pagination :page-size="limit" layout="prev, pager, next" :total="total_lao_dong" @current-change="danh_sach_lao_dong" :current-page.sync="currentPage"></el-pagination>
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-6 tb-label">
                                                    <span class="pull-right">Tổng: {{total_lao_dong}} LĐ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--////-->
                                </div>
                            </div>

                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form @submit.prevent="submit_lao_dong" id="form_bophan">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Thông tin hợp đồng lao động</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div :disabled="flag_body_modal" class="modal-body">
                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-form-label">Mã NV(*)</label>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input v-model="lao_dong.ma_nv" type="text" id="txtnhanvien-sua" class="form-control form-control-sm" readonly>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <el-select v-model="nhan_vien" @change="select_nv" :disabled="flag_disable_manv" value-key="ma_nv" filterable size="small" placeholder="Chọn nhân viên" style="width: 100%" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                                    <!--<template slot="prefix"><label class="prefix">{{nhan_vien.ma_nv}}</label></template>-->
                                                                    <el-option v-for="item in list_nhan_vien" :key="item.ma_nv" :label="item.ho_ten" :value="item">
                                                                        <span style="float: left">{{ item.ma_nv }}</span>
                                                                        <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ho_ten }}</span>
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--<div class="form-group row">-->
                                                    <!--<label class="label-form col-md-3 col-form-label">Tên nhân viên</label>-->
                                                    <!--<div class="col-md-9">-->
                                                        <!--<input name="txthoten" type="text" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('txthoten')}">-->
                                                    <!--</div>-->
                                                <!--</div>-->

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-form-label">Số HĐLĐ(*)</label>
                                                    <div class="col-md-10">
                                                        <input v-model="lao_dong.so_hdld" name="txthoten" type="text" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('txthoten')}">
                                                        <small v-show="errors.has('txthoten')" class="help text-muted is-danger">Vui lòng nhập tên nhân viên</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-form-label">Thời hạn</label>
                                                    <div class="col-md-10">
                                                        <!--<input v-model="lao_dong.thoi_han_hd" name="txtthoihan" type="text" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('txtthoihan')}">-->
                                                        <el-select v-model="lao_dong.thoi_han_hd" placeholder="Thời hạn" size="small" class="" style="width: 100%;">
                                                            <el-option v-for="item in [1,2,3,4,5,6,7,8,9,10]" :key="item" :label="item" :value="item"></el-option>
                                                        </el-select>
                                                        <small v-show="errors.has('txtthoihan')" class="help text-muted is-danger">Vui lòng nhập thời hạn lao động</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-form-label">Ngày ký</label>
                                                    <div class="col-md-4">
                                                        <input v-model="lao_dong.ngay_ky" type="date" name="txtngayky" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('txtngayky')}">
                                                        <small v-show="errors.has('txtngayky')" class="help text-muted is-danger">Vui lòng nhập ngày ký</small>
                                                    </div>

                                                    <label class="label-form col-md-2 col-form-label">Ngày KT</label>
                                                    <div class="col-md-4">
                                                        <input v-model="lao_dong.ngay_kt" name="txtngaykt" type="date" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('txtngaykt')}">
                                                        <small v-show="errors.has('txtngaykt')" class="help text-muted is-danger">Vui lòng nhập ngày kết thúc</small>
                                                    </div>
                                                </div>

                                                <!--<div class="form-group row">-->
                                                    <!--<label class="label-form col-md-2 col-form-label">Ngày KT</label>-->
                                                    <!--<div class="col-md-10">-->
                                                        <!--<input v-model="lao_dong.ngay_kt" name="txtngaykt" type="date" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('txtngaykt')}">-->
                                                        <!--<small v-show="errors.has('txtngaykt')" class="help text-muted is-danger">Vui lòng nhập ngày kết thúc</small>-->
                                                    <!--</div>-->
                                                <!--</div>-->

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-form-label">Ghi chú</label>
                                                    <div class="col-md-10">
                                                        <textarea v-model="lao_dong.ghi_chu" name="" id="" class="form-control form-control-sm"></textarea>
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

    import {api_get_all_lao_dong} from './lao_dong';
    import {api_add_lao_dong} from "./lao_dong";
    import {api_edit_lao_dong} from "./lao_dong";
    import {api_delete_lao_dong} from "./lao_dong";

    import {api_search_all_lao_dong} from "./lao_dong";
    import {api_nhan_vien_get_all_no_pa} from "../../helper/nhan_vien";

    export default {
        name: 'thongtinlaodong',
        beforeCreate(){
            check_url_phan_quyen(this);
        },
        mounted () {
            check_quyen_chuc_nang(this);
            this.danh_sach_lao_dong(1);
            api_nhan_vien_get_all_no_pa(this);
        },
        updated () {
            $(document).ready(function() {
                $('.select2').select2();
            });
        },
        data () {
            return {
                nhan_vien: '',
                ma_nv: '',
                list_nhan_vien: [],
                flag_nhan_vien: true,
                loading_lao_dong: true,
                flag_search: false,
                keyword: '',
                list_lao_dong: [],
                total_lao_dong: 0,
                lao_dong: { id: 0, so_hdld: '', thoi_han_hd: '', ngay_ky: '', ngay_kt: '', ghi_chu: '', ma_nv: '' },
                flag_btn: true,
                flag_disable_manv: false,
                flag_submit_lao_dong: true,
                flag_input_lao_dong: false,
                flag_body_modal: false,
                flag_btn_save: true,
                flag_disabled_submit: false,
                flag_input_ma_lao_dong: false,
                flag_disable_manv: false,
                options_display: [10,20,30],
                limit: 10,
                currentPage: 1,
                flag_cn: {add: false, edit: false, delete: false}
            }
        },
        methods: {
            validate_ma_bp: function () {
                var length_nv = this.lao_dong.ma_lao_dong.length;
                var value_nv  = this.lao_dong.ma_lao_dong;
                if((length_nv > 8 || length_nv < 8) || value_nv.indexOf('BP') == -1 || value_nv.indexOf(' ') > -1){
                    this.flag_input_ma_lao_dong = true;
                    this.flag_disabled_submit = true;
                }
                else{
                    this.flag_input_ma_lao_dong = false;
                    this.flag_disabled_submit = false;
                }
            },
            short_date: function (itemday) {
                var date_ = itemday.slice(0,10);
                var d     = new Date(date_);
                var month = '' + (d.getMonth() + 1);
                var day_   = '' + d.getDate();
                var year  = d.getFullYear();

                if (month.length < 2) month = '0' + month;
                if (day_.length < 2) day_ = '0' + day_;

                return [day_,month,year].join('-');
            },
            select_nv: function (nv) {
                this.lao_dong.ma_nv = nv.ma_nv;
            },
            search_lao_dong: function (page = 1) {
                if(this.keyword == '' || this.keyword == null) {this.flag_search = false; this.danh_sach_lao_dong();}
                this.flag_search = true;
                api_search_all_lao_dong(this, page);
            },
            tat_ca_danh_sach: function () {
                this.flag_search = false;
                api_get_all_lao_dong(this, 1);
            },
            danh_sach_lao_dong: function (page = 1) {
                this.loading_lao_dong = true;
                if(this.flag_search){
                    api_search_all_lao_dong(this, page);
                }
                else{
                    api_get_all_lao_dong(this, page);
                }
            },
            danh_sach_lao_dong_limit: function () {
                this.loading_lao_dong = true;
                if(this.flag_search){
                    this.currentPage = 1;
                    api_search_all_lao_dong(this, 1);
                }
                else{
                    this.currentPage = 1;
                    api_get_all_lao_dong(this, 1);
                }
            },
            _lao_dong: function (state, laodong = null) {
                if(state == 'add') {
                    this.flag_disable_manv = false;
                    this.flag_nhan_vien = true;
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_disable_manv = false;
                    this.flag_submit_lao_dong = true;
                    this.flag_input_lao_dong = false;
                    this.lao_dong = { id: 0, so_hdld: '', thoi_han_hd: '', ngay_ky: '', ngay_kt: '', ghi_chu: '', ma_nv: '' }
                    this.nhan_vien.ma_nv = this.nhan_vien.ho_ten = '';
                }
                else {
                    this.flag_disable_manv = true;
                    this.flag_nhan_vien = false;
                    this.nhan_vien = this.list_nhan_vien.filter(function(item){
                        return (item['ma_nv'] == laodong.ma_nv);
                    })[0];
                    this.lao_dong = laodong;
                    this.lao_dong.id = laodong.hd_id;
                    this.flag_disable_manv = true;
                    this.flag_submit_lao_dong = false;
                    this.flag_input_lao_dong = true;
                }
            },
            submit_lao_dong: function () {
                this.change_bnt_save();
                if(this.flag_submit_lao_dong) {
                    console.log(this.ma_nv);
                    // this.lao_dong.ma_nv = this.ma_nv;
                    this.flag_input_lao_dong = false;
                    this.add_lao_dong();
                }
                else {
                    this.flag_input_lao_dong = true;
                    this.edit_lao_dong();
                }
            },
            click_lao_dong: function (bp) {
                $('.row-nhom').removeClass("active-click-row");
                $('#n' + bp.id).addClass("active-click-row");
            },
            add_lao_dong: function () {
                // console.log(this.lao_dong);
                api_add_lao_dong(this);
            },
            edit_lao_dong: function() {
                // console.log(this.lao_dong);
                api_edit_lao_dong(this);
            },
            delete_lao_dong: function(hdld) {
                this.lao_dong.id = hdld.hd_id;
                if(this.lao_dong.id <= 0) return -1;
                api_delete_lao_dong(this);
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

    .el-input--prefix .el-input__inner {
        padding-left: 65px !important;
    }

    @media (min-width: 576px){
        .modal-dialog {
            max-width: 600px;
        }
    }
</style>