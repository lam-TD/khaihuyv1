<template>
    <div class="page-wrapper" style="min-height: 291px;">
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <!--<div class="col-md-12 lamlam">-->
                <!--<div class="card content-lam">-->
                <!--<div class="card-header">-->
                <!--<div class="card-actions">-->
                <!--&lt;!&ndash;<a @click="_danh_muc('add')" title="Thêm mới bộ phận" data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-dark btn-white" style="color: white"><i class="fa fa-plus-circle"></i> Thêm mới</a>&ndash;&gt;-->
                <!--<a @click="scroll_card" id="thunho" class="" data-action="collapse"><i class="ti-minus"></i></a>-->
                <!--<a @click="scroll_card_full_creem" id="phongto" class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>-->
                <!--&lt;!&ndash;<a class="btn-close" data-action="close"><i class="ti-close"></i></a>&ndash;&gt;-->
                <!--</div>-->
                <!--<h4 class="card-title m-b-0">Danh mục sản phẩm</h4>-->
                <!--&lt;!&ndash;<h6 class="card-subtitle m-0 op-5">Tổng số bộ phận: {{total_danh_muc}}</h6>&ndash;&gt;-->
                <!--</div>-->
                <!--<div class="card-body collapse show">-->
                <!--<div class="message-box contact-box">-->
                <!--<div class="message-widget contact-widget">-->
                <!--<div class="row">-->
                <!--<div class="col-md-12">-->
                <!--<div class="form-group row">-->
                <!--<label class="col-md-2 col-form-label">Tên danh mục(*)</label>-->
                <!--<div class="col-md-10">-->
                <!--<input v-model="danh_muc.tieu_de" type="text" id="tieu_de" class="form-control form-control-sm">-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->

                <!--<div class="col-md-12">-->
                <!--<div class="form-group row">-->
                <!--<label class="col-md-2 col-form-label">Danh mục cha(*)</label>-->
                <!--<div class="col-md-10">-->
                <!--<select v-model="danh_muc.danh_muc_id" size="8" class="form-control form-control-sm" id="">-->
                <!--<option value="0">ROOT</option>-->
                <!--<option v-for="n in list_danh_muc" :value="n.danh_muc_id">{{n.level}}{{n.tieu_de}}</option>-->
                <!--</select>-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->

                <!--<div class="col-md-12">-->
                <!--<div class="form-group row">-->
                <!--<label class="col-md-2 col-form-label">Mô tả(*)</label>-->
                <!--<div class="col-md-10">-->
                <!--<quill-editor v-model="danh_muc.tom_tat"-->
                <!--ref="myQuillEditor"-->
                <!--:options="editorOption"-->
                <!--@blur="onEditorBlur($event)"-->
                <!--@focus="onEditorFocus($event)"-->
                <!--@ready="onEditorReady($event)">-->
                <!--</quill-editor>-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->

                <!--<div class="col-md-12">-->
                <!--<div class="form-group row">-->
                <!--<label class="col-md-2 col-form-label">Hiển thị(*)</label>-->
                <!--<div class="col-md-10">-->
                <!--<div class="demo-checkbox" style="margin-top: 5px;">-->
                <!--<input type="checkbox" id="md_checkbox_26" class="filled-in chk-col-blue" checked />-->
                <!--<label for="md_checkbox_26"></label>-->

                <!--</div>-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->

                <!--<div class="col-md-12">-->
                <!--<div class="form-group row">-->
                <!--<label class="col-md-2 col-form-label">Ngày tạo(*)</label>-->
                <!--<div class="col-md-10">-->
                <!--<el-date-picker-->
                <!--v-model="danh_muc.created_at"-->
                <!--type="date"-->
                <!--placeholder="Pick a day">-->
                <!--</el-date-picker>-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->

                <!--<div class="col-md-12">-->
                <!--<div class="form-group row">-->
                <!--<div class="col-md-12">-->
                <!--<button class="btn btn-primary waves-effect waves-dark btn-white pull-right"><i class="fa fa-save"></i> Lưu lại</button>-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->
                <!--</div>-->


                <!--</div>-->
                <!--</div>-->
                <!--</div>-->
                <div class="col-md-12">
                    <div class="card content-lam mb-0 pb-0">
                        <div class="card-header">
                            <div class="card-actions">
                                <a @click="scroll_card_full_creem" id="phongto" class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                <!--<a class="btn-close" data-action="close"><i class="ti-close"></i></a>-->
                            </div>
                            <h4 class="card-title m-b-0">Danh mục sản phẩm</h4>
                        </div>
                        <!--danh sach danh muc-->
                        <div class="card-body collapse show pb-0">
                            <div class="message-box contact-box">
                                <div class="message-widget contact-widget">
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<form @submit.prevent="">-->
                                                        <!--<input v-model="key_word" type="text" id="timkiem" class="form-control" placeholder="Nhập từ khóa để tìm kiếm...">-->
                                                        <!--<button type="submit" class="btn btn-info btn-sm btntimkiem" name="button">Tìm kiếm</button>-->
                                                        <!--</form>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6" style="margin-bottom:5px;">
                                                    <button v-if="flag_cn.add" @click="__danh_muc('add')" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal_danh_muc_san_pham"><i class="fa fa-plus-circle"></i> Thêm mới </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <template>
                                                <el-table border :data="list_danh_muc" stripe style="width: 100%">
                                                    <el-table-column v-if="flag_cn.edit || flag_cn.delete" label="Thao tác" width="90" align="center" class-name="center-text">
                                                        <template slot-scope="scope" class="text-center" style="width: 100%">
                                                            <router-link v-if="flag_cn.edit" :to="{path: '/capnhatdanhmucsanpham', query: { id: scope.row.danh_muc_id }}" class="btn btn-info btn-sm" title="Cập nhật danh mục"> <i class="fa fa-edit"></i></router-link>
                                                            <button v-if="flag_cn.delete" @click="delete_danh_muc(scope.row)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                                        </template>
                                                    </el-table-column>

                                                    <el-table-column type="index" label="TT" width="50" align="center" class-name="center-text"></el-table-column>

                                                    <!--<el-table-column prop="danh_muc_id" label="ID" width="50" class-name="no-center-text"></el-table-column>-->

                                                    <el-table-column label="Tiêu đề" width="180" class-name="no-center-text">
                                                        <template slot-scope="scope">
                                                            {{scope.row.level}} {{scope.row.tieu_de}}
                                                        </template>
                                                    </el-table-column>

                                                    <el-table-column label="Tóm tắt" class-name="no-center-text">
                                                        <template slot-scope="props">
                                                            <span v-html="props.row.tomtat"></span>
                                                        </template>
                                                    </el-table-column>

                                                    <el-table-column label="Hiển thị" class-name="no-center-text">
                                                        <template slot-scope="props">
                                                            <span v-if="props.row.hienthi == '0'">Không</span>
                                                            <span v-else>Hiển thị</span>
                                                        </template>
                                                    </el-table-column>

                                                    <el-table-column prop="ghi_chu" label="Ghi chú" class-name="no-center-text"> </el-table-column>

                                                </el-table>
                                            </template>
                                        </div>
                                        <!--<div class="col-md-12">-->
                                            <!--<div class="row tb-row-hienthi">-->
                                                <!--<div class="col-md-1 col-sm-2 col-8 tb-label pr-0" style="padding-left: 15px;">-->
                                                    <!--<span>Hiển thị</span>-->
                                                <!--</div>-->
                                                <!--<div class="col-md-1 col-sm-2 col-4 tb-hienthi" style="padding-left: 4px;">-->
                                                    <!--<el-select v-model="limit" placeholder="10" size="small" @change="danh_sach_danh_muc_limit">-->
                                                        <!--<el-option v-for="item in options_display" :key="item" :label="item" :value="item"></el-option>-->
                                                    <!--</el-select>-->
                                                <!--</div>-->
                                                <!--<div class="col-md-8 col-sm-4 col-6" style="padding-left: 0px;">-->
                                                    <!--<el-pagination :page-size="limit" layout="prev, pager, next" :total="total_danh_muc" @current-change="danh_sach_danh_muc_" :current-page.sync="currentPage"></el-pagination>-->
                                                <!--</div>-->
                                                <!--<div class="col-md-2 col-sm-2 col-6 tb-label">-->
                                                    <!--<span class="pull-right">Tổng: {{total_danh_muc}} mẫu tin</span>-->

                                                <!--</div>-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end danh sach danh muc-->
                        <!--modal danh muc-->
                        <div class="modal" id="modal_danh_muc_san_pham" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <form @submit.prevent="submit_danh_muc">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel2">Thông tin danh mục</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
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
                                                    <el-input v-model="danh_muc.ghi_chu"></el-input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <!--<button id="save" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại</button>-->
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                            <button :disabled="flag_disabled_submit || danh_muc.tieu_de.length == 0" id="save" type="submit" class="btn btn-primary">
                                                <span v-if="flag_btn_save"><i class="fa fa-save"></i> Lưu lại</span>
                                                <span v-if="!flag_btn_save"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- end Modal danh muc -->
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

    import { quillEditor } from 'vue-quill-editor';

    import {check_url_phan_quyen} from "../../../helper/auth";
    import {check_quyen_chuc_nang} from "../../../helper/auth";

    import {api_get_all_danh_muc_san_pham} from "./danh_muc_san_pham";
    import {api_get_all_danh_muc_san_pham_pa} from "./danh_muc_san_pham";
    import {api_add_danh_muc} from "./danh_muc_san_pham";
    import {api_edit_danh_muc} from "./danh_muc_san_pham";
    import {api_delete_danh_muc} from "./danh_muc_san_pham";

    export default {
        name: 'danhmucsanpham',
        beforeCreate(){
            check_url_phan_quyen(this);
        },
        mounted () {
            check_quyen_chuc_nang(this);
            api_get_all_danh_muc_san_pham(this);
            api_get_all_danh_muc_san_pham_pa(this, 1);
        },
        components: { quillEditor },
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

                total_danh_muc: 0,
                list_danh_muc: [],
                list_danh_muc_2: [],
                options_display: [10,20,30],
                limit: 10,
                currentPage: 1,

                danh_muc: {danh_muc_id: '', danh_muc_cha: '',alias: '',hienthi: '1',  tieu_de: '', tomtat: '', created_at: Date.now(), ghi_chu: ''},
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
                flag_cn: {add: false, edit: false, delete: false}
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
            //
            danh_sach_danh_muc_limit: function () {
                this.currentPage = 1;
                api_get_all_danh_muc_san_pham_pa(this, 1);
            },
            danh_sach_danh_muc_: function (page = 1) {
                api_get_all_danh_muc_san_pham_pa(this, page);
            },
            ////
            danh_sach_danh_muc: function (page = 1) {
                this.loading_danh_muc = true;
                api_bophan_get(this, page);
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
            __danh_muc: function (state, danhmuc = null) {
                api_get_all_danh_muc_san_pham(this);
                if(state == 'add') {
                    this.flag_submit_danh_muc = true;
                    this.danh_muc =  {danh_muc_id: '', danh_muc_cha: '',alias: '',hienthi: '1',  tieu_de: '', tomtat: '', created_at: Date.now(), ghi_chu: ''};
                }
                else {
                    this.flag_submit_danh_muc = false;
                    this.danh_muc.danh_muc_id = danhmuc.danh_muc_id;
                    this.danh_muc.tieu_de = danhmuc.tieu_de;
                    this.danh_muc.danh_muc_cha = danhmuc.danh_muc_cha;
                    this.danh_muc.tomtat = danhmuc.tomtat;
                    this.danh_muc.hienthi = danhmuc.hienthi;
                    // this.danh_muc.created_at = danhmuc.created_at;
                    this.danh_muc.ghi_chu = danhmuc.ghi_chu;
                }
            },
            submit_danh_muc: function () {
                this.change_bnt_save();
                if(this.flag_submit_danh_muc) {
                    this.flag_input_danh_muc = false;
                    this.add_danh_muc();
                }
                else {
                    this.nhom = this.nhom_selected;
                    this.flag_input_danh_muc = true;
                    this.edit_danh_muc();
                }
            },
            click_danh_muc: function (bp) {
                $('.row-nhom').removeClass("active-click-row");
                $('#n' + bp.id).addClass("active-click-row");
            },
            add_danh_muc: function () {
                api_add_danh_muc(this);
            },
            edit_danh_muc: function() {
                api_edit_danh_muc(this);
            },
            delete_danh_muc: function(danhmuc) {
                this.danh_muc = danhmuc;
                if(this.danh_muc.id <= 0) return -1;
                api_delete_danh_muc(this);
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
                // console.log('editor blur!', quill)
            },
            onEditorFocus(quill) {
                // console.log('editor focus!', quill)
            },
            onEditorReady(quill) {
                // console.log('editor ready!', quill)
            },
            onEditorChange({ quill, html, text }) {
                // console.log('editor change!', quill, html, text)
                // this.content = html
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
</style>