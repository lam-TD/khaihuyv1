import axios from "axios/index";
import {sweetalert} from '../../../helper/sweetalert';
import {api_get_danh_sach_nhom_nguoi_dung_chua_co_tk} from "../quan_ly_nguoi_dung/quan_ly_nguoi_dung";

export function api_get_all_danh_sach_nhom_nguoi_dung(vm, page=1) {
    axios({
        method: 'GET',
        url: 'api/get-danh-sach-nhom-nguoi-dung-paginate/' + vm.limit + '?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_nguoi_dung = false;
            vm.list_nhom_nguoi_dung_paginate = response.data.data;
            vm.total_nhom_nguoi_dung = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_all_danh_sach_tai_khoan_theo_nhom(vm) {
    axios({
        method: 'GET',
        url: 'api/get-danh-sach-tai-khoan-theo-nhom-paginate/' + vm.nhom_nguoi_dung.id + '&' + vm.limit_tk_theo_nhom,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_tk_theo_nhom = response.data.data;
            vm.total_tk_theo_nhom = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_all_danh_sach_tai_khoan_chua_co_nhom(vm) {
    axios({
        method: 'GET',
        url: 'api/get-danh-sach-tai-khoan-chua-co-nhom',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_tai_khoan_chua_co_nhom = response.data;
            vm.un_change_bnt_save('save_add');
        })
        .catch((error) => {
            console.log(error);
            vm.un_change_bnt_save('save_add');
        })
}

export function api_add_nhom_nguoi_dung(vm) {
    vm.flag_input_nguoi_dung = false;
    axios({
        method: 'POST',
        url: 'api/add-nhom-nguoi-dung',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.nhom_nguoi_dung
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#myModaladd').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_get_all_danh_sach_nhom_nguoi_dung(vm,1);
                api_get_all_danh_sach_tai_khoan_chua_co_nhom(vm);
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã nhóm đã này đã được sử dụng trước đó!');
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_nhom_nguoi_dung(vm) {
    vm.flag_input_nguoi_dung = false;
    axios({
        method: 'POST',
        url: 'api/edit-nhom-nguoi-dung',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.nhom_nguoi_dung
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Cập nhật thành công!');
                $('#myModaladd').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_get_all_danh_sach_nhom_nguoi_dung(vm,1);
                api_get_all_danh_sach_tai_khoan_chua_co_nhom(vm);
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã nhóm đã này đã được sử dụng trước đó!');
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_add_tai_khoan_vao_nhom_nguoi_dung(vm) {
    vm.flag_input_nguoi_dung = false;
    axios({
        method: 'POST',
        url: 'api/add-tai-khoan-vao-nhom-nguoi-dung',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.nhom_nguoi_dung
    })
        .then((response) => {
            if(response.data == 1){
                sweetalert(1, 'Cập nhật thành công!');
                vm.flag_add_tk_vao_nhom = false;
                api_get_all_danh_sach_tai_khoan_chua_co_nhom(vm);
                api_get_all_danh_sach_tai_khoan_theo_nhom(vm);
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã nhóm đã này đã được sử dụng trước đó!');
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_nhom_nguoi_dung(vm) {
    swal({
            title: "Bạn có chắc chắn muốn xóa nhóm người dùng vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/delete-nhom-nguoi-dung/' + vm.nhom_nguoi_dung.id,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(parseInt(response.data) == 1) {
                        sweetalert(1, 'Nhóm '+ vm.nhom_nguoi_dung.ma_nhom +' đã được xóa!');
                    }
                    else if(parseInt(response.data) == 0){
                        sweetalert(0, 'Nhóm này có chứa tài khoản vui lòng xóa tài khoản ra khỏi nhóm');
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!'); vm.change_nhom_nguoi_dung_1(vm.nhom_nguoi_dung_1);}
                    api_get_all_danh_sach_nhom_nguoi_dung(vm,1);
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}