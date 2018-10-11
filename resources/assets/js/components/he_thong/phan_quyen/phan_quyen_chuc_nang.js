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

export function api_get_chuc_nang_theo_nhom(vm, type) {
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
