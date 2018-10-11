import axios from "axios/index";
import {sweetalert} from '../../../helper/sweetalert';

export function api_get_nhom_chuc_nang(vm) {
    vm.flag_nhom_chuc_nang = true;
    axios({
        method: 'GET',
        url: 'api/danh-sach-nhom-chuc-nang',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.flag_nhom_chuc_nang = false;
            vm.list_nhom_chuc_nang = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_chuc_nang_theo_nhom(vm, type="all") {
    vm.flag_chuc_nang = true;
    axios({
        method: 'GET',
        url: 'api/danh-sach-chuc-nang-theo-nhom/' + vm.nhom_nguoi_dung.id + '&' + type,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_chuc_nang = response.data;
            api_get_chuc_nang_theo_nhom_2(vm,1);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_chuc_nang_theo_nhom_2(vm, type) {
    vm.flag_chuc_nang = true;
    axios({
        method: 'GET',
        url: 'api/danh-sach-chuc-nang-theo-nhom/' + vm.nhom_nguoi_dung.id + '&' + type,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            if(type == "all"){
                vm.list_chuc_nang = response.data;
            }
            else {
                vm.list_chuc_nang_cua_nhom = response.data;
                vm.check_quyen_cho_nhom(response.data);
            }
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_chuc_nang_theo_nhom_nguoi_dung_va_nhom_chuc_nang(vm, id_nhom_nd, id_nhom_cn, type="all") {
    axios({
        method: 'GET',
        url: 'api/get-chuc-nang-theo-nhom-nguoi-dung-va-nhom-chuc-nang/' + id_nhom_nd + '&' + id_nhom_cn + '&' + type,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_chuc_nang = response.data;
            api_get_chuc_nang_theo_nhom_nguoi_dung_va_nhom_chuc_nang_2(vm, id_nhom_nd, id_nhom_cn, 1)
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_chuc_nang_theo_nhom_nguoi_dung_va_nhom_chuc_nang_2(vm, id_nhom_nd, id_nhom_cn, type) {
    axios({
        method: 'GET',
        url: 'api/get-chuc-nang-theo-nhom-nguoi-dung-va-nhom-chuc-nang/' + id_nhom_nd + '&' + id_nhom_cn + '&' + type,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_chuc_nang_cua_nhom = response.data;
            vm.check_quyen_cho_nhom(response.data);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_save_phan_quyen(vm, arr) {
    axios({
        method: 'POST',
        url: 'api/save-phan-quyen',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: arr
    })
        .then((response) => {
            if(response.data == 1){
                sweetalert(1, 'Lưu thành công!');
            }
            else{
                sweetalert(0, 'Lỗi không lưu được!');
            }
        })
        .catch((error) => {
            console.log(error);
            sweetalert(0, 'Lỗi không lưu được!');
        })
}
