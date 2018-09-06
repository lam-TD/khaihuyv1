<template id="bo-phan">
    <div class="page-wrapper" style="min-height: 291px;">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Danh sách nhóm người dùng</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Hệ thống</a></li>
                    <li class="breadcrumb-item">Quản lý nhóm</li>
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Danh sách nhóm người dùng</h4>
                            <button id="add_nhom" type="button" @click="_nhom('add')" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus-circle"></i> Thêm mới
                            </button>
                            <button v-bind:disabled="flag_btn" @click="_nhom('edit')" id="edit_nhom" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-edit"></i> Sửa
                            </button>
                            <button v-bind:disabled="flag_btn" @click="delete_nhom" type="button" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i> Xóa
                            </button>

                            <!-- The Modal NHOM -->
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form @submit.prevent="submit_nhom" id="form_nhom">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title"><b>Thông tin nhóm người dùng</b></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label><b>Mã nhóm</b></label>
                                                    <input v-model="nhom.ma_nhom" :disabled="flag_input_nhom" v-validate="'required'" :class="{'border-danger' : errors.has('txtmanhom')}" type="text" name="txtmanhom" class="form-control" id="ma_nhom" aria-describedby="" placeholder="">
                                                    <small v-show="errors.has('txtmanhom')" class="help text-muted is-danger">Vui lòng nhập mã nhóm</small>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Tên nhóm</b></label>
                                                    <input v-model="nhom.ten_nhom" v-validate="'required'" :class="{'border-danger' : errors.has('txttennhom')}" type="text" name="txttennhom" class="form-control" id="ten_nhom" placeholder="">
                                                    <small v-show="errors.has('txttennhom')" class="help text-muted is-danger">Vui lòng nhập tên nhóm</small>
                                                </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Lưu lại</button>
                                                <!--<button v-if="!flag_btn_submit_nhom" id="edit" @click="edit_nhom" type="button" class="btn btn-primary">Lưu lại</button>-->
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
                                            <th>Mã nhóm</th>
                                            <th>Tên nhóm</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="n in list_nhom" :id="'n' + n.id" class="row-nhom" @click="click_nhom(n)">
                                            <td>{{n.ma_nhom}}</td>
                                            <td>{{n.ten_nhom}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <el-pagination
                                        :page-size="10"
                                        layout="prev, pager, next"
                                        :total="total_nhom"
                                        @current-change="danh_sach_nhom">
                                </el-pagination>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Danh sách tài khoản trong nhóm</h4>
                            <button id="add_ds" type="button" @click="_nhom('add')" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus-circle"></i> Thêm mới
                            </button>
                            <button v-bind:disabled="flag_btn_tk" @click="_nhom('edit')" id="edit_ds" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-edit"></i> Sửa
                            </button>
                            <button v-bind:disabled="flag_btn_tk" @click="delete_nhom" type="button" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i> Xóa
                            </button>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Họ tên</th>
                                            <th style="width:50%">Tên đăng nhập</th>
                                            <th>Kích hoạt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-loading="loading_danh_sach_tk" v-if="list_nguoidung.length <= 0">
                                            <td colspan="3" class="text-center">Chưa có tài khoản nào trong nhóm</td>
                                        </tr>
                                        <tr v-for="n in list_nguoidung">
                                            <td>{{n.username}}</td>
                                            <td>{{n.username}}</td>
                                            <td class="demo-checkbox text-center" style="width: 100px;">
                                                <input type="checkbox" id="basic_checkbox_2" class="filled-in" :checked="n.active">
                                                <label for="basic_checkbox_2"></label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <el-pagination
                                        :page-size="10"
                                        layout="prev, pager, next"
                                        :total="total_nguoi_dung"
                                        @current-change="danh_sach_nguoi_dung_theo_id_nhom">
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
    import {sweetalert} from '../../../helper/sweetalert';
    export default {
        name: 'quanlynhom',
        mounted () {
            this.danh_sach_nhom();
        },
        data () {
            return {
                list_nhom: [],
                total_nhom: 0,
                nhom: { id_nhom: 0, ma_nhom: '', ten_nhom: '' },
                nhom_selected: { id_nhom: 0,ma_nhom: '', ten_nhom: '' },
                flag_btn: true,
                flag_submit_nhom: true,
                flag_input_nhom: false,
                list_nguoidung: [],
                total_nguoi_dung: 0,
                loading_danh_sach_tk: false,
                flag_btn_tk: true
            }
        },
        methods: {
            danh_sach_nhom: function (page = 1) {
                axios({
                    method: 'GET',
                    url: 'api/danh-sach-nhom-nguoi-dung?page=' + page,
                    headers: {'Authorization':'Bearer ' + this.$store.state.currentUser.token},
                    onDownloadProgress (uploadEvent) {
                        this.loading_dsnv = true;
                    }
                })
                    .then((response) => {
                        this.list_nhom = response.data.data;
                        this.total_nhom = response.data.total;
                        this.flag = false;
                        this.loading_dsnv = false;
                        console.log(response.data.data);
                    })
                    .catch((error) => {
                        console.log(error);
                        this.flag = true;
                    })
            },
            _nhom: function (state) {
                if(state == 'add') {
                    console.log('add nhom');
                    this.flag_submit_nhom = true;
                    this.flag_input_nhom = false;
                }
                else {
                    console.log('edit nhom');
                    this.flag_submit_nhom = false;
                    this.nhom = this.nhom_selected;
                    this.flag_input_nhom = true;
                }
            },
            submit_nhom: function () {
                if(this.flag_submit_nhom) {
                    console.log('add nhom');
                    this.flag_input_nhom = false;
                    this.add_nhom();
                }
                else {
                    console.log('edit nhom');
                    this.nhom = this.nhom_selected;
                    this.flag_input_nhom = true;
                    this.edit_nhom();
                }
            },
            click_nhom: function (nhom) {
                console.log(nhom);
                this.nhom_selected.id_nhom = nhom.id;
                this.nhom_selected.ma_nhom = nhom.ma_nhom;
                this.nhom_selected.ten_nhom = nhom.ten_nhom
                this.flag_btn = false;
                $('.row-nhom').removeClass("active-click-row");
                $('#n' + nhom.id).addClass("active-click-row");
                this.danh_sach_nguoi_dung_theo_id_nhom(nhom.id);
            },
            add_nhom: function (event) {
                this.flag_input_nhom = false;
                axios({
                    method: 'POST',
                    url: 'api/nhom-nguoi-dung-them',
                    headers: {'Authorization':'Bearer ' + this.$store.state.currentUser.token},
                    data: this.$data.nhom,
                    onDownloadProgress (uploadEvent) {
                        this.loading_dsnv = true;
                    }
                })
                    .then((response) => {
                        if(response.data == 1){
                            sweetalert(1, 'Thêm thành công!');
                            $('#myModal').modal('hide');
                            $('.modal-backdrop').css('display','none');
                            this.danh_sach_nhom();
                            this.nhom.ma_nhom = this.nhom.ten_nhom = '';
                            event.target.reset();
                        }
                        else if(response.data == 0){ sweetalert(0, 'Mã nhóm vừa chọn đã tồn tại!')}
                        else sweetalert(2, 'Lỗi không thêm được!');
                    })
                    .catch((error) => {
                        console.log(error);
                        sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                    })
            },
            edit_nhom: function() {
                axios({
                    method: 'POST',
                    url: 'api/edit-nhom-nguoi-dung',
                    headers: {'Authorization':'Bearer ' + this.$store.state.currentUser.token},
                    data: this.$data.nhom,
                    onDownloadProgress () {
                        this.loading_dsnv = true;
                    }
                })
                    .then((response) => {
                        if(response.data == 1){
                            sweetalert(1, 'Cập nhật thành công!');
                            $('#myModal').modal('hide');
                            $('.modal-backdrop').css('display','none');
                            this.danh_sach_nhom();
                            this.nhom.ma_nhom = this.nhom.ten_nhom = '';
                            event.target.reset();
                        }
                        else if(response.data == 0){ sweetalert(0, 'Mã nhóm vừa chọn đã tồn tại!')}
                        else sweetalert(2, 'Lỗi không thêm được!');
                    })
                    .catch((error) => {
                        console.log(error);
                        sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                    })
            },
            delete_nhom: function() {
                let vm = this;
                if(vm.nhom_selected.id_nhom == '') return -1;
                swal({
                        title: "Bạn có chắc chắn muốn xóa nhóm vừa chọn?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Đồng ý",
                        closeOnConfirm: true
                    },
                    function() {
                        axios({
                            method: 'GET',
                            url: 'api/delete-nhom-nguoi-dung/' + vm.nhom_selected.id_nhom,
                            headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
                            onDownloadProgress (uploadEvent) {
                                this.loading_dsnv = true;
                            }
                        })
                            .then((response) => {
                                if(response.data == 1) {
                                    sweetalert(1, 'Nhóm ' + vm.nhom_selected.ma_nhom + ' đã được xóa!');
                                    $('.row-nhom').removeClass("active-click-row");
                                    vm.flag_btn = true;
                                    vm.danh_sach_nhom();
                                    vm.nhom_selected.id_nhom = vm.nhom_selected.ma_nhom = vm.nhom_selected.ten_nhom = '';
                                }
                                else sweetalert(2, 'Lỗi không xóa được!');
                            })
                            .catch((error) => {
                                sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                            })

                    });
            },
            danh_sach_nguoi_dung_theo_id_nhom: function(id_nhom, page = 1) {
                axios({
                    method: 'GET',
                    url: 'api/danh-sach-nguoi-dung-theo-nhom/'+ id_nhom +'&page=' + page,
                    headers: {'Authorization':'Bearer ' + this.$store.state.currentUser.token},
                    onDownloadProgress (uploadEvent) {
                        this.loading_danh_sach_tk = true;
                    }
                })
                    .then((response) => {
                        this.list_nguoidung = response.data.data;
                        this.total_nguoi_dung = response.data.total;
                        console.log(response.data.data);
                    })
                    .catch((error) => {
                        console.log(error);
                        this.flag = true;
                    })
            }
        }
    }
</script>

<style scoped>
    .row-nhom:hover {
        cursor: pointer;
        color: black;
    }
    .demo-checkbox label, .demo-radio-button label{
        min-width: 0px !important;
        height: 0;
    }
</style>