<template>
    <div class="page-wrapper" style="min-height: 291px;">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!--<div class="row page-titles">-->
            <!--<div class="col-md-5 align-self-center">-->
                <!--<h3 class="text-themecolor">Danh sách thông tin bảo hiểm y tế</h3>-->
            <!--</div>-->
            <!--<div class="col-md-7 align-self-center">-->
                <!--<ol class="breadcrumb">-->
                    <!--<li class="breadcrumb-item"><a href="javascript:void(0)">Nhân sự</a></li>-->
                    <!--<li class="breadcrumb-item">Bảo hiểm y tế</li>-->
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
                            <h4 class="card-title m-b-0">Bảo hiểm y tế</h4>
                        </div>
                        <div class="card-body">
                            <div class="row" style="padding-top: 10px;margin-bottom: 15px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <form @submit.prevent="search_bhyt">
                                            <input v-model="keyword" type="text" id="timkiem" class="form-control" placeholder="Nhập từ khóa để tìm kiếm...">
                                            <button type="submit" class="btn btn-info btn-sm btntimkiem" name="button">Tìm kiếm</button>
                                            <!--<button v-if="flag_search" @click="tat_ca_danh_sach" type="button" class="btn btn-primary btn-sm btntatca" name="button">Tất cả</button>-->
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button @click="_bhyt('add')" title="Thêm mới bộ phận" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-dark pull-right">
                                        <i class="fa fa-plus-circle"></i> Thêm mới
                                    </button>
                                </div>
                            </div>
                            <div class="message-box contact-box">
                                <!--<h2 class="add-ct-btn">-->

                                <!--</h2>-->
                                <div class="message-widget contact-widget">
                                    <!--<div class="table-responsive">-->
                                        <!--<table class="table table-hover">-->
                                            <!--<thead>-->
                                            <!--<tr style="border-top: 1px solid #ddd">-->
                                                <!--<th class="text-center">#</th>-->
                                                <!--<th>Mã NV</th>-->
                                                <!--<th>Tên nhân viên</th>-->
                                                <!--<th>Số BHYT</th>-->
                                                <!--<th>Số BHXH</th>-->
                                                <!--<th>Nơi khám</th>-->
                                                <!--<th>Địa chỉ khám</th>-->
                                                <!--<th>Ghi chú</th>-->
                                            <!--</tr>-->
                                            <!--</thead>-->
                                            <!--<tbody class="body-table loading-item">-->
                                            <!--<tr v-if="loading_bhyt">-->
                                                <!--<td class="text-center" colspan="8"><b><i><i class="fa fa-spin fa-spinner"></i> Đang tải danh sách...</i></b></td>-->
                                            <!--</tr>-->
                                            <!--<tr v-else-if="list_bhyt.length <= 0">-->
                                                <!--<td class="text-center" colspan="8"><b><i>Chưa có bảo hiểm y tế</i></b></td>-->
                                            <!--</tr>-->
                                            <!--<tr v-else v-for="n in list_bhyt" :id="'n' + n.id" class="row-nhom" @click="click_bhyt(n)">-->
                                                <!--<td class="text-left" style="padding-right: 0">-->
                                                    <!--<button @click="_bhyt('edit',n)" id="edit_nhom" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">-->
                                                        <!--<i class="fa fa-edit"></i>-->
                                                    <!--</button>-->
                                                    <!--<button @click="delete_bhyt(n)" type="button" class="btn btn-danger btn-sm">-->
                                                        <!--<i class="fa fa-trash"></i>-->
                                                    <!--</button>-->
                                                <!--</td>-->
                                                <!--<td>{{n.ma_nv}}</td>-->
                                                <!--<td>{{n.ho_ten}}</td>-->
                                                <!--<td>{{n.so_bhyt}}</td>-->
                                                <!--<td>{{n.so_bhxh}}</td>-->
                                                <!--<td>{{n.noi_kham}}</td>-->
                                                <!--<td>{{n.dia_chi_kham}}</td>-->
                                                <!--<td>{{n.ghi_chu}}</td>-->
                                            <!--</tr>-->
                                            <!--</tbody>-->
                                        <!--</table>-->
                                        <!--<el-pagination-->
                                                <!--:page-size="10"-->
                                                <!--layout="prev, pager, next"-->
                                                <!--:total="total_bhyt"-->
                                                <!--@current-change="danh_sach_bhyt">-->
                                        <!--</el-pagination>-->
                                    <!--</div>-->
                                    <div class="row">
                                        <div class="col-md-12" style="margin-bottom: 10px;">
                                            <el-table :data="list_bhyt" border style="width: 100%">
                                                <el-table-column label="#" width="90" align="center">
                                                    <template slot-scope="scope" class="text-center" style="width: 100%">
                                                        <button @click="_bhyt('edit', scope.row)" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm" title="Cập nhật thông tin bảo hiểm y tế"> <i class="fa fa-edit"></i> </button>
                                                        <button @click="delete_bhyt(scope.row)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column type="index" label="TT" align="center"></el-table-column>
                                                <el-table-column prop="ma_nv" label="Mã NV" width="100"></el-table-column>
                                                <el-table-column prop="ho_ten" label="Tên NV" width="150"></el-table-column>
                                                <el-table-column prop="so_bhyt" label="Số BHYT"></el-table-column>
                                                <el-table-column prop="noi_kham" label="Nơi khám"></el-table-column>
                                                <el-table-column label="Địa chỉ khám" width="220">
                                                    <template slot-scope="scope" class="text-center" style="width: 100%">
                                                        {{scope.row.dia_chi_kham}}, {{scope.row.ten_phuong_xa}}, {{scope.row.ten_quan_huyen}}, {{scope.row.ten_tinh}}
                                                    </template>
                                                </el-table-column>
                                                <el-table-column prop="ghi_chu" label="Ghi chú"></el-table-column>
                                            </el-table>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row tb-row-hienthi">
                                                <div class="col-md-1 col-sm-2 col-8 tb-label pr-0" style="padding-left: 15px;">
                                                    <span>Hiển thị</span>
                                                </div>
                                                <div class="col-md-1 col-sm-2 col-4 tb-hienthi" style="padding-left: 4px;">
                                                    <el-select v-model="limit" placeholder="10" size="small" @change="danh_sach_bhyt_limit">
                                                        <el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-md-8 col-sm-4 col-6" style="padding-left: 0px;">
                                                    <el-pagination :page-size="limit" layout="prev, pager, next" :total="total_bhyt" @current-change="danh_sach_bhyt" :current-page.sync="currentPage"></el-pagination>
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-6 tb-label">
                                                    <span class="pull-right">Tổng: {{total_bhyt}} BHYT</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form @submit.prevent="submit_bhyt" id="form_bhyt">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Thông tin bảo hiểm  y tế</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div :disabled="flag_body_modal" class="modal-body">
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Nhân viên(*)</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input v-model="bhyt.nv_ma" type="text" id="txtnhanvien-sua" class="form-control form-control-sm" readonly>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <el-select v-model="nhan_vien"  value-key="ma_nv" filterable size="small" :disabled="flag_disable_manv" placeholder="Chọn nhân viên" style="width: 100%" @change="select_nv" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                                    <!--<template slot="prefix"><label class="prefix">{{nhan_vien.ma_nv}}</label></template>-->
                                                                    <el-option
                                                                            v-for="item in list_nhan_vien"
                                                                            :key="item.ma_nv"
                                                                            :label="item.ho_ten"
                                                                            :value="item">
                                                                        <span style="float: left">{{ item.ma_nv }}</span>
                                                                        <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ho_ten }}</span>
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Số BHYT(*)</label>
                                                    <div class="col-md-9">
                                                        <input v-model="bhyt.so_bhyt" name="so_bhyt" type="text" class="form-control form-control-sm">
                                                        <small v-show="errors.has('so_bhyt')" class="help text-muted is-danger">Vui lòng nhập số bảo hiểm y tết</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Số BHXH(*)</label>
                                                    <div class="col-md-9">
                                                        <input v-model="bhyt.so_bhxh" name="so_bhxh" type="text" class="form-control form-control-sm">
                                                        <small v-show="errors.has('so_bhxh')" class="help text-muted is-danger">Vui lòng nhập số bảo hiểm xã hội</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Nơi khám</label>
                                                    <div class="col-md-9">
                                                        <input v-model="bhyt.noi_kham" type="text" name="txtngayky" class="form-control form-control-sm">
                                                        <!--<small v-show="errors.has('txtngayky')" class="help text-muted is-danger">Vui lòng nhập ngày ký</small>-->
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Địa chỉ khám</label>
                                                    <div class="col-md-9" style="margin-bottom: 6px;">
                                                        <input v-model="bhyt.dia_chi_kham" name="txtngaykt" type="text" class="form-control form-control-sm">
                                                        <!--<small v-show="errors.has('txtngaykt')" class="help text-muted is-danger">Vui lòng nhập ngày kết thúc</small>-->
                                                    </div>

                                                    <label class="label-form col-md-3 col-form-label"></label>
                                                    <div class="col-md-9" style="margin-bottom: 6px;">
                                                        <el-select v-model="dia_chi.tinh_thanh" value-key="ma_tinh" filterable size="small" placeholder="Chọn tỉnh thành phố" style="width: 100%" @change="load_quan_huyen" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<el-option :disable="'true'" :label="'Chọn tỉnh thành'" :value="''"></el-option>-->
                                                            <el-option v-for="item in list_tinh_thanh" :key="item.ma_tinh" :label="item.ten_tinh" :value="item"></el-option>
                                                        </el-select>
                                                    </div>
                                                    <br>
                                                    <label class="label-form col-md-3 col-form-label"></label>
                                                    <div class="col-md-9" style="margin-bottom: 6px;">
                                                        <el-select v-model="dia_chi.quan_huyen" value-key="ma_quan_huyen" :disabled="!dia_chi.tinh_thanh" filterable size="small" placeholder="Quận huyện" style="width: 100%;" @change="load_phuong_xa" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<el-option v-if="change_quan_huyen.length==0" :label="'Chưa có quận huyện'" :value="''"></el-option>-->
                                                            <el-option v-for="qh in change_quan_huyen" :key="qh.ma_quan_huyen" :label="qh.ten_quan_huyen" :value="qh"></el-option>
                                                        </el-select>
                                                    </div>

                                                    <label class="label-form col-md-3 col-form-label"></label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="dia_chi.phuong_xa" value-key="phuongxa_id" :disabled="!dia_chi.quan_huyen && !dia_chi.tinh_thanh" filterable size="small" placeholder="Phường xã" style="width: 100%;" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<el-option v-if="change_phuong_xa.length==0" :label="'Chưa có phường xã'" :value="''"></el-option>-->
                                                            <el-option
                                                                    v-for="item in change_phuong_xa"
                                                                    :key="item.phuongxa_id"
                                                                    :label="item.ten_phuong_xa"
                                                                    :value="item">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Ghi chú</label>
                                                    <div class="col-md-9">
                                                        <textarea v-model="bhyt.ghi_chu" name="" id="" class="form-control form-control-sm"></textarea>
                                                    </div>
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
    import {api_get_all_bhyt} from './bao_hiem_y_te';
    import {api_add_bhyt} from "./bao_hiem_y_te";
    import {api_edit_bhyt} from "./bao_hiem_y_te";
    import {api_delete_bhyt} from "./bao_hiem_y_te";
    import {select_lam} from "../../helper/selectlam";
    import {api_search_all_bhyt} from "./bao_hiem_y_te";
    import {api_nhan_vien_get_all_no_pa} from "../../helper/nhan_vien";

    import {api_get_tinh} from "../../../helper/tinh_thanh";
    import {api_get_quan_huyen} from "../../../helper/tinh_thanh";
    import {api_get_phuong_xa} from "../../../helper/tinh_thanh";
    import {api_get_item_phuong_xa} from "../../../helper/tinh_thanh";
    import {api_get_item_phuong_xa_bhyt_noi_kham} from "../../../helper/tinh_thanh";

    export default {
        name: 'bophan',
        mounted () {
            this.danh_sach_bhyt(1);
            api_nhan_vien_get_all_no_pa(this);
            api_get_tinh(this);
            api_get_quan_huyen(this);
            api_get_phuong_xa(this);
        },
        updated () {
            $(document).ready(function() {
                $('.select2').select2();
            });
        },
        components: {
        },
        data () {
            return {
                list_tinh_thanh: [],
                tinh_thanh: '',
                list_quan_huyen: [],
                change_quan_huyen: [],
                quan_huyen: '',
                list_phuong_xa: [],
                change_phuong_xa: [],
                phuong_xa: '',
                dia_chi: {tinh_thanh: '', quan_huyen: '', phuong_xa: ''},
                nhan_vien: '',
                list_nhan_vien: '',
                loading_bhyt: true,
                flag_search: false,
                keyword: '',
                list_bhyt: [],
                total_bhyt: 0,
                bhyt: { id: 0, so_bhyt: '', so_bhxh: '', noi_kham: '', dia_chi_kham: '', ghi_chu: '', nv_ma: '', phuong_xa_id: '' },
                flag_btn: true,
                flag_submit_bhyt: true,
                flag_input_bhyt: false,
                flag_body_modal: false,
                flag_btn_save: true,
                flag_disabled_submit: false,
                flag_input_ma_bhyt: false,
                flag_disable_manv: false,
                options_display: [10,20,30],
                limit: 10,
                currentPage: 1
            }
        },
        methods: {
            load_quan_huyen: function (tinh) {
                console.log(tinh);
                this.change_quan_huyen = this.list_quan_huyen.filter(function(item){
                    return (item['ma_tinh'] == tinh.ma_tinh);
                })
                this.dia_chi.quan_huyen = '';
            },
            load_phuong_xa: function (quan_huyen) {
                console.log(quan_huyen);
                this.change_phuong_xa = this.list_phuong_xa.filter(function(item){
                    return (item['quanhuyen_id'] == quan_huyen.ma_quan_huyen);
                })
                this.dia_chi.phuong_xa = '';
            },
            only_number_input: function (evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                    evt.preventDefault();;
                } else {
                    return true;
                }
            },
            validate_ma_bp: function () {
                var length_nv = this.bhyt.ma_bhyt.length;
                var value_nv  = this.bhyt.ma_bhyt;
                if((length_nv > 8 || length_nv < 8) || value_nv.indexOf('BP') == -1 || value_nv.indexOf(' ') > -1){
                    this.flag_input_ma_bhyt = true;
                    this.flag_disabled_submit = true;
                }
                else{
                    this.flag_input_ma_bhyt = false;
                    this.flag_disabled_submit = false;
                }
            },
            select_nv: function (nv) {
                this.bhyt.nv_ma = nv.ma_nv;
            },
            search_bhyt: function (page = 1) {
                if(this.keyword == '' || this.keyword == null) {this.flag_search = false; this.danh_sach_bhyt();}
                this.flag_search = true;
                api_search_all_bhyt(this, page);
            },
            tat_ca_danh_sach: function () {
                this.flag_search = false;
                api_get_all_bhyt(this, 1);
            },
            danh_sach_bhyt: function (page = 1) {
                this.loading_bhyt = true;
                if(this.flag_search){
                    api_search_all_bhyt(this, page);
                }
                else{
                    api_get_all_bhyt(this, page);
                }
            },
            danh_sach_bhyt_limit: function () {
                this.loading_bhyt = true;
                if(this.flag_search){
                   this.currentPage = 1;
                    api_search_all_bhyt(this, 1);
                }
                else{
                    this.currentPage = 1;
                    api_get_all_bhyt(this, 1);
                }
            },
            _bhyt: function (state, baohiem = null) {
                if(state == 'add') {
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_bhyt = true;
                    this.flag_input_bhyt = false;
                    this.bhyt = { id: 0, so_bhyt: '', so_bhxh: '', noi_kham: '', dia_chi_kham: '', ghi_chu: '', nv_ma: '', phuong_xa_id: '' }
                    this.nhan_vien = '';
                    this.dia_chi.quan_huyen = this.dia_chi.tinh_thanh = this.dia_chi.phuong_xa = '';
                    this.flag_disable_manv = false;
                    $('#form_bhyt').trigger("reset");
                    document.getElementById('form_bhyt').reset();
                }
                else {
                    // api_get_item_phuong_xa_bhyt_noi_kham(this,laodong.phuong_xa_id);
                    // this.flag_disable_manv = true;
                    // let bh = laodong;
                    // this.bhyt = bh;
                    // this.bhyt.id = laodong.bhyt_id;
                    // // api_get_item_phuong_xa(this, laodong.phuong_xa_id);
                    // this.nhan_vien = this.list_nhan_vien.filter(function(item){
                    //     return (item['ma_nv'] == laodong.ma_nv);
                    // })[0];
                    // this.flag_submit_bhyt = false;
                    // this.flag_input_bhyt = true;


                    // console.log(laodong.phuong_xa_id);
                    this.flag_disable_manv = true;

                    this.bhyt.id = baohiem.id;
                    this.bhyt.so_bhyt = baohiem.so_bhyt;
                    this.bhyt.so_bhxh = baohiem.so_bhxh;
                    this.bhyt.noi_kham = baohiem.noi_kham;
                    this.bhyt.dia_chi_kham = baohiem.dia_chi_kham;
                    this.bhyt.ghi_chu = baohiem.ghi_chu;
                    this.nhan_vien = this.list_nhan_vien.filter(function(item){
                        return (item['ma_nv'] == laodong.ma_nv);
                    })[0];
                    api_get_item_phuong_xa(this, laodong.phuong_xa_id);
                    this.flag_submit_bhyt = false;
                    this.flag_input_bhyt = true;
                }
            },
            submit_bhyt: function () {
                // if(this.dia_chi.phuong_xa.phuongxa_id === 'undefined'){ this.dia_chi.phuong_xa.phuongxa_id = 'kxd' }
                // if(this.dia_chi.quan_huyen.ma_quan_huyen === 'undefined'){ this.dia_chi.quan_huyen.ma_quan_huyen = 'kxd' }
                this.bhyt.phuong_xa_id = this.dia_chi.phuong_xa.phuongxa_id;
                this.change_bnt_save();
                if(this.flag_submit_bhyt) {
                    this.flag_input_bhyt = false;
                    this.add_bhyt();
                }
                else {
                    this.nhom = this.nhom_selected;
                    this.flag_input_bhyt = true;
                    this.edit_bhyt();
                }
            },
            click_bhyt: function (bp) {
                $('.row-nhom').removeClass("active-click-row");
                $('#n' + bp.id).addClass("active-click-row");
            },
            add_bhyt: function () {
                api_add_bhyt(this);
            },
            edit_bhyt: function() {
                console.log(this.bhyt);
                api_edit_bhyt(this);
            },
            delete_bhyt: function(bh) {
                this.bhyt.id = bh.bhyt_id;
                if(this.bhyt.id <= 0) return -1;
                api_delete_bhyt(this);
            },
            change_bnt_save: function () {
                this.flag_btn_save = false;
                $('#save').attr('disabled', 'disabled');
            },
            un_change_bnt_save: function () {
                this.flag_btn_save = true;
                $('#save').removeAttr('disabled');
            },
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

    .card-title {
        font-weight: 600;
    }

    .row-title {
        padding-top: 6px;
    }

    .form-group {
        margin-bottom: 5px;
    }

    .prefix {
        margin-top: 5px;
    }

</style>