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
                                                    <router-link v-if="flag_cn.add" to="/sanpham/themmoi" class="btn btn-success pull-right" title="Thêm mới sản phẩm" style="height: 38px;padding: 6px 20px;"><i class="fa fa-plus-circle"></i> Thêm mới </router-link>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <el-table :data="list_san_pham" style="width: 100%" border>
                                                <el-table-column v-if="flag_cn.edit || flag_cn.delete" label="#" width="90" align="center" class-name="center-text">
                                                    <template slot-scope="scope" class="text-center" style="width: 100%">
                                                        <router-link v-if="flag_cn.edit" :to="{path: '/sanpham/capnhat' , query: { id: scope.row.id }}" class="btn btn-info btn-sm" title="Cập nhật thông tin sản phẩm"> <i class="fa fa-edit"></i> </router-link>
                                                        <button v-if="flag_cn.delete" @click="delete_san_pham(scope.row)" class="btn btn-danger btn-sm" title="Xóa sản phẩm"> <i class="fa fa-trash-o"></i> </button>
                                                    </template>
                                                </el-table-column>

                                                <el-table-column type="index" label="TT" align="center" width="50" class-name="center-text"></el-table-column>

                                                <el-table-column  prop="date" label="Hình ảnh" align="center" width="80" class-name="center-text">
                                                    <template slot-scope="scope">
                                                        <img @click="edit_sanpham(scope.row)" :src="parse_img(scope.row)" alt="" title="Click để xem chi tiết sản phẩm" class="img-sanpham">
                                                    </template>
                                                </el-table-column>

                                                <el-table-column prop="ma_sp" label="Mã SP" align="center" width="100" class-name="center-text"></el-table-column>

                                                <el-table-column label="Tên SP" class-name="no-center-text tensp" width="180">
                                                    <template slot-scope="scope">
                                                        <span @click="edit_sanpham(scope.row)" class="click-ten-sp" title="Click để xem chi tiết sản phẩm">{{scope.row.ten_sp}}</span>
                                                    </template>
                                                </el-table-column>

                                                <el-table-column prop="dien_giai" label="Diễn giải" width="180" class-name="no-center-text">
                                                    <template slot-scope="scope">
                                                        <div class="limit-text" v-html="scope.row.dien_giai"></div>
                                                    </template>
                                                </el-table-column>

                                                <el-table-column label="Ngày tạo" align="center" class-name="center-text">
                                                    <template slot-scope="scope">{{sort_date(scope.row.created_at)}}</template>
                                                </el-table-column>

                                                <el-table-column prop="full_vat_dealer" label="Dealer" class-name="no-center-text">
                                                    <template slot-scope="scope">
                                                        {{formatPrice(scope.row.full_vat_dealer)}}
                                                    </template>
                                                </el-table-column>

                                                <el-table-column prop="full_vat_end_user" label="Enduser" class-name="no-center-text">
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
                                                    <el-select v-model="value" placeholder="10" size="small" @change="danh_sach_san_pham_limit">
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
    import {check_url_phan_quyen} from "../../../helper/auth";
    import {check_quyen_chuc_nang} from "../../../helper/auth";

    import {api_get_danh_sach_san_pham_paginate} from "./san_pham";
    import {api_get_search_san_pham_paginate} from "./san_pham";
    import {api_delete_san_pham} from "./san_pham";

    export default {
        name: 'danhsachsanpham',
        beforeCreate(){
            check_url_phan_quyen(this);
        },
        mounted () {
            check_quyen_chuc_nang(this);
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
                flag_input_bo_phan: false,
                flag_btn_save: true,
                flag_disabled_submit: false,
                flag_input_ma_bo_phan: false,
                list_san_pham: [],
                limit_sp: 10,
                total_san_pham: 0,
                keyword: '',
                flag_submit_search: false,
                sp: { id: '', ma_sp: '', ten_sp: '' },
                options_display: [10,20,30],
                value: '',
                flag_cn: {add: false, edit: false, delete: false}
            }
        },
        methods: {
            formatPrice(value) {
                if(value == '' || value == null ) return ;
                let val = (value/1).toFixed().replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },
            parse_img: function (json) {
                // console.log(json);
                if(json.image == null || json.image == ''){
                    return 'public/images/san_pham/no-image.png';
                }
                let img = JSON.parse(json.image);
                let path = 'public/images/san_pham/' + json.id + '/' + img[0];
                return path;
            },
            sort_date: function (day) {
                return day.slice(0,10);
            },
            edit_sanpham: function (sanpham) {
                if(this.flag_cn.edit){
                    this.$router.push({ path: '/sanpham/capnhat', query: { id: sanpham.id }})
                }
            },
            getSanPham: function (page = 1) {
                this.loading_bo_phan = true;
                // api_get_danh_sach_san_pham_paginate(this, page);
                if(this.flag_submit_search){
                    api_get_search_san_pham_paginate(this,page);
                }
                else{
                    api_get_danh_sach_san_pham_paginate(this, page);
                }
            },
            danh_sach_san_pham_limit: function (limit) {
                this.currentPage = 1;
                this.limit_sp = limit;
                if(this.flag_submit_search){
                    api_get_search_san_pham_paginate(this,1);
                }
                else{
                    api_get_danh_sach_san_pham_paginate(this, 1);
                }
            },
            delete_san_pham: function(bp) {
                this.sp = bp;
                if(this.sp.id <= 0) return -1;
                api_delete_san_pham(this);
            },
            submit_search_san_pham: function () {
                if(this.keyword == '' || this.keyword == null){
                    this.flag_submit_search = false;
                    api_get_danh_sach_san_pham_paginate(this, 1);
                    return 1;
                }
                this.flag_submit_search = true;
                api_get_search_san_pham_paginate(this,1);
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

    .img-sanpham:hover {
        cursor: pointer;
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

    .message-box .message-widget a {
        border-bottom: 1px solid rgba(120, 130, 140, 0.13);
        display: inline-block;
        text-decoration: none;
        padding: 4px 8px;
    }
    .message-box .message-widget a:hover {
        background: #1976d2;
        border: 1px solid #1976d2;
        -webkit-box-shadow: 0 14px 26px -12px rgba(23, 105, 255, 0.42), 0 4px 23px 0 rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(23, 105, 255, 0.2);
        box-shadow: 0 14px 26px -12px rgba(23, 105, 255, 0.42), 0 4px 23px 0 rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(23, 105, 255, 0.2);
    }

    .has-gutter tr th .cell {
        font-weight: 800;
    }

    .click-ten-sp:hover {
        font-weight: 500;
        text-decoration: underline;
        cursor: pointer;
    }

</style>