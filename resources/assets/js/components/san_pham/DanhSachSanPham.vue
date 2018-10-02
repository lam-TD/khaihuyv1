<template>
    <div class="page-wrapper" style="min-height: 291px;">
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card content-lam">
                        <div class="card-header">
                            <div class="card-actions">
                                <a @click="scroll_card_full_creem" class="btn-minimize" id="phongto" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                <!--<a class="btn-close" data-action="close"><i class="ti-close"></i></a>-->
                            </div>
                            <h4 class="card-title m-b-0">Danh sách sản phẩm</h4>
                        </div>
                        <div class="card-body collapse show">
                            <div class="message-box contact-box">
                                <div class="message-widget contact-widget">
                                    <div class="row mb-10">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <form @submit.prevent="submit_search_san_pham">
                                                            <input v-model="keyword" type="text" id="timkiem" class="form-control" placeholder="Nhập từ khóa để tìm kiếm...">
                                                            <button type="submit" class="btn btn-info btn-sm btntimkiem" name="button">Tìm kiếm</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <router-link to="/sanpham/themmoi" class="btn btn-success pull-right" style="height: 38px;padding: 6px 20px;"><i class="fa fa-plus-circle"></i> Thêm mới </router-link>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <el-table :data="list_san_pham" style="width: 100%" border>
                                                <el-table-column prop="name" label="#" width="90" align="center">
                                                    <template slot-scope="scope" class="text-center" style="width: 100%">
                                                        <button @click="_san_pham('edit', scope.row)" data-toggle="modal" data-target="#modal_nv_tt_ca_nhan" class="btn btn-info btn-sm" title="Cập nhật thông tin sản phẩm"> <i class="fa fa-edit"></i> </button>
                                                        <button @click="delete_san_pham(scope.row.id)" class="btn btn-danger btn-sm" title="Xóa sản phẩm"> <i class="fa fa-trash-o"></i> </button>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column  prop="date" label="Hình ảnh" width="80">
                                                    <template slot-scope="scope">
                                                        <img :src="parse_img(scope.row)" alt="" class="img-sanpham">
                                                    </template>
                                                </el-table-column>
                                                <el-table-column prop="ma_sp" label="Mã SP" width="100"></el-table-column>
                                                <el-table-column prop="ten_sp" label="Tên SP"></el-table-column>
                                                <el-table-column prop="dien_giai" label="Diễn giải" width="180">
                                                    <template slot-scope="scope">
                                                        <div class="limit-text" v-html="scope.row.dien_giai"></div>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column prop="created_at" label="Ngày tạo"></el-table-column>
                                                <el-table-column prop="full_vat_dealer" label="Dealer">
                                                    <template slot-scope="scope">
                                                        {{formatPrice(scope.row.full_vat_dealer)}}
                                                    </template>
                                                </el-table-column>
                                                <el-table-column prop="full_vat_end_user" label="Enduser">
                                                    <template slot-scope="scope">
                                                        {{formatPrice(scope.row.full_vat_end_user)}}
                                                    </template>
                                                </el-table-column>
                                            </el-table>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="row tb-row-hienthi">
                                                <div class="col-md-1 col-sm-2 col-8 tb-label pr-0" style="padding-left: 15px;">
                                                    <span>Hiển thị</span>
                                                </div>
                                                <div class="col-md-1 col-sm-2 col-4 tb-hienthi" style="padding-left: 4px;">
                                                    <el-select v-model="value" placeholder="10" size="small">
                                                        <el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>
                                                    </el-select>
                                                </div>
                                                <div class="col-md-8 col-sm-4 col-6" style="padding-left: 0px;">
                                                    <el-pagination :page-size="limit_sp" layout="prev, pager, next" :total="total_san_pham" @current-change="getSanPham"></el-pagination>
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-6 tb-label">
                                                    <span class="pull-right">Tổng: {{total_san_pham}} sản phẩm</span>
                                                </div>
                                            </div>
                                        </div>
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
    import {api_get_danh_sach_san_pham_paginate} from "./san_pham";

    import {api_add_bo_phan} from "../nhan_su/bophan/bo_phan";
    import {api_edit_bo_phan} from "../nhan_su/bophan/bo_phan";
    import {api_delete_bo_phan} from "../nhan_su/bophan/bo_phan";

    export default {
        name: 'danhsachsanpham',
        mounted () {
            api_get_danh_sach_san_pham_paginate(this, 1);
        },
        updated () {
            $(document).ready(function() {
                $('.select2').select2();
            });
        },
        data () {
            return {
                loading_bo_phan: true,
                list_san_pham: [],
                flag_btn: true,
                flag_submit_bo_phan: true,
                flag_input_bo_phan: false,
                flag_body_modal: false,
                flag_btn_save: true,
                flag_disabled_submit: false,
                flag_input_ma_bo_phan: false,
                list_san_pham: [],
                limit_sp: 10,
                total_san_pham: 0,
                keyword: '',
                options_display: [10,20,30],
                value: ''
            }
        },
        methods: {
            validate_ma_bp: function () {
                var length_nv = this.bo_phan.ma_bo_phan.length;
                var value_nv  = this.bo_phan.ma_bo_phan;
                if((length_nv > 7 || length_nv < 7) || value_nv.indexOf('BP') == -1 || value_nv.indexOf(' ') > -1){
                    this.flag_input_ma_bo_phan = true;
                    this.flag_disabled_submit = true;
                }
                else{
                    this.flag_input_ma_bo_phan = false;
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
            formatPrice(value) {
                if(value == '' || value == null ) return ;
                let val = (value/1).toFixed().replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },
            parse_img: function (json) {
                console.log(json);
                if(json.image == null || json.image == ''){
                    return 'public/images/san_pham/no-image.png';
                }
                let img = JSON.parse(json.image);
                let path = 'public/images/san_pham/' + json.id + '/' + img[0];
                return path;
            },
            getSanPham: function (page = 1) {
                this.loading_bo_phan = true;
                api_get_danh_sach_san_pham_paginate(this, page);
            },
            _san_pham: function (state, bophan = null) {
                if(state == 'add') {
                    console.log('add nhom');
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_bo_phan = true;
                    this.flag_input_bo_phan = false;
                    this.bo_phan = { id: 0, ma_bo_phan: '', ten_bo_phan: '', dien_giai: '' }
                }
                else {
                    // this.bo_phan = bophan;
                    this.bo_phan.id = bophan.id;
                    this.bo_phan.ma_bo_phan = bophan.ma_bo_phan;
                    this.bo_phan.ten_bo_phan = bophan.ten_bo_phan;
                    this.bo_phan.dien_giai = bophan.dien_giai;
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
            delete_san_pham: function(bp) {
                this.bo_phan = bp;
                if(this.bo_phan.id <= 0) return -1;
                api_delete_bo_phan(this);
            },
            submit_search_san_pham: function () {

            },
            change_bnt_save: function () {
                this.flag_btn_save = false;
                $('#save').attr('disabled', 'disabled');
            },
            un_change_bnt_save: function () {
                this.flag_btn_save = true;
                $('#save').removeAttr('disabled');
            },
            handleEdit(index, row) {
                console.log(index, row);
            },
            handleDelete(index, row) {
                console.log(index, row);
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

    .modal {
        transition: 1s ease-out;
    }

    .img-sanpham {
        width: 100%;
        height: 50px;
    }

    .el-table thead.is-group th {
        font-weight: 600 !important;
        text-align: center;
    }

    .limit-text {
        padding-top: 1px;
        width: 160px;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        height: 30px;
    }
</style>