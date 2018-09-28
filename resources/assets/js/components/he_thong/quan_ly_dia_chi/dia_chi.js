import axios from "axios";
import {sweetalert} from "../../../helper/sweetalert";

export function api_get_tinh(vm) {
    axios({
        method: 'GET',
        url: 'api/get-tinh-thanh'
    })
        .then((response) => {
            vm.list_tinh_thanh = response.data;
            vm.tinh_thanh = response.data[0];
            api_get_quan_huyen_theo_tinh_paginate(vm,response.data[0].ma_tinh,1);
        })
        .catch((error) => {

        })
}

export function api_get_tinh_thanh_paginate(vm, page, limit=10) {
    axios({
        method: 'GET',
        url: 'api/get-tinh-thanh-paginate/' + limit + '?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_tinh = false;
            vm.list_tinh_thanh_pa = response.data.data;
            vm.total_tinh = response.data.total;
            console.log(vm.list_tinh_thanh_pa)
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_search_tinh_thanh_paginate(vm, page, limit=10) {
    axios({
        method: 'GET',
        url: 'api/get-search-tinh-thanh-paginate/' + vm.keyword_tinh + '&' + limit + '?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_tinh = false;
            vm.list_tinh_thanh_pa = response.data.data;
            vm.total_tinh = response.data.total;
            console.log(vm.list_tinh_thanh_pa)
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_add_tinh_thanh(vm) {
    vm.flag_input_bo_phan = false;
    axios({
        method: 'POST',
        url: 'api/add-tinh-thanh',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.tinh_thanh_new
    })
        .then((response) => {
            vm.un_change_bnt_save();
            vm.loading_tinh = false;
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#myModalTinh').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_get_tinh_thanh_paginate(vm,1,vm.limit_tinh);
            }
            else if(response.data == 0){
                vm.loading_tinh = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_tinh_thanh(vm) {
    console.log('bp: ' + vm.$data.bo_phan);
    axios({
        method: 'POST',
        url: 'api/edit-tinh-thanh',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.tinh_thanh_new
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                vm.loading_tinh = false;
                sweetalert(1, 'Cập nhật thành công!');
                $('#myModalTinh').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_get_tinh_thanh_paginate(vm,1,vm.limit_tinh);
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã nhóm vừa chọn đã tồn tại!');
                vm.loading_tinh = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_tinh_thanh(vm) {
    swal({
            title: "Bạn có chắc chắn muốn xóa tỉnh vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/delete-tinh-thanh/' + vm.tinh_thanh_new.ma_tinh,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Tỉnh vừa chọn đã được xóa!');
                        api_get_tinh_thanh_paginate(vm,1,vm.limit_tinh);
                        vm.loading_tinh = false;
                    }
                    else if(response.data == 0){
                        sweetalert(0, 'Tỉnh này có chứa quận huyện, vui lòng xóa quận huyện trước');
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!'); vm.loading_tinh = false; vm.loading_phong_ban = false;};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}

//
export function api_get_quan_huyen_theo_tinh_paginate(vm, ma_tinh, page) {
    axios({
        method: 'GET',
        url: 'api/get-list-quan-huyen/'+ ma_tinh +'&' + vm.limit_qh + '?page=' + page
    })
        .then((response) => {
            vm.list_qh = response.data.data;
            console.log(vm.list_qh);
            vm.total_qh = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_search_quan_huyen_theo_tinh_paginate(vm, ma_tinh, page) {
    axios({
        method: 'GET',
        url: 'api/get-list-search-quan-huyen/' + vm.keyword_qh + '&' + ma_tinh + '&' + vm.limit_qh + '?page=' + page
    })
        .then((response) => {
            vm.list_qh = response.data.data;
            vm.total_qh = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_add_quan_huyen(vm) {
    vm.flag_input_bo_phan = false;
    axios({
        method: 'POST',
        url: 'api/add-quan-huyen',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.quan_huyen_new
    })
        .then((response) => {
            vm.un_change_bnt_save();
            vm.loading_qh = false;
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#myModalquan').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_get_quan_huyen_theo_tinh_paginate(vm,vm.quan_huyen_new.ma_tinh,1);
            }
            else if(response.data == 0){
                vm.loading_qh = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_quan_huyen(vm) {
    console.log('bp: ' + vm.$data.bo_phan);
    axios({
        method: 'POST',
        url: 'api/edit-quan-huyen',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.quan_huyen_new
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                vm.loading_tinh = false;
                sweetalert(1, 'Cập nhật thành công!');
                $('#myModalquan').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_get_quan_huyen_theo_tinh_paginate(vm,vm.quan_huyen_new.ma_tinh,1);
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã nhóm vừa chọn đã tồn tại!');
                vm.loading_tinh = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_quan_huyen(vm) {
    swal({
            title: "Bạn có chắc chắn muốn xóa quận huyện vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/delete-quan-huyen/' + vm.quan_huyen_new.ma_quan_huyen,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Quận huyện vừa chọn đã được xóa!');
                        api_get_quan_huyen_theo_tinh_paginate(vm,vm.quan_huyen_new.ma_tinh,1);
                        vm.loading_qh = false;
                    }
                    else if(response.data == 0){
                        sweetalert(0, 'Quận huyện này có chứa phường xã, vui lòng xóa phường xã trước');
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!'); vm.loading_qh = false; vm.loading_phong_ban = false;};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}

export function api_get_phuong_xa_theo_quan_huyen_paginate(vm, ma_quan_huyen, page) {
    axios({
        method: 'GET',
        url: 'api/get-list-phuong-xa-theo-quan-huyen-paginate/' + ma_quan_huyen + '&' + vm.limit_px + '?page=' + page
    })
        .then((response) => {
            vm.list_px = response.data.data;
            console.log(vm.list_px);
            vm.total_px = response.data.total;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_add_phuong_xa(vm) {
    axios({
        method: 'POST',
        url: 'api/add-phuong-xa',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.phuong_xa_new
    })
        .then((response) => {
            vm.un_change_bnt_save();
            vm.loading_qh = false;
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#myModalquan').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_get_quan_huyen_theo_tinh_paginate(vm,vm.quan_huyen_new.ma_tinh,1);
            }
            else if(response.data == 0){
                vm.loading_qh = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_phuong_xa(vm) {
    console.log('bp: ' + vm.$data.bo_phan);
    axios({
        method: 'POST',
        url: 'api/edit-quan-huyen',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.phuong_xa_new
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                vm.loading_tinh = false;
                sweetalert(1, 'Cập nhật thành công!');
                $('#myModalquan').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_get_quan_huyen_theo_tinh_paginate(vm,vm.quan_huyen_new.ma_tinh,1);
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã nhóm vừa chọn đã tồn tại!');
                vm.loading_tinh = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_phuong_xa(vm) {
    swal({
            title: "Bạn có chắc chắn muốn xóa quận huyện vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/delete-quan-huyen/' + vm.quan_huyen_new.ma_quan_huyen,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Quận huyện vừa chọn đã được xóa!');
                        api_get_quan_huyen_theo_tinh_paginate(vm,vm.quan_huyen_new.ma_tinh,1);
                        vm.loading_qh = false;
                    }
                    else if(response.data == 0){
                        sweetalert(0, 'Quận huyện này có chứa phường xã, vui lòng xóa phường xã trước');
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!'); vm.loading_qh = false; vm.loading_phong_ban = false;};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}