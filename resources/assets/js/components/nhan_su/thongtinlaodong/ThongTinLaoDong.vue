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
                                        <form @submit.prevent="">
                                            <input type="text" id="timkiem" class="form-control" placeholder="Nhập từ khóa để tìm kiếm...">
                                            <button type="submit" class="btn btn-info btn-sm btntimkiem" name="button">Tìm kiếm</button>
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
                                                <th>Ghi chú</th>
                                                <!--<th>Ngày tạo</th>-->
                                            </tr>
                                            </thead>
                                            <tbody class="body-table loading-item">
                                            <tr v-if="loading_lao_dong">
                                                <td class="text-center" colspan="6"><b><i><i class="fa fa-spin fa-spinner"></i> Đang tải danh sách bộ phận...</i></b></td>
                                            </tr>
                                            <tr v-else-if="list_lao_dong.length <= 0">
                                                <td class="text-center" colspan="6"><b><i>Chưa có bộ phận</i></b></td>
                                            </tr>
                                            <tr v-else v-for="n in list_lao_dong" :id="'n' + n.id" class="row-nhom" @click="click_lao_dong(n)">
                                                <td class="text-left" style="padding-right: 0">
                                                    <button @click="_lao_dong('edit',n)" id="edit_nhom" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-edit"></i> Sửa
                                                    </button>
                                                    <button @click="delete_lao_dong(n.id)" type="button" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Xóa
                                                    </button>
                                                </td>
                                                <td>{{n.ma_lao_dong}}</td>
                                                <td>{{n.ten_lao_dong}}</td>
                                                <td>{{n.dien_giai}}</td>
                                                <!--<td>{{n.created_at}}</td>-->
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
                                                <h4 class="modal-title"><b>Thông tin bộ phận</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div :disabled="flag_body_modal" class="modal-body">
                                                <div class="form-group">
                                                    <label><b>Mã bộ phận</b></label>
                                                    <input @input="validate_ma_bp" v-model="lao_dong.ma_lao_dong" :disabled="flag_input_lao_dong" v-validate="'required'" :class="{'border-danger' : errors.has('txtmabophan')}" type="text" name="txtmabophan" class="form-control" id="txtmabophan" aria-describedby="" autofocus>
                                                    <!--<small v-show="errors.has('txtmabophan')" class="help text-muted is-danger">Vui lòng nhập mã bộ phận</small>-->
                                                    <small v-if="flag_input_ma_lao_dong" class="help text-muted is-danger">Mã bộ phận phải có 8 ký tự, bắt đầu bằng BP</small>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Tên bộ phận</b></label>
                                                    <input v-model="lao_dong.ten_lao_dong" v-validate="'required'" :class="{'border-danger' : errors.has('txttenbophan')}" type="text" name="txttenbophan" class="form-control" id="txttenbophan" placeholder="">
                                                    <small v-show="errors.has('txttenbophan')" class="help text-muted is-danger">Vui lòng nhập tên bộ phận</small>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Diễn giải</b></label>
                                                    <textarea v-model="lao_dong.dien_giai" type="text" name="txtdiengiai" class="form-control" id="txtdiengiai"></textarea>
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

    export default {
        name: 'bophan',
        mounted () {
            this.danh_sach_lao_dong();
        },
        updated () {
            $(document).ready(function() {
                $('.select2').select2();
            });
        },
        data () {
            return {
                loading_lao_dong: true,
                list_lao_dong: [],
                total_lao_dong: 0,
                lao_dong: { id: 0, ma_lao_dong: '', ten_lao_dong: '', dien_giai: '' },
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
            danh_sach_lao_dong: function (page = 1) {
                this.loading_lao_dong = true;
                api_bophan_get(this, page);
            },
            _lao_dong: function (state, bophan = null) {
                if(state == 'add') {
                    console.log('add nhom');
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_lao_dong = true;
                    this.flag_input_lao_dong = false;
                    this.lao_dong.id = this.lao_dong.ma_lao_dong = this.lao_dong.ten_lao_dong = this.lao_dong.dien_giai = '';
                }
                else {
                    console.log(bophan);
                    this.lao_dong = bophan;
                    this.flag_submit_lao_dong = false;
                    this.flag_input_lao_dong = true;
                }
            },
            submit_lao_dong: function () {
                this.change_bnt_save();
                if(this.flag_submit_lao_dong) {
                    this.flag_input_lao_dong = false;
                    this.add_lao_dong();
                }
                else {
                    this.nhom = this.nhom_selected;
                    this.flag_input_lao_dong = true;
                    this.edit_lao_dong();
                }
            },
            click_lao_dong: function (bp) {
                $('.row-nhom').removeClass("active-click-row");
                $('#n' + bp.id).addClass("active-click-row");
            },
            add_lao_dong: function () {
                api_add_lao_dong(this);
            },
            edit_lao_dong: function() {
                console.log(this.lao_dong);
                api_edit_lao_dong(this);
            },
            delete_lao_dong: function(id) {
                this.lao_dong.id = id;
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
</style>