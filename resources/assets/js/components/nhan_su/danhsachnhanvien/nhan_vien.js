import axios from "axios";
import {sweetalert} from "../../../helper/sweetalert";

export function api_get_nhan_vien(vm, page) {
    axios({
        method: 'GET',
        url: 'api/nhan-vien?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_dsnv = false;
            vm.dsnhanvien = response.data.data;
            vm.dsnhanvien_total = response.data.total;
            console.log(response.data);
        })
        .catch((error) => {
            console.log(error);
            this.flag = true;
        })
}

export function api_add_nhan_vien_thong_tin_ca_nhan(vm) {
    axios({
        method: 'POST',
        url: 'api/add-nhan-vien-thong-tin-ca-nhan',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.nhan_vien
    })
        .then((response) => {
            // console.log(response.data); return 1;
            if(response.data == 1){
                vm.flag_xu_ly_tt_ca_nhan = true;
                vm.un_change_bnt_save();
                sweetalert(1, 'Thêm thành công!');
                $('#modal_nv_tt_ca_nhan').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.getNhanVien();
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã nhân viên đã tồn tại!');
                vm.loading_bo_phan = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_nhan_vien_thong_tin_ca_nhan(vm) {
    axios({
        method: 'POST',
        url: 'api/edit-nhan-vien-thong-tin-ca-nhan',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.nhan_vien
    })
        .then((response) => {
            if(response.data == 1){
                vm.flag_xu_ly_tt_ca_nhan = true;
                vm.un_change_bnt_save();
                sweetalert(1, 'Cập nhật thành công!');
                $('#modal_nv_tt_ca_nhan').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.getNhanVien();
            }
            else sweetalert(2, 'Lỗi không cập nhật được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}