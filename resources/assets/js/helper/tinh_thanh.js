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

export function api_get_item_phuong_xa(vm, address) {
    // address = 122,4334,555
    var ma_phuong = address.slice(0, address.indexOf(','));
    var ma_quan   = address.slice(address.indexOf(',') + 1, address.lastIndexOf(','));
    var ma_tinh   = address.slice(address.lastIndexOf(',') + 1, address.length);

    console.log('phuong:' + ma_phuong);
    console.log('quan:' + ma_quan);
    console.log('tinh:' + ma_tinh);

    var item_px = vm.list_phuong_xa.filter(function(item){
        return (item['phuongxa_id'] == ma_phuong);
    })

    var item_qh = vm.list_quan_huyen.filter(function(item){
        return (item['ma_quan_huyen'] == ma_quan);
    })

    var item_tt = vm.list_tinh_thanh.filter(function(item){
        return (item['ma_tinh'] == ma_tinh);
    })

    vm.dia_chi.tinh_thanh = item_tt[0];
    vm.load_quan_huyen(item_tt[0]);
    setTimeout(function () {
        vm.dia_chi.quan_huyen = item_qh[0];
        vm.load_phuong_xa(item_qh[0]);
        setTimeout(function () {
            vm.dia_chi.phuong_xa = item_px[0];
        },1000)
    },1000);
}