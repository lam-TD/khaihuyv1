import axios from "axios";
import {sweetalert} from "../../../helper/sweetalert";
import {api_get_danh_sach_phong_theo_bo_phan} from "../phongban/phong_ban";

export function api_get_thong_tin_nhan_vien_ca_nhan_lao_dong(vm, page) {
    axios({
        method: 'GET',
        url: 'api/get-nhan-vien-all-thong-tin?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_dsnv = false;
            vm.dsnhanvien = response.data.data;
            vm.dsnhanvien_total = response.data.total;
            // console.log(response.data);
        })
        .catch((error) => {
            console.log(error);
        })
}


export function api_get_nhan_vien(vm, page) {
    axios({
        method: 'GET',
        url: 'api/nhan-vien?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_dsnv = false;
            vm.dsnhanvien = response.data.data;
            vm.dsnhanvien_total = response.data.total;
            console.log(response.data.data);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_nhan_vien_new(vm, page) {
    axios({
        method: 'GET',
        url: 'api/nhan-vien?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_dsnv = false;
            vm.dsnhanvien = response.data.data;
            vm.dsnhanvien_total = response.data.total;
            console.log(response.data.data);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_nhan_vien_thong_tin_lao_dong(vm, id_nhan_vien) {
    axios({
        method: 'GET',
        url: 'api/get-nhan-vien-thong-tin-lao-dong/' + id_nhan_vien,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            if(response.data == null){
                vm.lao_dong = {
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
                }
                return 1;
            }
            vm.lao_dong = response.data;
            vm.loading_lao_dong = false;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_add_nhan_vien_thong_tin_ca_nhan(vm) {
    axios({
        method: 'POST',
        url: 'api/add-nhan-vien-thong-tin-ca-nhan',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.nhan_vien
    })
        .then((response) => {
            vm.un_change_bnt_save('save');
            if(response.data == 1){
                vm.flag_xu_ly_tt_ca_nhan = true;
                sweetalert(1, 'Thêm thành công!');
                $('#modal_nv_tt_ca_nhan').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.getNhanVien();
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã nhân viên đã tồn tại!');
                vm.loading_bo_phan = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            vm.un_change_bnt_save('save');
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_nhan_vien_thong_tin_ca_nhan(vm) {
    axios({
        method: 'POST',
        url: 'api/edit-nhan-vien-thong-tin-ca-nhan',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.nhan_vien
    })
        .then((response) => {
            vm.un_change_bnt_save('save');
            if(response.data == 1){
                vm.nhan_vien.image = null;
                vm.flag_xu_ly_tt_ca_nhan = true;
                sweetalert(1, 'Cập nhật thành công!');
                // $('#modal_nv_tt_ca_nhan').modal('hide');
                // $('.modal-backdrop').css('display','none');
                vm.getNhanVien();
            }
            else sweetalert(2, 'Lỗi không cập nhật được!');
        })
        .catch((error) => {
            vm.un_change_bnt_save('save');
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_add_nhan_vien_thong_tin_lao_dong(vm) {
    axios({
        method: 'POST',
        url: 'api/add-nhan-vien-thong-tin-lao-dong',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.lao_dong
    })
        .then((response) => {
            vm.un_change_bnt_save('save2');
            if(response.data == 1){
                vm.flag_xu_ly_tt_ca_nhan = true;
                vm.un_change_bnt_save();
                sweetalert(1, 'Thêm thành công!');
                $('#modal_nv_tt_lao_dong').modal('hide');
                $('.modal-backdrop').css('display','none');
                // vm.getNhanVien();
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_search_thong_tin_nhan_vien(vm, page) {
    axios({
        method: 'GET',
        url: 'api/search-thong-tin-nhan-vien/'+ vm.key_word +'?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_dsnv = false;
            vm.dsnhanvien = response.data.data;
            vm.dsnhanvien_total = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_delete_all_thong_tin_nhan_vien(vm, id_nhan_vien) {
    swal({
            title: "Bạn có chắc chắn muốn thông tin nhân viên vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/delete-all-thong-tin-nhan-vien/' + id_nhan_vien,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        vm.getNhanVien();
                        vm.loading_dsnv = false;
                        sweetalert(1, 'Nhân viên có mã ' + vm.nhan_vien.ma_nv + ' đã được xóa!');
                        $('.row-nhom').removeClass("active-click-row");
                        vm.flag_btn = true;
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!')};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}