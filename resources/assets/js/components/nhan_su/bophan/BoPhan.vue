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
                    <li class="breadcrumb-item">Phòng ban</li>
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
                                    <button title="Thêm mới bộ phận" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-circle btn-lg btn-success waves-effect waves-dark">+</button>
                                </h2>
                                <div class="message-widget contact-widget">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Mã bộ phận</th>
                                                <th>Tên tên bộ phận</th>
                                                <th>Diễn giải</th>
                                                <th>Ngày tạo</th>
                                                <th>Ẩn hiện</th>
                                                <th>#</th>
                                            </tr>
                                            </thead>
                                            <tbody class="body-table loading-item">
                                            <tr v-if="loading_bo_phan">
                                                <td class="text-center" colspan="6">Loading...</td>
                                            </tr>
                                            <tr v-for="n in list_bo_phan" :id="'n' + n.id" class="row-nhom" @click="click_bo_phan(n)">
                                                <td>{{n.ma_bo_phan}}</td>
                                                <td>{{n.ten_bo_phan}}</td>
                                                <td>{{n.dien_giai}}</td>
                                                <td>{{n.created_at}}</td>
                                                <td>Ẩn</td>
                                                <td>
                                                    <button @click="_bo_phan('edit')" id="edit_nhom" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-edit"></i> Sửa
                                                    </button>
                                                    <button @click="delete_nhom" type="button" class="btn btn-danger btn-sm">
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
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Danh sách bộ phận</h4>
                            <button id="add_nhom" type="button" @click="_bo_phan('add')" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus-circle"></i> Thêm mới
                            </button>
                            <!--<button v-bind:disabled="flag_btn" @click="_bo_phan('edit')" id="edit_nhom" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">-->
                                <!--<i class="fa fa-edit"></i> Sửa-->
                            <!--</button>-->
                            <!--<button v-bind:disabled="flag_btn" @click="delete_nhom" type="button" class="btn btn-danger btn-sm">-->
                                <!--<i class="fa fa-trash"></i> Xóa-->
                            <!--</button>-->

                            <!-- The Modal NHOM -->
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
                                            <div class="modal-body">
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
                                                <button type="submit" class="btn btn-primary">Lưu lại</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- EMD Modal NHOM -->

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Mã bộ phận</th>
                                            <th>Tên tên bộ phận</th>
                                            <th>Diễn giải</th>
                                        </tr>
                                    </thead>
                                    <tbody class="body-table loading-item">
                                        <tr v-if="loading_bo_phan" colspan="3" class="text-center">Loading...</tr>
                                        <tr v-for="n in list_bo_phan" :id="'n' + n.id" class="row-nhom" @click="click_bo_phan(n)">
                                            <td>{{n.ma_bo_phan}}</td>
                                            <td>{{n.ten_bo_phan}}</td>
                                            <td>{{n.dien_giai}}</td>
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
                </div>

                <!--<div class="col-md-6">-->
                    <!--<div class="card">-->
                        <!--<div class="card-body">-->
                            <!--<h4 class="card-title">Danh sách phòng ban</h4>-->
                            <!--<button :disabled="flag_btn_add_phong" id="add_ds" type="button" @click="_phong_ban('add')" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_phong">-->
                                <!--<i class="fa fa-plus-circle"></i> Thêm mới-->
                            <!--</button>-->
                            <!--<button v-bind:disabled="flag_btn_phong_ban" @click="_phong_ban('edit')" id="edit_ds" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_phong">-->
                                <!--<i class="fa fa-edit"></i> Sửa-->
                            <!--</button>-->
                            <!--<button v-bind:disabled="flag_btn_phong_ban" @click="delete_phong_ban" type="button" class="btn btn-danger btn-sm">-->
                                <!--<i class="fa fa-trash"></i> Xóa-->
                            <!--</button>-->

                            <!--&lt;!&ndash; The Modal PHONG &ndash;&gt;-->
                            <!--<div class="modal" id="modal_phong">-->
                                <!--<div class="modal-dialog">-->
                                    <!--<div class="modal-content">-->
                                        <!--<form @submit.prevent="submit_phong_ban" id="form_phong">-->
                                            <!--&lt;!&ndash; Modal Header &ndash;&gt;-->
                                            <!--<div class="modal-header">-->
                                                <!--<h4 class="modal-title"><b>Thông tin phòng ban</b></h4>-->
                                                <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                                            <!--</div>-->

                                            <!--&lt;!&ndash; Modal body &ndash;&gt;-->
                                            <!--<div class="modal-body">-->
                                                <!--<div class="form-group">-->
                                                    <!--<label><b>Bộ phận</b></label>-->
                                                    <!--&lt;!&ndash;<input type="text">&ndash;&gt;-->
                                                    <!--<input :disabled="true" v-model="bo_phan.ten_bo_phan" v-validate="'required'" :class="{'border-danger' : errors.has('txtten_bophan')}" type="text" name="txtten_bophan" class="form-control" id="txtten_bophan" >-->
                                                    <!--<input hidden disabled v-model="phong_ban.id_bo_phan" v-validate="'required'" :class="{'border-danger' : errors.has('txtma_bophan')}" type="text" name="txtma_bophan" class="form-control" id="txtma_bophan">-->
                                                    <!--&lt;!&ndash;<select id="select_bo_phan" class="select2 form-control custom-select" style="width: 100%; height:36px;" placeholder="Chọn bộ phận">&ndash;&gt;-->
                                                        <!--&lt;!&ndash;<option v-for="b in list_bo_phan" :value="b.id">{{b.ten_bo_phan}}</option>&ndash;&gt;-->
                                                    <!--&lt;!&ndash;</select>&ndash;&gt;-->
                                                    <!--<small v-show="errors.has('txtma_bophan')" class="help text-muted is-danger">Vui chọn bộ phận</small>-->
                                                <!--</div>-->
                                                <!--<div class="form-group">-->
                                                    <!--<label><b>Mã phòng</b></label>-->
                                                    <!--<input v-model="phong_ban.ma_phong" :disabled="flag_input_phong_ban" v-validate="'required'" :class="{'border-danger' : errors.has('txtmaphong')}" type="text" name="txtmaphong" class="form-control" id="txtmaphong">-->
                                                    <!--<small v-show="errors.has('txtmaphong')" class="help text-muted is-danger">Vui lòng nhập mã phòng</small>-->
                                                <!--</div>-->
                                                <!--<div class="form-group">-->
                                                    <!--<label><b>Tên phòng</b></label>-->
                                                    <!--<input v-model="phong_ban.ten_phong" v-validate="'required'" :class="{'border-danger' : errors.has('txttenphong')}" type="text" name="txttenbophan" class="form-control" id="txttenphong">-->
                                                    <!--<small v-show="errors.has('txttenphong')" class="help text-muted is-danger">Vui lòng nhập tên phòng</small>-->
                                                <!--</div>-->
                                                <!--<div class="form-group">-->
                                                    <!--<label><b>Diễn giải</b></label>-->
                                                    <!--<textarea v-model="phong_ban.dien_giai" type="text" name="txtdiengiai" class="form-control" id="phongdiengiai"></textarea>-->
                                                <!--</div>-->
                                            <!--</div>-->

                                            <!--&lt;!&ndash; Modal footer &ndash;&gt;-->
                                            <!--<div class="modal-footer">-->
                                                <!--<button type="submit" class="btn btn-primary">Lưu lại</button>-->
                                                <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>-->
                                            <!--</div>-->
                                        <!--</form>-->
                                    <!--</div>-->
                                <!--</div>-->
                            <!--</div>-->
                            <!--&lt;!&ndash; EMD Modal PHONG &ndash;&gt;-->

                            <!--<div class="table-responsive">-->
                                <!--<table class="table table-hover">-->
                                    <!--<thead>-->
                                    <!--<tr>-->
                                        <!--<th>Mã phòng</th>-->
                                        <!--<th>Tên phòng</th>-->
                                        <!--<th>Diễn giải</th>-->
                                    <!--</tr>-->
                                    <!--</thead>-->
                                    <!--<tbody>-->
                                    <!--<tr v-loading="loading_phong_ban" v-if="list_phong_ban.length <= 0">-->
                                        <!--<td colspan="3" class="text-center">Chưa có phòng</td>-->
                                    <!--</tr>-->
                                    <!--<tr v-for="n in list_phong_ban" @click="click_phong_ban(n)" :id="'p' + n.id" class="row-phong">-->
                                        <!--<td>{{n.ma_phong}}</td>-->
                                        <!--<td>{{n.ten_phong}}</td>-->
                                        <!--<td>{{n.dien_giai}}</td>-->
                                    <!--</tr>-->
                                    <!--</tbody>-->
                                <!--</table>-->
                                <!--<el-pagination-->
                                        <!--:page-size="10"-->
                                        <!--layout="prev, pager, next"-->
                                        <!--:total="total_phong_ban"-->
                                        <!--@current-change="get_danh_sach_phong_theo_bo_phan">-->
                                <!--</el-pagination>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
    </div>
</template>

<script>
    import {sweetalert} from '../../../helper/sweetalert';
    import {api_bophan_get} from './bo_phan.js';
    import {api_add_bo_phan} from "./bo_phan";
    import {api_edit_bo_phan} from "./bo_phan";
    import {api_delete_bo_phan} from "./bo_phan";

    import {api_bophan_get_danh_sach_phong_theo_bo_phan} from './bo_phan.js';
    import {api_add_phong_ban} from "./phong_ban_bo_phan";
    import {api_edit_phong_ban} from "./phong_ban_bo_phan";
    import {api_delete_phong_ban} from "./phong_ban_bo_phan";

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
                bo_phan: { id_bo_phan: 0, ma_bo_phan: '', ten_bo_phan: '', dien_giai: '' },
                bo_phan_selected: { id_nhom: 0,ma_nhom: '', ten_nhom: '' },
                flag_btn: true,
                flag_submit_bo_phan: true,
                flag_input_bo_phan: false,
                loading_phong_ban: false,
                list_phong_ban: [],
                total_phong_ban: 0,
                phong_ban: { id: '', ma_phong: '', ten_phong: '', dien_giai: '', id_bo_phan: ''},
                flag_btn_add_phong: true,
                flag_btn_phong_ban: true,
                flag_input_phong_ban: false,
                flag_submit_phong_ban: true
            }
        },
        methods: {
            danh_sach_bo_phan: function (page = 1) {
                api_bophan_get(this, page);
            },
            _bo_phan: function (state) {
                if(state == 'add') {
                    console.log('add nhom');
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_bo_phan = true;
                    this.flag_input_bo_phan = false;
                    this.bo_phan.id_bo_phan = this.bo_phan.ma_bo_phan = this.bo_phan.ten_bo_phan = this.bo_phan.dien_giai = '';
                }
                else {
                    console.log('edit nhom');
                    this.flag_submit_bo_phan = false;
                    this.flag_input_bo_phan = true;
                }
            },
            submit_bo_phan: function () {
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
                this.bo_phan.id_bo_phan = bp.id;
                this.bo_phan.ma_bo_phan = bp.ma_bo_phan;
                this.bo_phan.ten_bo_phan = bp.ten_bo_phan
                this.bo_phan.dien_giai = bp.dien_giai;
                this.flag_btn = false;
                this.flag_btn_add_phong = false;

                this.loading_phong_ban = true;
                $('.row-nhom').removeClass("active-click-row");
                $('#n' + bp.id).addClass("active-click-row");
                this.get_danh_sach_phong_theo_bo_phan(bp.id, 1);
            },
            add_bo_phan: function () {
                api_add_bo_phan(this);
            },
            edit_bo_phan: function() {
                api_edit_bo_phan(this);
            },
            delete_nhom: function() {
                if(this.bo_phan.id_bo_phan <= 0) return -1;
                api_delete_bo_phan(this);
            },
            get_danh_sach_phong_theo_bo_phan: function(id_bo_phan, page = 1) {
                api_bophan_get_danh_sach_phong_theo_bo_phan(this, id_bo_phan, page);
            },
            _phong_ban: function (state) {
                if(state == 'add') {
                    console.log('add phong');
                    this.flag_btn = true;
                    $('.row-phong').removeClass("active-click-row");
                    this.flag_submit_phong_ban = true;
                    this.flag_input_phong_ban = false;
                    // $('#ten_bo_phan').val(this.bo_phan.ten_bo_phan);
                    this.phong_ban.id_phong_ban = this.bo_phan.id_bo_phan;
                    this.phong_ban.ma_phong_ban = this.phong_ban.ten_phong_ban = this.phong_ban.dien_giai = '';
                }
                else {
                    console.log('edit phong');
                    this.flag_submit_phong_ban = false;
                    this.flag_input_phong_ban = true;
                }
            },
            submit_phong_ban: function () {
                if(this.flag_submit_phong_ban) {
                    this.flag_input_phong_ban = false;
                    this.phong_ban.ma_phong = this.phong_ban.ma_phong;
                    this.phong_ban.ten_phong = this.phong_ban.ten_phong;
                    this.phong_ban.dien_giai = this.phong_ban.dien_giai;
                    this.phong_ban.id_bo_phan = this.bo_phan.id_bo_phan;
                    console.log(this.phong_ban);
                    api_add_phong_ban(this);
                }
                else {
                    console.log("sua");
                    this.flag_input_phong_ban = true;
                    this.phong_ban.ma_phong = this.phong_ban.ma_phong;
                    this.phong_ban.ten_phong = this.phong_ban.ten_phong;
                    this.phong_ban.dien_giai = this.phong_ban.dien_giai;
                    this.phong_ban.id_bo_phan = this.bo_phan.id_bo_phan;
                    api_edit_phong_ban(this);
                }
            },
            click_phong_ban: function (p) {
                $('.row-phong').removeClass("active-click-row");
                $('#p' + p.id).addClass("active-click-row");
                this.flag_btn_phong_ban = false;
                this.phong_ban = p;
            },
            add_phong_ban: function () {
                api_add_phong_ban(this);
            },
            edit_phong_ban: function () {

            },
            delete_phong_ban: function () {
                console.log("delete");
                api_delete_phong_ban(this, this.phong_ban.id);
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