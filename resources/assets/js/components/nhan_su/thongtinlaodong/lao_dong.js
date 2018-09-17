import axios from 'axios';
import {sweetalert} from '../../../helper/sweetalert';

export function api_search_all_lao_dong(vm, page) {
    axios({
        method: 'GET',
        url: 'api/search-hdld/'+ vm.keyword +'?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_lao_dong = false;
            vm.list_lao_dong = response.data.data;
            vm.total_lao_dong = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_all_lao_dong(vm, page) {
    axios({
        method: 'GET',
        url: 'api/get-all-hdld?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_lao_dong = false;
            vm.list_lao_dong = response.data.data;
            vm.total_lao_dong = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_add_lao_dong(vm) {
    vm.flag_input_lao_dong = false;
    axios({
        method: 'POST',
        url: 'api/add-hdld',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.lao_dong
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.danh_sach_lao_dong();
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã hợp đồng đã tồn tại!');
                vm.loading_lao_dong = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_lao_dong(vm) {
    axios({
        method: 'POST',
        url: 'api/edit-hdld',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.lao_dong
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Cập nhật thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.danh_sach_lao_dong();
            }
            else sweetalert(2, 'Lỗi cập nhật được thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_lao_dong(vm) {
    swal({
            title: "Bạn có chắc chắn muốn xóa hợp đồng lao động vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/delete-hdld/' + vm.lao_dong.id,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Hợp đồng lao động đã được xóa!');
                        $('.row-nhom').removeClass("active-click-row");
                        vm.flag_btn = true;
                        vm.danh_sach_lao_dong();
                        vm.loading_lao_dong = false;
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!'); vm.loading_lao_dong = false; vm.loading_phong_ban = false;};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}

export function api_bophan_get_danh_sach_phong_theo_lao_dong(vm, id, page) {
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