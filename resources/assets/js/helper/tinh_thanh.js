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
    console.log(address);
    var ma_phuong = address.slice(0, address.indexOf(','));
    var ma_quan   = address.slice(address.indexOf(',') + 1, address.lastIndexOf(','));
    var ma_tinh   = address.slice(address.lastIndexOf(',') + 1, address.length);

    // console.log('phuong:' + ma_phuong);
    // console.log('quan:' + ma_quan);
    // console.log('tinh:' + ma_tinh);

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

export function api_get_item_phuong_xa_nhan_vien(vm, ma_tinh, ma_quan_huyen, ma_phuong_xa, type ) {
    var item_px = vm.list_phuong_xa.filter(function(item){
        return (item['phuongxa_id'] == ma_phuong_xa);
    })

    var item_qh = vm.list_quan_huyen.filter(function(item){
        return (item['ma_quan_huyen'] == ma_quan_huyen);
    })

    var item_tt = vm.list_tinh_thanh.filter(function(item){
        return (item['ma_tinh'] == ma_tinh);
    })

    if(type == 1){
        vm.nv_tam_tru.tinh_thanh = item_tt[0];
        vm.load_quan_huyen(item_tt[0]);
        setTimeout(function () {
            vm.nv_tam_tru.quan_huyen = item_qh[0];
            vm.load_phuong_xa(item_qh[0]);
            setTimeout(function () {
                vm.nv_tam_tru.phuong_xa = item_px[0];
            },1000)
        },1000);
    }
    else if(type == 2) {
        vm.nv_thuong_tru.tinh_thanh = item_tt[0];
        vm.load_quan_huyen(item_tt[0]);
        setTimeout(function () {
            vm.nv_thuong_tru.quan_huyen = item_qh[0];
            vm.load_phuong_xa(item_qh[0]);
            setTimeout(function () {
                vm.nv_thuong_tru.phuong_xa = item_px[0];
            },1000)
        },1000);
    }
}

export function api_get_item_phuong_xa_tam_tru(vm, address) {
    // address = 122,4334,555
    console.log(address);
    var ma_phuong = address.slice(0, address.indexOf(','));
    var ma_quan   = address.slice(address.indexOf(',') + 1, address.lastIndexOf(','));
    var ma_tinh   = address.slice(address.lastIndexOf(',') + 1, address.length);

    // console.log('phuong:' + ma_phuong);
    // console.log('quan:' + ma_quan);
    // console.log('tinh:' + ma_tinh);

    var item_px = vm.list_phuong_xa.filter(function(item){
        return (item['phuongxa_id'] == ma_phuong);
    })

    var item_qh = vm.list_quan_huyen.filter(function(item){
        return (item['ma_quan_huyen'] == ma_quan);
    })

    var item_tt = vm.list_tinh_thanh.filter(function(item){
        return (item['ma_tinh'] == ma_tinh);
    })

    vm.nv_tam_tru.tinh_thanh = item_tt[0];
    vm.load_quan_huyen(item_tt[0]);
    setTimeout(function () {
        vm.nv_tam_tru.quan_huyen = item_qh[0];
        vm.load_phuong_xa(item_qh[0]);
        setTimeout(function () {
            vm.nv_tam_tru.phuong_xa = item_px[0];
        },1000)
    },1000);
}

export function api_get_item_phuong_xa_thuong_tru(vm, address) {
    // address = 122,4334,555
    console.log(address);
    var ma_phuong = address.slice(0, address.indexOf(','));
    var ma_quan   = address.slice(address.indexOf(',') + 1, address.lastIndexOf(','));
    var ma_tinh   = address.slice(address.lastIndexOf(',') + 1, address.length);

    // console.log('phuong:' + ma_phuong);
    // console.log('quan:' + ma_quan);
    // console.log('tinh:' + ma_tinh);

    var item_px = vm.list_phuong_xa.filter(function(item){
        return (item['phuongxa_id'] == ma_phuong);
    })

    var item_qh = vm.list_quan_huyen.filter(function(item){
        return (item['ma_quan_huyen'] == ma_quan);
    })

    var item_tt = vm.list_tinh_thanh.filter(function(item){
        return (item['ma_tinh'] == ma_tinh);
    })

    vm.nv_thuong_tru.tinh_thanh = item_tt[0];
    vm.load_quan_huyen(item_tt[0]);
    setTimeout(function () {
        vm.nv_thuong_tru.quan_huyen = item_qh[0];
        vm.load_phuong_xa(item_qh[0]);
        setTimeout(function () {
            vm.nv_thuong_tru.phuong_xa = item_px[0];
        },1000)
    },1000);
}

export function api_load_ten_tinh_quan_huyen (vm, address) {
    var ma_quan_huyen = address.slice(0, address.indexOf(','));
    var ma_tinh       = address.slice(address.indexOf(',') + 1,address.length);
    // console.log('quan:' + ma_quan_huyen);
    // console.log('tinh:' + ma_tinh);
    var list_tinh_thanh = [];
    var item_qh = [];
    var item_tt = [];
    axios({
        method: 'GET',
        url: 'api/get-tinh-thanh'
    })
        .then((response) => {
            list_tinh_thanh = response.data;
            item_tt = response.data.filter(function(item){
                return (item['ma_tinh'] == ma_tinh);
            })
        })
        .catch((error) => {

        })

    // axios({
    //     method: 'GET',
    //     url: 'api/get-quan-huyen'
    // })
    //     .then((response2) => {
    //         item_qh = response2.data.filter(function(item2){
    //             return (item2['ma_quan_huyen'] == ma_quan_huyen);
    //         })
    //     })
    //     .catch((error) => {
    //
    //     })

    setTimeout(function () {
        var name = item_tt[0].ten_tinh;
        console.log(item_tt[0].ten_tinh);
        return item_tt[0].ten_tinh;
    },5000);
}

export function load_ten_tinh(ma_tinh) {
    axios({
        method: 'GET',
        url: 'api/get-tinh-thanh'
    })
        .then((response) => {
            list_tinh_thanh = response.data;
            var item_tt = response.data.filter(function(item){
                return (item['ma_tinh'] == ma_tinh);
            })
            return item_tt[0].ten_tinh;
        })
        .catch((error) => {
            return '';
        })
}