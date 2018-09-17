<template>
    <div class="page-wrapper" style="min-height: 291px;">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <!--<h3 class="text-themecolor">Danh sách nhóm người dùng</h3>-->
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Nhân sự</a></li>
                    <li class="breadcrumb-item">Hợp đồng lao động</li>
                </ol>
            </div>
        </div>
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
                <div class="col-lg-12 col-md-12">
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row" style="padding-top: 10px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <form @submit.prevent="search_lao_dong">
                                            <input v-model="keyword" type="text" id="timkiem" class="form-control" placeholder="Nhập từ khóa để tìm kiếm...">
                                            <button type="submit" class="btn btn-info btn-sm btntimkiem" name="button">Tìm kiếm</button>
                                            <button v-if="flag_search" @click="tat_ca_danh_sach" type="button" class="btn btn-primary btn-sm btntatca" name="button">Tất cả</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button @click="_lao_dong('add')" title="Thêm mới bộ phận" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-dark pull-right">
                                        <i class="fa fa-plus-circle"></i> Thêm mới
                                    </button>
                                </div>
                            </div>
                            <div class="message-box contact-box">
                                <!--<h2 class="add-ct-btn">-->

                                <!--</h2>-->
                                <div class="message-widget contact-widget">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr style="border-top: 1px solid #ddd">
                                                <th class="text-left">#</th>
                                                <th>Mã NV</th>
                                                <th>Tên nhân viên</th>
                                                <th>Số HĐ</th>
                                                <th>Thời hạn</th>
                                                <th>Ngày ký</th>
                                                <th>Ngày KT</th>
                                                <th>Ghi chú</th>
                                                <!--<th>Ngày tạo</th>-->
                                            </tr>
                                            </thead>
                                            <tbody class="body-table loading-item">
                                            <tr v-if="loading_lao_dong">
                                                <td class="text-center" colspan="8"><b><i><i class="fa fa-spin fa-spinner"></i> Đang tải danh sách...</i></b></td>
                                            </tr>
                                            <tr v-else-if="list_lao_dong.length <= 0">
                                                <td class="text-center" colspan="8"><b><i>Chưa có hợp đồng lao động</i></b></td>
                                            </tr>
                                            <tr v-else v-for="n in list_lao_dong" :id="'n' + n.id" class="row-nhom" @click="click_lao_dong(n)">
                                                <td class="text-left" style="padding-right: 0">
                                                    <button @click="_lao_dong('edit',n)" id="edit_nhom" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-edit"></i> Sửa
                                                    </button>
                                                    <button @click="delete_lao_dong(n)" type="button" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Xóa
                                                    </button>
                                                </td>
                                                <td>{{n.ma_nv}}</td>
                                                <td>{{n.ho_ten}}</td>
                                                <td>{{n.so_hdld}}</td>
                                                <td>{{n.thoi_han_hd}}</td>
                                                <td>{{n.ngay_ky}}</td>
                                                <td>{{n.ngay_kt}}</td>
                                                <td>{{n.ghi_chu}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <el-pagination
                                                :page-size="10"
                                                layout="prev, pager, next"
                                                :total="total_lao_dong"
                                                @current-change="danh_sach_lao_dong">
                                        </el-pagination>
                                    </div>
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
                                                    <label class="label-form col-md-3 col-form-label">Mã nhân viên</label>
                                                    <div class="col-md-9">
                                                        <!--<div class="select-lam">-->
                                                            <!--<input v-model="lao_dong.so_hdld" name="txthoten" id="manv" type="text" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('txthoten')}">-->
                                                            <!--<small v-show="errors.has('txthoten')" class="help text-muted is-danger">Vui lòng nhập tên nhân viên</small>-->
                                                            <!--<div class="body-select-lam">-->
                                                                <!--<select name="" id="" class="form-control form-control-sm" multiple>-->
                                                                    <!--<option value="">sdadsdsdsda <span class="pull-right">KH000001</span></option>-->
                                                                    <!--<option value="">sdadsdsdsda <span class="pull-right">KH000001</span></option>-->
                                                                    <!--<option value="">sdadsdsdsda <span class="pull-right">KH000001</span></option>-->
                                                                <!--</select>-->
                                                            <!--</div>-->
                                                        <!--</div>-->
                                                        <input v-show="!flag_nhan_vien" type="text" id="txtnhanvien-sua" class="form-control form-control-sm" readonly>
                                                        <el-select v-show="flag_nhan_vien" v-model="ma_nv" filterable size="small" placeholder="Chọn mã nhân viên" style="width: 100%" @change="select_nv">
                                                            <!--<template slot="prefix"><label class="prefix">{{nhan_vien.ma_nv}}</label></template>-->
                                                            <el-option
                                                                    v-for="item in list_nhan_vien"
                                                                    :key="item.id"
                                                                    :label="item.ma_nv"
                                                                    :value="item.ma_nv">
                                                                <span style="float: left">{{ item.ma_nv }}</span>
                                                                <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ho_ten }}</span>
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>

                                                <!--<div class="form-group row">-->
                                                    <!--<label class="label-form col-md-3 col-form-label">Tên nhân viên</label>-->
                                                    <!--<div class="col-md-9">-->
                                                        <!--<input name="txthoten" type="text" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('txthoten')}">-->
                                                    <!--</div>-->
                                                <!--</div>-->

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Số HĐLĐ</label>
                                                    <div class="col-md-9">
                                                        <input v-model="lao_dong.so_hdld" name="txthoten" type="text" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('txthoten')}">
                                                        <small v-show="errors.has('txthoten')" class="help text-muted is-danger">Vui lòng nhập tên nhân viên</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Thời hạn</label>
                                                    <div class="col-md-9">
                                                        <input v-model="lao_dong.thoi_han_hd" name="txtthoihan" type="text" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('txtthoihan')}">
                                                        <small v-show="errors.has('txtthoihan')" class="help text-muted is-danger">Vui lòng nhập thời hạn lao động</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Ngày ký</label>
                                                    <div class="col-md-9">
                                                        <input v-model="lao_dong.ngay_ky" type="date" name="txtngayky" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('txtngayky')}">
                                                        <small v-show="errors.has('txtngayky')" class="help text-muted is-danger">Vui lòng nhập ngày ký</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Ngày kết thúc</label>
                                                    <div class="col-md-9">
                                                        <input v-model="lao_dong.ngay_kt" name="txtngaykt" type="date" class="form-control form-control-sm" v-validate="'required'" :class="{'border-danger' : errors.has('txtngaykt')}">
                                                        <small v-show="errors.has('txtngaykt')" class="help text-muted is-danger">Vui lòng nhập ngày kết thúc</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Ghi chú</label>
                                                    <div class="col-md-9">
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
    import {api_get_all_lao_dong} from './lao_dong';
    import {api_add_lao_dong} from "./lao_dong";
    import {api_edit_lao_dong} from "./lao_dong";
    import {api_delete_lao_dong} from "./lao_dong";
    import {select_lam} from "../../helper/selectlam";
    import {api_search_all_lao_dong} from "./lao_dong";
    import {api_nhan_vien_get_all_no_pa} from "../../helper/nhan_vien";

    export default {
        name: 'bophan',
        mounted () {
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
                nhan_vien: [],
                ma_nv: '',
                list_nhan_vien: [],
                flag_nhan_vien: true,
                loading_lao_dong: true,
                flag_search: false,
                keyword: '',
                list_lao_dong: [],
                total_lao_dong: 0,
                lao_dong: { id: 0, so_hdld: '', thoi_han_hd: '', ngay_ky: '', ngay_kt: '', ghi_chu: '', nv_id: '' },
                flag_btn: true,
                flag_submit_lao_dong: true,
                flag_input_lao_dong: false,
                flag_body_modal: false,
                flag_btn_save: true,
                flag_disabled_submit: false,
                flag_input_ma_lao_dong: false
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
            select_nv: function (nv) {
                this.ma_nv = nv;
            },
            search_lao_dong: function (page = 1) {
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
            _lao_dong: function (state, laodong = null) {
                if(state == 'add') {
                    this.flag_nhan_vien = true;
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_lao_dong = true;
                    this.flag_input_lao_dong = false;
                    this.lao_dong.id = this.lao_dong.nv_id =this.lao_dong.so_hdld = this.lao_dong.thoi_han_hd = this.lao_dong.ghi_chu = this.lao_dong.ngay_ky = this.lao_dong.ngay_kt = '';
                }
                else {
                    this.flag_nhan_vien = false;
                    this.lao_dong = laodong;
                    this.lao_dong.id = laodong.hd_id;
                    $('#txtnhanvien-sua').val(laodong.ho_ten + ' - ' + laodong.ma_nv);
                    this.flag_submit_lao_dong = false;
                    this.flag_input_lao_dong = true;
                }
            },
            submit_lao_dong: function () {
                this.change_bnt_save();
                if(this.flag_submit_lao_dong) {
                    console.log(this.ma_nv);
                    this.lao_dong.nv_id = this.ma_nv;
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
                console.log(this.lao_dong);
                api_add_lao_dong(this);
            },
            edit_lao_dong: function() {
                console.log(this.lao_dong);
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
</style>