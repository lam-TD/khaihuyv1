<template id="danhsachnhanvien">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" id="timkiem" class="form-control" placeholder="Nhập từ khóa để tìm kiếm...">
                                <button type="button" class="btn btn-info btn-sm btntimkiem" name="button">Tìm kiếm</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button @click="_nhan_vien('add')" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal_nv_tt_ca_nhan"><i class="fa fa-plus-circle"></i> Thêm mới</button>
                            <!-- Modal -->
                            <div class="modal" id="modal_nv_tt_ca_nhan"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel"><b>Thông tin cá nhân</b></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form @submit.prevent="submit_nhan_vien_thong_tin_ca_nhan" id="form_nhan_vien_thong_tin_ca_nhan" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">Mã NV</label>
                                                                <input v-model="nhan_vien.ma_nv" name="txtma_nv" type="text" class="form-control form-control-sm" id="manv" v-validate="'required'" :class="{'border-danger' : errors.has('txtma_nv')}">
                                                                <small v-show="errors.has('txtma_nv')" class="help text-muted is-danger">Vui lòng nhập mã nhân viên</small>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="label-form">Họ tên</label>
                                                                <input v-model="nhan_vien.ho_ten" name="txthoten" type="text" class="form-control form-control-sm" id="txthoten" v-validate="'required'" :class="{'border-danger' : errors.has('txthoten')}">
                                                                <small v-show="errors.has('txthoten')" class="help text-muted is-danger">Vui lòng nhập tên nhân viên</small>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">Giới tính</label>
                                                                <select v-model="nhan_vien.gioi_tinh" name="" id="" class="form-control form-control-sm">
                                                                    <option value="0" :selected="true">Nữ</option>
                                                                    <option value="1">Nam</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-5">
                                                                <label class="label-form">Nơi sinh</label>
                                                                <input v-model="nhan_vien.noi_sinh" type="text" class="form-control form-control-sm" id="dd1" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label class="label-form">Ngày sinh</label>
                                                                <input v-model="nhan_vien.ngay_sinh" type="text" class="form-control form-control-sm" id="sss" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">Quốc tịch</label>
                                                                <input v-model="nhan_vien.quoc_tich" type="text" class="form-control form-control-sm" id="1aaa" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="wizard-card" style="margin-top: -5px">
                                                            <div class="picture-container">
                                                                <div class="picture">
                                                                    <img style="height: 100%" src="https://cdn0.vox-cdn.com/images/verge/default-avatar.v9899025.gif" class="picture-src" id="wizardPicturePreview" title="" />
                                                                    <input name="image" type="file" id="wizard-picture" @change="onFileChange">
                                                                </div>
                                                                <button style="width: 106px;" class="btn btn-sm">Chọn ảnh</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">Số CMND</label>
                                                                <input v-model="nhan_vien.so_cmnd" name="txtsocmnd" type="text" class="form-control form-control-sm" id="txtsocmnd" v-validate="'required'" :class="{'border-danger' : errors.has('txtsocmnd')}">
                                                                <small v-show="errors.has('txtsocmnd')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="label-form">Ngày cấp</label>
                                                                <input v-model="nhan_vien.scmnd_ngay_cap" name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" id="scmnd_ngay_cap" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">Nơi cấp</label>
                                                                <input v-model="nhan_vien.scmnd_noi_cap" name="scmnd_noi_cap" type="text" class="form-control form-control-sm" id="scmnd_noi_cap" placeholder="">
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label class="label-form">Tạm trú</label>
                                                                <textarea v-model="nhan_vien.tam_tru" name="txttamtru" class="form-control form-control-sm" id="txttamtru"></textarea>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label class="label-form">Thường trú</label>
                                                                <textarea v-model="nhan_vien.thuong_tru" name="txtthuongtru" class="form-control form-control-sm" id="txtthuongtru"></textarea>
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">ĐT bàn</label>
                                                                <input v-model="nhan_vien.dt_ban" name="txtdtban" type="text" class="form-control form-control-sm" id="txtdtban" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="label-form">Di động 1</label>
                                                                <input v-model="nhan_vien.di_dong_1" type="text" name="txtdd1" class="form-control form-control-sm" id="txtdd1" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">Di động 2</label>
                                                                <input v-model="nhan_vien.di_dong_2" type="text" class="form-control form-control-sm" name="txtdd2" id="txtdd2" placeholder="">
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">MST CN</label>
                                                                <input v-model="nhan_vien.mst_cn" type="text" name="txtmst_cn" class="form-control form-control-sm" id="txtmst_cn" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="label-form">Nơi cấp</label>
                                                                <input v-model="nhan_vien.mst_cn_noi_cap" type="text" name="txtmst_cn_noi_cap" class="form-control form-control-sm" id="txtmst_cn_noi_cap" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label class="label-form">C/C thuế cấp</label>
                                                                <input v-model="nhan_vien.cc_thue_cap" type="text" name="txtccthuecap" class="form-control form-control-sm" id="txtccthuecap" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                <button id="save" type="submit" class="btn btn-primary">Lưu lại</button>
                                                <button @click="upload_img" id="anh" type="" class="btn btn-primary">Lưu ảnh</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="table_nhanvien">
                            <thead>
                                <tr style="border-top: 1px solid #ddd;">
                                    <th class="text-center">#</th>
                                    <th style="">Mã</th>
                                    <th style="">Tên nhân viên</th>
                                    <th>G/T</th>
                                    <th>Ngày sinh</th>
                                    <th>Nơi sinh</th>
                                    <th>Số CMND</th>
                                    <th>Ngày cấp</th>
                                    <th>Nơi cấp</th>
                                    <th>Tạm trú</th>
                                    <th style="width:400px;">Thường trú</th>
                                    <th>ĐT bàn</th>
                                    <th>Di động 1</th>
                                    <th>Di động 2</th>
                                    <th>MST CN</th>
                                    <th>Ngày cấp</th>
                                    <th>Nơi cấp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="loading_dsnv"><td colspan="17" class=""><b>Đang tải danh sách...</b></td></tr>
                                <tr v-if="flag"><td colspan="17" class=""><b class="error_load_nv">Lỗi không tải được danh sách vui lòng tải lại trang...</b></td></tr>
                                <tr v-if="dsnhanvien.length>0" v-for="n in dsnhanvien">
                                    <td class="text-nowrap">
                                        <button class="btn btn-info btn-sm" data-toggle="tooltip" data-original-title="Cập nhật"> <i class="fa fa-edit"></i> </button>
                                        <button class="btn btn-info btn-sm" data-toggle="tooltip" data-original-title="Thông tin lao động"><font-awesome-icon icon="coffee" /></button>
                                        <button class="btn btn-info btn-sm" data-toggle="tooltip" data-original-title="Thông tin công việc hiện tại"><i class="fas fa-id-card"></i></button>
                                        <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                    </td>
                                    <td style="width:100px;">{{n.ma_nv}}</td>
                                    <td>{{n.ho_ten}}</td>
                                    <td><span v-if="n.gioi_tinh">Nam</span><span v-else>Nữ</span></td>
                                    <td>{{n.ngay_sinh}}</td>
                                    <td>{{n.noi_sinh}}</td>
                                    <td>363809876</td>
                                    <td>22/02/2002</td>
                                    <td>Cần Thơ</td>
                                    <td class="hidden-text" style="width:400px;">{{n.tam_tru}}</td>
                                    <td class="hidden-text" style="width:400px;">{{n.thuong_tru}}</td>
                                    <td>{{n.dt_ban}}</td>
                                    <td>0965655654</td>
                                    <td>0965655654</td>
                                    <td>Prohaska</td>
                                    <td>Prohaska</td>
                                    <td class="hidden-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                                        but also the leap into electronic typesetting, remaining essentially unchanged.</td>
                                </tr>
                            </tbody>
                        </table>
                        <el-pagination
                                :page-size="10"
                                layout="prev, pager, next"
                                :total="dsnhanvien_total"
                                @current-change="getNhanVien">
                        </el-pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {api_add_nhan_vien_thong_tin_ca_nhan} from "./nhan_vien";
    import {api_get_nhan_vien} from "./nhan_vien";

    export default {
        name: 'danhsachnhanvien',
        mounted(){
            this.getNhanVien();
        },
        computed: {
            danh_sach_nhan_vien() {
                return this.dsnhanvien;
            },
            total() {
                return this.dsnhanvien_total;
            }
        },
        data(){
            return {
                dsnhanvien: [],
                dsnhanvien_total: 0,
                loading_dsnv: false,
                flag: false,
                flag_submit_nhan_vien_tt_ca_nhan: true,
                flag_input_nhan_vien_tt: false,
                nhan_vien: {
                    id: 0,
                    ma_nv: '',
                    ho_ten: '',
                    ngay_sinh: '',
                    noi_sinh: '',
                    quoc_tich: '',
                    gioi_tinh: '',
                    so_cmnd: '',
                    scmnd_noi_cap: '',
                    scmnd_ngay_cap: '',
                    thuong_tru: '',
                    tam_tru: '',
                    di_dong_1: '',
                    di_dong_2: '',
                    dt_ban: '',
                    mst_cn: '',
                    mst_cn_noi_cap: '',
                    cc_thue_cap: '',
                    avatar: '',
                    image: ''
                }
            }
        },
        methods: {
            onFileChange: function (e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length) return;
                this.createImage(files[0]);

                let reader = new FileReader();
                // reader.onload = function (e) {
                //     $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                //     vm.nhan_vien.avatar = files;
                // };
                // reader.readAsDataURL(e.target.files[0]);
            },
            createImage: function(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.nhan_vien.image = e.target.result;
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                    // console.log(vm.nhan_vien.image);
                };
                reader.readAsDataURL(file);
            },
            getNhanVien(page = 1) {
                this.loading_dsnv = true;
                api_get_nhan_vien(this, page);
            },
            add_nhan_vien_thong_tin_ca_nhan: function () {
                api_add_nhan_vien_thong_tin_ca_nhan(this);
            },
            _nhan_vien: function (state, nv= null) {
                if(state == 'add') {
                    console.log('add');
                    // $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_nhan_vien_tt_ca_nhan = true;
                    this.flag_input_nhan_vien_tt = false;
                    // this.phong_ban.id = this.phong_ban.ma_phong = this.phong_ban.ten_phong = this.phong_ban.dien_giai = '';
                }
                else {
                    this.nhan_vien = nv;
                    this.flag_submit_nhan_vien_tt_ca_nhan = false;
                    this.flag_input_nhan_vien_tt = true;
                }
            },
            submit_nhan_vien_thong_tin_ca_nhan: function () {
                // console.log('submit');
                if(this.flag_submit_nhan_vien_tt_ca_nhan) {
                    this.flag_input_nhan_vien_tt = false;
                    this.add_nhan_vien_thong_tin_ca_nhan();
                    this.upload_img();
                    // if (this.nhan_vien.image != null){
                    //     this.upload_img();
                    // }
                }
                else {
                    this.nhom = this.nhom_selected;
                    this.flag_input_nhan_vien_tt = true;
                    this.edit_phong_ban();
                }
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
            },
            upload_img: function () {
                console.log(this.nhan_vien.image);
                axios({
                    method: 'POST',
                    url: 'api/image-upload',
                    headers: {'Authorization':'Bearer ' + this.$store.state.currentUser.token},
                    data: this.$data.nhan_vien
                })
                    .then((response) => {
                        console.log(response.data);
                    })
                    .catch((error) => {
                        return -1;
                    })
            }
        }
    }
</script>

<style media="screen" scoped>
    .m-t-40 {
    margin-top: 0px !important;
    }
    #timkiem{
        width: 100%;
        position: relative;
        padding-right: 87px;
        font-size: 13px;
    }

    .btntimkiem{
        position: absolute;
        top: 3px;
        right: 18px;
        height: 37px;
        font-size: 13px;
        height: 32px;
        padding: 5px 13px;
    }

    .error_load_nv{
        color: #ff7a6e;
    }

    .form-group {
        margin-bottom: 0px;
    }

    .label-form {
        font-weight: 500;
        font-size: 13px;
        margin-bottom: 0;
    }

    .wizard-card .picture-container {
        position: relative;
        cursor: pointer;
        text-align: center;
    }

    .wizard-card .picture {
        width: 106px;
        height: 106px;
        background-color: #999999;
        border: 4px solid #CCCCCC;
        color: #FFFFFF;
        border-radius: 1px;
        margin: 5px auto;
        overflow: hidden;
        transition: all 0.2s;
        -webkit-transition: all 0.2s;
    }

    .wizard-card .picture:hover {
        border-color: #2ca8ff;
    }

    .wizard-card.ct-wizard-azzure .picture:hover {
        border-color: #2CA8FF;
    }

    .wizard-card.ct-wizard-green .picture:hover {
        border-color: #05ae0e;
    }

    .wizard-card.ct-wizard-blue .picture:hover {
        border-color: #3472f7;
    }

    .wizard-card.ct-wizard-orange .picture:hover {
        border-color: #ff9500;
    }

    .wizard-card.ct-wizard-red .picture:hover {
        border-color: #ff3b30;
    }

    .wizard-card .picture input[type="file"] {
        cursor: pointer;
        display: block;
        height: 100%;
        left: 0;
        opacity: 0 !important;
        position: absolute;
        top: 0;
        width: 100%;
    }

    .wizard-card .picture-src {
        width: 100%;
    }

    wizard-card{
        margin-top: -5px;
    }
</style>
