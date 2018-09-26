<template>
    <div class="page-wrapper" style="min-height: 291px;">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!--<div class="row page-titles">-->
        <!--<div class="col-md-5 align-self-center">-->
        <!--&lt;!&ndash;<h3 class="text-themecolor">Danh sách nhóm người dùng</h3>&ndash;&gt;-->
        <!--</div>-->
        <!--<div class="col-md-7 align-self-center">-->
        <!--<ol class="breadcrumb">-->
        <!--<li class="breadcrumb-item"><a href="javascript:void(0)">Nhân sự</a></li>-->
        <!--<li class="breadcrumb-item">Bộ phận</li>-->
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
                <div class="col-md-12">
                    <div class="card content-lam">
                        <div class="card-header">
                            <div class="card-actions">
                                <a @click="_bo_phan('add')" title="Thêm mới bộ phận" data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-dark btn-white" style="color: white"><i class="fa fa-plus-circle"></i> Thêm mới</a>
                                <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                <!--<a class="btn-close" data-action="close"><i class="ti-close"></i></a>-->
                            </div>
                            <h4 class="card-title m-b-0">Danh sách sản phẩm</h4>
                        </div>
                        <div class="card-body collapse show">
                            <div class="message-box contact-box">
                                <div class="message-widget contact-widget">
                                    <div class="row mb-10">
                                        <div class="col-md-12">
                                            <input class="form-control"/>
                                        </div>
                                        <div class="col-md-12">
                                            <el-table :data="tableData3" height="450" style="width: 100%" border>
                                                <el-table-column  prop="date" label="Hình ảnh" width="100">
                                                    <template slot-scope="scope">
                                                        <img src="public/image_nhan_vien/1537859972.jpeg" alt="" class="img-sanpham">
                                                    </template>
                                                </el-table-column>
                                                <el-table-column prop="name" label="Mã SP" width="100"></el-table-column>
                                                <el-table-column prop="address" label="Tên SP"></el-table-column>
                                                <el-table-column prop="address" label="Diễn giải"></el-table-column>
                                                <el-table-column prop="address" label="Ngày tạo"></el-table-column>
                                                <el-table-column label="Giá VND đã full VAT">
                                                    <el-table-column label="Dealer"></el-table-column>
                                                    <el-table-column label="Enduser"></el-table-column>
                                                </el-table-column>
                                            </el-table>
                                        </div>
                                        <div class="col-md-12">
                                            <el-pagination :page-size="20" :pager-count="5" layout="prev, pager, next" :total="1000"></el-pagination>
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
    import {api_bophan_get} from '../nhan_su/bophan/bo_phan.js';
    import {api_add_bo_phan} from "../nhan_su/bophan/bo_phan";
    import {api_edit_bo_phan} from "../nhan_su/bophan/bo_phan";
    import {api_delete_bo_phan} from "../nhan_su/bophan/bo_phan";

    export default {
        name: 'bophan',
        mounted () {
            this.danh_sach_bo_phan();
        },
        updated () {
            $(document).ready(function() {
                $('.select2').select2();
            });
        },
        data () {
            return {
                loading_bo_phan: true,
                list_bo_phan: [],
                total_bo_phan: 0,
                bo_phan: { id: 0, ma_bo_phan: '', ten_bo_phan: '', dien_giai: '' },
                flag_btn: true,
                flag_submit_bo_phan: true,
                flag_input_bo_phan: false,
                flag_body_modal: false,
                flag_btn_save: true,
                flag_disabled_submit: false,
                flag_input_ma_bo_phan: false,
                tableData3: [{
                    date: '2016-05-03',
                    name: 'Tom',
                    address: 'No. 189, Grove St, Los Angeles'
                }, {
                    date: '2016-05-02',
                    name: 'Tom',
                    address: 'No. 189, Grove St, Los Angeles'
                }, {
                    date: '2016-05-04',
                    name: 'Tom',
                    address: 'No. 189, Grove St, Los Angeles'
                }, {
                    date: '2016-05-01',
                    name: 'Tom',
                    address: 'No. 189, Grove St, Los Angeles'
                }, {
                    date: '2016-05-08',
                    name: 'Tom',
                    address: 'No. 189, Grove St, Los Angeles'
                }, {
                    date: '2016-05-06',
                    name: 'Tom',
                    address: 'No. 189, Grove St, Los Angeles'
                }, {
                    date: '2016-05-07',
                    name: 'Tom',
                    address: 'No. 189, Grove St, Los Angeles'
                }],
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
            danh_sach_bo_phan: function (page = 1) {
                this.loading_bo_phan = true;
                api_bophan_get(this, page);
            },
            _bo_phan: function (state, bophan = null) {
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
            delete_bo_phan: function(bp) {
                this.bo_phan = bp;
                if(this.bo_phan.id <= 0) return -1;
                api_delete_bo_phan(this);
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
</style>