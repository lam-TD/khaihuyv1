import axios from "axios";
import {sweetalert} from "../../helper/sweetalert";
import {api_tk_kho_get_paginate} from "./taikhoankho/tai_khoan_kho";

export function api_get_dvt(vm) {
    axios({
        method: 'GET',
        url: 'api/get-dvt'
    })
        .then((response) => {
            vm.list_dvt = response.data;
            vm.don_vi_tinh = response.data[0];
        })
        .catch((error) => {
            console.log(error);
        })
}


export function api_get_all_tk_ke_toan(vm) {
    axios({
        method: 'GET',
        url: 'api/get-all-tk-ke-toan',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_tk_ke_toan = response.data;
            console.log(response.data);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_danh_sach_san_pham_paginate(vm, page) {
    axios({
        method: 'GET',
        url: 'api/get-all-san-pham-paginate/'+ vm.limit_sp +'?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_dsnv = false;
            vm.list_san_pham = response.data.data;
            vm.total_san_pham = response.data.total;
            console.log(vm.list_san_pham);
        })
        .catch((error) => {
            console.log(error);
        })
}


export function api_add_san_pham(vm) {
    vm.flag_input_bo_phan = false;
    axios({
        method: 'POST',
        url: 'api/add-san-pham',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.sp
    })
        .then((response) => {
            // vm.un_change_bnt_save();
            if(response.data >= 1){
                api_upload_image_san_pham(vm, response.data)
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã sản phẩm đã tồn tại!');
                vm.loading_bo_phan = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_san_pham(vm) {
    vm.flag_input_bo_phan = false;
    axios({
        method: 'POST',
        url: 'api/add-san-pham',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.sp
    })
        .then((response) => {
            // vm.un_change_bnt_save();
            if(response.data >= 1){
                sweetalert(0, 'Cập nhật thành công!');
            }
            else sweetalert(2, 'Lỗi không cập nhật được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_san_pham(vm) {
    swal({
            title: "Bạn có chắc chắn muốn xóa sản phẩm vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/delete-san-pham/' + vm.sp.id,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Sản phẩm ' + vm.sp.ma_sp + ' đã được xóa!');
                        api_get_danh_sach_san_pham_paginate(vm,1);
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!');};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}

export function api_upload_image_san_pham(vm, id_san_pham) {
    let formData = new FormData();
    let elem = document.querySelector('.el-upload__input');
    console.log(elem.files);
    for (let i = 0; i < elem.files.length; i++) {
        formData.append(`file[${i}]`, elem.files[i]);
    }

    // axios.post( 'api/upload-img/14',
    //     formData,
    // ).then((response) => {
    //     console.log(response.data);
    // })
    //     .catch((error) => {
    //         console.log(error);
    //     })

    axios({
        method: 'POST',
        url: 'api/upload-img/' + id_san_pham,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: formData
    })
        .then((response) => {
            if(response.data == 1){
                sweetalert(1, 'Thêm sản phẩm thành công!');
            }
            else{
                sweetalert(0, 'Lỗi không thêm được ảnh sản phẩm!');
            }
            vm.$router.push({path: '/danhsachsanpham'});
        })
        .catch((error) => {
            console.log(error);
        })
}
