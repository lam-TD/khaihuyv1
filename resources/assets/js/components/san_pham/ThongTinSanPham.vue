<template>
    <div class="">
        <!--<top-bar></top-bar>-->
        <!--<left-bar></left-bar>-->
        <div class="page-wrapper">
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <div class="col-md-12 lamlam">
                        <div class="card-group content-lam">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-actions">
                                        <a @click="scroll_card_full_creem" class="btn-minimize" id="phongto" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                        <!--<a class="btn-close" data-action="close"><i class="ti-close"></i></a>-->
                                    </div>
                                    <h4 class="card-title m-b-0">Thêm mới sản phẩm</h4>
                                </div>
                                <div class="card-body">
                                    <form @submit.prevent="onSubmit" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6 col-thongtinsanpham">
                                                <!--================ THONG TIN SAN PHAM =============-->
                                                <h4 class="card-title"><i class="fa fa-inbox"></i> <b>Thông tin sản phẩm</b></h4>
                                                <hr>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-sm-12 col-12">Mã hàng</label>
                                                    <div class="col-sm-10 col-12">
                                                        <!--<input type="text" class="form-control" id="wew1" placeholder="">-->
                                                        <input v-model="sp.ma_sp" v-validate="'required'" :class="{'border-danger' : errors.has('txtmahang')}" class="form-control" name="txtmahang" type="text" autofocus>
                                                        <small v-show="errors.has('txtmahang')" class="help text-muted is-danger">Vui lòng nhập mã hàng</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label style="padding-right: 0;" class="label-form col-md-2 col-sm-12 col-12">Mặt hàng</label>
                                                    <div class="col-sm-10 col-12">
                                                        <input v-model="sp.ten_sp" v-validate="'required'" type="text" :class="{'border-danger' : errors.has('txtmathang')}" class="form-control" name="txtmathang" id="tt" placeholder="">
                                                        <small v-show="errors.has('txtmathang')" class="help text-muted is-danger">Vui lòng nhập mặt hàng</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-sm-12 col-12">ĐVT</label>
                                                    <div class="col-sm-4 col-12">
                                                        <!--<input type="text" class="form-control" id="" placeholder="">-->
                                                        <el-select v-model="don_vi_tinh" value-key="id" placeholder="Select" filterable size="small">
                                                            <el-option v-for="item in list_dvt" value-key="id" :key="item.id" :label="item.ten_dvt" :value="item"></el-option>
                                                        </el-select>
                                                    </div>

                                                    <label  class="label-form col-md-2 col-sm-12 col-12">Net.</label>
                                                    <div class="col-sm-4 col-12">
                                                        <input v-model="sp.net" type="text" class="form-control" id="1" placeholder="">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-sm-12 col-12">Warranty</label>
                                                    <div class="col-sm-10 col-12">
                                                        <input v-model="sp.warranty" type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label  class="label-form col-md-2 col-sm-12 col-12">Diễn giả</label>
                                                    <div class="col-sm-10 col-12">
                                                        <!--<textarea class="form-control diengiai" id="tt6634" placeholder=""></textarea>-->
                                                        <quill-editor v-model="sp.dien_giai" :options="editorOption"></quill-editor>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-sm-12 col-12">Hình ảnh</label>
                                                    <div class="col-sm-10 col-12 pb-2">
                                                        <button class="btn btn-info btn-sm" type="button" @click="upload_img"><i class="fa fa-upload"></i> Tải ảnh lên</button>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <!--<input type="file" @change="change_image">-->
                                                        <el-upload
                                                                action="api/upload-img/14"
                                                                name="file"
                                                                ref="upload"
                                                                :on-change="change_image"
                                                                multiple
                                                                :auto-upload="false"
                                                                :on-success="handleSuccess"
                                                                list-type="picture-card"
                                                                :file-list="fileList"
                                                                :on-preview="handlePictureCardPreview"
                                                                :on-remove="handleRemove">
                                                            <i class="el-icon-plus"></i>
                                                        </el-upload>
                                                    </div>
                                                </div>

                                                <!--<div class="form-group row">-->
                                                    <!--<label style="padding-right: 0" class="label-form col-md-2 col-sm-12 col-12">Nhóm hàng</label>-->
                                                    <!--<div class="col-sm-10 col-12">-->
                                                        <!--<input type="text" class="form-control" id="tssSt66" placeholder="">-->
                                                    <!--</div>-->
                                                <!--</div>-->
                                            </div>

                                            <div class="col-md-6">
                                                <!--================ GIA SAN PHAM =============-->
                                                <h4 class="card-title"><i class="fa fa-cubes"></i> <b>Giá sản phẩm</b></h4>
                                                <hr>
                                                <label class="title-sanpham">Giá vnđ full VAT</label>
                                                <div class="form-group row" style="margin-bottom: 10px">
                                                    <label class="label-form col-md-2 col-sm-12 col-12">Dealer</label>
                                                    <div class="col-sm-4 col-12">
                                                        <input v-model="sp.full_vat_dealer" v-on:keypress="only_number_input" type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="label-form col-md-2 col-sm-12 col-12">Enduser</label>
                                                    <div class="col-sm-4 col-12">
                                                        <input v-model="sp.full_vat_end_user" v-on:keypress="only_number_input" type="text" class="form-control" id="tt890" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="" style="height: 1px;width: 100%;border-bottom: 1px dashed #ddd"></div>

                                                <label class="title-sanpham">DEAL</label>
                                                <div class="form-group row">
                                                    <label class="label-form label-deal col-md-2 col-sm-12 col-12">Deal 1 (>= 1tr)</label>
                                                    <div class="col-sm-6 col-12">
                                                        <!--<vue-numeric class="form-control" separator="," v-model="sp.deal_1"></vue-numeric>-->
                                                        <input @input="tinh_trung_bnh_cong_distri" v-on:keypress="only_number_input" v-model="sp.deal_1" type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="label-form col-md-2 col-sm-12 col-12"> Số lượng</label>
                                                    <div class="col-sm-2 col-12">
                                                        <input v-model="sp.deal_1_sl" v-on:keypress="only_number_input" type="number" class="form-control" id="tt890h" placeholder="">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form label-deal col-md-2 col-sm-12 col-12">Deal 2 (>= 2tr)</label>
                                                    <div class="col-sm-6 col-12">
                                                        <input @input="tinh_trung_bnh_cong_distri" v-on:keypress="only_number_input" v-model="sp.deal_2" type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="label-form col-md-2 col-sm-12 col-12"> Số lượng</label>
                                                    <div class="col-sm-2 col-12">
                                                        <input v-model="sp.deal_2_sl" v-on:keypress="only_number_input" type="number" class="form-control" id="tt890yf" placeholder="">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form label-deal col-md-2 col-sm-12 col-12">Deal 3 (>=3,5tr)</label>
                                                    <div class="col-sm-6 col-12">
                                                        <!--<vue-numeric class="form-control" separator="," v-model="sp.giasanpham"></vue-numeric>-->
                                                        <input @input="tinh_trung_bnh_cong_distri" v-on:keypress="only_number_input" v-model="sp.deal_3" type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="label-form col-md-2 col-sm-12 col-12"> Số lượng</label>
                                                    <div class="col-sm-2 col-12">
                                                        <input v-model="sp.deal_3_sl" v-on:keypress="only_number_input" type="number" class="form-control" id="tt890rr" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="" style="height: 1px;width: 100%;border-bottom: 1px dashed #ddd"></div>
                                                <br>
                                                <label class="title-sanpham">DISTRI</label>
                                                <div class="form-group row" style="margin-bottom: 10px">
                                                    <label class="label-form col-md-2 col-sm-12 col-12">DISTRI</label>
                                                    <div class="col-sm-10 col-12">
                                                        <input v-model="sp.distri" type="text" class="form-control" id="tt8d9" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="" style="height: 1px;width: 100%;border-bottom: 1px dashed #ddd"></div>

                                                <div class="" style="height: 1px;width: 100%;border-bottom: 1px dashed #ddd"></div>
                                                <br>
                                                <label class="title-sanpham">Cộng dịch vụ</label>
                                                <div class="form-group row" style="margin-bottom: 10px">
                                                    <label class="label-form col-md-2 col-sm-12 col-12">Cộng DV</label>
                                                    <div class="col-sm-10 col-12">
                                                        <input v-on:keypress="only_number_input" v-model="sp.cong_dv" type="text" class="form-control" id="tt8dsd9" placeholder="">
                                                    </div>
                                                </div>

                                                <div class="" style="height: 1px;width: 100%;border-bottom: 1px dashed #ddd"></div>
                                                <br>

                                                <!--================ KHO =============-->
                                                <h4 class="card-title"><i class="fa fa-tasks"></i> <b>Kho</b></h4>
                                                <hr>
                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-sm-12 col-12">Kho</label>
                                                    <div class="col-sm-10 col-12">
                                                        <!--<input type="text" class="form-control" id="tSt66" placeholder="">-->
                                                        <el-select v-model="tk_ke_toan" value-key="ma_tk" @change="change_tk_ke_toan" placeholder="Select" style="width: 100%;height: 38px;">
                                                            <el-option v-for="item in list_tk_ke_toan" :key="item.ma_tk" :label="item.ten_tk" :value="item"></el-option>
                                                        </el-select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label style="padding-right: 0" class="label-form col-md-2 col-sm-12 col-12">Loại hàng</label>
                                                    <div class="col-sm-10 col-12">
                                                        <!--<input type="text" class="form-control" id="tsSt66" placeholder="">-->
                                                        <el-select v-model="danh_muc" value-key="danh_muc_id" placeholder="Select" style="width: 100%;height: 38px;">
                                                            <el-option v-for="item in list_danh_muc" :key="item.danh_muc_id" :label="item.tieu_de" :value="item">
                                                                <span style="float: left">{{item.level}}{{ item.tieu_de }}</span>
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <hr>
                                                <div class="form-actions pull-right">
                                                    <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Lưu</button>
                                                    <!--<button type="button" class="btn btn-inverse">Hủy</button>-->
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!--<script !src=""></script>-->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
    </div>
</template>
<script>
    import VueNumeric from 'vue-numeric';
    import {api_get_dvt} from "./san_pham";
    import {api_get_all_tk_ke_toan} from "./san_pham";
    import {api_get_all_danh_muc_san_pham} from "./danh_muc_san_pham";
    import {sweetalert} from "../../helper/sweetalert";

    import {api_add_san_pham} from "./san_pham";
    import { quillEditor } from 'vue-quill-editor';

    export default {
        name: 'thongtinsanpham',
        created() {
        },
        mounted() {
            api_get_dvt(this);
            api_get_all_tk_ke_toan(this);
            api_get_all_danh_muc_san_pham(this);
        },
        updated () {
            let j = document.createElement('script');
            let j2 = document.createElement('script');
            j.setAttribute('src',"public/assets/plugins/jquery-FileUploader/thumbnails/js/custom.js");
            j.setAttribute('id','fileupload-custom');
            j2.setAttribute('src',"public/assets/plugins/jquery-FileUploader/jquery.fileuploader.min.js");
            j2.setAttribute('id','fileupload-js');
            document.head.appendChild(j2);
            document.head.appendChild(j);
        },
        beforeDestroy() {
            $('#fileupload-custom').remove();
            $('#fileupload-js').remove();
        },
        watch: {

        },
        data () {
            return {
                currentRoute: this.$route.query.id,
                sp: { id: '', ma_sp: '', ten_sp: '', dvt_id: '', net: '', warranty: '', dien_giai: '', full_vat_dealer: '', full_vat_end_user: '', deal_1: '', deal_2: '', deal_3: '', deal_1_sl: '', deal_2_sl: '', deal_3_sl: '', distri: '', cong_dv: '', danh_muc_id: '', tk_ke_toan_id: '', image: '', ghi_chu: ''},
                list_dvt: [],
                don_vi_tinh: '',
                disable_submit: true,
                list_tk_ke_toan: [],
                tk_ke_toan: '',
                list_danh_muc: [],
                danh_muc: '',
                images: null,
                form_lam: new FormData,
                fileList: [],
                url_add_img: 'upload-img/',
                count_success_img: 0,
                count_old_success: 0,
                attachments: [],
                uploadData: [],
                editorOption: {
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{ 'header': 1 }, { 'header': 2 }],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                            [{ 'script': 'sub' }, { 'script': 'super' }],
                            [{ 'indent': '-1' }, { 'indent': '+1' }],
                            [{ 'direction': 'rtl' }],
                            [{ 'size': ['small', false, 'large', 'huge'] }],
                            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                            [{ 'font': [] }],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'align': [] }],
                            ['clean'],
                            ['link', 'image', 'video']
                        ]
                    }
                }
            }
        },
        methods: {
            onSubmit: function () {
                this.sp.danh_muc_id = this.danh_muc.danh_muc_id;
                this.sp.dvt_id = this.don_vi_tinh.id;
                // this.sp.tk_ke_toan_id = this.tk_ke_toan.ma_tk;
                console.log(this.tk_ke_toan.ma_tk);
                // return 1;
                if(typeof this.currentRoute === 'undefined'){
                    console.log("them moi");
                    api_add_san_pham(this);
                }
                else{
                    console.log("cap nhat");
                }
            },
            change_tk_ke_toan: function (tk) {
                console.log(tk);
                this.sp.tk_ke_toan_id = tk.ma_tk;
            },
            tinh_trung_bnh_cong_distri: function () {
                this.sp.distri = 0;
                this.sp.distri = (this.sp.deal_1 + this.sp.deal_2 + this.sp.deal_3)/3;
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
            scroll_card_full_creem: function () {
                $('#phongto').closest('.card').find('[data-action="expand"] i').toggleClass('mdi-arrow-expand mdi-arrow-compress');
                $('#phongto').closest('.card').toggleClass('card-fullscreen');
            },
            handleRemove(file, fileList) {
                console.log(file, fileList);
            },
            handlePictureCardPreview(file) {
                this.dialogImageUrl = file.url;
                this.dialogVisible = true;
            },
            change_image: function (file, fileList) {
                this.fileList = fileList;
            },
            upload_img: function () {
                let formData = new FormData();
                let elem = document.querySelector('.el-upload__input');
                console.log(elem.files);
                for (let i = 0; i < elem.files.length; i++) {
                    formData.append(`file[${i}]`, elem.files[i]);
                }

                axios.post( 'api/upload-img/14',
                    formData,
                    ).then((response) => {
                        console.log(response.data);
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            },
            handleSuccess: function (response, file, fileList) {
                this.count_old_success++;
                console.log('old: ' + this.count_old_success);
                console.log('suc' + this.count_success_img);
                if (this.count_old_success == this.count_success_img) {
                    sweetalert(1, 'Thêm sản phẩm thành công!');
                }
            }
        },
        components: { VueNumeric,quillEditor }
    }
</script>

<style scoped>
    label.label-form {
        font-weight: 500;
        margin-top: 5px;
        font-size: 13px;
    }

    input{
        font-size: 13px !important;
        min-height: 25px;
    }

    .form-group {
        margin-bottom: 10px;
    }

    .form-control{
        width: 100%;
    }

    .diengiai{
        min-height: 100px;
        font-size: 13px;
    }
    .col-thongtinsanpham{
        border-right: 1px solid #ddd;
    }

    label.title-sanpham{
        font-weight: 700 !important;
        font-size: 15px !important;
    }

    .label-deal{
        margin-top: 0px !important;
    }

    .text-muted{
        color: red !important;
    }
</style>