import axios from 'axios';
import {sweetalert} from "../../../helper/sweetalert";


export function api_get_all_vi_tri(vm, page) {
    axios({
        method: 'GET',
        url: 'api/get-all-vi-tri/'+vm.limit+'?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_vi_tri = response.data.data;
            vm.total_vi_tri = response.data.total;
            vm.loading_vi_tri = false;
            // console.log(response.data.data);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_vi_tri_theo_phong(vm, id, page) {
    console.log('đấ: ' + id);
    axios({
        method: 'GET',
        url: 'api/get-vi-tri-theo-phong/'+ id +'/'+vm.limit+'?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_vi_tri = response.data.data;
            vm.total_vi_tri = response.data.total;
            vm.loading_vi_tri = false;
            // console.log(response.data.data);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_add_vi_tri(vm) {
    axios({
        method: 'POST',
        url: 'api/add-vi-tri',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.vi_tri
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_get_vi_tri_theo_phong(vm, vm.$data.vi_tri.id_phong_ban, 1);
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã vị trí đã tồn tại!');
                vm.loading_vi_tri = false;
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_edit_vi_tri(vm) {
    axios({
        method: 'POST',
        url: 'api/edit-vi-tri',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.vi_tri
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Cập nhật thành công!');
                $('#myModal').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_get_vi_tri_theo_phong(vm, vm.$data.vi_tri.id_phong_ban, 1);
            }
            else sweetalert(2, 'Lỗi không cập nhật được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}

export function api_delete_vi_tri(vm) {
    swal({
            title: "Bạn có chắc chắn muốn xóa vị trí vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/delete-vi-tri/' + vm.vi_tri.ma_vi_tri,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Vị trí ' + vm.vi_tri.ma_vi_tri + ' đã được xóa!');
                        $('.row-nhom').removeClass("active-click-row");
                        vm.flag_btn = true;
                        api_get_vi_tri_theo_phong(vm, vm.$data.vi_tri.id_phong_ban, 1);
                        vm.loading_phong_ban = false;
                    }
                    else if(response.data == 0){
                        sweetalert(0, 'Vị trí này có nhân viên, vui lòng xóa nhân viên ra khỏi vị trí này');
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!'); vm.loading_vi_tri = false;};
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}