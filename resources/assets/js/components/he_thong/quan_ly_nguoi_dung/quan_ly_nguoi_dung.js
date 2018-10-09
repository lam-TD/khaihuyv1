import axios from 'axios';
import {sweetalert} from '../../../helper/sweetalert';


export function api_get_danh_sach_nhom_nguoi_dung_no_paginate(vm) {
    axios({
        method: 'GET',
        url: 'api/get-danh-sach-nhom-nguoi-dung-no-paginate',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            // vm.loading_nguoi_dung = false;
            vm.list_nhom_nguoi_dung = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_all_danh_sach_nguoi_dung(vm, page) {
    axios({
        method: 'GET',
        url: 'api/get-all-danh-sach-nguoi-dung/' + vm.limit + '?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_nguoi_dung = false;
            vm.list_nguoi_dung = response.data.data;
            vm.total_nguoi_dung = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_search_nguoi_dung(vm) {
    axios({
        method: 'GET',
        url: 'api/tim-kiem-nguoi-dung-theo-nhom/' + vm.keyword,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_nguoi_dung = false;
            vm.list_nguoi_dung = response.data.data;
            vm.total_nguoi_dung = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_danh_sach_nguoi_dung_theo_nhom(vm, page, id_nhom) {
    axios({
        method: 'GET',
        url: 'api/get-danh-sach-nguoi-dung-theo-nhom/' + id_nhom + '&' + vm.limit + '?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_nguoi_dung = false;
            vm.list_nguoi_dung = response.data.data;
            vm.total_nguoi_dung = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_danh_sach_nhom_nguoi_dung_chua_co_tk(vm) {
    axios({
        method: 'GET',
        url: 'api/get-all-danh-sach-nguoi-dung-chua-co-tk',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_nguoi_dung_chua_co_tk = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_add_nguoi_dung(vm) {
    vm.flag_input_nguoi_dung = false;
    axios({
        method: 'POST',
        url: 'api/add-nguoi-dung',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.nguoi_dung
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data.status == "OK"){
                sweetalert(1, 'Thêm thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.change_nhom_nguoi_dung_1(vm.nhom_nguoi_dung_1);
                api_get_danh_sach_nhom_nguoi_dung_chua_co_tk(vm);
            }
            else if(response.data.status == "error_username"){
                sweetalert(0, 'Email này đã được sử dụng trước đó!');
                vm.loading_nguoi_dung = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_nguoi_dung(vm) {
    console.log('bp: ' + vm.$data.nguoi_dung);
    axios({
        method: 'POST',
        url: 'api/edit-nguoi-dung',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.nguoi_dung
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data.status == "OK"){
                sweetalert(1, 'Cập nhật thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.change_nhom_nguoi_dung_1(vm.nhom_nguoi_dung_1);
            }
            else sweetalert(2, 'Lỗi không cập nhật được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_kich_hoat_tk_nguoi_dung(vm, id, active) {
    axios({
        method: 'GET',
        url: 'api/kich-hoat-tk-nguoi-dung/' + id + '&' + active,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            if(response.data.status == "OK"){
                sweetalert(1, 'Cập nhật thành công!');
                vm.change_nhom_nguoi_dung_1(vm.nhom_nguoi_dung_1);
            }
            else sweetalert(2, 'Lỗi không cập nhật được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_nguoi_dung(vm) {
    swal({
            title: "Bạn có chắc chắn muốn xóa tài khoản vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/delete-nguoi-dung/' + vm.nguoi_dung.user_id,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data.status == "OK") {
                        sweetalert(1, 'Tài khoản ' + vm.nguoi_dung.username + ' đã được xóa!');
                        vm.change_nhom_nguoi_dung_1(vm.nhom_nguoi_dung_1);
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!'); vm.change_nhom_nguoi_dung_1(vm.nhom_nguoi_dung_1);}
                    api_get_danh_sach_nhom_nguoi_dung_chua_co_tk(vm);
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}
