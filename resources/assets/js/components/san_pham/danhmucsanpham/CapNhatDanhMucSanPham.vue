<template>
    <div class="page-wrapper" style="min-height: 291px;">
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card content-lam mb-0 pb-0">
                        <div class="card-header">
                            <div class="card-actions">
                                <a @click="scroll_card_full_creem" id="phongto" class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                <!--<a class="btn-close" data-action="close"><i class="ti-close"></i></a>-->
                            </div>
                            <h4 class="card-title m-b-0">Cập nhật danh mục sản phẩm</h4>
                        </div>
                        <!--danh sach danh muc-->
                        <div class="card-body collapse show pb-0">
                            <div class="message-box contact-box">
                                <div class="message-widget contact-widget">
                                    <div class="row mb-4">
                                            <div class="modal-body" style="padding-left: 30px;padding-right: 30px;">
                                                <div class="form-group row border-form mt-2">
                                                    <label class=" col-md-2 col-3 col-form-label">Tên danh mục:</label>
                                                    <div class="col-md-10 col-9 tt-dacbiet">
                                                        <input v-model="danh_muc.tieu_de" type="text" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                                <div class="form-group row border-form">
                                                    <label class=" col-md-2 col-3 col-form-label">Danh mục cha(*):</label>
                                                    <div class="col-md-10 col-9 tt-dacbiet">
                                                        <select v-model="danh_muc.danh_muc_cha" size="8" class="form-control form-control-sm">
                                                            <option value="0">ROOT</option>
                                                            <option v-for="n in list_danh_muc_2" :value="n.danh_muc_id" :disabled="n.danh_muc_id == danh_muc.danh_muc_id">{{n.level}}{{n.tieu_de}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row border-form">
                                                    <label class=" col-md-2 col-3 col-form-label">Mô tả:</label>
                                                    <div class="col-md-10 col-9 tt-dacbiet">
                                                        <quill-editor v-model="danh_muc.tomtat"
                                                                      ref="myQuillEditor"
                                                                      :options="editorOption"
                                                                      @blur="onEditorBlur($event)"
                                                                      @focus="onEditorFocus($event)"
                                                                      @ready="onEditorReady($event)">
                                                        </quill-editor>
                                                    </div>
                                                </div>
                                                <div class="form-group row border-form">
                                                    <label class=" col-md-2 col-3 col-form-label">Hiển thị:</label>
                                                    <div class="col-md-10 col-9 tt-dacbiet" style="margin-top:3px;">
                                                        <input v-model="danh_muc.hienthi" type="checkbox" id="md_checkbox_26" class="filled-in chk-col-blue" checked />
                                                        <label for="md_checkbox_26"></label>
                                                    </div>
                                                </div>
                                                <!--<div class="form-group row border-form">-->
                                                <!--<label class="label-form col-md-2 col-3 col-form-label">Ngày tạo:</label>-->
                                                <!--<div class="col-md-10 col-9 tt-dacbiet">-->
                                                <!--<el-date-picker-->
                                                <!--v-model="danh_muc.created_at"-->
                                                <!--type="date"-->
                                                <!--placeholder="Pick a day">-->
                                                <!--</el-date-picker>-->
                                                <!--</div>-->
                                                <!--</div>-->
                                                <div class="form-group row border-form">
                                                    <label class=" col-md-2 col-3 col-form-label">Ghi chú</label>
                                                    <div class="col-md-10 col-9 tt-dacbiet">
                                                        <input v-model="danh_muc.ghi_chu" type="text" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                                <br>
                                                <h5 style="font-weight: 600">Thứ tự hiển thị sản phẩm</h5>

                                                <div class="form-group row border-form">
                                                    <div class="col-md-12 mb-2">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <form @submit.prevent="submit_search">
                                                                    <el-input placeholder="Tìm kiếm sản phẩm" size="small" suffix-icon="el-icon-search" v-model="keyword"></el-input>
                                                                </form>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <el-select v-model="sap_xep" value-key="key" placeholder="Thủ công" size="small" @change="change_sap_xep" class="pull-right">
                                                                    <el-option v-for="item in list_sap_xep" :key="item.key" :label="item.label" :value="item">
                                                                        <span v-if="item.key == 'a-z'" style="float: left"><i class="fa fa-sort-alpha-asc"></i> {{ item.label }}</span>
                                                                        <span v-else-if="item.key == 'z-a'" style="float: left"><i class="fa fa-sort-alpha-desc"></i> {{ item.label }}</span>
                                                                        <span v-else-if="item.key == 'manual'" style="float: left"><i class="fa fa-hand-o-up"></i> {{ item.label }}</span>
                                                                        <span v-else-if="item.key == 'created_asc'" style="float: left"><i class="fa fa-sort-amount-asc"></i> {{ item.label }}</span>
                                                                        <span v-else style="float: left"><i class="fa fa-sort-amount-desc"></i> {{ item.label }}</span>
                                                                    </el-option>
                                                                </el-select>
                                                                <label class="col-form-label pull-right mr-2">Sắp xếp</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--<div class="col-md-12"><small>Kéo thả chuột để sắp xếp vị trí</small></div>-->
                                                    <div class="col-md-12 table-responsive">
                                                        <table class="table table-bordered mb-2">
                                                            <thead>
                                                            <tr>
                                                                <th class="text-center" style="width:38px;border-right: 1px solid #ddd;">#</th>
                                                                <th class="text-center" style="width:38px;border-right: 1px solid #ddd;">TT</th>
                                                                <th class="text-center" style="width:38px;border-right: 1px solid #ddd;">HA</th>
                                                                <th style="border-right: 1px solid #ddd;">Tên sản phẩm</th>
                                                                <th class="text-center" style="border-right: 1px solid #ddd;width:100px;">Ngày tạo</th>
                                                                <th class="text-center" style="width:50px;"></th>
                                                            </tr>
                                                            </thead>
                                                            <draggable v-model="list_san_pham" :options="{'disabled':flag_diasebled_draggable, 'animation':'150', 'handle':'.btn-move'}" :element="'tbody'">
                                                                <tr v-if="loading_sp"><td class="text-center" colspan="4"><i>Đang tải danh sách sản phẩm...</i></td></tr>
                                                                <tr v-else v-for="(n,index) in list_san_pham" title="Kéo thả chuột để sắp xếp vị trí" class="row-sp">
                                                                    <td class="text-center dichuyen btn-move"><i class="fa fa-arrows"></i></td>
                                                                    <td class="text-center dichuyen">{{count_tt(index + 1)}}</td>
                                                                    <td class="text-center">
                                                                        <img :src="parse_img(n)" class="img-sanpham">
                                                                    </td>
                                                                    <td>{{n.ten_sp}}</td>
                                                                    <td class="text-center">{{short_date(n.created_at)}}</td>
                                                                    <td class="text-center"><button @click="delete_sp_khoi_dm(n)" title="Xóa khỏi danh mục này" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></td>
                                                                </tr>
                                                            </draggable>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="row tb-row-hienthi">
                                                            <div class="col-md-1 col-sm-2 col-8 tb-label pr-0" style="padding-left: 15px;">
                                                                <span>Hiển thị</span>
                                                            </div>
                                                            <div class="col-md-1 col-sm-2 col-4 tb-hienthi" style="padding-left: 4px;">
                                                                <el-select v-model="limit" placeholder="10" size="small" @change="danh_sach_san_pham_limit">
                                                                    <el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>
                                                                </el-select>
                                                            </div>
                                                            <div class="col-md-8 col-sm-4 col-6" style="padding-left: 0px;">
                                                                <el-pagination :page-size="limit" layout="prev, pager, next" :total="total_san_pham" @current-change="getSanPham"></el-pagination>
                                                            </div>
                                                            <div class="col-md-2 col-sm-2 col-6 tb-label">
                                                                <span class="pull-right">Tổng: {{total_san_pham}} sản phẩm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row border-form pull-right">
                                                    <div class="col-md-12">
                                                        <button @click="submit_danh_muc" :disabled="flag_disabled_submit" id="save" type="button" class="btn btn-primary pull-right">
                                                            <span v-if="flag_btn_save"><i class="fa fa-save"></i> Lưu lại</span>
                                                            <span v-if="!flag_btn_save"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</span>
                                                        </button>

                                                        <button @click="quay_ve" type="button" class="btn btn-warning pull-right mr-2" style=""><i class="fa fa-backward"></i> Quay về</button>
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
    import '../../../../../../node_modules/quill/dist/quill.core.css'
    import '../../../../../../node_modules/quill/dist/quill.snow.css'
    import '../../../../../../node_modules/quill/dist/quill.bubble.css'
    import draggable from 'vuedraggable';
    import { quillEditor } from 'vue-quill-editor';

    import {api_get_all_danh_muc_san_pham} from "./danh_muc_san_pham";
    import {api_get_danh_muc_san_pham_theo_id} from "./danh_muc_san_pham";
    import {api_get_danh_sach_san_pham_theo_danh_muc} from "./danh_muc_san_pham";
    import {api_add_danh_muc} from "./danh_muc_san_pham";
    import {api_edit_danh_muc} from "./danh_muc_san_pham";
    import {api_delete_danh_muc} from "./danh_muc_san_pham";

    import {api_search_san_pham_trong_danh_muc} from "./danh_muc_san_pham";
    import {api_delete_san_pham_trong_danh_muc} from "./danh_muc_san_pham";
    import {api_sap_xep_san_pham_trong_danh_muc} from "./danh_muc_san_pham";

    export default {
        name: 'capnhatdanhmucsanpham',
        mounted () {
            api_get_danh_muc_san_pham_theo_id(this);
            api_get_all_danh_muc_san_pham(this);
            // api_get_danh_sach_san_pham_theo_danh_muc(this,1);
        },
        components: { quillEditor, draggable },
        updated () {
            $(document).ready(function() {
                $('.select2').select2();
                // $('.textarea_editor').wysihtml5();
            });
        },
        computed: {
        },
        data () {
            return {
                loading_danh_muc: true,
                bo_phan: { id: 0, ma_danh_muc: '', tieu_de: '', ten_danh_muc: '', dien_giai: '' },
                flag_btn: true,
                flag_submit_danh_muc: true,
                flag_input_danh_muc: false,
                flag_body_modal: false,
                flag_btn_save: true,
                flag_disabled_submit: false,
                flag_input_ma_danh_muc: false,
                flag_search_san_pham: false,
                keyword: '',
                total_danh_muc: 0,
                total_san_pham: 0,
                list_danh_muc: [],
                list_danh_muc_2: [],
                list_san_pham: [],
                options_display: [10,20,30],
                limit: 10,
                currentPage: 1,
                loading_sp: false,
                danh_muc: {danh_muc_id: '', danh_muc_cha: '',alias: '',hienthi: '1',  tieu_de: '', tomtat: '', created_at: Date.now(), ghi_chu: '', danhmucsapxep: ''},
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
                },
                sap_xep: {label: 'Thủ công',key: 'manual'},
                list_sap_xep: [
                    {
                        label: 'Thủ công',
                        key: 'manual'
                    },
                    {
                        label: 'Tên sản phẩm từ A - Z',
                        key: 'a-z'
                    },
                    {
                        label: 'Tên sản phẩm từ Z - A',
                        key: 'z-a'
                    },
                    {
                        label: 'Ngày tạo',
                        key: 'created_desc'
                    },
                    {
                        label: 'Ngày tạo',
                        key: 'created_asc'
                    },
                ],
                flag_diasebled_draggable: true,
                value: ''
            }
        },
        methods: {
            validate_ma_bp: function () {
                var length_nv = this.bo_phan.ma_danh_muc.length;
                var value_nv  = this.bo_phan.ma_danh_muc;
                if((length_nv > 7 || length_nv < 7) || value_nv.indexOf('BP') == -1 || value_nv.indexOf(' ') > -1){
                    this.flag_input_ma_danh_muc = true;
                    this.flag_disabled_submit = true;
                }
                else{
                    this.flag_input_ma_danh_muc = false;
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
            load_select_sap_xep: function (key) {
                if(key == 'manual') {
                    this.flag_diasebled_draggable = false;
                }
                else {
                    this.flag_diasebled_draggable = true;
                    $('.dichchuyen').hover(function () {
                        $(this).css('cursor','no-drop');
                    });
                }

                this.sap_xep = this.list_sap_xep.filter(function (item) {
                    return (item['key'] == key);
                })[0];
            },
            short_date: function (day) {
                return day.slice(0,10);
            },
            getSanPham: function (page = 1) {
                if(this.flag_search_san_pham){
                    api_search_san_pham_trong_danh_muc(this,page);
                }else{
                    api_get_danh_sach_san_pham_theo_danh_muc(this,page);
                }
                this.currentPage = page;
            },
            danh_sach_san_pham_limit: function () {
                if(this.flag_search_san_pham){
                    api_search_san_pham_trong_danh_muc(this,1);
                }else{
                    api_get_danh_sach_san_pham_theo_danh_muc(this,1);
                }
            },
            change_sap_xep: function (item) {
                if(item.key == 'manual') {
                    this.flag_diasebled_draggable = false;
                }
                else {
                    this.flag_diasebled_draggable = true;
                    $('.dichchuyen').hover(function () {
                        $(this).css('cursor','no-drop');
                    });
                }
                this.danh_muc.danhmucsapxep = item.key;
                api_get_danh_sach_san_pham_theo_danh_muc(this,1);
            },
            submit_search: function () {
                if(this.keyword == '' || this.keyword == null){
                    this.flag_search = false;
                    api_get_danh_sach_san_pham_theo_danh_muc(this,1);
                }
                else{
                    this.flag_search = true;
                    api_search_san_pham_trong_danh_muc(this,1);
                }
            },
            _danh_muc: function (state, bophan = null) {
                if(state == 'add') {
                    console.log('add nhom');
                    this.flag_btn = true;
                    $('.row-nhom').removeClass("active-click-row");
                    this.flag_submit_danh_muc = true;
                    this.flag_input_danh_muc = false;
                    this.bo_phan = { id: 0, ma_danh_muc: '', ten_danh_muc: '', dien_giai: '' }
                }
                else {
                    // this.bo_phan = bophan;
                    this.bo_phan.id = bophan.id;
                    this.bo_phan.ma_danh_muc = bophan.ma_danh_muc;
                    this.bo_phan.ten_danh_muc = bophan.ten_danh_muc;
                    this.bo_phan.dien_giai = bophan.dien_giai;
                    this.flag_submit_danh_muc = false;
                    this.flag_input_danh_muc = true;
                }
            },
            count_tt: function (index) {
                return ((this.currentPage - 1) * this.limit) + index;
            },
            submit_danh_muc: function () {
                this.change_bnt_save();
                api_edit_danh_muc(this);
                // api_sap_xep_san_pham_trong_danh_muc(this);
            },
            delete_sp_khoi_dm: function(sp) {
                api_delete_san_pham_trong_danh_muc(this, sp.ma_sp);
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
            change_bnt_save: function () {
                this.flag_btn_save = false;
                $('#save').attr('disabled', 'disabled');
            },
            un_change_bnt_save: function () {
                this.flag_btn_save = true;
                $('#save').removeAttr('disabled');
            },
            scroll_card: function () {
                $('#thunho').closest('.card').find('[data-action="collapse"] i').toggleClass('ti-minus ti-plus');
                $('#thunho').closest('.card').children('.card-body').collapse('toggle');
            },
            scroll_card_full_creem: function () {
                $('#phongto').closest('.card').find('[data-action="expand"] i').toggleClass('mdi-arrow-expand mdi-arrow-compress');
                $('#phongto').closest('.card').toggleClass('card-fullscreen');
            },
            onEditorBlur(quill) {
                console.log('editor blur!', quill)
            },
            onEditorFocus(quill) {
                console.log('editor focus!', quill)
            },
            onEditorReady(quill) {
                console.log('editor ready!', quill)
            },
            onEditorChange({ quill, html, text }) {
                console.log('editor change!', quill, html, text)
                // this.content = html
            },
            quay_ve: function () {
                this.$router.push({path: '/danhmucsanpham'});
            },
            removeJob: function(machineId, jobNumber, jobs, index) {
                // Remove job from GUI
                jobs.splice(index, 1);
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

    .col-form-label {
        font-size: 13px;
    }

    label {
        font-weight: 600;
    }

    .img-sanpham {
        height: 30px;
        width: 30px;
        border: 1px solid #ddd;
    }

    .table td, .table th {
        padding: 4px 4px;
        vertical-align: middle;
        border-top: 1px solid #dee2e6;
    }

    .table-responsive>.table-bordered {
        border: 1px solid #ddd;
    }

    tr th {
        font-size: 14px;
    }

    tr td {
        font-size: 14px;
        font-weight: 400;
    }

    .dichuyen:hover {
        cursor: n-resize;
    }

    .row-sp:hover {
        background-color: #ddd;
    }
</style>