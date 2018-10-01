import axios from "axios";
import {sweetalert} from "../../helper/sweetalert";

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

export function api_add_san_pham(vm) {
    vm.flag_input_bo_phan = false;
    axios({
        method: 'POST',
        url: 'api/add-san-pham',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token},
        data: vm.$data.sp
    })
        .then((response) => {
            vm.un_change_bnt_save();
            if(response.data == 1){
                sweetalert(1, 'Thêm thành công!');
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