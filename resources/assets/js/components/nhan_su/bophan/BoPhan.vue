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
                            <h4 class="text-white card-title">Danh sách bộ phận</h4>
                            <h6 class="card-subtitle text-white m-0 op-5">Quản lý bộ phận</h6>
                        </div>
                        <div class="card-body">
                            <div class="message-box contact-box">
                                <h2 class="add-ct-btn">
                                    <button @click="_bo_phan('add')" title="Thêm mới bộ phận" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-circle btn-lg btn-success waves-effect waves-dark">+</button>
                                </h2>
                                <div class="message-widget contact-widget">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Mã bộ phận</th>
                                                <th>Tên bộ phận</th>
                                                <th>Diễn giải</th>
                                                <th>Ngày tạo</th>
                                                <th>Ẩn hiện</th>
                                                <th class="text-center">#</th>
                                            </tr>
                                            </thead>
                                            <tbody class="body-table loading-item">
                                            <tr v-if="loading_bo_phan">
                                                <td class="text-center" colspan="6"><b><i>Loading...</i></b></td>
                                            </tr>
                                            <tr v-for="n in list_bo_phan" :id="'n' + n.id" class="row-nhom" @click="click_bo_phan(n)">
                                                <td>{{n.ma_bo_phan}}</td>
                                                <td>{{n.ten_bo_phan}}</td>
                                                <td>{{n.dien_giai}}</td>
                                                <td>{{n.created_at}}</td>
                                                <td>Ẩn</td>
                                                <td class="text-center">
                                                    <button @click="_bo_phan('edit',n)" id="edit_nhom" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-edit"></i> Sửa
                                                    </button>
                                                    <button @click="delete_bo_phan(n.id)" type="button" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Xóa
                                                    </button>
                                                </td>
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
                                                <div class="form-group">
                                                    <label><b>Mã bộ phận</b></label>
                                                    <input v-model="bo_phan.ma_bo_phan" :disabled="flag_input_bo_phan" v-validate="'required'" :class="{'border-danger' : errors.has('txtmabophan')}" type="text" name="txtmabophan" class="form-control" id="txtmabophan" aria-describedby="" autofocus>
                                                    <small v-show="errors.has('txtmabophan')" class="help text-muted is-danger">Vui lòng nhập mã bộ phận</small>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Tên bộ phận</b></label>
                                                    <input v-model="bo_phan.ten_bo_phan" v-validate="'required'" :class="{'border-danger' : errors.has('txttenbophan')}" type="text" name="txttenbophan" class="form-control" id="txttenbophan" placeholder="">
                                                    <small v-show="errors.has('txttenbophan')" class="help text-muted is-danger">Vui lòng nhập tên bộ phận</small>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Diễn giải</b></label>
                                                    <textarea v-model="bo_phan.dien_giai" type="text" name="txtdiengiai" class="form-control" id="txtdiengiai"></textarea>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button id="save" type="submit" class="btn btn-primary">Lưu lại</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
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
                flag_body_modal: false
            }
        },
        methods: {
            danh_sach_bo_phan: function (page = 1) {
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
            delete_bo_phan: function(id) {
                this.bo_phan.id = id;
                if(this.bo_phan.id <= 0) return -1;
                api_delete_bo_phan(this);
            },
            change_bnt_save: function () {
                this.flag_body_modal = true;
                $('#save').attr('disabled', 'disabled');
                $('#save').text('Đang xử lý...');
            },
            un_change_bnt_save: function () {
                this.flag_body_modal = false;
                $('#save').removeAttr('disabled');
                $('#save').text('Lưu lại');
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

</style>