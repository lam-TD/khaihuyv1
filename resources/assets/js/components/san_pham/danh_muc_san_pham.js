import axios from "axios";

export function api_get_all_danh_muc_san_pham(vm) {
    axios({
        method: 'GET',
        url: 'api/get-danh-muc-san-pham',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_danh_muc = response.data;
            console.log(vm.list_danh_muc);
        })
        .catch((error) => {
            console.log(error);
        })
}