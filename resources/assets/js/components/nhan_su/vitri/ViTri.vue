<template>
    <div class="page-wrapper" style="min-height: 291px;">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Danh sách vị trí</h4>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Vị trí</a></li>
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
                            <div class="row row-title">
                                <div class="col-md-10 col-sm-6">
                                    <div class="dropdown">
                                        <button @click="dropdown('dropdown_bo_phan')" class="btn btn-outline-primary dropdown-toggle btn-full-width" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="min-width: 200px;">
                                            Tất cả phòng ban
                                        </button>
                                        <ul id="dropdown_bo_phan" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li @click="selected_item(0, 'Tất cả phòng ban', 'dropdown_bo_phan')" data-id-bo-phan="0" class="dropdown-item">Tất cả phòng ban</li>
                                            <li v-for="n in list_phong_ban" @click="selected_item(n.id, n.ten_phong, 'dropdown_bo_phan','dropdownMenuButton','dropdownMenuButton2')" class="dropdown-item">{{n.ten_phong}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6 col-12">
                                    <button @click="_vi_tri('add')" title="Thêm mới phòng" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-dark pull-right btn-full-width">
                                        <i class="fa fa-plus-circle"></i> Thêm mới
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="message-box contact-box">
                                <!--<h2 class="add-ct-btn">-->
                                <!--&lt;!&ndash;<button @click="_vi_tri('add')" title="Thêm mới phòng" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"><i class="fa fa-plus"></i></button>&ndash;&gt;-->
                                <!--</h2>-->
                                <div class="message-widget contact-widget">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr style="border-top: 1px solid #ddd">
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
                                                <td class="text-center" colspan="6"><b><i>Đang tải danh sách vị trí...</i></b></td>
                                            </tr>
                                            <tr v-else-if="list_vi_tri.length <= 0">
                                                <td class="text-center" colspan="6"><b><i>Chưa có vị trí</i></b></td>
                                            </tr>
                                            <tr v-else-if="list_vi_tri.length > 0" v-for="n in list_vi_tri" :id="'n' + n.id" class="row-nhom" @click="click_vi_tri(n)">
                                                <td>{{n.ma_vi_tri}}</td>
                                                <td>{{n.ten_vi_tri}}</td>
                                                <td>{{n.dien_giai}}</td>
                                                <td>{{n.created_at}}</td>
                                                <td class="text-center">Hiện</td>
                                                <td class="text-right" style="padding-right: 0">
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
                                                <h4 class="modal-title"><b>Thông tin vị trí</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div :disabled="flag_body_modal" class="modal-body">
                                                <div class="form-group">
                                                    <label><b>Bộ phận</b></label>
                                                    <!--<input v-model="vi_tri.id_bo_phan" :disabled="flag_input_vi_tri" v-validate="'required'" >-->
                                                    <div class="dropdown">
                                                        <button @click="dropdown('dropdown_bo_phan2')" v-model="vi_tri._bo_phan" class="btn btn-outline-primary dropdown-toggle btn-full-width" type="button" id="dropdownMenuButton2" data-toggle="dropdown" style="width: 100%">
                                                            --- Chọn phòng ---
                                                        </button>
                                                        <ul id="dropdown_bo_phan2" class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 100%">
                                                            <!--<li @click="selected_item(0, '-&#45;&#45; Chọn bộ phận -&#45;&#45;', 'dropdown_bo_phan2')" disabled data-id-bo-phan="0" class="dropdown-item">-&#45;&#45; Chọn bộ phận -&#45;&#45;</li>-->
                                                            <li v-for="n in list_phong_ban" @click="selected_item(n.id, n.ten_phong, 'dropdown_bo_phan2','dropdownMenuButton2','dropdownMenuButton')" class="dropdown-item">{{n.ten_phong}}</li>
                                                        </ul>
                                                    </div>
                                                    <small v-show="errors.has('txtmabophan')" class="help text-muted is-danger">Vui lòng chọn bộ phận</small>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Mã vị trí</b></label>
                                                    <input v-model="vi_tri.ma_vi_tri" :disabled="flag_input_vi_tri" v-validate="'required'" :class="{'border-danger' : errors.has('txtmabophan')}" type="text" name="txtmabophan" class="form-control" id="txtmabophan" aria-describedby="" autofocus>
                                                    <small v-show="errors.has('txtmabophan')" class="help text-muted is-danger">Vui lòng nhập mã vị trí</small>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Tên vị trí</b></label>
                                                    <input v-model="vi_tri.ten_vi_tri" v-validate="'required'" :class="{'border-danger' : errors.has('txttenvitri')}" type="text" name="txttenvitri" class="form-control" id="txttenbophan" placeholder="">
                                                    <small v-show="errors.has('txttenvitri')" class="help text-muted is-danger">Vui lòng nhập tên vị trí</small>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Diễn giải</b></label>
                                                    <textarea v-model="vi_tri.dien_giai" type="text" name="txtdiengiai" class="form-control" id="txtdiengiai"></textarea>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button id="save" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại</button>
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
    // import {api_get_all_bo_phan} from "../bophan/bo_phan";
    import {api_get_all_vi_tri} from "./vi_tri";
    import {api_get_vi_tri_theo_phong} from "./vi_tri";
    import {api_get_all_phong_ban_no_paginate} from "../phongban/phong_ban";
    import {api_add_vi_tri} from "./vi_tri";
    import {api_edit_vi_tri} from "./vi_tri";
    import {api_delete_vi_tri} from "./vi_tri";

    export default {
        name: 'bophan',
        mounted () {
            this.danh_sach_phong_ban();
            api_get_all_vi_tri(this);
        },
        updated () {
        },
        data () {
            return {
                loading_bo_phan: true,
                select_bo_phan: '',
                bo_phan: [],
                list_phong_ban: [],
                list_bo_phan: [],
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
            dropdown: function (id_con) {
                $('#' + id_con).toggleClass("show");
            },
            selected_item: function (id_bo_phan, ten_bo_phan, id_dropdown, id_btn, id_btn2) {
                $('#' + id_btn).text(ten_bo_phan);
                $('#' + id_btn).val(id_bo_phan);
                $('#' + id_btn2).text(ten_bo_phan);
                $('#' + id_btn2).text(ten_bo_phan);
                $('#' + id_dropdown).removeClass("show");
                this.vi_tri.id_phong_ban = id_bo_phan;
                this.danh_sach_vi_tri(id_bo_phan);
            },
            danh_sach_phong_ban: function () {
                api_get_all_phong_ban_no_paginate(this);
            },
            danh_sach_vi_tri: function (page = 1) {
                this.loading_vi_tri = true;
                if(this.vi_tri.id_phong_ban == 0){
                    api_get_all_vi_tri(this, page);
                }
                else{
                    api_get_vi_tri_theo_phong(this, this.vi_tri.id_phong_ban, page);
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
                    // api_get_danh_sach_phong_theo_bo_phan(this, $('#select_phong_1').val(),1);
                }
            },
            _vi_tri: function (state, bophan = null) {
                if(state == 'add') {
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_vi_tri = true;
                    this.flag_input_vi_tri = false;
                    this.vi_tri.id = this.vi_tri.ma_vi_tri = this.vi_tri.ten_vi_tri = this.vi_tri.dien_giai = '';
                }
                else {
                    $('#select_phong_2').attr('disabled', 'disabled');
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
                this.change_bnt_save();
                api_add_vi_tri(this);
            },
            edit_vi_tri: function() {
                console.log(this.vi_tri);
                api_edit_vi_tri(this);
            },
            delete_vi_tri: function(id) {
                this.vi_tri.id = id;
                if(this.vi_tri.id <= 0) return -1;
                this.change_bnt_save();
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

    .bg-inverse {
        background-color: white;
        padding-bottom: 0;
    }

    .card-body {
        padding-top: 10px;
    }

    .row-title {
        padding-top: 10px;
    }

    .dropdown-menu {
        border-radius: 0 !important;
        height: 200px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .dropdown-item{
        cursor: pointer;
    }

    #dropdownMenuButton2::after {
        position: absolute;
        top: 50%;
        width: 0;
        height: 0;
        right: 10px;
        margin-left: .255em;
        vertical-align: .255em;
        content: "";
        border-top: .3em solid;
        border-right: .3em solid transparent;
        border-bottom: 0;
        border-left: .3em solid transparent;
    }

</style>