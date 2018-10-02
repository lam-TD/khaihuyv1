import axios from 'axios';
import {sweetalert} from '../../../helper/sweetalert';

export function api_tk_kho_get_paginate(vm, page) {
    axios({
        method: 'GET',
        url: 'api/get-tk-kho-paginate/' + vm.limit + '?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_tk_kho = false;
            vm.list_tk_kho = response.data.data;
            vm.total_tk_kho = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_add_tk_kho(vm) {
    vm.flag_input_tk_kho = false;
    axios({
        method: 'POST',
        url: 'api/add-tk-kho',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.tk_kho
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_tk_kho_get_paginate(vm,1);
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã tài khoản đã tồn tại!');
                vm.loading_tk_kho = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_tk_kho(vm) {
    console.log('bp: ' + vm.$data.tk_kho);
    axios({
        method: 'POST',
        url: 'api/edit-tk-kho',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.tk_kho
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Cập nhật thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_tk_kho_get_paginate(vm,1);
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_tk_kho(vm) {
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
                url: 'api/delete-tk-kho/' + vm.tk_kho.id,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Tài khoản ' + vm.tk_kho.ma_tk + ' đã được xóa!');
                        vm.flag_btn = true;
                        api_tk_kho_get_paginate(vm,1);
                        vm.loading_tk_kho = false;
                    }
                    else if(response.data == 0){
                        sweetalert(0, 'Tài khoản này có chứa sản phẩm, vui lòng xóa sản phẩm trước');
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!');};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}