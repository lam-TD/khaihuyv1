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
                    <li class="breadcrumb-item">Vị trí</li>
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
                        <div class="card-body bg-inverse form-chung">
                            <h4 class="card-title">Danh sách vị trí</h4>
                            <h6 class="card-subtitle text-white m-0 op-5"></h6>
                            <!--<select v-model="select_bo_phan" id="select_phong_1" class="select2 form-control custom-select" style="width: 100%; height:36px;" v-on:change="change_vi_tri">-->
                            <!--<option value="0">Tất cả</option>-->
                            <!--<option v-for="n in list_bo_phan" :value="n.id">{{n.ten_bo_phan}}</option>-->
                            <!--</select>-->
                            <select id="select_phong_1" class="form-control custom-select" style="width: 80%; height:36px;" v-on:change="change_vi_tri">
                                <option value="" selected disabled>-----Chọn phòng ban-----</option>
                                <option value="0">Tất cả</option>
                                <option v-for="n in list_phong_ban" :value="n.id">{{n.ten_phong}}</option>
                            </select>
                        </div>
                        <div class="card-body">
                            <div class="message-box contact-box">
                                <h2 class="add-ct-btn">
                                    <button @click="_vi_tri('add')" title="Thêm mới phòng" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"><i class="fa fa-plus"></i></button>
                                </h2>
                                <div class="message-widget contact-widget">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Mã vị trí</th>
                                                <th>Tên vị trí</th>
                                                <th>Diễn giải</th>
                                                <th>Ngày tạo</th>
                                                <th class="text-center">Ẩn hiện</th>
                                                <th class="text-center">#</th>
                                            </tr>
                                            </thead>
                                            <tbody class="body-table loading-item">
                                            <tr v-if="loading_vi_tri">
                                                <td class="text-center" colspan="6"><b><i>Loading...</i></b></td>
                                            </tr>
                                            <!--<tr v-if="list_vi_tri.length <= 0">-->
                                            <!--<td class="text-center" colspan="6"><b><i>Chưa có phòng</i></b></td>-->
                                            <!--</tr>-->
                                            <tr v-if="list_vi_tri.length > 0" v-for="n in list_vi_tri" :id="'n' + n.id" class="row-nhom" @click="click_vi_tri(n)">
                                                <td>{{n.ma_vi_tri}}</td>
                                                <td>{{n.ten_vi_tri}}</td>
                                                <td>{{n.dien_giai}}</td>
                                                <td>{{n.created_at}}</td>
                                                <td class="text-center">Hiện</td>
                                                <td class="text-center">
                                                    <button @click="_vi_tri('edit',n)" id="edit_nhom" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-edit"></i> Sửa
                                                    </button>
                                                    <button @click="delete_vi_tri(n.id)" type="button" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Xóa
                                                    </button>
                                                </td>
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

                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form @submit.prevent="submit_vi_tri" id="form_bophan">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Thông tin phòng</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div :disabled="flag_body_modal" class="modal-body">
                                                <div class="form-group">
                                                    <label><b>Phòng</b></label>
                                                    <!--<input v-model="vi_tri.id_bo_phan" :disabled="flag_input_vi_tri" v-validate="'required'" >-->
                                                    <select :disabled="flag_input_vi_tri" v-model="vi_tri.id_phong_ban" name="select_phong" id="select_phong_2" class=" form-control custom-select" style="width: 100%; height:36px;">
                                                        <option v-for="n in list_phong_ban" :value="n.id">{{n.ten_phong}}</option>
                                                    </select>
                                                    <small v-show="vi_tri.id_phong_ban <= 0" class="help text-muted is-danger">Vui lòng chọn phòng ban</small>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Mã vị trí</b></label>
                                                    <input v-model="vi_tri.vi_tri" :disabled="flag_input_vi_tri" v-validate="'required'" :class="{'border-danger' : errors.has('txtmabophan')}" type="text" name="txtmabophan" class="form-control" id="txtmabophan" aria-describedby="" autofocus>
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
    import {api_get_all_phong_ban_no_paginate} from "../phongban/phong_ban";
    import {api_get_all_vi_tri} from "./vi_tri";
    import {api_get_vi_tri_theo_phong} from './vi_tri';
    import {api_add_vi_tri} from "./vi_tri";
    import {api_edit_vi_tri} from "./vi_tri";
    import {api_delete_vi_tri} from "./vi_tri";

    export default {
        name: 'vitri',
        mounted () {
            this.danh_sach_phong_ban();
            // this.change_vi_tri();
        },
        updated () {
            // let vm = this;
            // $(document).ready(function() {
            //     $('.select2').select2({
            //         placeholder: 'Chọn bộ phận'
            //     });
            //     $('#select_phong_1').on('select2:select', function (e) {
            //         vm.change_vi_tri();
            //     });
            // });
        },
        data () {
            return {
                loading_bo_phan: true,
                select_bo_phan: '',
                phong_ban: [],
                list_phong_ban: [],
                loading_vi_tri: true,
                list_vi_tri: [],
                total_vi_tri: 0,
                vi_tri: { id: 0, ma_vi_tri: '', ten_vi_tri: '', dien_giai: '', id_phong_ban: '' },
                flag_btn: true,
                flag_submit_vi_tri: true,
                flag_input_vi_tri: false,
                flag_body_modal: false
            }
        },
        methods: {
            danh_sach_phong_ban: function () {
                api_get_all_phong_ban_no_paginate(this);
            },
            danh_sach_vi_tri: function (page = 1) {
                if($('#select_phong_1').val() == 0){
                    api_get_all_vi_tri(this, page);
                }
                else{
                    api_get_vi_tri_theo_phong(this, page);
                }
            },
            change_vi_tri: function () {
                // this.bo_phan =
                this.loading_vi_tri = true;
                this.list_vi_tri = [];
                if($('#select_phong_1').val() == 0){
                    api_get_all_vi_tri(this, 1);
                }
                else{
                    api_get_vi_tri_theo_phong(this, $('#select_phong_1').val(),1);
                }
            },
            _vi_tri: function (state, bophan = null) {
                if(state == 'add') {
                    $('#select_phong_2').removeAttr('disabled');
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_vi_tri = true;
                    this.flag_input_vi_tri = false;
                    this.vi_tri.id = this.vi_tri.ma_phong = this.vi_tri.ten_phong = this.vi_tri.dien_giai = '';
                }
                else {
                    $('#select_phong_2').attr('disabled', 'disabled');
                    console.log(bophan);
                    this.vi_tri = bophan;
                    this.flag_submit_vi_tri = false;
                    this.flag_input_vi_tri = true;
                }
            },
            submit_vi_tri: function () {
                // this.change_bnt_save();
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
                $('.row-nhom').removeClass("active-click-row");
                $('#n' + bp.id).addClass("active-click-row");
            },
            add_vi_tri: function () {
                api_add_vi_tri(this);
            },
            edit_vi_tri: function() {
                console.log(this.vi_tri);
                api_edit_vi_tri(this);
            },
            delete_vi_tri: function(id) {
                this.vi_tri.id = id;
                if(this.vi_tri.id <= 0) return -1;
                api_delete_vi_tri(this);
            },
            change_bnt_save: function () {
                this.flag_body_modal = true;
                $('#save').attr('disabled', 'disabled');
                $('#save').text('Đang xử lý...');
            },
            un_change_bnt_save: function () {
                console.log("unchange");
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