import axios from "axios";

export function api_nhan_vien_get_all_no_pa(vm) {
    axios({
        method: 'GET',
        url: 'api/get-all-nhan-vien-no-pa',
        headers: {'Authorization':'Bearer ' + vm.$store.state.currentUser.token}
    })
        .then((response) => {
            vm.list_nhan_vien = response.data;
        })
        .catch((error) => {
            console.log(error);
        })
}