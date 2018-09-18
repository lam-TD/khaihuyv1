<template>
    <div class="page-wrapper" style="min-height: 291px;">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Danh sách phòng ban</h4>
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
                            <div class="row row-title">
                                <div class="col-md-4 col-sm-6">
                                    <!--<div class="dropdown">-->
                                        <!--<button @click="dropdown('dropdown_bo_phan')" class="btn btn-outline-primary dropdown-toggle btn-full-width" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                                            <!--Tất cả bộ phận-->
                                        <!--</button>-->
                                        <!--<ul id="dropdown_bo_phan" class="dropdown-menu" aria-labelledby="dropdownMenuButton">-->
                                            <!--<li @click="selected_item(0, 'Tất cả bộ phận', 'dropdown_bo_phan')" data-id-bo-phan="0" class="dropdown-item">Tất cả bộ phận</li>-->
                                            <!--<li v-for="n in list_bo_phan" @click="selected_item(n.id, n.ten_bo_phan, 'dropdown_bo_phan','dropdownMenuButton','dropdownMenuButton2')" class="dropdown-item">{{n.ten_bo_phan}}</li>-->
                                        <!--</ul>-->
                                    <!--</div>-->
                                    <div class="">
                                        <el-select v-model="phong_ban.id_bo_phan" value-key="phong_ban.id_bo_phan" filterable placeholder="Tất cả bộ phận" @change="select_phong_theo_bo_phan">
                                            <el-option :key="''" :label="'Tất cả bộ phận'" :value="''"></el-option>
                                            <el-option v-for="item in list_bo_phan" :key="item.id" :label="item.ten_bo_phan" :value="item.ma_bo_phan">
                                                <span style="float: left">{{ item.ten_bo_phan }}</span>
                                                <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ma_bo_phan }}</span>
                                            </el-option>
                                        </el-select>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-6 col-12">
                                    <button @click="_phong_ban('add')" title="Thêm mới phòng" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-dark pull-right btn-full-width">
                                        <i class="fa fa-plus-circle"></i> Thêm mới
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="message-box contact-box">
                                <!--<h2 class="add-ct-btn">-->
                                    <!--&lt;!&ndash;<button @click="_phong_ban('add')" title="Thêm mới phòng" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"><i class="fa fa-plus"></i></button>&ndash;&gt;-->
                                <!--</h2>-->
                                <div class="message-widget contact-widget">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr style="border-top: 1px solid #ddd">
                                                    <th class="text-center" style="width: 100px;">#</th>
                                                    <th>Mã phòng</th>
                                                    <th>Tên phòng</th>
                                                    <th>Diễn giải</th>
                                                </tr>
                                            </thead>
                                            <tbody class="body-table loading-item">
                                                <tr v-if="loading_phong_ban">
                                                    <td class="text-center" colspan="6"><b><i><i class="fa fa-spin fa-spinner"></i> Đang tải danh sách phòng...</i></b></td>
                                                </tr>
                                                <tr v-else-if="list_phong_ban.length <= 0">
                                                    <td class="text-center" colspan="6"><b><i>Chưa có phòng</i></b></td>
                                                </tr>
                                                <tr v-else-if="list_phong_ban.length > 0" v-for="n in list_phong_ban" :id="'n' + n.id" class="row-nhom" @click="click_phong_ban(n)">
                                                    <td class="text-center" style="padding-right: 0">
                                                        <button @click="_phong_ban('edit',n)" id="edit_nhom" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button @click="delete_phong_ban(n)" type="button" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                    <td>{{n.ma_phong}}</td>
                                                    <td>{{n.ten_phong}}</td>
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

                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form @submit.prevent="submit_phong_ban" id="form_bophan">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Thông tin phòng</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div :disabled="flag_body_modal" class="modal-body">
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Bộ phận</b></label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="phong_ban.id_bo_phan" value-key="phong_ban.id_bo_phan" size="small" filterable placeholder="Chọn bộ phận" @change="select_phong_theo_bo_phan">
                                                            <el-option v-for="item in list_bo_phan" :key="item.id" :label="item.ten_bo_phan" :value="item.ma_bo_phan">
                                                                <span style="float: left">{{ item.ten_bo_phan }}</span>
                                                                <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ma_bo_phan }}</span>
                                                            </el-option>
                                                        </el-select>
                                                        <small v-show="error_select_bo_phan" class="help text-muted is-danger">Vui lòng chọn bộ phận</small>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Mã phòng</b></label>
                                                    <div class="col-md-9">
                                                        <input @input="validate_ma_ph" v-model="phong_ban.ma_phong" :disabled="flag_input_phong_ban" v-validate="'required'" :class="{'border-danger' : errors.has('txtmabophan')}" type="text" name="txtmabophan" class="form-control form-control-sm" id="txtmabophan" aria-describedby="" autofocus>
                                                        <!--<small v-show="errors.has('txtmabophan')" class="help text-muted is-danger">Vui lòng nhập mã phòng</small>-->
                                                        <small v-if="flag_input_ma_phong" class="help text-muted is-danger">Mã phòng phải có 8 ký tự, bắt đầu bằng PH</small>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Tên phòng</b></label>
                                                    <div class="col-md-9">
                                                        <input v-model="phong_ban.ten_phong" v-validate="'required'" :class="{'border-danger' : errors.has('txttenbophan')}" type="text" name="txttenbophan" class="form-control form-control-sm" id="txttenbophan" placeholder="">
                                                        <small v-show="errors.has('txttenbophan')" class="help text-muted is-danger">Vui lòng nhập tên phòng</small>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label"><b>Diễn giải</b></label>
                                                    <div class="col-md-9">
                                                        <textarea v-model="phong_ban.dien_giai" type="text" name="txtdiengiai" class="form-control form-control-sm" id="txtdiengiai"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <!--<button id="save" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại</button>-->
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                                <button :disabled="flag_disabled_submit || phong_ban.ten_phong.length == 0 || phong_ban.id_bo_phan == ''" id="save" type="submit" class="btn btn-primary">
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
    import {api_get_all_bo_phan} from "../bophan/bo_phan";
    import {api_get_all_phong_ban} from "./phong_ban";
    import {api_get_danh_sach_phong_theo_bo_phan} from './phong_ban';
    import {api_add_phong_ban} from "./phong_ban";
    import {api_edit_phong_ban} from "./phong_ban";
    import {api_delete_phong_ban} from "./phong_ban";
    import SelectLam from '../../helper/select_lam';

    export default {
        name: 'bophan',
        components:{SelectLam},
        mounted () {
            api_get_all_bo_phan(this);
            api_get_all_phong_ban(this, 1);
        },
        updated () {
            // let vm = this;
            // $(document).ready(function() {
            //     $('.select2').select2({
            //         placeholder: 'Chọn bộ phận'
            //     });
            //     $('#select_phong_1').on('select2:select', function (e) {
            //         vm.change_phong_ban();
            //     });
            // });
        },
        data () {
            return {
                loading_bo_phan: true,
                select_bo_phan: '',
                bo_phan: [],
                list_bo_phan: [],
                loading_phong_ban: true,
                list_phong_ban: [],
                total_phong_ban: 0,
                phong_ban: { id: 0, ma_phong: '', ten_phong: '', dien_giai: '', id_bo_phan: '' },
                flag_btn: true,
                flag_submit_phong_ban: true,
                flag_input_phong_ban: false,
                flag_body_modal: false,
                flag_input_ma_phong: false,
                flag_disabled_submit: false,
                flag_btn_save: true,
                error_select_bo_phan: true
            }
        },
        methods: {
            validate_ma_ph: function () {
                var length_nv = this.phong_ban.ma_phong.length;
                var value_nv  = this.phong_ban.ma_phong;
                if((length_nv > 8 || length_nv < 8) || value_nv.indexOf('PH') == -1 || value_nv.indexOf(' ') > -1){
                    this.flag_input_ma_phong = true;
                    this.flag_disabled_submit = true;
                }
                else{
                    this.flag_input_ma_phong = false;
                    this.flag_disabled_submit = false;
                }
            },
            dropdown: function (id_con) {
                $('#' + id_con).toggleClass("show");
            },
            selected_item: function (id_bo_phan, ten_bo_phan, id_dropdown, id_btn, id_btn2) {
                $('#' + id_btn).text(ten_bo_phan);
                $('#' + id_btn).val(id_bo_phan);
                $('#' + id_btn2).text(ten_bo_phan);
                $('#' + id_btn2).text(ten_bo_phan);
                $('#' + id_dropdown).removeClass("show");
                this.phong_ban.id_bo_phan = id_bo_phan;
                this.danh_sach_phong_ban(id_bo_phan);
            },
            select_phong_theo_bo_phan: function (id_bo_phan) {
                this.phong_ban.id_bo_phan = id_bo_phan;
                console.log(id_bo_phan);
                this.error_select_bo_phan = false;
                this.danh_sach_phong_ban(1);
            },
            danh_sach_bo_phan: function () {

            },
            danh_sach_phong_ban: function (page = 1) {
                this.loading_phong_ban = true;
                if(this.phong_ban.id_bo_phan == ''){
                    api_get_all_phong_ban(this, page);
                }
                else{
                    api_get_danh_sach_phong_theo_bo_phan(this, this.phong_ban.id_bo_phan, page);
                }
            },
            change_phong_ban: function () {
                // this.bo_phan =
                this.loading_phong_ban = true;
                this.list_phong_ban = [];
                if($('#select_phong_1').val() == 0){
                    api_get_all_phong_ban(this, 1);
                }
                else{
                    api_get_danh_sach_phong_theo_bo_phan(this, $('#select_phong_1').val(),1);
                }
            },
            _phong_ban: function (state, bophan = null) {
                if(state == 'add') {
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_phong_ban = true;
                    this.flag_input_phong_ban = false;
                    this.phong_ban.id = this.phong_ban.ma_phong = this.phong_ban.ten_phong = this.phong_ban.dien_giai = '';
                }
                else {
                    $('#select_phong_2').attr('disabled', 'disabled');
                    this.error_select_bo_phan = false;
                    this.phong_ban = bophan;
                    this.flag_submit_phong_ban = false;
                    this.flag_input_phong_ban = true;
                }
            },
            submit_phong_ban: function () {
                if(this.phong_ban.id_bo_phan == '') { this.error_select_bo_phan = true; return 1}
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
                $('.row-nhom').removeClass("active-click-row");
                $('#n' + bp.id).addClass("active-click-row");
            },
            add_phong_ban: function () {
                this.change_bnt_save();
                api_add_phong_ban(this);
            },
            edit_phong_ban: function() {
                this.change_bnt_save();
                api_edit_phong_ban(this);
            },
            delete_phong_ban: function(n) {
                this.phong_ban = n;
                if(this.phong_ban.id <= 0) return -1;
                api_delete_phong_ban(this);
            },
            change_bnt_save: function () {
                this.flag_btn_save = false;
                $('#save').attr('disabled', 'disabled');
            },
            un_change_bnt_save: function () {
                console.log("unchange");
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

    .row-title {
        padding-top: 10px;
    }

    .el-select {
        width: 100%;
    }

    .form-group {
        margin-bottom: 5px;
    }

</style>