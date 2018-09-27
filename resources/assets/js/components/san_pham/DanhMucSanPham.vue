<template>
    <div class="page-wrapper" style="min-height: 291px;">
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12 lamlam">
                    <div class="card content-lam">
                        <div class="card-header">
                            <div class="card-actions">
                                <!--<a @click="_bo_phan('add')" title="Thêm mới bộ phận" data-toggle="modal" data-target="#myModal" class="btn btn-success waves-effect waves-dark btn-white" style="color: white"><i class="fa fa-plus-circle"></i> Thêm mới</a>-->
                                <a @click="scroll_card" id="thunho" class="" data-action="collapse"><i class="ti-minus"></i></a>
                                <a @click="scroll_card_full_creem" id="phongto" class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                <!--<a class="btn-close" data-action="close"><i class="ti-close"></i></a>-->
                            </div>
                            <h4 class="card-title m-b-0">Danh mục sản phẩm</h4>
                            <!--<h6 class="card-subtitle m-0 op-5">Tổng số bộ phận: {{total_bo_phan}}</h6>-->
                        </div>
                        <div class="card-body collapse show">
                            <div class="message-box contact-box">
                                <div class="message-widget contact-widget">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Tên danh mục(*)</label>
                                                <div class="col-md-10">
                                                    <input v-model="danh_muc.tieu_de" type="text" id="tieu_de" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Danh mục cha(*)</label>
                                                <div class="col-md-10">
                                                    <select name="" size="8" class="form-control form-control-sm" id="">
                                                        <option value="">ROOT</option>
                                                        <option value="">May in</option>
                                                        <option value="">|--May in 1</option>
                                                        <option value="">May in</option>
                                                        <option value="">|--May in 2</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Mô tả(*)</label>
                                                <div class="col-md-10">
                                                    <quill-editor v-model="danh_muc.tom_tat"
                                                                  ref="myQuillEditor"
                                                                  :options="editorOption"
                                                                  @blur="onEditorBlur($event)"
                                                                  @focus="onEditorFocus($event)"
                                                                  @ready="onEditorReady($event)">
                                                    </quill-editor>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Hiển thị(*)</label>
                                                <div class="col-md-10">
                                                    <div class="demo-checkbox" style="margin-top: 5px;">
                                                        <input type="checkbox" id="md_checkbox_26" class="filled-in chk-col-blue" checked />
                                                        <label for="md_checkbox_26"></label>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Ngày tạo(*)</label>
                                                <div class="col-md-10">
                                                    <el-date-picker
                                                            v-model="danh_muc.created_at"
                                                            type="date"
                                                            placeholder="Pick a day">
                                                    </el-date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-primary waves-effect waves-dark btn-white pull-right"><i class="fa fa-save"></i> Lưu lại</button>
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
    import VueCkeditor from 'vue-ckeditor2';
    import '../../../../../node_modules/quill/dist/quill.core.css'
    import '../../../../../node_modules/quill/dist/quill.snow.css'
    import '../../../../../node_modules/quill/dist/quill.bubble.css'

    import { quillEditor } from 'vue-quill-editor';

    import {api_bophan_get} from '../nhan_su/bophan/bo_phan';
    import {api_add_bo_phan} from "../nhan_su/bophan/bo_phan";
    import {api_edit_bo_phan} from "../nhan_su/bophan/bo_phan";
    import {api_delete_bo_phan} from "../nhan_su/bophan/bo_phan";

    export default {
        name: 'bophan',
        mounted () {
            this.danh_sach_bo_phan();
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
                list_danh_muc: [],
                danh_muc: {danh_muc_id: '', danh_muc_cha: '', tieu_de: '', tom_tat: '', created_at: Date.now()},
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
                this.content = html
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

    .col-form-label {
        font-size: 13px;
    }
</style>