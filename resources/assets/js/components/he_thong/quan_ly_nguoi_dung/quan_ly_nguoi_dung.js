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

export function api_add_nguoi_dung(vm) {
    vm.flag_input_nguoi_dung = false;
    axios({
        method: 'POST',
        url: 'api/add-bo-phan',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.nguoi_dung
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.danh_sach_nguoi_dung();
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã bộ phận đã tồn tại!');
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
        url: 'api/edit-bo-phan',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.nguoi_dung
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Cập nhật thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.danh_sach_nguoi_dung();
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã nhóm vừa chọn đã tồn tại!');
                vm.loading_nguoi_dung = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_nguoi_dung(vm) {
    swal({
            title: "Bạn có chắc chắn muốn xóa bộ phận vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/delete-bo-phan/' + vm.nguoi_dung.id,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Bộ phận ' + vm.nguoi_dung.ma_nguoi_dung + ' đã được xóa!');
                        $('.row-nhom').removeClass("active-click-row");
                        vm.flag_btn = true;
                        vm.danh_sach_nguoi_dung();
                        vm.loading_nguoi_dung = false;
                    }
                    else if(response.data == 0){
                        sweetalert(0, 'Bộ phận này có chứa phòng, vui lòng xóa phòng trước');
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!'); vm.loading_nguoi_dung = false; vm.loading_phong_ban = false;};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}

export function api_bophan_get_danh_sach_phong_theo_nguoi_dung(vm, id, page) {
    var lam = 'api/get-phong-theo-bo-phan/'+ id +'?page=' + page;
    console.log(lam);
    axios({
        method: 'GET',
        url: 'api/get-phong-theo-bo-phan/'+ id +'?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_phong_ban = response.data.data;
            vm.total_phong_ban = response.data.total;
            vm.loading_phong_ban = false;
            console.log(response.data.data);
        })
        .catch((error) => {
            console.log(error);
        })
}

//
export function api_bophan_get_ma_nguoi_dung(vm) {
    axios({
        method: 'GET',
        url: 'api/get-ma-bo-phan',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.nguoi_dung.ma_nguoi_dung = response.data;
            console.log(vm.nguoi_dung.ma_nguoi_dung);
        })
        .catch((error) => {
            console.log(error);
        })
}