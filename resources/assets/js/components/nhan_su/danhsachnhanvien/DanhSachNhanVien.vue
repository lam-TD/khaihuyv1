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
                            <!-- Modal thong tin ca nhan -->
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
                                                                <input :disabled="flag_input_nhan_vien_tt" v-model="nhan_vien.ma_nv" name="txtma_nv" type="text" class="form-control form-control-sm" id="manv" v-validate="'required'" :class="{'border-danger' : errors.has('txtma_nv')}">
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
                                                <button id="save" type="submit" class="btn btn-primary">
                                                    <span v-if="flag_xu_ly_tt_ca_nhan"><i class="fa fa-save"></i> Lưu lại</span>
                                                    <span v-if="!flag_xu_ly_tt_ca_nhan"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</span>
                                                </button>
                                                <!--<button @click="upload_img" id="anh" type="" class="btn btn-primary">Lưu ảnh</button>-->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal thong tin lao dong -->
                            <div class="modal" id="modal_nv_tt_lao_dong"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabe2"><b>Thông tin lao động</b></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form @submit.prevent="submit_nhan_vien_thong_tin_lao_dong" id="form_nhan_vien_thong_tin_lao_dong">
                                            <div v-loading="loading_lao_dong" class="modal-body modal-lao-dong">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Vào công ty</label>
                                                        <input v-model="lao_dong.vao_cty" name="txtvaocty" type="text" class="form-control form-control-sm" id="s" v-validate="'required'" :class="{'border-danger' : errors.has('txtvaocty')}">
                                                        <small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Thôi việc</label>
                                                        <input v-model="lao_dong.thoi_viec" name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" id="1" placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="label-form"></label>
                                                        <input readonly class="form-control form-control-sm" value="Tổng thời gian làm việc">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="label-form">Năm</label>
                                                        <input v-model="lao_dong.nam" name="scmnd_noi_cap" type="text" class="form-control form-control-sm" id="121" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label class="label-form">Tháng</label>
                                                        <input v-model="lao_dong.thang" name="scmnd_noi_cap" type="text" class="form-control form-control-sm" id="32" placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="label-form">Ngày</label>
                                                        <input v-model="lao_dong.ngay" name="scmnd_noi_cap" type="text" class="form-control form-control-sm" id="56" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Số HĐLĐ</label>
                                                        <input v-model="lao_dong.so_hdld" name="txtvaocty" type="text" class="form-control form-control-sm" id="txtv6r56aocty" v-validate="'required'" :class="{'border-danger' : errors.has('txtvaocty')}">
                                                        <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Ngày ký</label>
                                                        <input v-model="lao_dong.ngay_ky" name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" id="56544" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Thời hạn</label>
                                                        <input v-model="lao_dong.thoi_han" name="txtvaocty" type="text" class="form-control form-control-sm" id="txtvtaocty" v-validate="'required'" :class="{'border-danger' : errors.has('txtvaocty')}">
                                                        <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Hết hạn</label>
                                                        <input v-model="lao_dong.het_han" name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" id="tscmnd_ngay_cap" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Số BHXH</label>
                                                        <input v-model="lao_dong.so_bhxh" name="txtvaocty" type="text" class="form-control form-control-sm" id="txtvareeocty" v-validate="'required'" :class="{'border-danger' : errors.has('txtvaocty')}">
                                                        <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Số BHYT</label>
                                                        <input v-model="lao_dong.so_bhyt" name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" id="scmend_ngay_cap" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Nơi khám</label>
                                                        <input v-model="lao_dong.noi_kham" name="txtvaocty" type="text" class="form-control form-control-sm" id="t45xtvaocty" v-validate="'required'" :class="{'border-danger' : errors.has('txtvaocty')}">
                                                        <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Địa chỉ khám</label>
                                                        <input v-model="lao_dong.dia_chi_kham" name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" id="scmn545d_ngay_cap" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label class="label-form">Ghi chú</label>
                                                        <input v-model="lao_dong.ghi_chu" name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" id="scmnd545_ngay_cap" placeholder="">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                <button id="save2" type="submit" class="btn btn-primary">
                                                    <span v-if="flag_xu_ly_tt_ca_nhan"><i class="fa fa-save"></i> Lưu lại</span>
                                                    <span v-if="!flag_xu_ly_tt_ca_nhan"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</span>
                                                </button>
                                                <!--<button @click="upload_img" id="anh" type="" class="btn btn-primary">Lưu ảnh</button>-->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- END Modal thong tin lao dong -->

                            <!-- Modal thong tin cong viec -->
                            <div class="modal" id="modal_nv_tt_cong_viec"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabe3"><b>Thông tin công việc</b></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form @submit.prevent="submit_nhan_vien_thong_tin_cong_viec" id="form_nhan_vien_thong_tin_cong_viec">
                                            <div v-loading="false" class="modal-body modal-lao-dong">
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <label class="label-form">EPLV</label>
                                                        <input v-model="cong_viec.id_eplv" name="id_eplv" type="text" class="form-control form-control-sm" id="id_eplv" v-validate="'required'" :class="{'border-danger' : errors.has('id_eplv')}">
                                                        <small v-show="errors.has('id_eplv')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="label-form"></label>
                                                        <input name="scmnd_ngay_cap" type="text" class="form-control form-control-sm" id="1ss" placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="label-form">Phòng</label>
                                                        <input v-model="cong_viec.id_phong" readonly class="form-control form-control-sm" value="">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label class="label-form"></label>
                                                        <input name="scmnd_noi_cap" type="text" class="form-control form-control-sm" id="121d" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Vị trí</label>
                                                        <input v-model="cong_viec.id_vi_tri" name="id_vi_tri" type="text" class="form-control form-control-sm" id="id_vi_tri" placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form"></label>
                                                        <input name="scmnd_noi_cap" type="text" class="form-control form-control-sm" id="5fv6" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Hệ số lương</label>
                                                        <input v-model="cong_viec.he_so" name="he_so" type="text" class="form-control form-control-sm" id="he_so" v-validate="'required'" :class="{'border-danger' : errors.has('he_so')}">
                                                        <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Lương cơ bản</label>
                                                        <input v-model="cong_viec.luong_co_ban" name="luong_co_ban" type="text" class="form-control form-control-sm" id="luong_co_ban" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Lương CVHT</label>
                                                        <input v-model="cong_viec.luong_cvht" name="luong_cvht" type="text" class="form-control form-control-sm" id="luong_cvht" v-validate="'required'" :class="{'border-danger' : errors.has('luong_cvht')}">
                                                        <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Thời gian làm việc</label>
                                                        <input v-model="cong_viec.thoi_gian_lam_viec" name="scmnd_thoi_gian_lam_viecngay_cap" type="text" class="form-control form-control-sm" id="thoi_gian_lam_viec" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Tình trạng</label>
                                                        <input v-model="cong_viec.tinh_trang" name="txtvaocty" type="text" class="form-control form-control-sm" id="txtvareeocty" v-validate="'required'" :class="{'border-danger' : errors.has('txtvaocty')}">
                                                        <!--<small v-show="errors.has('txtvaocty')" class="help text-muted is-danger">Vui lòng nhập số CMND</small>-->
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-form">Chấm công</label>
                                                        <input v-model="cong_viec.cham_cong" name="cham_cong" type="text" class="form-control form-control-sm" id="cham_cong" placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <label class="label-form">Ghi chú</label>
                                                        <input v-model="cong_viec.ghi_chu" name="ghi_chu" type="text" class="form-control form-control-sm" id="ghi_chu">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                <button id="save3" type="submit" class="btn btn-primary">
                                                    <span v-if="flag_xu_ly_tt_ca_nhan"><i class="fa fa-save"></i> Lưu lại</span>
                                                    <span v-if="!flag_xu_ly_tt_ca_nhan"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</span>
                                                </button>
                                                <!--<button @click="upload_img" id="anh" type="" class="btn btn-primary">Lưu ảnh</button>-->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- END Modal thong tin cong viec -->
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
                                <tr v-if="loading_dsnv"><td colspan="17" class=""><b><i class="fa fa-spin fa-spinner"></i> Đang tải danh sách...</b></td></tr>
                                <tr v-if="flag"><td colspan="17" class=""><b class="error_load_nv">Lỗi không tải được danh sách vui lòng tải lại trang...</b></td></tr>
                                <tr v-if="dsnhanvien.length>0" v-for="n in dsnhanvien">
                                    <td class="text-nowrap">
                                        <button @click="_nhan_vien('edit', n)" data-toggle="modal" data-target="#modal_nv_tt_ca_nhan" class="btn btn-success btn-sm" title="Cập nhật thông tin cá nhân"> <i class="fa fa-edit"></i> </button>
                                        <button @click="_lao_dong(n)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_nv_tt_lao_dong" title="Thông tin lao động"><i class="fa fa-address-book-o"></i></button>
                                        <button @click="_cong_viec(n)"class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_nv_tt_cong_viec" title="Thông tin công việc hiện tại"><i class="fa fa-id-card-o"></i></button>
                                        <button class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                    </td>
                                    <td style="width:100px;">{{n.ma_nv}}</td>
                                    <td>{{n.ho_ten}}</td>
                                    <td><span v-if="n.gioi_tinh">Nam</span><span v-else>Nữ</span></td>
                                    <td>{{n.ngay_sinh}}</td>
                                    <td>{{n.noi_sinh}}</td>
                                    <td>{{n.so_cmnd}}</td>
                                    <td>{{n.scmnd_ngay_cap}}</td>
                                    <td>{{n.scmnd_noi_cap}}</td>
                                    <td class="hidden-text" style="width:400px;">{{n.tam_tru}}</td>
                                    <td class="hidden-text" style="width:400px;">{{n.thuong_tru}}</td>
                                    <td>{{n.dt_ban}}</td>
                                    <td>{{n.di_dong_1}}</td>
                                    <td>{{n.di_dong_2}}</td>
                                    <td>{{n.mst_cn}}</td>
                                    <td>{{n.mst_cn_noi_cap}}</td>
                                    <td class="hidden-text">{{n.cc_thue_cap}}</td>
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
                flag_xu_ly_tt_ca_nhan: true,
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
                },
                lao_dong:{
                    vao_cty: '',
                    nv_id: '',
                    thoi_viec: '',
                    nam: '',
                    thang: '',
                    ngay: '',
                    so_hdld: '',
                    ngay_ky: '',
                    thoi_han: '',
                    het_han: '',
                    so_bhxh: '',
                    so_bhyt: '',
                    noi_kham: '',
                    dia_chi_kham: '',
                    ghi_chu: ''
                },
                loading_lao_dong: true,
                flag_xu_ly_tt_lao_dong: true,
                cong_viec: {
                    id_eplv: '',
                    id_phong: '',
                    id_vi_tri: '',
                    he_so: 0,
                    luong_co_ban: 0,
                    luong_cvht: 0,
                    thoi_gian_lam_viec: '',
                    tinh_trang: '',
                    cham_cong: '',
                    ghi_chu: ''
                }
            }
        },
        methods: {
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
            edit_nhan_vien_thong_tin_ca_nhan: function () {
                api_edit_nhan_vien_thong_tin_ca_nhan(this);
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
                    if (nv.avatar != null){
                        $('#wizardPicturePreview').attr('src', 'public/image_nhan_vien/' + nv.avatar).fadeIn('slow');
                    }else{$('#wizardPicturePreview').attr('src', 'https://cdn0.vox-cdn.com/images/verge/default-avatar.v9899025.gif').fadeIn('slow');}
                    this.flag_submit_nhan_vien_tt_ca_nhan = false;
                    this.flag_input_nhan_vien_tt = true;
                }
            },
            submit_nhan_vien_thong_tin_ca_nhan: function () {
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
            },
            _lao_dong: function (nv) {
                this.loading_lao_dong = true;
                api_get_nhan_vien_thong_tin_lao_dong(this, nv.id);
            },
            submit_nhan_vien_thong_tin_lao_dong: function () {
                this.change_bnt_save('save2');
                api_add_nhan_vien_thong_tin_lao_dong(this);
            },
            _cong_viec: function (nv) {

            },
            submit_nhan_vien_thong_tin_cong_viec: function () {

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
</style>
