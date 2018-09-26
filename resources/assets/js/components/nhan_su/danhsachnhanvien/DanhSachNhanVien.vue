<template id="danhsachnhanvien">
    <div class="row">
        <!--<div class="col-md-12 lamlam">-->
            <!--<div class="card content-lam">-->
                <!--<div class="card-header">-->
                    <!--<div class="card-actions">-->
                        <!--<a class="" data-action="collapse"><i class="ti-minus"></i></a>-->
                        <!--<a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>-->
                        <!--<a class="btn-close" data-action="close"><i class="ti-close"></i></a>-->
                    <!--</div>-->
                    <!--<h4 class="card-title m-b-0">Danh sách nhân viên</h4>-->
                <!--</div>-->
                <!--<div class="card-body">-->
                    <!--<div class="row" style="margin-bottom: 5px;">-->
                        <!--<div class="col-md-6">-->
                            <!--<div class="form-group">-->
                                <!--<form @submit.prevent="submit_search_thong_tin_nhan_vien">-->
                                    <!--<input v-model="key_word" type="text" id="timkiem" class="form-control" placeholder="Nhập từ khóa để tìm kiếm...">-->
                                    <!--<button type="submit" class="btn btn-info btn-sm btntimkiem" name="button">Tìm kiếm</button>-->
                                <!--</form>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="col-md-6">-->
                            <!--<button @click="_nhan_vien('add')" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal_nv_tt_ca_nhan"><i class="fa fa-plus-circle"></i> Thêm mới </button>-->
                        <!--</div>-->
                    <!--</div>-->
                    <!--<div class="table-responsive">-->
                        <!--<table v-on:scroll="scroll_table" class="table table-hover table-fixed mb-0" id="table_nhanvien">-->
                            <!--<thead>-->
                                <!--<tr style="border-top: 1px solid #ddd;">-->
                                    <!--<th class="text-center">#</th>-->
                                    <!--<th class="text-center" style="width: 50px;">TT</th>-->
                                    <!--<th class="text-center">Ảnh</th>-->
                                    <!--<th style="">Mã</th>-->
                                    <!--<th style="">Tên nhân viên</th>-->
                                    <!--<th>G/T</th>-->
                                    <!--<th>Ngày sinh</th>-->


                                    <!--<th>Di động 1</th>-->
                                    <!--<th>Ghi chú</th>-->
                                <!--</tr>-->
                            <!--</thead>-->
                            <!--<tbody>-->
                                <!--<tr v-if="loading_dsnv"><td colspan="19" style="width: 100%"><b><i class="fa fa-spin fa-spinner"></i> Loading...</b></td></tr>-->
                                <!--<tr v-if="dsnhanvien.length>0" v-for="(n, index) in dsnhanvien">-->
                                    <!--<td class="text-nowrap">-->
                                        <!--<button @click="_nhan_vien('edit', n)" data-toggle="modal" data-target="#modal_nv_tt_ca_nhan" class="btn btn-info btn-sm" title="Cập nhật thông tin cá nhân"> <i class="fa fa-edit"></i> </button>-->
                                        <!--<button @click="delete_all_thong_tin_nv(n.id)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>-->
                                    <!--</td>-->
                                    <!--<td class="text-center">{{index + 1}}</td>-->
                                    <!--<td><img :src="'public/image_nhan_vien/' + n.avatar" alt="Chưa có ảnh" class="img-nv" data-toggle="modal" data-target="#"></td>-->
                                    <!--<td style="width:100px;">{{n.ma_nv}}</td>-->
                                    <!--<td> <span @click="_nhan_vien('edit', n)" data-toggle="modal" data-target="#exampleModal2" class="ten-nv">{{n.ho_ten}}</span></td>-->
                                    <!--<td><span v-if="n.gioi_tinh">Nam</span><span v-else>Nữ</span></td>-->

                                    <!--<td class="hidden-text" style="width:400px;">{{n.thuong_tru}}</td>-->
                                    <!--<td>{{n.di_dong_1}}</td>-->
                                    <!--<td>{{n.ghi_chu}}</td>-->
                                <!--</tr>-->
                            <!--</tbody>-->
                        <!--</table>-->

                        <!--<el-pagination-->
                                <!--:page-size="10"-->
                                <!--layout="prev, pager, next"-->
                                <!--:total="dsnhanvien_total"-->
                                <!--@current-change="getNhanVien">-->
                        <!--</el-pagination>-->
                    <!--</div>-->
                    <!--&lt;!&ndash; nd table &ndash;&gt;-->


                    <!--&lt;!&ndash;&lt;!&ndash; Modal &ndash;&gt;&ndash;&gt;-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->

        <div class="col-md-12">
            <div class="card content-lam">
                <div class="card-header">
                    <div class="card-actions">
                        <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                        <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                        <!--<a class="btn-close" data-action="close"><i class="ti-close"></i></a>-->
                    </div>
                    <h4 class="card-title m-b-0">Danh sách nhân viên</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="message-box contact-box">
                        <div class="message-widget contact-widget">
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <form @submit.prevent="submit_search_thong_tin_nhan_vien">
                                                    <input v-model="key_word" type="text" id="timkiem" class="form-control" placeholder="Nhập từ khóa để tìm kiếm...">
                                                    <button type="submit" class="btn btn-info btn-sm btntimkiem" name="button">Tìm kiếm</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button @click="_nhan_vien('add')" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal_nv_tt_ca_nhan"><i class="fa fa-plus-circle"></i> Thêm mới </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <el-table :data="dsnhanvien" height="400" style="width: 100%" border empty-text="Chưa có dữ liệu">
                                        <el-table-column prop="name" label="#" width="90" align="center">
                                            <template slot-scope="scope" class="text-center" style="width: 100%">
                                                <button @click="_nhan_vien('edit', scope.row)" data-toggle="modal" data-target="#modal_nv_tt_ca_nhan" class="btn btn-info btn-sm" title="Cập nhật thông tin cá nhân"> <i class="fa fa-edit"></i> </button>
                                                <button @click="delete_all_thong_tin_nv(scope.row.id)" class="btn btn-danger btn-sm" title="Xóa"> <i class="fa fa-trash-o"></i> </button>
                                            </template>
                                        </el-table-column>
                                        <el-table-column type="index" label="TT" :index="indexMethod" align="center"></el-table-column>
                                        <el-table-column  prop="date" label="Hình ảnh" width="80">
                                            <template slot-scope="props">
                                                <img :src="'public/image_nhan_vien/'+props.row.avatar" alt="" class="img-sanpham">
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="ma_nv" label="Mã NV" width="100"></el-table-column>
                                        <el-table-column label="Tên NV" width="150">
                                            <template slot-scope="scope">
                                                <span @click="load_chi_tiet_nhan_vien(scope.row)" class="ten-nv" data-toggle="modal" data-target="#exampleModal2">{{scope.row.ho_ten}}</span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Giới tính" width="80">
                                            <template slot-scope="props">
                                                <span v-if="props.row.gioi_tinh == '0'">Nữ</span><span v-else>Nam</span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="ngay_sinh"  label="Ngày sinh" width="100"></el-table-column>
                                        <el-table-column prop="di_dong_1"  label="Di động" width="120"></el-table-column>
                                        <el-table-column prop="ghi_chu"  label="Ghi chú"></el-table-column>
                                    </el-table>
                                </div>
                                <div class="col-md-12">
                                    <el-pagination :page-size="10" layout="prev, pager, next" :total="dsnhanvien_total" @current-change="getNhanVien">
                                    </el-pagination>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Modal thong tin ca nhan-->
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
                                                        <el-radio-group v-model="nhan_vien.gioi_tinh" style="width: 100%">
                                                            <el-radio :label="0">Nữ</el-radio>
                                                            <el-radio :label="1">Nam</el-radio>
                                                        </el-radio-group>
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
                                                        <el-select v-model="nv_noi_sinh.tinh_thanh" value-key="ma_tinh" filterable size="small" placeholder="Tỉnh thành phố" @change="load_quan_huyen_noi_sinh" style="width: 49%;" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <el-option
                                                                    v-for="item in list_tinh_thanh"
                                                                    :key="item.ma_tinh"
                                                                    :label="item.ten_tinh"
                                                                    :value="item">
                                                            </el-option>
                                                        </el-select>

                                                        <el-select v-model="nv_noi_sinh.quan_huyen" value-key="ma_quan_huyen" :disabled="!nv_noi_sinh.tinh_thanh" filterable size="small" placeholder="Quận huyện" style="width: 49%;margin-left: 1px;" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <el-option
                                                                    v-for="item in change_quan_huyen_noi_sinh"
                                                                    :key="item.ma_quan_huyen"
                                                                    :label="item.ten_quan_huyen"
                                                                    :value="item">
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
                                                    <div class="col-md-4">
                                                        <input v-model="nhan_vien.tam_tru" name="txttamtru" class="form-control form-control-sm" style="width: 100%;"/>
                                                    </div>

                                                    <!--<label class="label-form col-md-2 col-form-label"></label>-->
                                                    <div class="col-md-2">
                                                        <el-select v-model="nv_tam_tru.tinh_thanh" value-key="ma_tinh" filterable size="small" placeholder="Tỉnh thành phố" @change="load_quan_huyen_tam_tru(nv_tam_tru.tinh_thanh,1)" style="width: 100%" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <el-option v-for="item in list_tinh_thanh" :key="item.ma_tinh" :label="item.ten_tinh" :value="item">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                    <!--<label class="label-form col-md-2 col-form-label"></label>-->
                                                    <div class="col-md-2">
                                                        <el-select v-model="nv_tam_tru.quan_huyen" @change="load_phuong_xa(nv_tam_tru.quan_huyen,1)" value-key="ma_quan_huyen" :disabled="!nv_tam_tru.tinh_thanh" filterable size="small" placeholder="Quận huyện" style="width: 100%;" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <el-option v-for="item in change_quan_huyen_tam_tru" :key="item.ma_quan_huyen" :label="item.ten_quan_huyen" :value="item">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <el-select v-model="nv_tam_tru.phuong_xa" value-key="phuongxa_id" :disabled="!nv_tam_tru.tinh_thanh || !nv_tam_tru.quan_huyen" filterable size="small" placeholder="Phường xã" style="width: 100%;" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<el-option v-if="change_phuong_xa.length==0" :label="'Chưa có phường xã'" :value="''"></el-option>-->
                                                            <el-option v-for="item in change_phuong_xa_tam_tru" :key="item.phuongxa_id" :label="item.ten_phuong_xa" :value="item">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>

                                                <div class="form-group row address">
                                                    <label class="label-form col-md-2 col-form-label">Thường trú</label>
                                                    <div class="col-md-4">
                                                        <input v-model="nhan_vien.thuong_tru" name="txttamtru" class="form-control form-control-sm" style="width: 100%;"/>
                                                    </div>
                                                    <!--<label class="label-form col-md-2 col-form-label"></label>-->
                                                    <div class="col-md-2">
                                                        <el-select v-model="nv_thuong_tru.tinh_thanh" value-key="ma_tinh" filterable size="small" placeholder="Tỉnh thành phố" @change="load_quan_huyen_thuong_tru(nv_thuong_tru.tinh_thanh,2)" style="width: 100%" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <el-option
                                                                    v-for="item in list_tinh_thanh"
                                                                    :key="item.ma_tinh"
                                                                    :label="item.ten_tinh"
                                                                    :value="item">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <el-select v-model="nv_thuong_tru.quan_huyen" @change="load_phuong_xa(nv_thuong_tru.quan_huyen,2)" :disabled="!nv_thuong_tru.tinh_thanh" value-key="ma_quan_huyen" filterable size="small" placeholder="Quận huyện" style="width: 100%;" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <el-option
                                                                    v-for="item in change_quan_huyen_thuong_tru"
                                                                    :key="item.ma_quan_huyen"
                                                                    :label="item.ten_quan_huyen"
                                                                    :value="item">
                                                            </el-option>
                                                        </el-select>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <el-select v-model="nv_thuong_tru.phuong_xa" value-key="phuongxa_id" :disabled="!nv_thuong_tru.quan_huyen" filterable size="small" placeholder="Phường xã" style="width: 100%;" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<el-option v-if="change_phuong_xa.length==0" :label="'Chưa có phường xã'" :value="''"></el-option>-->
                                                            <el-option
                                                                    v-for="item in change_phuong_xa_thuong_tru"
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

                                                <div class="form-group row">
                                                    <label class="label-form col-md-2 col-form-label">Ghi chú</label>
                                                    <div class="col-md-10">
                                                        <input v-model="nhan_vien.ghi_chu" type="text" name="ghi_chu" class="form-control form-control-sm" id="ghi_chu" placeholder="">
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
                    <!--end Modal thong tin ca nhan-->

                    <!-- Modal chi tiet -->
                    <div class="modal" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel2">Thông tin chi tiết</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="padding-top: 0">
                                    <ul class="nav nav-tabs customtab" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home2" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Thông tin cá nhân</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Thông tin công việc</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages3" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Hợp đồng</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages4" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">BHYT</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages5" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Người phụ thuộc</span></a> </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home2" role="tabpanel">
                                            <div style="padding-top:10px">
                                                <div class="form-group row border-form">
                                                    <label class="label-form col-md-2 col-3 col-form-label">Mã NV:</label>
                                                    <div class="col-md-2 col-8 tt-dacbiet">
                                                        <p>{{nv_thong_tin_ca_nhan.ma_nv}}</p>
                                                    </div>

                                                    <label class="label-form col-md-2 col-3 col-form-label">Tên NV:</label>
                                                    <div class="col-md-3 col-8">
                                                        <p>{{nv_thong_tin_ca_nhan.ho_ten}}</p>
                                                    </div>

                                                    <label class="label-form col-md-2 col-3 col-form-label">Giới tính:</label>
                                                    <div class="col-md-1 col-8">
                                                        <p v-if="nv_thong_tin_ca_nhan.gioi_tinh == 0">Nữ</p>
                                                        <p v-else>Nam</p>
                                                    </div>
                                                </div>

                                                <div class="form-group row border-form">
                                                    <label class="label-form col-md-2 col-3 col-form-label">Ngày sinh:</label>
                                                    <div class="col-md-2 col-8 tt-dacbiet">
                                                        <p>{{nv_thong_tin_ca_nhan.ngay_sinh}}</p>
                                                    </div>

                                                    <label class="label-form col-md-2 col-3 col-form-label">Nơi sinh:</label>
                                                    <div class="col-md-3 col-9 tt-dacbiet">
                                                        <p>{{nv_noi_sinh.tinh_thanh.ten_tinh}}, {{nv_noi_sinh.quan_huyen.ten_quan_huyen}}</p>
                                                    </div>

                                                    <label class="label-form col-md-2 col-3 col-form-label">Quốc tịch:</label>
                                                    <div class="col-md-2 col-8">
                                                        <p>{{nv_thong_tin_ca_nhan.quoc_tich}}</p>
                                                    </div>
                                                </div>

                                                <div class="form-group row border-form">
                                                    <label class="label-form col-md-2 col-3 col-form-label">Số CMND:</label>
                                                    <div class="col-md-2 col-8 tt-dacbiet">
                                                        <p>{{nv_thong_tin_ca_nhan.so_cmnd}}</p>
                                                    </div>

                                                    <label class="label-form col-md-2 col-3 col-form-label">Ngày cấp:</label>
                                                    <div class="col-md-3 col-8">
                                                        <p>{{nv_thong_tin_ca_nhan.scmnd_ngay_cap}}</p>
                                                    </div>

                                                    <label class="label-form col-md-2 col-3 col-form-label">Nơi cấp:</label>
                                                    <div class="col-md-2 col-8">
                                                        <p>{{nv_thong_tin_ca_nhan.scmnd_noi_cap}}</p>
                                                    </div>
                                                </div>

                                                <div class="form-group row border-form">
                                                    <label class="label-form col-md-2 col-3 col-form-label">Tạm trú:</label>
                                                    <div class="col-md-10 col-8" style="padding-left: 0">
                                                        <p>{{nv_tam_tru.tinh_thanh.ten_tinh}}, {{nv_tam_tru.quan_huyen.ten_quan_huyen}}, {{nv_tam_tru.phuong_xa.ten_phuong_xa}}, {{nv_thong_tin_ca_nhan.tam_tru}}</p>
                                                    </div>
                                                </div>

                                                <div class="form-group row border-form">
                                                    <label class="label-form col-md-2 col-3 col-form-label" style="padding-right: 0">Thường trú:</label>
                                                    <div class="col-md-10 col-8" style="padding-left: 0">
                                                        <p>{{nv_thuong_tru.tinh_thanh.ten_tinh}}, {{nv_thuong_tru.quan_huyen.ten_quan_huyen}}, {{nv_thuong_tru.phuong_xa.ten_phuong_xa}}, {{nv_thong_tin_ca_nhan.thuong_tru}}</p>
                                                    </div>
                                                </div>

                                                <div class="form-group row border-form">
                                                    <label class="label-form col-md-2 col-3 col-form-label">ĐT bàn:</label>
                                                    <div class="col-md-2 col-8 tt-dacbiet">
                                                        <p>{{nv_thong_tin_ca_nhan.dt_ban}}</p>
                                                    </div>

                                                    <label class="label-form col-md-2 col-3 col-form-label">Di động 1:</label>
                                                    <div class="col-md-3 col-8">
                                                        <p>{{nv_thong_tin_ca_nhan.di_dong_1}}</p>
                                                    </div>

                                                    <label class="label-form col-md-2 col-3 col-form-label">Di động 2:</label>
                                                    <div class="col-md-2 col-8">
                                                        <p>{{nv_thong_tin_ca_nhan.di_dong_2}}</p>
                                                    </div>
                                                </div>

                                                <div class="form-group row border-form">
                                                    <label class="label-form col-md-2 col-3 col-form-label">MST CN:</label>
                                                    <div class="col-md-2 col-8 tt-dacbiet">
                                                        <p>{{nv_thong_tin_ca_nhan.mst_cn}}</p>
                                                    </div>
                                                    <label class="label-form col-md-2 col-3 col-form-label">Nơi cấp:</label>
                                                    <div class="col-md-3 col-8">
                                                        <p>{{nv_thong_tin_ca_nhan.mst_cn_noi_cap}}</p>
                                                    </div>

                                                    <label class="label-form col-md-2 col-3 col-form-label" style="padding-right: 0">C/C thuế cấp:</label>
                                                    <div class="col-md-2 col-8">
                                                        <p>{{nv_thong_tin_ca_nhan.cc_thue_cap}}</p>
                                                    </div>
                                                </div>

                                                <div class="form-group row border-form">
                                                    <label class="label-form col-md-2 col-3 col-form-label">Ghi chú:</label>
                                                    <div class="col-md-10 col-8 tt-dacbiet">
                                                        <p>{{nv_thong_tin_ca_nhan.ghi_chu}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane  p-20" id="profile2" role="tabpanel">
                                            <form @submit.prevent="submit_ttcv">
                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Nhân viên(*)</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input v-model="nhan_vien.ma_nv" type="text" id="txtnhanvien-sua" class="form-control form-control-sm" readonly>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input v-model="nhan_vien.ho_ten" type="text" id="-sua" class="form-control form-control-sm" readonly>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Ngày</label>
                                                    <div class="col-md-9">
                                                        <input v-model="ttcv.ngay" name="so_ttcv" type="date" class="form-control form-control-sm">
                                                        <small v-show="errors.has('so_ttcv')" class="help text-muted is-danger">Vui lòng nhập số bảo hiểm y tết</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Tình trạng</label>
                                                    <div class="col-md-9">
                                                        <select v-model="ttcv.tinh_trang" name="" id="" class="form-control form-control-sm" style="width:100%">
                                                            <option value="0">Thử việc</option>
                                                            <option value="1">Chính thức</option>
                                                            <option value="2">Thôi việc</option>
                                                        </select>
                                                        <!--<small v-show="errors.has('so_bhxh')" class="help text-muted is-danger">Vui lòng nhập số bảo hiểm xã hội</small>-->
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Bộ phận LV</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="ttcv.bo_phan_ma" filterable size="small" placeholder="Chọn bộ phận" style="width: 100%" @change="select_bo_phan" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<template slot="prefix"><label class="prefix">{{nhan_vien.ma_nv}}</label></template>-->
                                                            <el-option
                                                                    v-for="item in list_bo_phan"
                                                                    :key="item.id"
                                                                    :label="item.ma_bo_phan"
                                                                    :value="item.ma_bo_phan">
                                                                <span style="float: left">{{ item.ma_bo_phan }}</span>
                                                                <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ten_bo_phan }}</span>
                                                            </el-option>
                                                        </el-select>
                                                        <small v-show="errors.has('so_bhxh')" class="help text-muted is-danger">Vui lòng nhập số bảo hiểm xã hội</small>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Phòng</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="ttcv.phong_ma" size="small" placeholder="Chọn phòng" style="width: 100%" @change="select_phong" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<template slot="prefix"><label class="prefix">{{nhan_vien.ma_nv}}</label></template>-->
                                                            <el-option
                                                                    v-for="item in list_change_phong"
                                                                    :key="item.id"
                                                                    :label="item.ma_phong"
                                                                    :value="item.ma_phong">
                                                                <span style="float: left">{{ item.ma_phong }}</span>
                                                                <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ten_phong }}</span>
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Vị trí</label>
                                                    <div class="col-md-9">
                                                        <el-select v-model="ttcv.vi_tri_ma" filterable size="small" placeholder="Chọn phòng" style="width: 100%" @change="select_vi_tri" no-match-text="Không tìm thấy" no-data-text="Không có dữ liệu">
                                                            <!--<template slot="prefix"><label class="prefix">{{nhan_vien.ma_nv}}</label></template>-->
                                                            <el-option
                                                                    v-for="item in list_vi_tri"
                                                                    :key="item.ma_vi_tri"
                                                                    :label="item.ma_vi_tri"
                                                                    :value="item.ma_vi_tri">
                                                                <span style="float: left">{{ item.ma_vi_tri }}</span>
                                                                <span style="float: right; color: #8492a6; font-size: 13px">{{ item.ten_vi_tri }}</span>
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Hệ số lương</label>
                                                    <div class="col-md-9">
                                                        <input v-on:keypress="only_number_input" v-model="ttcv.he_so_luong" name="txtngaykt" type="text" class="form-control form-control-sm">
                                                        <!--<vue-numeric class="form-control form-control-sm" separator="," v-model="ttcv.he_so_luong"></vue-numeric>-->
                                                        <!--<small v-show="errors.has('txtngaykt')" class="help text-muted is-danger">Vui lòng nhập ngày kết thúc</small>-->
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Lương cơ bản</label>
                                                    <div class="col-md-9">
                                                        <!--<vue-numeric class="form-control form-control-sm" separator="," v-model="ttcv.luong_co_ban"></vue-numeric>-->
                                                        <input v-on:keypress="only_number_input" v-model="ttcv.luong_co_ban" name="txtngaykt" type="text" class="form-control form-control-sm">
                                                        <!--<small v-show="errors.has('txtngaykt')" class="help text-muted is-danger">Vui lòng nhập ngày kết thúc</small>-->
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Lương HTCV</label>
                                                    <div class="col-md-9">
                                                        <input v-on:keypress="only_number_input" v-model="ttcv.htcv" name="htcv" type="text" class="form-control form-control-sm">
                                                        <!--<vue-numeric class="form-control form-control-sm" separator="," v-model="ttcv.htcv"></vue-numeric>-->
                                                        <!--<small v-show="errors.has('txtngaykt')" class="help text-muted is-danger">Vui lòng nhập ngày kết thúc</small>-->
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Chấm công</label>
                                                    <div class="col-md-9">
                                                        <el-radio-group v-model="cham_cong">
                                                            <el-radio :label="1">Có</el-radio>
                                                            <el-radio :label="0">Không</el-radio>
                                                        </el-radio-group>
                                                    </div>
                                                </div>

                                                <div v-show="cham_cong" class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Thời gian LV</label>
                                                    <div class="col-md-4">
                                                        <!--<input v-model="ttcv.thoi_gian_lv_bd" name="txtngaykt" type="time" class="form-control form-control-sm">-->
                                                        <el-time-select placeholder="Bắt đầu" v-model="ttcv.thoi_gian_lv_bd" :picker-options="{ start: '06:00', step: '00:30', end: '23:30' }" size="small">
                                                        </el-time-select>
                                                        <!--<small v-show="errors.has('txtngaykt')" class="help text-muted is-danger">Vui lòng nhập ngày kết thúc</small>-->
                                                    </div>
                                                    <label class="label-form col-md-1 col-form-label">-></label>
                                                    <div class="col-md-4">
                                                        <!--<input v-model="ttcv.thoi_gian_lv_kt" name="" type="time" class="form-control form-control-sm">-->
                                                        <el-time-select placeholder="Kết thúc" v-model="ttcv.thoi_gian_lv_kt" :picker-options="{ start: '06:00', step: '00:30', end: '23:30' }" size="small">
                                                        </el-time-select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="label-form col-md-3 col-form-label">Ghi chú</label>
                                                    <div class="col-md-9">
                                                        <textarea v-model="ttcv.ghi_chu" name="" id="" class="form-control form-control-sm"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <button :disabled="!ttcv.vi_tri_ma" id="save_ttcv" type="submit" class="btn btn-primary pull-right">
                                                            <span ><i class="fa fa-save"></i> Lưu lại</span>
                                                            <!--<span v-if="!flag_btn_save"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</span>-->
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane p-20" id="messages3" role="tabpanel">
                                            <!--contrac-->
                                            <div class="form-body">
                                                <h3 class="box-title">Thông tin hợp đồng</h3>
                                                <hr class="m-t-0 m-b-40">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-6">Số hợp đồng</label>
                                                            <div class="col-md-6">
                                                                <label class="control-label text-right text-info col-md-12">{{hop_dong_lao_dong.so_hdld}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-6">Thời hạn hợp đồng</label>
                                                            <div class="col-md-6">
                                                                <label class="control-label text-right text-info col-md-12">{{hop_dong_lao_dong.thoi_han_hd}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-6">Ngày ký</label>
                                                            <div class="col-md-6">
                                                                <label class="control-label text-right text-info col-md-12">{{hop_dong_lao_dong.ngay_ky}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-6">Ngày kết thúc</label>
                                                            <div class="col-md-6">
                                                                <label class="control-label text-right text-info col-md-12">{{hop_dong_lao_dong.ngay_kt}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group row">
                                                            <label class="control-label text-right col-md-3">Ghi chú</label>
                                                            <div class="col-md-9">
                                                                <label class="control-label text-right text-info col-md-12">{{hop_dong_lao_dong.Ghi_chu}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--//contrac-->
                                        </div>
                                        <div class="tab-pane p-20" id="messages4" role="tabpanel">4</div>
                                        <div class="tab-pane p-20" id="messages5" role="tabpanel">5</div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Modal chi tiet -->

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
    import {api_get_item_phuong_xa_nhan_vien} from "../../../helper/tinh_thanh";
    import {api_get_item_phuong_xa_noi_sinh} from "../../../helper/tinh_thanh";
    import {api_get_item_phuong_xa_nhan_vien_thuong_tru} from "../../../helper/tinh_thanh";

    import {api_get_all_bo_phan} from "../bophan/bo_phan";
    import {api_get_all_phong_ban_no_paginate} from "../phongban/phong_ban";
    import {api_get_vi_tri_all_theo_phong} from "../thongtincongviec/thong_tin_cong_viec";
    import {api_get_ttcv_hien_tai_theo_nhan_vien} from "../thongtincongviec/thong_tin_cong_viec";
    import {api_edit_ttcv} from "../thongtincongviec/thong_tin_cong_viec";
    import {api_get_hop_dong_lao_dong_moi_nhat} from "../thongtinlaodong/lao_dong";


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
                list_quan_huyen: [],
                change_quan_huyen_thuong_tru: [],
                change_phuong_xa_thuong_tru: [],
                change_quan_huyen_tam_tru: [],
                change_phuong_xa_tam_tru: [],
                quan_huyen: '',
                list_phuong_xa: [],
                phuong_xa: '',
                change_quan_huyen_noi_sinh: [],
                nv_noi_sinh: {tinh_thanh: '', quan_huyen: ''},
                nv_tam_tru: {tinh_thanh: '', quan_huyen: '', phuong_xa: ''},
                nv_thuong_tru: {tinh_thanh: '', quan_huyen: '', phuong_xa: ''},
                list_bo_phan: [],
                list_phong_ban: [],
                bo_phan: '',
                list_change_phong: [],
                list_vi_tri: [],
                phong_ban: '',
                vi_tri: '',
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
                    noi_sinh_tinh_thanh: '',
                    quoc_tich: 'Việt Nam',
                    gioi_tinh: '0',
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
                    thuong_tru_tinh_thanh: '',
                    ghi_chu: ''
                },
                ttcv: { id: 0, ngay: '', tinh_trang: '', he_so_luong: '', luong_co_ban: '', htcv:'', ghi_chu: '', nv_ma: '', bo_phan_ma: '', phong_ma: '', vi_tri_ma: '', thoi_gian_lv_bd: '', thoi_gian_lv_kt: '', cham_cong: 0 },
                cham_cong: 0,
                flag_disable_manv: false,
                loading_lao_dong: true,
                flag_xu_ly_tt_lao_dong: true,
                flag_form_cong_viec: false,
                nhan_vien_tinh_trang: [
                    { label: 'Thử việc', value: 0 },
                    { label: 'Chính thức', value: 1 },
                    { label: 'Thôi việc', value: 2 },
                ],
                // hop dong lao dong
                hop_dong_lao_dong:[],
                nv_thong_tin_ca_nhan: ''
            }
        },
        methods: {
            //get hop dong
            load_hop_dong_nv: function(id_nv)
            {
                api_get_hop_dong_lao_dong_moi_nhat(this, id_nv);
            },
            //
            load_quan_huyen_noi_sinh: function (tinh) {
                this.change_quan_huyen_noi_sinh = this.list_quan_huyen.filter(function(item){
                    return (item['ma_tinh'] == tinh.ma_tinh);
                })
                this.nv_noi_sinh.quan_huyen = '';
            },
            load_quan_huyen_tam_tru: function (tinh) {
                this.change_quan_huyen_tam_tru = this.list_quan_huyen.filter(function(item){
                    return (item['ma_tinh'] == tinh.ma_tinh);
                })
            },
            load_quan_huyen_thuong_tru: function (tinh) {
                this.nv_thuong_tru.quan_huyen = '';
                this.change_quan_huyen_thuong_tru = this.list_quan_huyen.filter(function(item){
                    return (item['ma_tinh'] == tinh.ma_tinh);
                })
            },
            load_phuong_xa: function (quan_huyen, type) {
                if(type == 1){ this.nv_tam_tru.phuong_xa = '';
                    this.change_phuong_xa_tam_tru = this.list_phuong_xa.filter(function(item){
                        return (item['quanhuyen_id'] == quan_huyen.ma_quan_huyen);
                    })
                }
                else if(type==2){this.nv_thuong_tru.phuong_xa = '';
                    this.change_phuong_xa_thuong_tru = this.list_phuong_xa.filter(function(item){
                        return (item['quanhuyen_id'] == quan_huyen.ma_quan_huyen);
                    })
                }
            },
            select_bo_phan: function (id_bp) {
                this.ttcv.bo_phan_ma = id_bp;
                this.list_change_phong = this.list_phong_ban.filter(function(item){
                    return (item['id_bo_phan'] == id_bp);
                })
            },
            select_phong: function (id_bp) {
                api_get_vi_tri_all_theo_phong(this, id_bp);
                this.ttcv.phong_ma = id_bp;
            },
            select_vi_tri: function (id_vt) {
                this.ttcv.vi_tri_ma = id_vt;
            },
            auto_select_bp_p_vt: function (id_bp, id_phong, id_vt) {
                this.ttcv.bo_phan_ma = id_bp;
                this.list_change_phong = this.list_phong_ban.filter(function(item){
                    return (item['id_bo_phan'] == id_bp);
                })

                this.ttcv.phong_ma = id_phong;

                api_get_vi_tri_all_theo_phong(this, id_phong);
                this.ttcv.vi_tri_ma = id_vt;

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
                    this.nhan_vien = { id: 0, ma_nv: '', ho_ten: '', ngay_sinh: '', noi_sinh_tinh_thanh: '', quoc_tich: 'Việt Nam', gioi_tinh: '0', so_cmnd: '', scmnd_noi_cap: '', scmnd_ngay_cap: '', thuong_tru: '',
                            thuong_tru_tinh_thanh: '', thuong_tru_quan_huyen: '', tam_tru: '', tam_tru_tinh_thanh: '', tam_tru_quan_huyen: '', di_dong_1: '',
                            di_dong_2: '', dt_ban: '', mst_cn: '', mst_cn_noi_cap: '', cc_thue_cap: '', avatar: '',
                            image: '', tinh_trang: 0, tam_tru_tinh_thanh: '', thuong_tru_tinh_thanh: ''
                    }
                    this.nv_tam_tru.quan_huyen = this.nv_tam_tru.tinh_thanh = this.nv_tam_tru.phuong_xa = '';
                    this.nv_thuong_tru.quan_huyen = this.nv_thuong_tru.tinh_thanh = this.nv_thuong_tru.phuong_xa = '';
                }
                else {
                    api_get_item_phuong_xa_noi_sinh(this, nv.noi_sinh_tinh_thanh);
                    api_get_item_phuong_xa_nhan_vien(this, nv.tam_tru_tinh_thanh,1);
                    api_get_item_phuong_xa_nhan_vien_thuong_tru(this, nv.thuong_tru_tinh_thanh);
                    var lma = this.list_tinh_thanh.filter(function (item) {
                        return (item['ma_tinh'] == nv.scmnd_noi_cap);
                    });

                    api_get_all_bo_phan(this);
                    api_get_all_phong_ban_no_paginate(this);
                    api_get_ttcv_hien_tai_theo_nhan_vien(this, nv.ma_nv);
                    // this.auto_select_bp_p_vt(nv.bo_phan_ma, nv.phong_ma, nv.vi_tri_ma);

                    //hop dong lao dong
                    api_get_hop_dong_lao_dong_moi_nhat(this,nv.ma_nv);
                    this.value = lma[0];
                    // this.nhan_vien = nv;
                    if (nv.avatar != null){
                        $('#wizardPicturePreview').attr('src', 'public/image_nhan_vien/' + nv.avatar).fadeIn('slow');
                        $('#wizardPicturePreview2').attr('src', 'public/image_nhan_vien/' + nv.avatar).fadeIn('slow');
                    }else{$('#wizardPicturePreview').attr('src', 'https://cdn0.vox-cdn.com/images/verge/default-avatar.v9899025.gif').fadeIn('slow');}
                    this.flag_submit_nhan_vien_tt_ca_nhan = false;
                    this.flag_input_nhan_vien_tt = true;
                    // set detail nv;
                    this.nhan_vien.id = nv.id;this.nhan_vien.ma_nv = nv.ma_nv;this.nhan_vien.ho_ten = nv.ho_ten;this.nhan_vien.avatar = nv.avatar;this.nhan_vien.gioi_tinh = nv.gioi_tinh;this.nhan_vien.ngay_sinh = nv.ngay_sinh;this.nhan_vien.noi_sinh = nv.noi_sinh;this.nhan_vien.quoc_tich = nv.quoc_tich;
                    this.nhan_vien.thuong_tru = nv.thuong_tru;this.nhan_vien.tam_tru = nv.tam_tru;this.nhan_vien.noi_sinh = nv.noi_sinh;this.nhan_vien.so_cmnd = nv.so_cmnd;this.nhan_vien.scmnd_noi_cap = nv.scmnd_noi_cap;
                    this.nhan_vien.scmnd_ngay_cap = nv.scmnd_ngay_cap;this.nhan_vien.di_dong_1 = nv.di_dong_1;this.nhan_vien.di_dong_2 = nv.di_dong_2;this.nhan_vien.dt_ban = nv.dt_ban;
                    this.nhan_vien.mst_cn = nv.mst_cn;this.nhan_vien.mst_cn_noi_cap = nv.mst_cn_noi_cap;this.nhan_vien.cc_thue_cap = nv.cc_thue_cap;this.nhan_vien.tam_tru_tinh_thanh = nv.tam_tru_tinh_thanh;this.nhan_vien.thuong_tru_tinh_thanh = nv.thuong_tru_tinh_thanh;
                    this.nhan_vien.noi_sinh_tinh_thanh = nv.noi_sinh_tinh_thanh;this.nhan_vien.ghi_chu = nv.ghi_chu;
                }
            },
            submit_nhan_vien_thong_tin_ca_nhan: function () {
                this.nhan_vien.noi_sinh_tinh_thanh = this.nv_noi_sinh.quan_huyen.ma_quan_huyen;
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
                // $('table').on('scroll', function () {
                //     $("#"+this.id+" > *").width($(this).width() + $(this).scrollLeft());
                // });
            },
            submit_ttcv: function () {
                api_edit_ttcv(this);
            },
            indexMethod: function (index) {
                return index + 1;
            },
            load_chi_tiet_nhan_vien: function (nv) {
                this.nv_thong_tin_ca_nhan = nv;
                api_get_item_phuong_xa_noi_sinh(this, nv.noi_sinh_tinh_thanh);
                api_get_item_phuong_xa_nhan_vien(this, nv.tam_tru_tinh_thanh,1);
                api_get_item_phuong_xa_nhan_vien_thuong_tru(this, nv.thuong_tru_tinh_thanh);
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

        .padding-tt {
            padding-left: 0;
        }
    }
    .el-radio-group {
        padding-top: 8px;
    }

    .img-nv {
        width: 100%;
        cursor: pointer;
    }

    .ten-nv:hover {
        cursor: pointer;
        border-bottom: 1px solid blue;
        color: black;
        font-weight: 500;
    }
    .img-sanpham {
        height: 50px;
        width: 100%;
    }

    p{
        margin-bottom: 0;
        margin-top: 3px;
    }

    .border-form {
        border-bottom: 1px solid #ddddff;
        margin-left: 0px;
        margin-right: 0;
    }
    @media (min-width: 768px)
    {
        .tt-dacbiet {
            padding-left: 0;
            padding-right: 0;
        }
    }
</style>
