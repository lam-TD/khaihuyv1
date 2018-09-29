import axios from "axios";

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