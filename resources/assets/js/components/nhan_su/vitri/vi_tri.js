import axios from 'axios';
import {sweetalert} from "../../../helper/sweetalert";

export function api_get_vi_tri(vm, page) {
    console.log("get...");
    axios({
        method: 'GET',
        url: 'api/get-vi-tri?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_vi_tri = response.data.data;
            vm.total_vi_tri = response.data.total;
            vm.loading_vi_tri = false;
            console.log(response.data.data);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_add_vi_tri(vm) {
    axios({
        method: 'POST',
        url: 'api/add-vi-tri',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.vi_tri
    })
        .then((response) => {
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.danh_sach_vi_tri();
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã vị trí đã tồn tại!');
                vm.loading_vi_tri = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_vi_tri(vm) {
    axios({
        method: 'POST',
        url: 'api/edit-vi-tri',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.vi_tri
    })
        .then((response) => {
            if(response.data == 1){
                sweetalert(1, 'Cập nhật thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.danh_sach_vi_tri();
            }
            else sweetalert(2, 'Lỗi không cập nhật được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_vi_tri(vm) {
    swal({
            title: "Bạn có chắc chắn muốn xóa vị trí vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/delete-vi-tri/' + vm.vi_tri.id,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Nhóm ' + vm.vi_tri.ma_vi_tri + ' đã được xóa!');
                        $('.row-nhom').removeClass("active-click-row");
                        vm.flag_btn = true;
                        vm.danh_sach_vi_tri();
                        vm.loading_phong_ban = false;
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!'); vm.loading_vi_tri = false;};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}