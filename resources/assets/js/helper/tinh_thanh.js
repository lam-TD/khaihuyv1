import axios from "axios";

export function api_get_tinh(vm) {
    axios({
        method: 'GET',
        url: 'api/get-tinh-thanh'
    })
        .then((response) => {
            vm.list_tinh_thanh = response.data;
            vm.tinh_thanh = response.data[0];
        })
        .catch((error) => {

        })
}

export function api_get_quan_huyen(vm) {
    axios({
        method: 'GET',
        url: 'api/get-quan-huyen'
    })
        .then((response) => {
            vm.list_quan_huyen = response.data;
        })
        .catch((error) => {

        })
}

export function api_get_phuong_xa(vm) {
    axios({
        method: 'GET',
        url: 'api/get-phuong-xa'
    })
        .then((response) => {
            vm.list_phuong_xa = response.data;
        })
        .catch((error) => {

        })
}