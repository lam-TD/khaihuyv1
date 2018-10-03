<template>
    <div class="page-wrapper pb-0" style="min-height: 291px;">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!--<div class="row page-titles">-->
            <!--<div class="col-md-5 align-self-center">-->
                <!--<h3 class="text-themecolor">Danh sách người phụ thuộc</h3>-->
            <!--</div>-->
            <!--<div class="col-md-7 align-self-center">-->
                <!--<ol class="breadcrumb">-->
                    <!--<li class="breadcrumb-item"><a href="javascript:void(0)">Nhân sự</a></li>-->
                    <!--<li class="breadcrumb-item">Người phụ thuộc</li>-->
                <!--</ol>-->
            <!--</div>-->
        <!--</div>-->
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
                <div class="col-lg-12 col-md-12 lamlam">
                    <!-- Column -->
                    <div class="card content-lam">
                        <div class="card-header">
                            <div class="card-actions">
                                <a @click="scroll_card_full_creem" id="phongto" class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                            </div>
                            <h4 class="card-title m-b-0">Người phụ thuộc</h4>
                        </div>
                        <div class="card-body bg-inverse">
                            <div class="row row-title">
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input v-model="npt.ma_nv" type="text" class="form-control" readonly style="height: 40px;">
                                        </div>
                                        <div class="col-md-6 ganlaibennhau">
                                            <el-select v-model="nhan_vien" value-key="ma_nv" filterable placeholder="Chọn nhân viên" @change="select_npt_theo_nhan_vien" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                <el-option :key="''" :label="'Tất cả nhân viên'" :value="''"></el-option>
                                                <el-option v-for="item in list_nhan_vien" :key="item.ma_nv" :label="item.ho_ten" :value="item">
                                                    <span style="float: left">{{ item.ma_nv }}</span>
                                                    <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ho_ten }}</span>
                                                </el-option>
                                            </el-select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <button @click="_npt('add')" title="Thêm mới phòng" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-dark pull-right btn-full-width">
                                        <i class="fa fa-plus-circle"></i> Thêm mới
                                    </button>
                                </div>
                            </div>
                        <!--</div>-->
                        <!--<div class="card-body">-->
                            <div class="message-box contact-box">
                                <!--<h2 class="add-ct-btn">-->
                                <!--&lt;!&ndash;<button @click="_npt('add')" title="Thêm mới phòng" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"><i class="fa fa-plus"></i></button>&ndash;&gt;-->
                                <!--</h2>-->
                                <div class="message-widget contact-widget">
                                    <!--<div class="table-responsive">-->
                                        <!--<table class="table table-hover" id="table_npt">-->
                                            <!--<thead>-->
                                            <!--<tr style="border-top: 1px solid #ddd">-->
                                                <!--<th scope="col" class="text-center">#</th>-->
                                                <!--<th scope="col">TT</th>-->
                                                <!--<th scope="col">Mã NV</th>-->
                                                <!--<th scope="col">Tên NV</th>-->
                                                <!--<th scope="col">Họ tên NPT</th>-->
                                                <!--<th scope="col">Ngày sinh</th>-->
                                                <!--<th scope="col">Từ - đến ngày</th>-->
                                                <!--<th scope="col">Ghi chú</th>-->
                                            <!--</tr>-->
                                            <!--</thead>-->
                                            <!--<tbody class="body-table loading-item">-->
                                                <!--<tr v-if="loading_npt">-->
                                                    <!--<td class="" colspan="12"><b><i><i class="fa fa-spin fa-spinner"></i> Đang tải danh sách phòng...</i></b></td>-->
                                                <!--</tr>-->
                                                <!--<tr v-else-if="list_npt.length <= 0">-->
                                                    <!--<td class="text-center" colspan="12"><b><i>Chưa có thân nhân</i></b></td>-->
                                                <!--</tr>-->
                                                <!--<tr v-for="(n, index) in list_npt" :id="'n' + n.id" class="row-nhom" @click="click_npt(n)">-->
                                                    <!--<td class="text-left" style="padding-right: 0">-->
                                                        <!--<button @click="_npt('edit',n)" id="edit_nhom" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">-->
                                                            <!--<i class="fa fa-edit"></i>-->
                                                        <!--</button>-->
                                                        <!--<button @click="delete_npt(n)" type="button" class="btn btn-danger btn-sm">-->
                                                            <!--<i class="fa fa-trash"></i>-->
                                                        <!--</button>-->
                                                    <!--</td>-->
                                                    <!--<td>{{ index + 1 }}</td>-->
                                                    <!--<td>{{n.ma_nv}}</td>-->
                                                    <!--<td>{{n.ho_ten}}</td>-->
                                                    <!--<td>{{n.ho_ten_npt}}</td>-->
                                                    <!--<td>{{n.ngay_sinh_npt}}</td>-->
                                                    <!--<td>{{n.tg_giam_tru_tu}} - {{n.tg_giam_tru_den}}</td>-->
                                                    <!--<td>{{n.ghi_chu}}</td>-->
                                                <!--</tr>-->
                                            <!--</tbody>-->
                                        <!--</table>-->
                                        <!--<el-pagination-->
                                                <!--:page-size="10"-->
                                                <!--layout="prev, pager, next"-->
                                                <!--:total="total_npt"-->
                                                <!--@current-change="danh_sach_npt">-->
                                        <!--</el-pagination>-->
                                    <!--</div>-->
                                    <!--//-->
                                    <div class="row mt-2">
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <el-table :data="list_npt" border style="width: 100%">
                                                <el-table-column label="#" width="90" align="center">
                                                    <template slot-scope="scope" class="text-center" style="width: 100%">
                                                        <button @click="_npt('edit',scope.row)" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm" title="Cập nhật thông tin cá nhân"> <i class="fa fa-edit"></i> </button>
                                                        <button @click="delete_npt(scope.row)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column type="index" label="TT" align="center"></el-table-column>
                                                <el-table-column prop="ma_nv" label="Mã NV" width="100"></el-table-column>
                                                <el-table-column prop="ho_ten" label="Tên NV" width="150"></el-table-column>
                                                <el-table-column prop="ho_ten_npt" label="Họ tên NPT" width="150"></el-table-column>
                                                <el-table-column prop="ngay_sinh_npt" label="Ngày sinh"></el-table-column>
                                                <el-table-column prop="tg_giam_tru_tu" label="TG Giảm trừ từ" width="150"></el-table-column>
                                                <el-table-column prop="tg_giam_tru_den" label="TG Giảm trừ đến" width="150"></el-table-column>
                                                <el-table-column prop="quan_he_nnt" label="Quan hệ"></el-table-column>
                                            </el-table>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row tb-row-hienthi">
                                                <div class="col-md-1 col-sm-2 col-8 tb-label pr-0" style="padding-left: 15px;">
                                                    <span>Hiển thị</span>
                                                </div>
                                                <div class="col-md-1 col-sm-2 col-4 tb-hienthi" style="padding-left: 4px;">
                                                    <el-select v-model="limit" placeholder="10" size="small" @change="danh_sach_npt_limit">
                                                        <el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-md-8 col-sm-4 col-6" style="padding-left: 0px;">
                                                    <el-pagination :page-size="limit" layout="prev, pager, next" :total="total_npt" @current-change="danh_sach_npt" :current-page.sync="currentPage"></el-pagination>
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-6 tb-label">
                                                    <span class="pull-right">Tổng: {{total_npt}} NPT</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--////-->
                                </div>
                            </div>

                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form @submit.prevent="submit_npt" id="form_bophan">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Thông tin người phụ thuộc</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div :disabled="flag_body_modal" class="modal-body">
                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-form-label">Mã NV(*)</label>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input id="txtma_nv" type="text" class="form-control form-control-sm" readonly>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <el-select disabled v-model="nhan_vien" value-key="ma_nv" size="small" filterable placeholder="Chọn nhân viên" @change="select_npt_theo_nhan_vien" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                                    <!--<el-option :key="''" :label="'Tất cả bộ phận'" :value="''"></el-option>-->
                                                                    <el-option v-for="item in list_nhan_vien" :key="item.ma_nv" :label="item.ho_ten" :value="item">
                                                                        <span style="float: left">{{ item.ma_nv }}</span>
                                                                        <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ho_ten }}</span>
                                                                    </el-option>
                                                                </el-select>
                                                                <!--<small v-show="error_select_nhan_vien" class="help text-muted is-danger">Vui lòng chọn nhân viên</small>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-form-label" style="padding-right: 0">Họ tên NPT(*)</label>
                                                    <div class="col-md-10">
                                                        <input v-model="npt.ho_ten_npt" name="ho_ten_npt" type="text" class="form-control form-control-sm"  v-validate="'required'">
                                                        <small v-show="errors.has('ho_ten_npt')" class="help text-muted is-danger">Vui lòng nhập tên người phụ thuộc</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-form-label">Ngày sinh(*)</label>
                                                    <div class="col-md-10">
                                                        <input v-model="npt.ngay_sinh_npt" name="ngay_sinh_npt" type="date" class="form-control form-control-sm"  v-validate="'required|date_format:DD/MM/YYYY'">
                                                        <small v-show="errors.has('ngay_sinh_npt')" class="help text-muted is-danger">Vui lòng chọn ngày sinh người phụ thuộc</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-form-label">Số CMND(*)</label>
                                                    <div class="col-md-10">
                                                        <input v-on:keypress="only_number_input" v-model="npt.so_cmnd_npt" name="so_cmnd_npt" type="text" class="form-control form-control-sm" v-validate="'required|min:9|numeric'">
                                                        <small v-show="errors.has('so_cmnd_npt')" class="help text-muted is-danger">Vui lòng nhập số chứng minh người phụ thuộc</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-form-label">MST NPT(*)</label>
                                                    <div class="col-md-10">
                                                        <input v-on:keypress="only_number_input" v-model="npt.mst_npt" name="mst_npt" type="text" class="form-control form-control-sm" v-validate="'required|min:9|numeric'">
                                                        <small v-show="errors.has('mst_npt')" class="help text-muted is-danger">Vui lòng nhập mã số thuế người phụ thuộc</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-form-label" style="padding-right: 0">Mã QT(*)</label>
                                                    <div class="col-md-4">
                                                        <input v-model="npt.ma_quoc_tich_npt" name="ma_quoc_tich_npt" type="text" class="form-control form-control-sm" v-validate="'required|min:2'">
                                                        <small v-show="errors.has('ma_quoc_tich_npt')" class="help text-muted is-danger">Vui lòng nhập mã quốc tịch người phụ thuộc</small>
                                                    </div>

                                                    <label class="label-form col-md-2 col-form-label">Quốc tịch(*)</label>
                                                    <div class="col-md-4">
                                                        <input v-model="npt.quoc_tich_npt" name="quoc_tich_npt" type="text" class="form-control form-control-sm" v-validate="'required|min:5'">
                                                        <small v-show="errors.has('quoc_tich_npt')" class="help text-muted is-danger">Vui lòng nhập quốc tịch người phụ thuộc</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-form-label" style="padding-right: 0">Mã QH(*)</label>
                                                    <div class="col-md-4">
                                                        <input v-model="npt.ma_quan_he_nnt" name="ma_quan_he_nnt" type="text" class="form-control form-control-sm" v-validate="'required'">
                                                        <small v-show="errors.has('ma_quan_he_nnt')" class="help text-muted is-danger">Vui lòng nhập mã quan hệ người phụ thuộc</small>
                                                    </div>

                                                    <label class="label-form col-md-2 col-form-label">Quan hệ(*)</label>
                                                    <div class="col-md-4">
                                                        <input v-model="npt.quan_he_nnt" name="quan_he_nnt" type="text" class="form-control form-control-sm" v-validate="'required|min:3'">
                                                        <small v-show="errors.has('quan_he_nnt')" class="help text-muted is-danger">Vui lòng nhập quan hệ người phụ thuộc</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-form-label" style="padding-right: 0">TG giảm trừ(*)</label>
                                                    <div class="col-md-4">
                                                        <input v-model="npt.tg_giam_tru_tu" name="tg_giam_tru_tu" type="date" class="form-control form-control-sm" ref="giam_tru_tu" v-validate="'required|date_format:MM/DD/YYYY|before:giam_tru_den'">
                                                        <small v-show="errors.has('tg_giam_tru_tu')" class="help text-muted is-danger">Vui lòng chọn thời gian giảm trừ từ</small>
                                                    </div>
                                                    <label class="label-form col-md-2 col-form-label" style="padding-right: 0">Đến(*)</label>
                                                    <div class="col-md-4">
                                                        <input v-model="npt.tg_giam_tru_den" name="thoi_gian_giam_tru_den" type="date" class="form-control form-control-sm" ref="giam_tru_den" v-validate="'required|date_format:MM/DD/YYYY|after:giam_tru_tu'">
                                                        <small v-show="errors.has('thoi_gian_giam_tru_den')" class="help text-muted is-danger">Vui lòng chọn thời gian giảm trừ đến</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <!--<button id="save" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại</button>-->
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                                <button :disabled="flag_disabled_submit || npt.ma_nv == ''" id="save" type="submit" class="btn btn-primary">
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
    import {api_get_all_danh_sach_npt} from "./nguoi_phu_thuoc";
    import {api_nhan_vien_get_all_no_pa} from "../../helper/nhan_vien";
    import {api_get_danh_sach_npt_theo_nhan_vien} from './nguoi_phu_thuoc';
    import {api_add_npt} from "./nguoi_phu_thuoc";
    import {api_edit_npt} from "./nguoi_phu_thuoc";
    import {api_delete_npt} from "./nguoi_phu_thuoc";
    import SelectLam from '../../helper/select_lam';


    export default {
        name: 'bophan',
        components:{SelectLam},
        mounted () {
            api_nhan_vien_get_all_no_pa(this);
            api_get_all_danh_sach_npt(this,1);
        },
        data () {
            return {
                loading_nhan_vien: true,
                select_nhan_vien: '',
                nhan_vien: '',
                list_nhan_vien: [],
                loading_npt: false,
                list_npt: [],
                total_npt: 0,
                npt: { id: 0, ma_nv: '', ho_ten_npt: '', ngay_sinh_npt: '', so_cmnd_npt: '', mst_npt: '', ma_quoc_tich_npt: 'VN', quoc_tich_npt: 'Việt Nam', ma_quan_he_nnt: '', quan_he_nnt: '', tg_giam_tru_tu: '', tg_giam_tru_den: '', ghi_chu: '' },
                flag_btn: true,
                flag_submit_npt: true,
                flag_input_npt: false,
                flag_body_modal: false,
                flag_input_ma_phong: false,
                flag_disabled_submit: false,
                flag_btn_save: true,
                error_select_nhan_vien: true,
                options_display: [10,20,30],
                limit: 10,
                currentPage: 1
            }
        },
        methods: {
            only_number_input: function (evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                    evt.preventDefault();
                } else {
                    return true;
                }
            },
            validate_ma_ph: function () {
                var length_nv = this.npt.ma_phong.length;
                var value_nv  = this.npt.ma_phong;
                if((length_nv > 8 || length_nv < 8) || value_nv.indexOf('PH') == -1 || value_nv.indexOf(' ') > -1){
                    this.flag_input_ma_phong = true;
                    this.flag_disabled_submit = true;
                }
                else{
                    this.flag_input_ma_phong = false;
                    this.flag_disabled_submit = false;
                }
            },
            select_npt_theo_nhan_vien: function (nv) {
                if(nv == null || nv == '') {
                    $('#txtma_nv').val('Tất cả nhân viên');
                    api_get_all_danh_sach_npt(this,1);
                }
                else {
                    $('#txtma_nv').val(nv.ma_nv);
                    this.npt.ma_nv = nv.ma_nv;
                    this.error_select_nhan_vien = false;
                    this.danh_sach_npt(1);
                }
            },
            danh_sach_nhan_vien: function () {

            },
            danh_sach_npt: function (page = 1) {
                this.loading_npt = true;
                if(this.nhan_vien == ''){
                    api_get_all_danh_sach_npt(this, page);
                }
                else{
                    api_get_danh_sach_npt_theo_nhan_vien(this, this.npt.ma_nv, page);
                }
            },
            danh_sach_npt_limit: function () {
                this.loading_npt = true;
                if(this.nhan_vien == ''){
                    api_get_all_danh_sach_npt(this, 1);
                }
                else{
                    api_get_danh_sach_npt_theo_nhan_vien(this, this.npt.ma_nv, 1);
                }
            },
            change_npt: function () {
                // this.nhan_vien =
                this.loading_npt = true;
                this.list_npt = [];
                if($('#select_phong_1').val() == 0){
                    api_get_all_npt(this, 1);
                }
                else{
                    api_get_danh_sach_phong_theo_nhan_vien(this, $('#select_phong_1').val(),1);
                }
            },
            _npt: function (state, bophan = null) {
                if(state == 'add') {
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_npt = true;
                    this.flag_input_npt = false;
                    this.npt = { id: 0, ma_nv: $('#txtma_nv').val(), ho_ten_npt: '', ngay_sinh_npt: '', so_cmnd_npt: '', mst_npt: '', ma_quoc_tich_npt: 'VN', quoc_tich_npt: 'Việt Nam', ma_quan_he_nnt: '', quan_he_nnt: '', tg_giam_tru_tu: '', tg_giam_tru_den: '', ghi_chu: '' };
                }
                else {
                    $('#select_phong_2').attr('disabled', 'disabled');;
                    this.flag_submit_npt = false;
                    this.flag_input_npt = true;
                    this.nhan_vien = this.list_nhan_vien.filter(function(item){
                        return (item['ma_nv'] == bophan.ma_nv);
                    })[0];
                    $('#txtma_nv').val(bophan.ma_nv);
                    console.log(bophan);
                    this.npt.id = bophan.id; this.npt.ma_nv = bophan.ma_nv; this.npt.ho_ten_npt = bophan.ho_ten_npt; this.npt.ngay_sinh_npt = bophan.ngay_sinh_npt;
                    this.npt.so_cmnd_npt = bophan.so_cmnd_npt; this.npt.mst_npt = bophan.mst_npt; this.npt.ma_quoc_tich_npt = bophan.ma_quoc_tich_npt; this.npt.quoc_tich_npt = bophan.quoc_tich_npt;
                    this.npt.ma_quan_he_nnt = bophan.ma_quan_he_nnt; this.npt.quan_he_nnt = bophan.quan_he_nnt; this.npt.tg_giam_tru_tu = bophan.tg_giam_tru_tu; this.npt.tg_giam_tru_den = bophan.tg_giam_tru_den; this.npt.ghi_chu = bophan.ghi_chu;
                }
            },
            submit_npt: function () {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        if(this.npt.id_nhan_vien == '') { this.error_select_nhan_vien = true; return 1}
                        if(this.flag_submit_npt) {
                            this.flag_input_npt = false;
                            this.add_npt();
                        }
                        else {
                            console.log(this.npt);
                            this.nhom = this.nhom_selected;
                            this.flag_input_npt = true;
                            this.edit_npt();
                        }
                    }
                })
            },
            click_npt: function (bp) {
                $('.row-nhom').removeClass("active-click-row");
                $('#n' + bp.id).addClass("active-click-row");
            },
            add_npt: function () {
                this.change_bnt_save();
                api_add_npt(this);
            },
            edit_npt: function() {
                this.change_bnt_save();
                api_edit_npt(this);
            },
            delete_npt: function(n) {
                this.npt = n;
                console.log(n);
                if(this.npt.id <= 0) return -1;
                api_delete_npt(this);
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
            maxview: function () {

            },
            scroll_card_full_creem: function () {
                $('#phongto').closest('.card').find('[data-action="expand"] i').toggleClass('mdi-arrow-expand mdi-arrow-compress');
                $('#phongto').closest('.card').toggleClass('card-fullscreen');
            }
        }
    }
</script>

<style scoped>
    .label-form{
        padding-right: 0;
    }
    .el-table .cell
    {
        display: block;
    }
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
         margin-bottom: 2px;
    }

    @media (min-width: 576px){
        .modal-dialog {
            max-width: 600px;
        }
        .ganlaibennhau {
            padding-left: 0;
        }
    }
    /*table*/

    thead, tbody {
        display: block;
    }
    tbody {
        overflow-y: auto;
        overflow-x: hidden;
        height: 250px;
    }
    /*.table th*/
    /*{*/
        /*width: 12.5%;*/
    /*}*/
    /*.table td*/
    /*{*/
        /*width: 12.5%;*/
    /*}*/
    /*.table tr th:nth-child(2)*/
    /*{*/
        /*width: 5%;*/
        /*!*min-width: 0px;*!*/
    /*}*/
    /*.table tr td:nth-child(2)*/
    /*{*/
        /*width: 5%;*/
    /*}*/
    /*.table tr th:nth-child(7)*/
    /*{*/
        /*width: 20%;*/
    /*}*/
    /*.table tr td:nth-child(7)*/
    /*{*/
        /*width: 20%;*/
    /*}*/
    /*.card-fullscreen*/
    /*{*/
        /*z-index: 100;*/
    /*}*/
    /*@media screen and (min-width: 1024px) {*/
        /*.table td*/
        /*{*/
            /*padding-left: 10px;*/
        /*}*/
        /*.table tr th:nth-child(1)*/
        /*{*/
            /*min-width:130px;*/
        /*}*/
        /*.table tr td:nth-child(1)*/
        /*{*/
            /*min-width: 130px;*/
        /*}*/
        /*.table tr th:nth-child(2)*/
        /*{*/
            /*min-width: 50px;*/
        /*}*/
        /*.table tr td:nth-child(2)*/
        /*{*/
            /*min-width: 50px;*/
        /*}*/
        /*.table tr th:nth-child(3)*/
        /*{*/
            /*min-width: 130px;*/
        /*}*/
        /*.table tr td:nth-child(3)*/
        /*{*/
            /*min-width: 130px;*/
        /*}*/
        /*.table tr th:nth-child(4)*/
        /*{*/
            /*min-width: 150px;*/
        /*}*/
        /*.table tr td:nth-child(4)*/
        /*{*/
            /*min-width: 150px;*/
        /*}*/
        /*.table tr th:nth-child(5)*/
        /*{*/
            /*min-width: 150px;*/
        /*}*/
        /*.table tr td:nth-child(5)*/
        /*{*/
            /*min-width: 150px;*/
        /*}*/
        /*.table tr th:nth-child(6)*/
        /*{*/
            /*min-width: 110px;*/
        /*}*/
        /*.table tr td:nth-child(6)*/
        /*{*/
            /*min-width: 110px;*/
        /*}*/
        /*.table tr th:nth-child(7)*/
        /*{*/
            /*min-width: 200px;*/
        /*}*/
        /*.table tr td:nth-child(7)*/
        /*{*/
            /*min-width: 200px;*/
        /*}*/
        /*.table tr th:nth-child(8)*/
        /*{*/
            /*min-width: 100px;*/
        /*}*/
        /*.table tr td:nth-child(8)*/
        /*{*/
            /*min-width: 100px;*/
        /*}*/
        /*.card-fullscreen .table tr th:nth-child(4)*/
        /*{*/
            /*min-width: 260px;*/
        /*}*/
        /*.card-fullscreen .table tr td:nth-child(4)*/
        /*{*/
            /*min-width: 260px;*/
        /*}*/
        /*.card-fullscreen .table tr th:nth-child(5)*/
        /*{*/
            /*min-width: 260px;*/
        /*}*/
        /*.card-fullscreen .table tr td:nth-child(5)*/
        /*{*/
            /*min-width: 260px;*/
        /*}*/
        /*.card-fullscreen .table tr th:nth-child(8)*/
        /*{*/
            /*min-width: 140px;*/
        /*}*/
        /*.card-fullscreen .table tr td:nth-child(8)*/
        /*{*/
            /*min-width: 140px;*/
        /*}*/
    /*}*/
    /*@media screen and (max-width: 1023px){*/
        /*.table tr th:nth-child(1)*/
        /*{*/
            /*min-width:100px;*/
        /*}*/
        /*.table tr td:nth-child(1)*/
        /*{*/
            /*min-width: 100px;*/
        /*}*/
        /*.table tr th:nth-child(2)*/
        /*{*/
            /*min-width: 100px;*/
        /*}*/
        /*.table tr td:nth-child(2)*/
        /*{*/
            /*min-width: 100px;*/
        /*}*/
        /*.table tr th:nth-child(3)*/
        /*{*/
            /*min-width: 100px;*/
        /*}*/
        /*.table tr td:nth-child(3)*/
        /*{*/
            /*min-width: 100px;*/
        /*}*/
        /*.table tr th:nth-child(4)*/
        /*{*/
            /*min-width: 150px;*/
        /*}*/
        /*.table tr td:nth-child(4)*/
        /*{*/
            /*min-width: 150px;*/
        /*}*/
        /*.table tr th:nth-child(5)*/
        /*{*/
            /*min-width: 150px;*/
        /*}*/
        /*.table tr td:nth-child(5)*/
        /*{*/
            /*min-width: 150px;*/
        /*}*/
        /*.table tr th:nth-child(6)*/
        /*{*/
            /*min-width: 110px;*/
        /*}*/
        /*.table tr td:nth-child(6)*/
        /*{*/
            /*min-width: 110px;*/
        /*}*/
        /*.table tr th:nth-child(7)*/
        /*{*/
            /*min-width: 200px;*/
        /*}*/
        /*.table tr td:nth-child(7)*/
        /*{*/
            /*min-width: 200px;*/
        /*}*/
        /*.table tr th:nth-child(8)*/
        /*{*/
            /*min-width: 100px;*/
        /*}*/
        /*.table tr td:nth-child(8)*/
        /*{*/
            /*min-width: 100px;*/
        /*}*/
    /*}*/


</style>