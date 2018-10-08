<template>
    <div class="page-wrapper" style="min-height: 291px;">

        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-lg-12 col-md-12 lamlam">
                    <!-- Column -->
                    <div class="card content-lam">
                        <div class="card-header">
                            <div class="card-actions">
                                <!--<a @click="scroll_card" id="thunho" class="" data-action="collapse"><i class="ti-minus"></i></a>-->
                                <a @click="scroll_card_full_creem" id="phongto" class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                <!--<a class="btn-close" data-action="close"><i class="ti-close"></i></a>-->
                            </div>
                            <h4 class="card-title m-b-0">Danh sách vị trí</h4>
                        </div>
                        <div class="card-body">
                            <div class="row row-title" style="margin-bottom: 10px;">
                                <div class="col-md-4 col-sm-6">
                                    <div class="">
                                        <el-select v-model="vi_tri.id_phong_ban" value-key="vi_tri.id_phong_ban" filterable placeholder="Tất cả phòng ban" @change="select_vi_tri_theo_phong" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                            <el-option :key="''" :label="'Tất cả phòng'" :value="''"></el-option>
                                            <el-option-group v-for="item in list_phong_ban" :key="item.ten_bo_phan" :label="item.ten_bo_phan">
                                                <el-option v-for="p in item.phong" :key="p.id" :label="p.ten_phong" :value="p.ma_phong">
                                                    <span style="float: left">{{ p.ten_phong }}</span>
                                                    <span style="float: right; color: #8492a6; font-size: 13px">{{ p.ma_phong }}</span>
                                                </el-option>
                                            </el-option-group>
                                        </el-select>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-6 col-12">
                                    <button @click="_vi_tri('add')" title="Thêm mới phòng" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-dark pull-right btn-full-width">
                                        <i class="fa fa-plus-circle"></i> Thêm mới
                                    </button>
                                </div>
                            </div>

                            <div class="message-box contact-box">
                                <!--<h2 class="add-ct-btn">-->
                                <!--&lt;!&ndash;<button @click="_vi_tri('add')" title="Thêm mới phòng" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"><i class="fa fa-plus"></i></button>&ndash;&gt;-->
                                <!--</h2>-->
                                <div class="message-widget contact-widget">
                                    <!--<div class="table-responsive">-->
                                        <!--<table class="table table-hover">-->
                                            <!--<thead>-->
                                            <!--<tr style="border-top: 1px solid #ddd">-->
                                                <!--<th class="text-center" style="width: 100px;">#</th>-->
                                                <!--<th>Mã vị trí</th>-->
                                                <!--<th>Tên vị trí</th>-->
                                                <!--<th>Diễn giải</th>-->
                                            <!--</tr>-->
                                            <!--</thead>-->
                                            <!--<tbody class="body-table loading-item">-->
                                            <!--<tr v-if="loading_vi_tri">-->
                                                <!--<td class="text-center" colspan="6"><b><i>Đang tải danh sách vị trí...</i></b></td>-->
                                            <!--</tr>-->
                                            <!--<tr v-else-if="list_vi_tri.length <= 0">-->
                                                <!--<td class="text-center" colspan="6"><b><i>Chưa có vị trí</i></b></td>-->
                                            <!--</tr>-->
                                            <!--<tr v-else-if="list_vi_tri.length > 0" v-for="n in list_vi_tri" :id="'n' + n.id" class="row-nhom" @click="click_vi_tri(n)">-->
                                                <!--<td class="text-center" style="padding-right: 0">-->
                                                    <!--<button @click="_vi_tri('edit',n)" id="edit_nhom" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">-->
                                                        <!--<i class="fa fa-edit"></i>-->
                                                    <!--</button>-->
                                                    <!--<button @click="delete_vi_tri(n)" type="button" class="btn btn-danger btn-sm">-->
                                                        <!--<i class="fa fa-trash"></i>-->
                                                    <!--</button>-->
                                                <!--</td>-->
                                                <!--<td>{{n.ma_vi_tri}}</td>-->
                                                <!--<td>{{n.ten_vi_tri}}</td>-->
                                                <!--<td>{{n.dien_giai}}</td>-->
                                            <!--</tr>-->
                                            <!--</tbody>-->
                                        <!--</table>-->
                                        <!--<el-pagination-->
                                                <!--:page-size="10"-->
                                                <!--layout="prev, pager, next"-->
                                                <!--:total="total_vi_tri"-->
                                                <!--@current-change="danh_sach_vi_tri">-->
                                        <!--</el-pagination>-->
                                    <!--</div>-->
                                    <!--//-->
                                    <div class="row">
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <el-table :data="list_vi_tri" style="width: 100%" border :empty-text="loading_vi_tri">
                                                <el-table-column prop="name" label="#" width="90" align="center" class-name="center-text">
                                                    <template slot-scope="scope" class="text-center" style="width: 100%">
                                                        <button @click="_vi_tri('edit', scope.row)" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm" title="Cập nhật thông tin vị trí"> <i class="fa fa-edit"></i> </button>
                                                        <button @click="delete_vi_tri(scope.row)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column type="index" label="TT" align="center" class-name="center-text"></el-table-column>
                                                <el-table-column prop="ma_vi_tri" label="Mã vị trí" align="center" width="120" class-name="center-text"></el-table-column>
                                                <el-table-column prop="ten_vi_tri" label="Tên vị trí" class-name="no-center-text"></el-table-column>
                                                <el-table-column prop="dien_giai" label="Diễn giải" class-name="no-center-text"></el-table-column>
                                            </el-table>
                                        </div>
                                        <!--////-->
                                        <div class="col-md-12">
                                            <div class="row tb-row-hienthi">
                                                <div class="col-md-1 col-sm-2 col-8 tb-label pr-0" style="padding-left: 15px;">
                                                    <span>Hiển thị</span>
                                                </div>
                                                <div class="col-md-1 col-sm-2 col-4 tb-hienthi" style="padding-left: 4px;">
                                                    <el-select v-model="limit" placeholder="10" size="small" @change="danh_sach_vi_tri_limit">
                                                        <el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-md-8 col-sm-4 col-6" style="padding-left: 0px;">
                                                    <el-pagination :page-size="limit" layout="prev, pager, next" :total="total_vi_tri" @current-change="danh_sach_vi_tri" :current-page.sync="currentPage"></el-pagination>
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-6 tb-label">
                                                    <span class="pull-right">Tổng: {{total_vi_tri}} VT</span>
                                                </div>
                                            </div>
                                        </div>
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
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Phòng ban(*)</b></label>
                                                    <div class="col-md-9">
                                                        <el-select :disabled="flag_disabled_phong" v-model="vi_tri.id_phong_ban" value-key="vi_tri.id_phong_ban" size="small" filterable placeholder="Tất cả phòng ban" @change="select_vi_tri_theo_phong" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <el-option-group v-for="item in list_phong_ban" :label="item.ten_bo_phan" :key="item.ten_bo_phan">
                                                                <el-option v-for="p in item.phong" :key="p.id" :label="p.ten_phong" :value="p.ma_phong">
                                                                    <span style="float: left">{{ p.ten_phong }}</span>
                                                                    <span style="float: right; color: #8492a6; font-size: 13px">{{ p.ma_phong }}</span>
                                                                </el-option>
                                                            </el-option-group>
                                                        </el-select>
                                                        <small v-if="error_select_phong" class="help text-muted is-danger">Vui lòng chọn phòng</small>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Mã vị trí(*)</b></label>
                                                    <div class="col-md-9">
                                                        <input v-model="vi_tri.ma_vi_tri" v-on:keypress="disable_spaces" v-bind:maxlength="7" @input="validate_ma_vt" :disabled="flag_input_vi_tri" v-validate="'required'" :class="{'border-danger' : errors.has('txtmabophan')}" type="text" name="txtmabophan" class="form-control form-control-sm" id="txtmabophan" aria-describedby="" autofocus>
                                                        <!--<small v-show="errors.has('txtmabophan')" class="help text-muted is-danger">Vui lòng nhập mã vị trí</small>-->
                                                        <small v-if="flag_input_ma_vt" class="help text-muted is-danger">Mã Vị trí phải có 7 ký tự, bắt đầu bằng VT</small>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Tên vị trí(*)</b></label>
                                                    <div class="col-md-9">
                                                        <input v-model="vi_tri.ten_vi_tri" v-validate="'required'" :class="{'border-danger' : errors.has('txttenvitri')}" type="text" name="txttenvitri" class="form-control form-control-sm" id="txttenbophan" placeholder="">
                                                        <small v-show="errors.has('txttenvitri')" class="help text-muted is-danger">Vui lòng nhập tên vị trí</small>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Diễn giải</b></label>
                                                    <div class="col-md-9">
                                                        <textarea v-model="vi_tri.dien_giai" type="text" name="txtdiengiai" class="form-control form-control-sm" id="txtdiengiai"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <!--<button :disabled="flag_select_phong || vi_tri.ten_vi_tri.length == 0 || flag_disabled_submit" id="save" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại</button>-->
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                                <button :disabled="flag_disabled_submit || vi_tri.ten_vi_tri.length == 0 || vi_tri.id_phong_ban == ''" id="save" type="submit" class="btn btn-primary">
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
    // import {api_get_all_bo_phan} from "../bophan/bo_phan";
    import {api_get_all_vi_tri} from "./vi_tri";
    import {api_get_vi_tri_theo_phong} from "./vi_tri";
    import {api_get_all_phong_ban_no_paginate} from "../phongban/phong_ban";
    import {api_add_vi_tri} from "./vi_tri";
    import {api_edit_vi_tri} from "./vi_tri";
    import {api_delete_vi_tri} from "./vi_tri";
    import {api_group_all_phong_ban_theo_bo_phan} from "../phongban/phong_ban";
    import {api_get_ma_vi_tri} from "./vi_tri";

    export default {
        name: 'bophan',
        mounted () {
            // this.danh_sach_phong_ban();
            api_group_all_phong_ban_theo_bo_phan(this);
            api_get_all_vi_tri(this,1);
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
                loading_vi_tri: 'Đang tải...',
                list_vi_tri: [],
                total_vi_tri: 0,
                vi_tri: { id: 0, ma_vi_tri: '', ten_vi_tri: '', dien_giai: '', id_phong_ban: '' },
                flag_btn: true,
                flag_submit_vi_tri: true,
                flag_input_vi_tri: false,
                flag_input_ma_vt: false,
                flag_disabled_submit: false,
                flag_select_phong: true,
                flag_btn_save: true,
                error_select_phong: true,
                options_display: [10,20,30],
                limit: 10,
                currentPage: 1,
                flag_disabled_phong: false
            }
        },
        methods: {
            validate_ma_vt: function () {
                var length_nv = this.vi_tri.ma_vi_tri.length;
                var value_nv  = this.vi_tri.ma_vi_tri;
                if((length_nv > 7 || length_nv < 7) || value_nv.indexOf('VT') == -1 || value_nv.indexOf(' ') > -1){
                    this.flag_input_ma_vt = true;
                    this.flag_disabled_submit = true;
                }
                else{
                    this.flag_input_ma_vt = false;
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
            select_vi_tri_theo_phong: function (id_phong) {
                this.error_select_phong = false;
                this.vi_tri.id_phong_ban = id_phong;
                this.danh_sach_vi_tri(1);
            },
            danh_sach_phong_ban: function () {
                api_get_all_phong_ban_no_paginate(this);
            },
            danh_sach_vi_tri: function (page = 1) {
                this.loading_vi_tri = true;
                if(this.vi_tri.id_phong_ban == ''){
                    api_get_all_vi_tri(this, page);
                }
                else{
                    api_get_vi_tri_theo_phong(this, this.vi_tri.id_phong_ban, page);
                }
            },
            danh_sach_vi_tri_limit: function () {
                this.loading_vi_tri = true;
                if(this.vi_tri.id_phong_ban == ''){
                    this.currentPage = 1;
                    api_get_all_vi_tri(this, 1);
                }
                else{
                    this.currentPage = 1;
                    api_get_vi_tri_theo_phong(this, this.vi_tri.id_phong_ban, 1);
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
                    this.flag_disabled_phong = false;
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_vi_tri = true;
                    this.flag_input_vi_tri = false;
                    this.vi_tri = { id: 0, ma_vi_tri: '', ten_vi_tri: '', dien_giai: '', id_phong_ban: '' }
                    api_get_ma_vi_tri(this);
                }
                else {
                    this.flag_disabled_phong = true;
                    this.error_select_phong = false;
                    $('#select_phong_2').attr('disabled', 'disabled');
                    this.vi_tri.id = bophan.id;
                    this.vi_tri.ma_vi_tri = bophan.ma_vi_tri;
                    this.vi_tri.id_phong_ban = bophan.id_phong_ban;
                    this.vi_tri.ten_vi_tri = bophan.ten_vi_tri;
                    this.vi_tri.dien_giai = bophan.dien_giai;
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
                this.change_bnt_save();
                api_edit_vi_tri(this);
            },
            delete_vi_tri: function(n) {
                // this.vi_tri = n;
                // if(this.vi_tri.id <= 0) return -1;
                console.log(this.vi_tri.id_phong_ban);
                api_delete_vi_tri(this, n.ma_vi_tri);


            },
            change_bnt_save: function () {
                this.flag_btn_save = false;
                $('#save').attr('disabled', 'disabled');
            },
            un_change_bnt_save: function () {
                console.log("unchange");
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

    .el-select {
        width: 100%;
    }

    .form-group {
        margin-bottom: 5px;
    }

</style>