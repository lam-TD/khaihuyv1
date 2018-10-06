import axios from "axios";
import {sweetalert} from "../../../helper/sweetalert";

export function api_get_danh_muc_san_pham_theo_id(vm) {
    if(typeof vm.$route.query.id == 'undefined'){vm.$router.push({path: '/danhmucsanpham'});}
    axios({
        method: 'GET',
        url: 'api/get-danh-muc-san-pham-theo-id/' + vm.$route.query.id,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.danh_muc = response.data;
            vm.load_select_sap_xep(response.data.danhmucsapxep);
            api_get_danh_sach_san_pham_theo_danh_muc(vm,1);
            // console.log(vm.danh_muc);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_danh_sach_san_pham_theo_danh_muc(vm, page) {
    if(typeof vm.$route.query.id == 'undefined'){vm.$router.push({path: '/danhmucsanpham'});}
    console.log('api/get-danh-sach-san-pham-theo-danh-muc/' + vm.$route.query.id + '&' + vm.limit + '&' + vm.danh_muc.danhmucsapxep + '?page=' + page);
    vm.loading_sp = true;
    axios({
        method: 'GET',
        url: 'api/get-danh-sach-san-pham-theo-danh-muc/' + vm.$route.query.id + '&' + vm.limit + '&' + vm.danh_muc.danhmucsapxep + '?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_sp = false;
            vm.list_san_pham = response.data.data;
            vm.total_san_pham = response.data.total;
            console.log(vm.list_san_pham);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_get_all_danh_muc_san_pham(vm) {
    axios({
        method: 'GET',
        url: 'api/get-danh-muc-san-pham',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_danh_muc_2 = response.data;
            // console.log(vm.list_danh_muc);
        })
        .catch((error) => {
            console.log(error);
        })
}
export function api_get_all_danh_muc_san_pham_pa(vm, page) {
    var old_url = 'api/get-danh-muc-san-pham-pa/ + vm.limit?page=page';
    axios({
        method: 'GET',
        url: 'api/get-danh-muc-san-pham',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_danh_muc = response.data;
            vm.total_danh_muc = response.data.length;
            // console.log(vm.list_danh_muc);
        })
        .catch((error) => {
            console.log(error);
        })
}
//add
export function api_add_danh_muc(vm) {
    axios({
        method: 'POST',
        url: 'api/add-danh-muc',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.danh_muc
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
                $('#modal_danh_muc_san_pham').modal('hide');
                $('.modal-backdrop').css('display','none');
                api_get_all_danh_muc_san_pham_pa(vm,1);
            }
            else if(response.data == 0){
                sweetalert(0, 'Mã danh mục đã tồn tại!');
            }
            else sweetalert(2, 'Lỗi không thêm được!');
        })
        .catch((error) => {
            console.log(error);
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}
//edit
export function api_edit_danh_muc(vm) {
    axios({
        method: 'POST',
        url: 'api/edit-danh-muc/'+vm.danh_muc.danh_muc_id,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.danh_muc
    })
        .then((response) => {
            console.log(response.data);
            vm.un_change_bnt_save();
            if(response.data == 1){
                if(vm.danh_muc.danhmucsapxep == 'manual'){
                    api_sap_xep_san_pham_trong_danh_muc(vm);
                }
                sweetalert(1, 'Cập nhật thành công!');
                api_get_danh_muc_san_pham_theo_id(vm);
                api_get_all_danh_muc_san_pham(vm);
            }
            else sweetalert(2, 'Lỗi không thể cập nhật được!');
        })
        .catch((error) => {
            console.log(error);
            vm.un_change_bnt_save();
            sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
        })
}


//xoa
export function api_delete_danh_muc(vm) {
    swal({
            title: "Bạn có chắc chắn muốn xóa danh mục vừa chọn?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/xoa-danh-muc/' + vm.danh_muc.danh_muc_id,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Danh mục vừa chọn đã được xóa!');
                        api_get_all_danh_muc_san_pham_pa(vm,1);
                    }
                    else if(response.data == 0){
                        sweetalert(0, 'Danh mục này có chứa sản phẩm, vui lòng xóa sản phẩm trước');
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!');}
                })
                .catch((error) => {
                    sweetalert(2, 'Lỗi không thực hiện được chức năng này!');
                })

        });
}

// --- San Pham Danh Muc ---
export function api_search_san_pham_trong_danh_muc(vm, page) {
    if(typeof vm.$route.query.id == 'undefined'){vm.$router.push({path: '/danhmucsanpham'});}
    axios({
        method: 'GET',
        url: 'api/tim-kiem-san-pham-trong-danh-muc/' + vm.keyword + '&' + vm.danh_muc.danh_muc_id + '&' + vm.danh_muc.danh_muc_id + '?page=' + page,
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.loading_sp = false;
            vm.list_san_pham = response.data.data;
            vm.total_san_pham = response.data.total;
            console.log(vm.list_san_pham);
        })
        .catch((error) => {
            console.log(error);
        })
}

export function api_delete_san_pham_trong_danh_muc(vm, ma_sp) {
    if(typeof vm.$route.query.id == 'undefined'){vm.$router.push({path: '/danhmucsanpham'});}
    swal({
            title: "Bạn có chắc chắn muốn xóa sản phẩm vừa chọn ra khỏi danh mục ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function() {
            axios({
                method: 'GET',
                url: 'api/delete-san-pham-ra-khoi-danh-muc/' + ma_sp + '&' + vm.$route.query.id,
                headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
            })
                .then((response) => {
                    if(response.data == 1) {
                        sweetalert(1, 'Đã xóa sản phẩm khỏi danh mục!');
                        api_get_danh_muc_san_pham_theo_id(vm);
                    }
                    else {sweetalert(2, 'Lỗi không xóa được!');}
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                })
        });
}

export function api_sap_xep_san_pham_trong_danh_muc(vm) {
    if(typeof vm.$route.query.id == 'undefined'){vm.$router.push({path: '/danhmucsanpham'});}
    axios({
        method: 'POST',
        url: 'api/sap-xep-thu-tu-san-pham-trong-danh-muc',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: {
            list_san_pham: vm.list_san_pham,
            currentPage: vm.currentPage,
            limit: vm.limit
        }
    })
        .then((response) => {
            vm.un_change_bnt_save();
            console.log(response.data);
        })
        .catch((error) => {
            vm.un_change_bnt_save();
            console.log(error);
        })
}