<template id="danhsachnhanvien">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <form @submit.prevent="submit_search_thong_tin_nhan_vien">
                                    <input v-model="key_word" type="text" id="timkiem" class="form-control" placeholder="Nhập từ khóa để tìm kiếm...">
                                    <button type="submit" class="btn btn-info btn-sm btntimkiem" name="button">Tìm kiếm</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button @click="_nhan_vien('add')" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal_nv_tt_ca_nhan"><i class="fa fa-plus-circle"></i> Thêm mới</button>

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
                                                    <div class="col-md-10" style="float: left">
                                                        <div class="form-group row">
                                                            <label class="label-form col-md-2 col-form-label">Mã NV(*)</label>
                                                            <div class="col-md-4">
                                                                <input :disabled="flag_input_nhan_vien_tt" v-model="nhan_vien.ma_nv" @input="validate_ma_nv" v-on:keypress="disable_spaces" v-bind:maxlength="7" name="txtma_nv" type="text" class="form-control form-control-sm" id="manv" v-validate="'required'" :class="{'border-danger' : flag_input_ma_nv}">
                                                                <!--<small v-show="errors.has('txtma_nv')" class="help text-muted is-danger">Vui lòng nhập mã NV</small>-->
                                                                <small v-if="flag_input_ma_nv" class="help text-muted is-danger">Mã NV phải có 7 ký tự, bắt đầu bằng KH</small>
                                                            </div>

                                                            <label class="label-form col-md-2 col-form-label">Giới tính</label>
                                                            <div class="col-md-5">
                                                                <!--<select v-model="nhan_vien.gioi_tinh" name="" id="" class="form-control form-control-sm">-->
                                                                    <!--<option value="0" :selected="true">Nữ</option>-->
                                                                    <!--<option value="1">Nam</option>-->
                                                                <!--</select>-->
                                                                <el-radio-group v-model="nhan_vien.gioi_tinh" style="width: 49%">
                                                                    <el-radio :label="0">Nữ</el-radio>
                                                                    <el-radio :label="1">Nam</el-radio>
                                                                </el-radio-group>

                                                                <el-select v-model="nhan_vien.tinh_trang"  size="small" placeholder="Tình trạng" style="width: 49%">
                                                                    <el-option :label="'Thử việc'" :value="0"></el-option>
                                                                    <el-option :label="'Chính thức'" :value="1"></el-option>
                                                                    <el-option :label="'Thôi việc'" :value="2"></el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="label-form col-md-2 col-form-label">Họ tên</label>
                                                            <div class="col-md-4">
                                                                <input v-model="nhan_vien.ho_ten" name="txthoten" type="text" class="form-control form-control-sm" id="txthoten" v-validate="'required'" :class="{'border-danger' : errors.has('txthoten')}">
                                                                <small v-show="errors.has('txthoten')" class="help text-muted is-danger">Vui lòng nhập tên nhân viên</small>
                                                            </div>

                                                            <label class="label-form col-md-2 col-form-label">Ngày sinh</label>
                                                            <div class="col-md-5">
                                                                <input v-model="nhan_vien.ngay_sinh" type="date" class="form-control form-control-sm" id="sss" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="label-form col-md-2 col-form-label">Quốc tịch</label>

                                                            <!--<input v-model="nhan_vien.noi_sinh" type="text" class="form-control form-control-sm" id="dd1" placeholder="">-->
                                                            <div class="col-md-4">
                                                                <input v-model="nhan_vien.quoc_tich" type="text" class="form-control form-control-sm" id="1aaa" placeholder="">
                                                            </div>

                                                            <label class="label-form col-md-2 col-form-label">Nơi sinh</label>
                                                            <div class="col-md-5">
                                                                <el-select v-model="nv_noi_sinh.tinh_thanh" filterable size="small" placeholder="Tỉnh thành phố" @change="load_quan_huyen_noi_sinh" style="width: 49%;" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                                    <el-option
                                                                            v-for="item in list_tinh_thanh"
                                                                            :key="item.ma_tinh"
                                                                            :label="item.ten_tinh"
                                                                            :value="item.ma_tinh">
                                                                    </el-option>
                                                                </el-select>

                                                                <el-select v-model="nv_noi_sinh.quan_huyen" value-key="ma_quan_huyen" filterable size="small" placeholder="Quận huyện" style="width: 49%;margin-left: 1px;" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                                    <el-option
                                                                            v-for="item in change_quan_huyen_noi_sinh"
                                                                            :key="item.ma_quan_huyen"
                                                                            :label="item.ten_quan_huyen"
                                                                            :value="item.ten_quan_huyen">
                                                                    </el-option>
                                                                </el-select>
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
                                                                <!--<button style="width: 106px;" class="btn btn-sm">Chọn ảnh</button>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="label-form col-md-2 col-form-label">Số CMND</label>
                                                            <div class="col-md-10">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <input v-model="nhan_vien.so_cmnd" v-on:keypress="only_number_input" name="txtsocmnd" type="text" class="form-control form-control-sm" id="txtsocmnd" v-validate="'required'" :class="{'border-danger' : errors.has('txtsocmnd')}">
                                                                        <small v-show="errors.has('txtsocmnd')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>
                                                                    </div>

                                                                    <label class="label-form col-md-2 col-form-label">Ngày cấp</label>
                                                                    <div class="col-md-3">
                                                                        <input v-model="nhan_vien.scmnd_ngay_cap" name="scmnd_ngay_cap" type="date" class="form-control form-control-sm" id="scmnd_ngay_cap" placeholder="">
                                                                    </div>

                                                                    <label class="label-form col-md-2 col-form-label">Nơi cấp</label>
                                                                    <div class="col-md-3 chuan-input">
                                                                        <el-select v-model="nhan_vien.scmnd_noi_cap" filterable size="small" placeholder="Chọn tỉnh thành phố" style="width: 100%" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                                            <el-option
                                                                                    v-for="item in list_tinh_thanh"
                                                                                    :key="item.ma_tinh"
                                                                                    :label="item.ten_tinh"
                                                                                    :value="item.ten_tinh">
                                                                            </el-option>
                                                                        </el-select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row address">
                                                            <label class="label-form col-md-2 col-form-label">Tạm trú</label>
                                                            <div class="col-md-10">
                                                                <input v-model="nhan_vien.tam_tru" name="txttamtru" class="form-control form-control-sm" style="width: 100%;"/>
                                                            </div>

                                                            <label class="label-form col-md-2 col-form-label"></label>
                                                            <div class="col-md-3">
                                                                <el-select v-model="nv_tam_tru.tinh_thanh" value-key="ma_tinh" filterable size="small" placeholder="Tỉnh thành phố" @change="load_quan_huyen(nv_tam_tru.tinh_thanh,1)" style="width: 100%" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                                    <el-option v-for="item in list_tinh_thanh" :key="item.ma_tinh" :label="item.ten_tinh" :value="item">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                            <!--<label class="label-form col-md-2 col-form-label"></label>-->
                                                            <div class="col-md-3">
                                                                <el-select v-model="nv_tam_tru.quan_huyen" @change="load_phuong_xa(nv_tam_tru.quan_huyen,1)" value-key="ma_quan_huyen" :disabled="!nv_tam_tru.tinh_thanh" filterable size="small" placeholder="Quận huyện" style="width: 100%;" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                                    <el-option v-for="item in change_quan_huyen" :key="item.ma_quan_huyen" :label="item.ten_quan_huyen" :value="item">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <el-select v-model="nv_tam_tru.phuong_xa" value-key="phuongxa_id" :disabled="!nv_tam_tru.tinh_thanh || !nv_tam_tru.quan_huyen" filterable size="small" placeholder="Phường xã" style="width: 100%;" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                                    <!--<el-option v-if="change_phuong_xa.length==0" :label="'Chưa có phường xã'" :value="''"></el-option>-->
                                                                    <el-option v-for="item in change_phuong_xa" :key="item.phuongxa_id" :label="item.ten_phuong_xa" :value="item">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row address">
                                                            <label class="label-form col-md-2 col-form-label">Thường trú</label>
                                                            <div class="col-md-10">
                                                                <input v-model="nhan_vien.thuong_tru" name="txttamtru" class="form-control form-control-sm" style="width: 100%;"/>
                                                            </div>
                                                            <label class="label-form col-md-2 col-form-label"></label>
                                                            <div class="col-md-3">
                                                                <el-select v-model="nv_thuong_tru.tinh_thanh" value-key="ma_tinh" filterable size="small" placeholder="Tỉnh thành phố" @change="load_quan_huyen(nv_thuong_tru.tinh_thanh,2)" style="width: 100%" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                                    <el-option
                                                                            v-for="item in list_tinh_thanh"
                                                                            :key="item.ma_tinh"
                                                                            :label="item.ten_tinh"
                                                                            :value="item">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <el-select v-model="nv_thuong_tru.quan_huyen" @change="load_phuong_xa(nv_thuong_tru.quan_huyen,2)" :disabled="!nv_thuong_tru.quan_huyen" value-key="ma_quan_huyen" filterable size="small" placeholder="Quận huyện" style="width: 100%;" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                                    <el-option
                                                                            v-for="item in change_quan_huyen"
                                                                            :key="item.ma_quan_huyen"
                                                                            :label="item.ten_quan_huyen"
                                                                            :value="item">
                                                                    </el-option>
                                                                </el-select>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <el-select v-model="nv_thuong_tru.phuong_xa" value-key="phuongxa_id" :disabled="!nv_thuong_tru.phuong_xa" filterable size="small" placeholder="Phường xã" style="width: 100%;" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
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
                                                            <label class="label-form col-md-2 col-form-label">ĐT bàn</label>
                                                            <div class="col-md-10">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <input v-model="nhan_vien.dt_ban" v-on:keypress="only_number_input" name="txtdtban" type="text" class="form-control form-control-sm" placeholder="">
                                                                    </div>

                                                                    <label class="label-form col-md-2 col-form-label">Di động 1</label>
                                                                    <div class="col-md-3">
                                                                        <input v-model="nhan_vien.di_dong_1" v-on:keypress="only_number_input" name="txtdtban" type="text" class="form-control form-control-sm" placeholder="">
                                                                    </div>

                                                                    <label class="label-form col-md-2 col-form-label">Di động 2</label>
                                                                    <div class="col-md-3 chuan-input">
                                                                        <input v-model="nhan_vien.di_dong_2" v-on:keypress="only_number_input" name="txtdtban" type="text" class="form-control form-control-sm" placeholder="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="label-form col-md-2 col-form-label">MST CN</label>
                                                            <div class="col-md-10">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <input v-model="nhan_vien.mst_cn" v-on:keypress="only_number_input" type="text" name="txtmst_cn" class="form-control form-control-sm" id="txtmst_cn" placeholder="">
                                                                    </div>

                                                                    <label class="label-form col-md-2 col-form-label">Nơi cấp</label>
                                                                    <div class="col-md-3">
                                                                        <el-select v-model="nhan_vien.mst_cn_noi_cap" filterable size="small" placeholder="Chọn tỉnh thành phố" style="width: 100%" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                                            <el-option
                                                                                    v-for="item in list_tinh_thanh"
                                                                                    :key="item.ma_tinh"
                                                                                    :label="item.ten_tinh"
                                                                                    :value="item.ten_tinh">
                                                                            </el-option>
                                                                        </el-select>
                                                                    </div>

                                                                    <label class="label-form col-md-2 col-form-label" style="padding-right: 0">C/C Thuế cấp</label>
                                                                    <div class="col-md-3 chuan-input">
                                                                        <input v-model="nhan_vien.cc_thue_cap" type="text" name="txtccthuecap" class="form-control form-control-sm" id="txtccthuecap" placeholder="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                <button :disabled="flag_disabled_tt_ca_nhan" id="save" type="submit" class="btn btn-primary">
                                                    <span v-if="flag_xu_ly_tt_ca_nhan"><i class="fa fa-save"></i> Lưu lại</span>
                                                    <span v-if="!flag_xu_ly_tt_ca_nhan"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</span>
                                                </button>
                                                <!--<button @click="upload_img" id="anh" type="" class="btn btn-primary">Lưu ảnh</button>-->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table v-on:scroll="scroll_table" class="table table-hover table-fixed" id="table_nhanvien">
                            <thead>
                                <tr style="border-top: 1px solid #ddd;">
                                    <th class="text-center">#</th>
                                    <th class="text-center" style="width: 50px;">TT</th>
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
                                    <th>C/C TC</th>
                                    <th>Nơi cấp</th>
                                    <th class="text-center">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="loading_dsnv"><td colspan="17" class=""><b><i class="fa fa-spin fa-spinner"></i> Đang tải danh sách...</b></td></tr>
                                <tr v-if="dsnhanvien.length>0" v-for="(n, index) in dsnhanvien">
                                    <td class="text-nowrap">
                                        <button @click="_nhan_vien('edit', n)" data-toggle="modal" data-target="#modal_nv_tt_ca_nhan" class="btn btn-info btn-sm" title="Cập nhật thông tin cá nhân"> <i class="fa fa-edit"></i> </button>
                                        <!--<button @click="_lao_dong(n)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_nv_tt_lao_dong" title="Thông tin lao động"><i class="fa fa-address-book-o"></i></button>-->
                                        <!--<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_nv_tt_cong_viec" title="Thông tin công việc hiện tại"><i class="fa fa-id-card-o"></i></button>-->
                                        <button @click="delete_all_thong_tin_nv(n.id)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                    </td>
                                    <td class="text-center">{{index + 1}}</td>
                                    <td style="width:100px;">{{n.ma_nv}}</td>
                                    <td>{{n.ho_ten}}</td>
                                    <td><span v-if="n.gioi_tinh">Nam</span><span v-else>Nữ</span></td>
                                    <td>{{n.ngay_sinh}}</td>
                                    <td>{{n.noi_sinh}}</td>
                                    <td>{{n.so_cmnd}}</td>
                                    <td>{{n.scmnd_ngay_cap}}</td>
                                    <td>{{n.scmnd_noi_cap}}</td>
                                    <td class="hidden-text" style="width:400px;">{{n.ten_tinh}}, {{n.ten_quan_huyen}}, {{n.ten_phuong_xa}}, {{n.tam_tru}}</td>
                                    <td class="hidden-text" style="width:400px;">{{n.thuong_tru}}</td>
                                    <td>{{n.dt_ban}}</td>
                                    <td>{{n.di_dong_1}}</td>
                                    <td>{{n.di_dong_2}}</td>
                                    <td>{{n.mst_cn}}</td>
                                    <td>{{n.cc_thue_cap}}</td>
                                    <td>{{n.mst_cn_noi_cap}}</td>
                                    <td v-if="n.tinh_trang == 0" class="text-center">Thử việc</td><td v-else-if="n.tinh_trang==1" class="text-center">Chính thức</td><td v-else class="text-center">Thôi việc</td>
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
    import {api_edit_nhan_vien_thong_tin_ca_nhan} from "./nhan_vien";
    import {api_add_nhan_vien_thong_tin_lao_dong} from "./nhan_vien";
    import {api_get_nhan_vien_thong_tin_lao_dong} from "./nhan_vien";
    import {api_search_thong_tin_nhan_vien} from "./nhan_vien";
    import {api_delete_all_thong_tin_nhan_vien} from "./nhan_vien";

    import {api_get_tinh} from "../../../helper/tinh_thanh";
    import {api_get_quan_huyen} from "../../../helper/tinh_thanh";
    import {api_get_phuong_xa} from "../../../helper/tinh_thanh";
    import {api_get_item_phuong_xa_tam_tru} from "../../../helper/tinh_thanh";
    import {api_get_item_phuong_xa_thuong_tru} from "../../../helper/tinh_thanh";
    import {api_get_item_phuong_xa_nhan_vien} from "../../../helper/tinh_thanh";


    import {api_get_all_bo_phan} from "../bophan/bo_phan";

    export default {
        name: 'danhsachnhanvien',
        created () {
            api_get_tinh(this);
            api_get_quan_huyen(this);
            api_get_phuong_xa(this);
        },
        mounted () {
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
                list_tinh_thanh: [],
                tinh_thanh: null,
                value: null,
                list_quan_huyen: [],
                change_quan_huyen: [],
                quan_huyen: '',
                list_phuong_xa: [],
                change_phuong_xa: [],
                phuong_xa: '',
                change_quan_huyen_noi_sinh: [],
                nv_noi_sinh: {tinh_thanh: '', quan_huyen: ''},
                nv_tam_tru: {tinh_thanh: '', quan_huyen: '', phuong_xa: ''},
                nv_thuong_tru: {tinh_thanh: '', quan_huyen: '', phuong_xa: ''},
                loading_bo_phan: true,
                flag_input_ma_nv: false,
                dsnhanvien: [],
                key_word: '',
                dsnhanvien_total: 0,
                loading_dsnv: false,
                flag_search: false,
                flag_submit_nhan_vien_tt_ca_nhan: true,
                flag_disabled_tt_ca_nhan: false,
                flag_input_nhan_vien_tt: false,
                flag_xu_ly_tt_ca_nhan: true,
                nhan_vien: {
                    id: 0,
                    ma_nv: '',
                    ho_ten: '',
                    ngay_sinh: '',
                    noi_sinh: '',
                    noi_sinh_tinh_thanh: '',
                    noi_sinh_quan_huyen: '',
                    quoc_tich: '',
                    gioi_tinh: 'Việt Nam',
                    so_cmnd: '',
                    scmnd_noi_cap: '',
                    scmnd_ngay_cap: '',
                    thuong_tru: '',
                    thuong_tru_tinh_thanh: '',
                    thuong_tru_quan_huyen: '',
                    tam_tru: '',
                    tam_tru_tinh_thanh: '',
                    tam_tru_quan_huyen: '',
                    di_dong_1: '',
                    di_dong_2: '',
                    dt_ban: '',
                    mst_cn: '',
                    mst_cn_noi_cap: '',
                    cc_thue_cap: '',
                    avatar: '',
                    image: '',
                    tinh_trang: 0,
                    tam_tru_tinh_thanh: '',
                    thuong_tru_tinh_thanh: ''
                },
                loading_lao_dong: true,
                flag_xu_ly_tt_lao_dong: true,
                flag_form_cong_viec: false,
                list_bo_phan: [],
                list_phong_ban: [],
                list_vi_tri: [],
                nhan_vien_tinh_trang: [
                    { label: 'Thử việc', value: 0 },
                    { label: 'Chính thức', value: 1 },
                    { label: 'Thôi việc', value: 2 },
                ]
            }
        },
        methods: {
            load_quan_huyen_noi_sinh: function (ma_tinh) {
                this.change_quan_huyen_noi_sinh = this.list_quan_huyen.filter(function(item){
                    return (item['ma_tinh'] == ma_tinh);
                })
                this.nv_tam_tru.quan_huyen = '';
            },
            load_quan_huyen: function (tinh, type) {
                if(type == 1){ this.nv_tam_tru.quan_huyen = ''; }
                else if(type==2){this.nv_thuong_tru.quan_huyen = '';}
                this.change_quan_huyen = this.list_quan_huyen.filter(function(item){
                    return (item['ma_tinh'] == tinh.ma_tinh);
                })
            },
            load_phuong_xa: function (quan_huyen, type) {
                if(type == 1){ this.nv_tam_tru.phuong_xa = ''; }
                else if(type==2){this.nv_thuong_tru.phuong_xa = '';}
                this.change_phuong_xa = this.list_phuong_xa.filter(function(item){
                    return (item['quanhuyen_id'] == quan_huyen.ma_quan_huyen);
                })
            },
            show_select_lam: function (data_select, id_select) {
                $('#' + id_select).val(data_select.ten_bo_phan);
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
            validate_ma_nv: function () {
                var length_nv = this.nhan_vien.ma_nv.length;
                var value_nv  = this.nhan_vien.ma_nv;
                if((length_nv > 7 || length_nv < 7) || value_nv.indexOf('KH') == -1 || value_nv.indexOf(' ') > -1){
                    this.flag_input_ma_nv = true;
                    this.flag_disabled_tt_ca_nhan = true;
                }
                else{
                    this.flag_input_ma_nv = false;
                    this.flag_disabled_tt_ca_nhan = false;
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
            onFileChange: function (e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length) return;
                this.createImage(files[0]);
                let reader = new FileReader();
            },
            createImage: function(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.nhan_vien.image = e.target.result;
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                    console.log(vm.nhan_vien.image);
                };
                reader.readAsDataURL(file);
            },
            delete_all_thong_tin_nv: function (id_nhan_vien) {
                api_delete_all_thong_tin_nhan_vien(this, id_nhan_vien);
            },
            getNhanVien(page = 1) {
                this.loading_dsnv = true;
                if(this.flag_search){
                    api_search_thong_tin_nhan_vien(this, page);
                }
                else{
                    api_get_nhan_vien(this, page);
                }
            },
            add_nhan_vien_thong_tin_ca_nhan: function () {
                api_add_nhan_vien_thong_tin_ca_nhan(this);
            },
            edit_nhan_vien_thong_tin_ca_nhan: function () {
                api_edit_nhan_vien_thong_tin_ca_nhan(this);
            },
            _nhan_vien: function (state, nv= null) {
                if(state == 'add') {
                    this.flag_submit_nhan_vien_tt_ca_nhan = true;
                    this.flag_input_nhan_vien_tt = false;
                    $('#wizardPicturePreview').attr('src', 'https://cdn0.vox-cdn.com/images/verge/default-avatar.v9899025.gif').fadeIn('slow');
                    this.nhan_vien = {
                        id: 0,
                        ma_nv: '',
                        ho_ten: '',
                        ngay_sinh: '',
                        noi_sinh: '',
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
                        image: '',
                        quoc_tich: 'Việt Nam'
                    }
                    this.nv_tam_tru.quan_huyen = this.nv_tam_tru.tinh_thanh = this.nv_tam_tru.phuong_xa = '';
                    this.nv_thuong_tru.quan_huyen = this.nv_thuong_tru.tinh_thanh = this.nv_thuong_tru.phuong_xa = '';
                }
                else {
                    api_get_item_phuong_xa_nhan_vien(this, nv.ma_tinh, nv.ma_quan_huyen, nv.phuongxa_id,1);
                    api_get_item_phuong_xa_nhan_vien(this, nv.ma_tinh, nv.ma_quan_huyen, nv.phuongxa_id,2);
                    var lma = this.list_tinh_thanh.filter(function (item) {
                        return (item['ma_tinh'] == nv.scmnd_noi_cap);
                    });
                    // this.nv_noi_sinh.tinh_thanh = nv.noi_sinh.slice(0,nv.noi_sinh.indexOf(','));
                    // this.nv_noi_sinh.quan_huyen = nv.noi_sinh.slice(nv.noi_sinh.indexOf(',') + 1, nv.noi_sinh.length)
                    // console.log(lma);
                    this.value = lma[0];
                    this.nhan_vien = nv;
                    if (nv.avatar != null){
                        $('#wizardPicturePreview').attr('src', 'public/image_nhan_vien/' + nv.avatar).fadeIn('slow');
                    }else{$('#wizardPicturePreview').attr('src', 'https://cdn0.vox-cdn.com/images/verge/default-avatar.v9899025.gif').fadeIn('slow');}
                    this.flag_submit_nhan_vien_tt_ca_nhan = false;
                    this.flag_input_nhan_vien_tt = true;
                }
            },
            submit_nhan_vien_thong_tin_ca_nhan: function () {
                this.nhan_vien.tam_tru_tinh_thanh = this.nv_tam_tru.phuong_xa.phuongxa_id;
                this.nhan_vien.thuong_tru_tinh_thanh = this.nv_thuong_tru.phuong_xa.phuongxa_id;
                this.change_bnt_save('save');
                if(this.flag_submit_nhan_vien_tt_ca_nhan) {
                    this.flag_input_nhan_vien_tt = false;
                    this.add_nhan_vien_thong_tin_ca_nhan();
                }
                else {
                    this.change_bnt_save('save');
                    this.nhom = this.nhom_selected;
                    this.flag_input_nhan_vien_tt = true;
                    this.edit_nhan_vien_thong_tin_ca_nhan();
                }
            },
            change_bnt_save: function (id_btn) {
                this.flag_xu_ly_tt_ca_nhan = false;
                $('#' + id_btn).attr('disabled', 'disabled');
            },
            un_change_bnt_save: function (id_btn) {
                this.flag_xu_ly_tt_ca_nhan = true;
                $('#' + id_btn).removeAttr('disabled');
            },
            upload_img: function () {
                // console.log(this.nhan_vien.image);
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
            },
            _lao_dong: function (nv) {
                this.loading_lao_dong = true;
                api_get_nhan_vien_thong_tin_lao_dong(this, nv.id);
            },
            submit_nhan_vien_thong_tin_lao_dong: function () {
                this.change_bnt_save('save2');
                api_add_nhan_vien_thong_tin_lao_dong(this);
            },
            _cong_viec_show_hide: function (state) {
                this.flag_form_cong_viec = true;
                api_get_all_bo_phan(this);
            },
            submit_nhan_vien_thong_tin_cong_viec: function (id) {
                console.log("Dang submit day" + id);
            },
            submit_search_thong_tin_nhan_vien: function () {
                this.loading_dsnv = true;
                if(this.key_word == '' || this.key_word == null){ this.flag_search = false; this.getNhanVien()  }
                this.flag_search = true;
                api_search_thong_tin_nhan_vien(this, 1);
            },
            scroll_table: function () {
                $('table').on('scroll', function () {
                    $("#"+this.id+" > *").width($(this).width() + $(this).scrollLeft());
                });
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
        margin-bottom: 5px;
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

    #form_nhan_vien_thong_tin_lao_dong .modal-lao-dong {
        height: 100%;
        width: 100%;
        background-color: white;
    }

    #form_nhan_vien_thong_tin_lao_dong .modal-lao-dong::before {
        height: 100%;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }

    .modal-cong-viec{
        background-color: #ddddff;
        max-height: 480px;
        overflow: auto;
    }

    .btn-cong-viec-sub{
        color: #fff;
    }

    .btn-cong-viec-cancel {
        color: #fff;
    }

    .select-lam {
        position: relative !important;
    }
    .select-lam:hover .body-select-lam {
        display: block;
    }

    .body-select-lam {
        position: absolute;
        top: 33px;
        left: 0;
        width: 100%;
        z-index: 200;
        max-height: 200px;
        overflow-y: auto;
        display: none;
        transition: ease;
    }

    .body-select-lam ul {
        padding: 0;
        border: 1px solid #ddddff;
        background-color: #fff;
        font-size: 13px;
        color: black;
        font-weight: 500;
    }

    .body-select-lam ul li {
        list-style-type: none;
        padding: 5px;
        cursor: pointer;
    }

    .body-select-lam ul li:hover {
        background-color: #ddd;
    }

    .active-select-lamv {
        display: block;
    }

    @media (min-width: 992px) {
        .modal-lg {
            max-width: 1000px !important;
        }
        .chuan {
            padding-right: 0;
            margin-left: 2px;
        }
        .chuan-input {
            margin-left: 7px;
        }

        .address{
            margin-bottom: 10px;
        }
    }
    .el-radio-group {
        padding-top: 8px;
    }

    table {
        border-collapse: collapse;
        width: 3000px;
        overflow-x: scroll;
        display: block;
    }
    thead {
        /*background-color: #EFEFEF;*/
    }
    thead, tbody {
        display: block;
    }
    tbody {
        overflow-y: scroll;
        overflow-x: hidden;
        height: 300px;
    }
    td{
        /*min-width: 200px;*/
        height: 25px;
        /*border: dashed 1px lightblue;*/
        overflow:hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    /*#table_nhanvien {*/

    /*}*/

    #table_nhanvien tr td:nth-child(1){
        min-width: 100px;
        max-width: 100px;
    }

    #table_nhanvien tr td:nth-child(2){
        min-width: 50px;
        max-width: 50px;
    }

    #table_nhanvien tr td:nth-child(3){
        min-width: 100px;
        max-width: 100px;
    }

    #table_nhanvien tr td:nth-child(4){
        min-width: 200px;
        max-width: 200px;
    }

    #table_nhanvien tr td:nth-child(5){
        min-width: 100px;
    }

    #table_nhanvien tr td:nth-child(6){
        min-width: 120px;
        max-width: 120px;
    }

    #table_nhanvien tr td:nth-child(7){
        min-width: 220px;
        max-width: 220px;
    }

    #table_nhanvien tr td:nth-child(8){
        min-width: 120px;
        max-width: 120px;
    }

    #table_nhanvien tr td:nth-child(9){
        min-width: 105px;
    }

    #table_nhanvien tr td:nth-child(10){
        min-width: 150px;
    }

    #table_nhanvien tr td:nth-child(11){
        min-width: 300px;
        max-width: 300px;
    }

    #table_nhanvien tr td:nth-child(12){
        min-width: 300px;
        max-width: 300px;
    }

    #table_nhanvien tr td:nth-child(13){
        min-width: 120px;
        max-width: 120px;
    }

    #table_nhanvien tr td:nth-child(14){
        min-width: 120px;
        max-width: 120px;
    }

    #table_nhanvien tr td:nth-child(15){
        min-width: 120px;
        max-width: 120px;
    }

    #table_nhanvien tr td:nth-child(16){
        min-width: 120px;
        max-width: 120px;
    }

    #table_nhanvien tr td:nth-child(17){
        min-width: 120px;
        max-width: 120px;
    }

    #table_nhanvien tr td:nth-child(18){
        min-width: 300px;
        max-width: 300px;
    }

    #table_nhanvien tr td:nth-child(19){
        min-width: 120px;
        max-width: 120px;
    }


</style>
