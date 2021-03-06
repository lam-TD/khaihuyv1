import axios from 'axios';
import {sweetalert} from "../../../helper/sweetalert";

export function api_get_all_phong_ban_no_paginate(vm) {
    axios({
        method: 'GET',
        url: 'api/get-all-phong-ban-no-paginate',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_phong_ban = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_all_phong_ban(vm, page) {
    axios({
        method: 'GET',
        url: 'api/get-all-phong-ban/' + vm.limit +'?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_phong_ban = response.data.data;
            vm.total_phong_ban = response.data.total;
            vm.loading_phong_ban = false;
            // console.log(response.data.data);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_danh_sach_phong_theo_bo_phan(vm, id, page) {
    let limit = vm.limit;
    axios({
        method: 'GET',
        url: 'api/get-phong-theo-bo-phan/'+ id +'/' + limit + '?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_phong_ban = response.data.data;
            vm.total_phong_ban = response.data.total;
            vm.loading_phong_ban = false;
            // console.log(response.data.data);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_phong_ban(vm, page) {
    axios({
        method: 'GET',
        url: 'api/get-phong-ban?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_phong_ban = response.data.data;
            vm.total_phong_ban = response.data.total;
            vm.loading_phong_ban = false;
            // console.log(response.data);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_group_all_phong_ban_theo_bo_phan (vm) {
    axios({
        method: 'GET',
        url: 'api/group-all-phong-theo-bo-phan',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_phong_ban = response.data;
            vm.loading_phong_ban = false;
            // console.log(response.data);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_add_phong_ban(vm) {
    axios({
        method: 'POST',
        url: 'api/add-phong-ban',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.phong_ban
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_get_danh_sach_phong_theo_bo_phan(vm, vm.$data.phong_ban.id_bo_phan,1);
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã vị trí đã tồn tại!');
                vm.loading_phong_ban = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_phong_ban(vm) {
    axios({
        method: 'POST',
        url: 'api/edit-phong-ban',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.phong_ban
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Cập nhật thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                if(vm.bo_phan == ''){
                    api_get_all_phong_ban(vm,1);
                }
                else{
                    api_get_danh_sach_phong_theo_bo_phan(vm, vm.phong_ban.id_bo_phan, 1);
                }
            }
            else sweetalert(2, 'Lỗi không cập nhật được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_phong_ban(vm, ma_phong) {
    swal({
            title: "Bạn có chắc chắn muốn xóa phòng vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/delete-phong-ban/' + ma_phong,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Phòng ' + vm.phong_ban.ma_phong + ' đã được xóa!');
                        // $('.row-nhom').removeClass("active-click-row");
                        // vm.flag_btn = true;
                        if(vm.phong_ban.id_bo_phan == '' ){
                            api_get_all_phong_ban(vm, 1);
                        }
                        else{
                            api_get_danh_sach_phong_theo_bo_phan(vm, vm.phong_ban.id_bo_phan, 1);
                        }
                        // api_get_danh_sach_phong_theo_bo_phan(vm, vm.$data.phong_ban.id_bo_phan,1);
                        vm.loading_phong_ban = false;
                    }
                    else if(response.data == 0){
                        sweetalert(0, 'Phòng này có chứa vị trí, vui lòng xóa vị trí trước');
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!'); vm.loading_phong_ban = false;};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}
//get ma_phong
export function api_get_ma_phong(vm) {
    axios({
        method: 'GET',
        url: 'api/get-ma-phong-ban',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.phong_ban
    })
        .then((response) => {
            vm.phong_ban.ma_phong = response.data;
            console.log(vm.phong_ban.ma_phong);
        })
        .catch((error) => {
            console.log(error);
        })
}
