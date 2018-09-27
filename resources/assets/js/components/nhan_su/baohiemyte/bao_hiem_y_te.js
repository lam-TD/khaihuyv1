import axios from 'axios';
import {sweetalert} from '../../../helper/sweetalert';

export function api_search_all_bhyt(vm, page) {
    axios({
        method: 'GET',
        url: 'api/search-bhyt/'+ vm.keyword +'?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_bhyt = false;
            vm.list_bhyt = response.data.data;
            vm.total_bhyt = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_all_bhyt(vm, page) {
    axios({
        method: 'GET',
        url: 'api/get-all-bhyt?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_bhyt = false;
            vm.list_bhyt = response.data.data;
            vm.total_bhyt = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_add_bhyt(vm) {
    vm.flag_input_bhyt = false;
    axios({
        method: 'POST',
        url: 'api/add-bhyt',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.bhyt
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.danh_sach_bhyt();
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã bảo hiểm đã tồn tại!');
                vm.loading_bhyt = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_bhyt(vm) {
    axios({
        method: 'POST',
        url: 'api/edit-bhyt',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.bhyt
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Cập nhật thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.danh_sach_bhyt();
            }
            else sweetalert(2, 'Lỗi cập nhật được thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_bhyt(vm) {
    swal({
            title: "Bạn có chắc chắn muốn xóa bảo hiểm y tế vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/delete-bhyt/' + vm.bhyt.id,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Bảo hiểm đã được xóa!');
                        $('.row-nhom').removeClass("active-click-row");
                        vm.flag_btn = true;
                        vm.danh_sach_bhyt();
                        vm.loading_bhyt = false;
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!'); vm.loading_bhyt = false; vm.loading_phong_ban = false;};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}
//
export function api_get_bhyt_nhan_vien_moi_nhat(vm, id_nv) {
        axios({
            method: 'GET',
            url: 'api/get-bhyt-moi-nhat-theo-nv/' + id_nv,
            headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
        })
        .then((response) => {
            vm.nhan_vien_bhyt = [];
            vm.nhan_vien_bhyt = response.data;
            console.log(response);
        })
        .catch((error) => {
            console.log(error);
        })
}
