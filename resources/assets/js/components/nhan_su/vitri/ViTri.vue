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
                            <button id="add_nhom" type="button" @click="_vi_tri('add')" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus-circle"></i> Thêm mới
                            </button>
                            <button v-bind:disabled="flag_btn" @click="_vi_tri('edit')" id="edit_nhom" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-edit"></i> Sửa
                            </button>
                            <button v-bind:disabled="flag_btn" @click="delete_nhom" type="button" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i> Xóa
                            </button>

                            <!-- The Modal NHOM -->
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form @submit.prevent="submit_vi_tri" id="form_bophan">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Thông tin vị trí</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label><b>Mã vị trí</b></label>
                                                    <input v-model="vi_tri.ma_vi_tri" :disabled="flag_input_vi_tri" v-validate="'required'" :class="{'border-danger' : errors.has('txtmabophan')}" type="text" name="txtmabophan" class="form-control" id="txtmabophan" aria-describedby="" autofocus>
                                                    <small v-show="errors.has('txtmabophan')" class="help text-muted is-danger">Vui lòng nhập mã vị trí</small>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Tên vị trí</b></label>
                                                    <input v-model="vi_tri.ten_vi_tri" v-validate="'required'" :class="{'border-danger' : errors.has('txttenbophan')}" type="text" name="txttenbophan" class="form-control" id="txttenbophan" placeholder="">
                                                    <small v-show="errors.has('txttenbophan')" class="help text-muted is-danger">Vui lòng nhập tên vị trí</small>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Diễn giải</b></label>
                                                    <textarea v-model="vi_tri.dien_giai" type="text" name="txtdiengiai" class="form-control" id="txtdiengiai"></textarea>
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
                                        <tr v-if="loading_vi_tri"><td colspan="3" class="text-center">Loading...</td></tr>
                                        <tr v-for="n in list_vi_tri" :id="'n' + n.id" class="row-nhom" @click="click_vi_tri(n)">
                                            <td>{{n.ma_vi_tri}}</td>
                                            <td>{{n.ten_vi_tri}}</td>
                                            <td>{{n.dien_giai}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <el-pagination
                                        :page-size="10"
                                        layout="prev, pager, next"
                                        :total="total_vi_tri"
                                        @current-change="danh_sach_vi_tri">
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
    import {api_get_vi_tri} from "./vi_tri";
    import {api_add_vi_tri} from "./vi_tri";
    import {api_edit_vi_tri} from "./vi_tri";
    import {api_delete_vi_tri} from "./vi_tri";

    export default {
        name: 'vitri',
        mounted (){
            this.danh_sach_vi_tri();
        },
        data () {
            return {
                loading_vi_tri : true,
                list_vi_tri: [],
                total_vi_tri: 0,
                vi_tri: { idi: 0, ma_vi_tri: '', ten_vi_tri: '', dien_giai: '' },
                flag_btn: true,
                flag_submit_vi_tri: true,
                flag_input_vi_tri: false
            }
        },
        methods: {
            danh_sach_vi_tri: function (page = 1) {
                api_get_vi_tri(this, page);
            },
            _vi_tri: function (state) {
                if(state == 'add') {
                    console.log('add nhom');
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_vi_tri = true;
                    this.flag_input_vi_tri = false;
                    this.vi_tri.id = this.vi_tri.ma_vi_tri = this.vi_tri.ten_vi_tri = this.vi_tri.dien_giai = '';
                }
                else {
                    console.log('edit nhom');
                    this.flag_submit_vi_tri = false;
                    this.flag_input_vi_tri = true;
                }
            },
            submit_vi_tri: function () {
                if(this.flag_submit_vi_tri) {
                    this.flag_input_vi_tri = false;
                    this.add_vi_tri();
                }
                else {
                    this.nhom = this.nhom_selected;
                    this.flag_input_vi_tri = true;
                    this.edit_vi_tri();
                }
            },
            click_vi_tri: function (bp) {
                this.vi_tri.id = bp.id;
                this.vi_tri.ma_vi_tri = bp.ma_vi_tri;
                this.vi_tri.ten_vi_tri = bp.ten_vi_tri
                this.vi_tri.dien_giai = bp.dien_giai;
                this.flag_btn = false;
                this.flag_btn_add_phong = false;
                // console.log(bp);
                this.loading_phong_ban = true;
                $('.row-nhom').removeClass("active-click-row");
                $('#n' + bp.id).addClass("active-click-row");
            },
            add_vi_tri: function () {
                api_add_vi_tri(this);
            },
            edit_vi_tri: function() {
                api_edit_vi_tri(this);
            },
            delete_nhom: function() {
                if(this.vi_tri.id <= 0) return -1;
                api_delete_vi_tri(this);
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