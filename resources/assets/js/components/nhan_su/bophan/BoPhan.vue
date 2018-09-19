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
                    <li class="breadcrumb-item">Bộ phận</li>
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
                        <div class="card-body bg-inverse">
                            <div class="row row-title">
                                <div class="col-md-10">
                                    <h4 class="card-title">Danh sách bộ phận</h4>
                                    <h6 class="card-subtitle m-0 op-5">Tổng số bộ phận: {{total_bo_phan}}</h6>
                                </div>
                                <div class="col-md-2">
                                    <button @click="_bo_phan('add')" title="Thêm mới bộ phận" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-dark pull-right">
                                        <i class="fa fa-plus-circle"></i> Thêm mới
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="message-box contact-box">
                                <!--<h2 class="add-ct-btn">-->

                                <!--</h2>-->
                                <div class="message-widget contact-widget">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr style="border-top: 1px solid #ddd">
                                                <th class="text-center" style="width: 100px;">#</th>
                                                <th>Mã bộ phận</th>
                                                <th>Tên bộ phận</th>
                                                <th>Diễn giải</th>
                                                <!--<th>Ngày tạo</th>-->
                                            </tr>
                                            </thead>
                                            <tbody class="body-table loading-item">
                                            <tr v-if="loading_bo_phan">
                                                <td class="text-center" colspan="6"><b><i><i class="fa fa-spin fa-spinner"></i> Đang tải danh sách bộ phận...</i></b></td>
                                            </tr>
                                            <tr v-else-if="list_bo_phan.length <= 0">
                                                <td class="text-center" colspan="6"><b><i>Chưa có bộ phận</i></b></td>
                                            </tr>
                                            <tr v-else v-for="n in list_bo_phan" :id="'n' + n.id" class="row-nhom" @click="click_bo_phan(n)">
                                                <td class="text-center" style="padding-right: 0">
                                                    <button @click="_bo_phan('edit',n)" id="edit_nhom" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button @click="delete_bo_phan(n)" type="button" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                                <td>{{n.ma_bo_phan}}</td>
                                                <td>{{n.ten_bo_phan}}</td>
                                                <td>{{n.dien_giai}}</td>
                                                <!--<td>{{n.created_at}}</td>-->
                                            </tr>
                                            </tbody>
                                        </table>
                                        <el-pagination
                                                :page-size="10"
                                                layout="prev, pager, next"
                                                :total="total_bo_phan"
                                                @current-change="danh_sach_bo_phan">
                                        </el-pagination>
                                    </div>
                                </div>
                            </div>

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
    import {api_bophan_get} from './bo_phan.js';
    import {api_add_bo_phan} from "./bo_phan";
    import {api_edit_bo_phan} from "./bo_phan";
    import {api_delete_bo_phan} from "./bo_phan";

    export default {
        name: 'bophan',
        mounted () {
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
                flag_input_ma_bo_phan: false
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
            danh_sach_bo_phan: function (page = 1) {
                this.loading_bo_phan = true;
                api_bophan_get(this, page);
            },
            _bo_phan: function (state, bophan = null) {
                if(state == 'add') {
                    console.log('add nhom');
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_bo_phan = true;
                    this.flag_input_bo_phan = false;
                    this.bo_phan.id = this.bo_phan.ma_bo_phan = this.bo_phan.ten_bo_phan = this.bo_phan.dien_giai = '';
                }
                else {
                    console.log(bophan);
                    this.bo_phan = bophan;
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