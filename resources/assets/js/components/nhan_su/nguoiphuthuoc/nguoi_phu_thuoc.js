import axios from "axios";
import {sweetalert} from '../../../helper/sweetalert';

export function api_get_all_danh_sach_npt(vm, page) {
    axios({
        method: 'GET',
        url: 'api/get-all-npt/?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_npt = false;
            vm.list_npt = response.data.data;
            vm.total_npt = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_danh_sach_npt_theo_nhan_vien(vm, ma_nv, page) {
    axios({
        method: 'GET',
        url: 'api/get-npt-theo-nhan-vien/'+ ma_nv +'?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_npt = false;
            vm.list_npt = response.data.data;
            vm.total_npt = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_add_npt(vm) {
    axios({
        method: 'POST',
        url: 'api/add-npt',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.npt
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_get_danh_sach_npt_theo_nhan_vien(vm, vm.$data.npt.ma_nv,1);
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã vị trí đã tồn tại!');
                vm.loading_npt = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_npt(vm) {
    axios({
        method: 'POST',
        url: 'api/edit-npt',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.npt
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Cập nhật thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.danh_sach_npt();
            }
            else sweetalert(2, 'Lỗi không cập nhật được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_npt(vm) {
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
                url: 'api/delete-npt/' + vm.npt.id,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Người phụ thuôc đã được xóa!');
                        $('.row-nhom').removeClass("active-click-row");
                        vm.flag_btn = true;
                        api_get_danh_sach_npt_theo_nhan_vien(vm, vm.$data.npt.ma_nv,1);
                        vm.loading_npt = false;
                    }
                    else if(response.data == 0){
                        sweetalert(0, 'Phòng này có chứa vị trí, vui lòng xóa vị trí trước');
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!'); vm.loading_npt = false;};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}