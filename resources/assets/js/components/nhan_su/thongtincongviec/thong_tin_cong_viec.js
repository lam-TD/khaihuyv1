import axios from 'axios';
import {sweetalert} from '../../../helper/sweetalert';

export function api_search_all_ttcv(vm, page) {
    axios({
        method: 'GET',
        url: 'api/search-ttcv/'+ vm.keyword +'/'+vm.limit+'?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_ttcv = false;
            vm.list_ttcv = response.data.data;
            vm.total_ttcv = response.data.total;
            vm.index_ttcv = page * 10;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_all_ttcv(vm, page) {
    axios({
        method: 'GET',
        url: 'api/get-all-ttcv/'+vm.limit+'?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_ttcv = false;
            vm.list_ttcv = response.data.data;
            vm.total_ttcv = response.data.total;
            vm.index_ttcv = page * 10;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_add_ttcv(vm) {
    vm.flag_input_ttcv = false;
    axios({
        method: 'POST',
        url: 'api/add-ttcv',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.ttcv
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.danh_sach_ttcv();
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã bảo hiểm đã tồn tại!');
                vm.loading_ttcv = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_ttcv(vm) {
    axios({
        method: 'POST',
        url: 'api/edit-ttcv',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.ttcv
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Cập nhật thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.danh_sach_ttcv();
            }
            else sweetalert(2, 'Lỗi cập nhật được thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_ttcv(vm) {
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
                url: 'api/delete-ttcv/' + vm.ttcv.id,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Thông tin công việc đã được xóa!');
                        $('.row-nhom').removeClass("active-click-row");
                        vm.flag_btn = true;
                        vm.danh_sach_ttcv();
                        vm.loading_ttcv = false;
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!'); vm.loading_ttcv = false; vm.loading_phong_ban = false;};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}

export function api_get_vi_tri_all_theo_phong(vm, id_phong) {
    axios({
        method: 'GET',
        url: 'api/get-vi-tri-all-theo-phong/'+ id_phong,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_vi_tri = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_ttcv_hien_tai_theo_nhan_vien(vm, manv) {
    axios({
        method: 'GET',
        url: 'api/get-ttcv-hien-tai-theo-nhan-vien/'+ manv,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.ttcv = response.data;

        })
        .catch((error) => {
            console.log(error);
        })
}
