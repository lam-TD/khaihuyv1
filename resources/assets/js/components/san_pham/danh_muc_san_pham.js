import axios from "axios";
import {sweetalert} from "../../helper/sweetalert";

export function api_get_all_danh_muc_san_pham(vm) {
    axios({
        method: 'GET',
        url: 'api/get-danh-muc-san-pham',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_danh_muc_2 = response.data;
            console.log(vm.list_danh_muc_2);
        })
        .catch((error) => {
            console.log(error);
        })
}
export function api_get_all_danh_muc_san_pham_pa(vm, page) {
    axios({
        method: 'GET',
        url: 'api/get-danh-muc-san-pham-pa/'+vm.limit+'?page='+page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_danh_muc = response.data.data;
            vm.total_danh_muc = response.data.total;
            console.log(vm.list_danh_muc);
        })
        .catch((error) => {
            console.log(error);
        })
}
//add
export function api_add_danh_muc(vm) {
    axios({
        method: 'POST',
        url: 'api/add-danh-muc',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.danh_muc
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#modal_danh_muc_san_pham').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_get_all_danh_muc_san_pham_pa(vm,1);
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã danh mục đã tồn tại!');
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}
//edit
export function api_edit_danh_muc(vm) {
    axios({
        method: 'POST',
        url: 'api/edit-danh-muc/'+vm.danh_muc.danh_muc_id,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.danh_muc
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#modal_danh_muc_san_pham').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_get_all_danh_muc_san_pham_pa(vm,vm.currentPage);
            }
            else sweetalert(2, 'Lỗi không thể cập nhật được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}
//xoa
export function api_delete_danh_muc(vm) {
    swal({
            title: "Bạn có chắc chắn muốn xóa danh mục vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'POST',
                url: 'api/xoa-danh-muc/'+vm.danh_muc.danh_muc_id,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    console.log(response.data);
                    if(response.data == 1){
                        sweetalert(1, 'Thêm thành công!');
                        api_get_all_danh_muc_san_pham_pa(vm,1);
                    }
                    else if(parseInt(response.data) == 0){
                        sweetalert(2, 'Lỗi không thể xóa được!');
                    }
                    else sweetalert(2, 'Lỗi không thể xóa được!');
                })
                .catch((error) => {
                    console.log(error);
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })
        });
}
