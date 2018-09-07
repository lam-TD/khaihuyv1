import axios from 'axios';
import {sweetalert} from '../../../helper/sweetalert';


export function api_bophan_get(vm, page) {
    // axios.interceptors.request.use(function(config) {
    //     vm.loading_bo_phan = true;
    //     return config;
    // });

    axios({
        method: 'GET',
        url: 'api/get-bo-phan?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_bo_phan = response.data.data;
            vm.total_bo_phan = response.data.total;
            vm.loading_bo_phan = false;
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_add_bo_phan(vm) {
    vm.flag_input_bo_phan = false;
    axios({
        method: 'POST',
        url: 'api/add-bo-phan',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.bo_phan
    })
        .then((response) => {
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.danh_sach_bo_phan();
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã bộ đã tồn tại!');
                vm.loading_bo_phan = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_bo_phan(vm) {
    axios({
        method: 'POST',
        url: 'api/edit-bo-phan',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.bo_phan
    })
        .then((response) => {
            if(response.data == 1){
                sweetalert(1, 'Cập nhật thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                vm.danh_sach_bo_phan();
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã nhóm vừa chọn đã tồn tại!');
                vm.loading_bo_phan = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_bo_phan(vm) {
    swal({
            title: "Bạn có chắc chắn muốn xóa bộ phận vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/delete-bo-phan/' + vm.bo_phan.id_bo_phan,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Nhóm ' + vm.bo_phan.ma_bo_phan + ' đã được xóa!');
                        $('.row-nhom').removeClass("active-click-row");
                        vm.flag_btn = true;
                        vm.danh_sach_bo_phan();
                        vm.loading_phong_ban = false;
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!'); vm.loading_bo_phan = false; vm.loading_phong_ban = false;};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}

export function api_bophan_get_danh_sach_phong_theo_bo_phan(vm, id_bo_phan, page) {
    // axios.interceptors.request.use(function(config) {
    //     vm.loading_phong_ban = true;
    //     vm.loading_phong_ban = false;
    //     return config;
    // });
    var lam = 'api/get-phong-theo-bo-phan/'+ id_bo_phan +'?page=' + page;
    console.log(lam);
    axios({
        method: 'GET',
        url: 'api/get-phong-theo-bo-phan/'+ id_bo_phan +'?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_phong_ban = response.data.data;
            vm.total_phong_ban = response.data.total;
            vm.loading_phong_ban = false;
            console.log(response.data.data);
        })
        .catch((error) => {
            console.log(error);
        })
}