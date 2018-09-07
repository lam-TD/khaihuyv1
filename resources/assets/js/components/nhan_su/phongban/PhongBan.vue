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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Danh sách vị trí</h4>
                            <button id="add_nhom" type="button" @click="_phong_ban('add')" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus-circle"></i> Thêm mới
                            </button>
                            <button v-bind:disabled="flag_btn" @click="_phong_ban('edit')" id="edit_nhom" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-edit"></i> Sửa
                            </button>
                            <button v-bind:disabled="flag_btn" @click="delete_nhom" type="button" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i> Xóa
                            </button>

                            <!-- The Modal NHOM -->
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form @submit.prevent="submit_phong_ban" id="form_bophan">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Thông tin vị trí</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label><b>Mã vị trí</b></label>
                                                    <input v-model="phong_ban.ma_phong_ban" :disabled="flag_input_phong_ban" v-validate="'required'" :class="{'border-danger' : errors.has('txtmabophan')}" type="text" name="txtmabophan" class="form-control" id="txtmabophan" aria-describedby="" autofocus>
                                                    <small v-show="errors.has('txtmabophan')" class="help text-muted is-danger">Vui lòng nhập mã vị trí</small>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Tên vị trí</b></label>
                                                    <input v-model="phong_ban.ten_phong_ban" v-validate="'required'" :class="{'border-danger' : errors.has('txttenbophan')}" type="text" name="txttenbophan" class="form-control" id="txttenbophan" placeholder="">
                                                    <small v-show="errors.has('txttenbophan')" class="help text-muted is-danger">Vui lòng nhập tên vị trí</small>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Diễn giải</b></label>
                                                    <textarea v-model="phong_ban.dien_giai" type="text" name="txtdiengiai" class="form-control" id="txtdiengiai"></textarea>
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
                                        <th>Mã vị trí</th>
                                        <th>Tên vị trí</th>
                                        <th>Diễn giải</th>
                                    </tr>
                                    </thead>
                                    <tbody class="body-table loading-item">
                                    <tr v-if="loading_phong_ban">
                                        <td colspan="3" class="text-center">
                                            <div class="fa-3x">
                                                <i class="fas fa-spinner fa-spin"></i>
                                                <i class="fas fa-circle-notch fa-spin"></i>
                                                <i class="fas fa-sync fa-spin"></i>
                                                <i class="fas fa-cog fa-spin"></i>
                                                <i class="fas fa-spinner fa-pulse"></i>
                                                <i class="fas fa-stroopwafel fa-spin"></i>
                                            </div>
                                            Loading...
                                        </td>
                                    </tr>
                                    <tr v-for="n in list_phong_ban" :id="'n' + n.id" class="row-nhom" @click="click_phong_ban(n)">
                                        <td>{{n.ma_phong_ban}}</td>
                                        <td>{{n.ten_phong_ban}}</td>
                                        <td>{{n.dien_giai}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <el-pagination
                                        :page-size="10"
                                        layout="prev, pager, next"
                                        :total="total_phong_ban"
                                        @current-change="danh_sach_phong_ban">
                                </el-pagination>
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
    import {api_get_phong_ban} from "./phong_ban";
    import {api_add_phong_ban} from "./phong_ban";
    import {api_edit_phong_ban} from "./phong_ban";
    import {api_delete_phong_ban} from "./phong_ban";

    export default {
        name: 'phongban',
        mounted (){
            this.danh_sach_phong_ban();
        },
        data () {
            return {
                loading_phong_ban : true,
                list_phong_ban: [],
                total_phong_ban: 0,
                phong_ban: { idi: 0, ma_phong_ban: '', ten_phong_ban: '', dien_giai: '' },
                flag_btn: true,
                flag_submit_phong_ban: true,
                flag_input_phong_ban: false
            }
        },
        methods: {
            danh_sach_phong_ban: function (page = 1) {
                api_get_phong_ban(this, page);
            },
            _phong_ban: function (state) {
                if(state == 'add') {
                    console.log('add nhom');
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_phong_ban = true;
                    this.flag_input_phong_ban = false;
                    this.phong_ban.id = this.phong_ban.ma_phong_ban = this.phong_ban.ten_phong_ban = this.phong_ban.dien_giai = '';
                }
                else {
                    console.log('edit nhom');
                    this.flag_submit_phong_ban = false;
                    this.flag_input_phong_ban = true;
                }
            },
            submit_phong_ban: function () {
                if(this.flag_submit_phong_ban) {
                    this.flag_input_phong_ban = false;
                    this.add_phong_ban();
                }
                else {
                    this.nhom = this.nhom_selected;
                    this.flag_input_phong_ban = true;
                    this.edit_phong_ban();
                }
            },
            click_phong_ban: function (bp) {
                this.phong_ban.id = bp.id;
                this.phong_ban.ma_phong_ban = bp.ma_phong_ban;
                this.phong_ban.ten_phong_ban = bp.ten_phong_ban
                this.phong_ban.dien_giai = bp.dien_giai;
                this.flag_btn = false;
                this.flag_btn_add_phong = false;
                // console.log(bp);
                this.loading_phong_ban = true;
                $('.row-nhom').removeClass("active-click-row");
                $('#n' + bp.id).addClass("active-click-row");
            },
            add_phong_ban: function () {
                api_add_phong_ban(this);
            },
            edit_phong_ban: function() {
                api_edit_phong_ban(this);
            },
            delete_nhom: function() {
                if(this.phong_ban.id <= 0) return -1;
                api_delete_phong_ban(this);
            }
        }
    }
</script>

<style>
    .row-nhom:hover {
        cursor: pointer;
        color: black;
    }
</style>