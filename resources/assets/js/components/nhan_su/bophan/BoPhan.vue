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
                                <a v-if="flag_cn.add" @click="_bo_phan('add')" title="Thêm mới bộ phận" data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-dark btn-white" style="color: white"><i class="fa fa-plus-circle"></i> Thêm mới</a>
                                <!--<a @click="scroll_card" id="thunho" class="" data-action="collapse"><i class="ti-minus"></i></a>-->
                                <a @click="scroll_card_full_creem" id="phongto" class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                <!--<a class="btn-close" data-action="close"><i class="ti-close"></i></a>-->
                            </div>
                            <h4 class="card-title m-b-0">Danh sách bộ phận</h4>
                            <!--<h6 class="card-subtitle m-0 op-5">Tổng số bộ phận: {{total_bo_phan}}</h6>-->
                        </div>
                        <div class="card-body collapse show">
                            <div class="message-box contact-box">
                                <!--<dic class="add-ct-btn">-->
                                    <!---->
                                <!--</dic>-->
                                <div class="message-widget contact-widget">
                                    <div class="row">
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <el-table :data="list_bo_phan" border style="width: 100%">
                                                <el-table-column label="#" width="90" align="center" class-name="center-text">
                                                    <template slot-scope="scope" align="center">
                                                        <div class="text-center">
                                                            <button v-if="flag_cn.edit" @click="_bo_phan('edit', scope.row)" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm" title="Cập nhật thông tin bộ phận"> <i class="fa fa-edit"></i> </button>
                                                            <button v-if="flag_cn.delete" @click="delete_bo_phan(scope.row)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                                        </div>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column type="index" label="TT" align="center" width="40" class-name="center-text"></el-table-column>
                                                <el-table-column prop="ma_bo_phan" label="Mã bộ phận" align="center" width="100" class-name="center-text"></el-table-column>
                                                <el-table-column prop="ten_bo_phan" label="Tên bộ phận" class-name="no-center-text"></el-table-column>
                                                <el-table-column prop="dien_giai" label="Diễn giải" class-name="no-center-text"></el-table-column>
                                            </el-table>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row tb-row-hienthi">
                                                <div class="col-md-1 col-sm-2 col-8 tb-label pr-0" style="padding-left: 15px;">
                                                    <span>Hiển thị</span>
                                                </div>
                                                <div class="col-md-1 col-sm-2 col-4 tb-hienthi" style="padding-left: 4px;">
                                                    <el-select v-model="limit" placeholder="10" size="small" @change="change_danh_sach_bo_phan">
                                                        <el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-md-8 col-sm-4 col-6" style="padding-left: 0px;">
                                                    <el-pagination :page-size="limit" layout="prev, pager, next" :total="total_bo_phan" @current-change="danh_sach_bo_phan"></el-pagination>
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-6 tb-label">
                                                    <span class="pull-right">Tổng: {{total_bo_phan}} BP</span>
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
                                        <form @submit.prevent="submit_bo_phan" id="form_bophan">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Thông tin bộ phận</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div :disabled="flag_body_modal" class="modal-body">
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Mã bộ phận(*)</b></label>
                                                    <div class="col-md-9">
                                                        <input @input="validate_ma_bp" v-on:keypress="disable_spaces" v-bind:maxlength="7" v-model="bo_phan.ma_bo_phan" :disabled="flag_input_bo_phan" v-validate="'required'" :class="{'border-danger' : errors.has('txtmabophan')}" type="text" name="txtmabophan" class="form-control form-control-sm" id="txtmabophan" aria-describedby="" autofocus>
                                                        <small v-if="flag_input_ma_bo_phan" class="help text-muted is-danger">Mã bộ phận phải có 7 ký tự, bắt đầu bằng BP</small>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Tên bộ phận(*)</b></label>
                                                    <div class="col-md-9">
                                                        <input v-model="bo_phan.ten_bo_phan" v-validate="'required'" :class="{'border-danger' : errors.has('txttenbophan')}" type="text" name="txttenbophan" class="form-control form-control-sm" id="txttenbophan" placeholder="">
                                                        <small v-show="errors.has('txttenbophan')" class="help text-muted is-danger">Vui lòng nhập tên bộ phận</small>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Diễn giải</b></label>
                                                    <div class="col-md-9">
                                                        <textarea v-model="bo_phan.dien_giai" type="text" name="txtdiengiai" class="form-control form-control-sm" id="txtdiengiai"></textarea>
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
    import {check_url_phan_quyen} from "../../../helper/auth";
    import {check_quyen_chuc_nang} from "../../../helper/auth";

    import {api_bophan_get} from './bo_phan.js';
    import {api_add_bo_phan} from "./bo_phan";
    import {api_edit_bo_phan} from "./bo_phan";
    import {api_delete_bo_phan} from "./bo_phan";
    import {api_bophan_get_ma_bo_phan} from "./bo_phan";

    export default {
        name: 'bophan',
        beforeCreate(){
            check_url_phan_quyen(this);
        },
        mounted () {
            check_quyen_chuc_nang(this);
            this.danh_sach_bo_phan();
        },
        updated () {
            $(document).ready(function() {
                $('.select2').select2();
            });
        },
        data () {
            return {
                loading_bo_phan: true,
                list_bo_phan: [],
                total_bo_phan: 0,
                bo_phan: { id: 0, ma_bo_phan: '', ten_bo_phan: '', dien_giai: '' },
                flag_btn: true,
                flag_submit_bo_phan: true,
                flag_input_bo_phan: false,
                flag_body_modal: false,
                flag_btn_save: true,
                flag_disabled_submit: false,
                flag_input_ma_bo_phan: false,
                options_display: [10,20,30],
                limit: 10,
                flag_cn: {add: false, edit: false, delete: false}
            }
        },
        methods: {
            validate_ma_bp: function () {
                var length_nv = this.bo_phan.ma_bo_phan.length;
                var value_nv  = this.bo_phan.ma_bo_phan;
                if((length_nv > 7 || length_nv < 7) || value_nv.indexOf('BP') == -1 || value_nv.indexOf(' ') > -1){
                    this.flag_input_ma_bo_phan = true;
                    this.flag_disabled_submit = true;
                }
                else{
                    this.flag_input_ma_bo_phan = false;
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
            change_danh_sach_bo_phan: function () {
                api_bophan_get(this, 1);
            },
            danh_sach_bo_phan: function (page) {
                api_bophan_get(this, page);
            },
            _bo_phan: function (state, bophan = null) {
                if(state == 'add') {
                    console.log('add nhom');
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_bo_phan = true;
                    this.flag_input_bo_phan = false;
                    this.bo_phan = { id: 0, ma_bo_phan: '', ten_bo_phan: '', dien_giai: '' }
                    api_bophan_get_ma_bo_phan(this);
                }
                else {
                    // this.bo_phan = bophan;
                    this.bo_phan.id = bophan.id;
                    this.bo_phan.ma_bo_phan = bophan.ma_bo_phan;
                    this.bo_phan.ten_bo_phan = bophan.ten_bo_phan;
                    this.bo_phan.dien_giai = bophan.dien_giai;
                    this.flag_submit_bo_phan = false;
                    this.flag_input_bo_phan = true;
                }
            },
            submit_bo_phan: function () {
                this.change_bnt_save();
                if(this.flag_submit_bo_phan) {
                    this.flag_input_bo_phan = false;
                    this.add_bo_phan();
                }
                else {
                    this.nhom = this.nhom_selected;
                    this.flag_input_bo_phan = true;
                    this.edit_bo_phan();
                }
            },
            click_bo_phan: function (bp) {
                $('.row-nhom').removeClass("active-click-row");
                $('#n' + bp.id).addClass("active-click-row");
            },
            add_bo_phan: function () {
                api_add_bo_phan(this);
            },
            edit_bo_phan: function() {
                console.log(this.bo_phan);
                api_edit_bo_phan(this);
            },
            delete_bo_phan: function(bp) {
                this.bo_phan = bp;
                if(this.bo_phan.id <= 0) return -1;
                api_delete_bo_phan(this);
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

    .center-text {
        text-align: center;
    }
</style>