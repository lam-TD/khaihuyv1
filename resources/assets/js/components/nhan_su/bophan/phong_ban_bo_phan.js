import axios from 'axios';
import {api_bophan_get_danh_sach_phong_theo_bo_phan} from './bo_phan';
import {sweetalert} from "../../../helper/sweetalert";
export function api_add_phong_ban(vm) {
    vm.flag_input_phong_ban = false;
    // var p = { id_bo_phan: id_bo_phan, ma_phong: vm.phong_ban.ma_phong, ten_phong: vm.phong_ban.ten_phong, dien_giai: vm.phong_ban.dien_giai }
    axios({
        method: 'POST',
        url: 'api/add-phong-ban',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.phong_ban
    })
        .then((response) => {
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#modal_phong').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_bophan_get_danh_sach_phong_theo_bo_phan(vm, vm.phong_ban.id_bo_phan, 1);
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã phòng đã tồn tại!');
            }
            else sweetalert(2, 'Lỗi không thêm được!');
            vm.loading_bo_phan = false;
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
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#modal_phong').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_bophan_get_danh_sach_phong_theo_bo_phan(vm, id_bo_phan, 1);
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã phòng đã tồn tại!');
            }
            else sweetalert(2, 'Lỗi không thêm được!');
            vm.loading_bo_phan = false;
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_phong_ban(vm, id_phong_ban) {
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
                url: 'api/delete-phong-ban/' + vm.phong_ban.id,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Phòng ' + vm.phong_ban.ma_phong + ' đã được xóa!');
                        $('.row-phong').removeClass("active-click-row");
                        api_bophan_get_danh_sach_phong_theo_bo_phan(vm, vm.bo_phan.id_bo_phan, 1);
                        vm.loading_phong_ban = false;
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!'); vm.loading_bo_phan = false; vm.loading_phong_ban = false;};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}