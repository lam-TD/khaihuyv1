export function login(credentials, vm) {
    return new Promise((res, rej) => {
        axios.post('api/auth/login', credentials)
            .then((response) => {
                if(response.data.error == "Unauthorized"){
                    swal({
                            title: "Tài khoản này đã bị khóa",
                            type: "warning",
                            showCancelButton: false,
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Đồng ý",
                            closeOnConfirm: true
                        },
                        function() {
                            vm.$store.commit("logout");
                            vm.$router.push({path: '/'});
                        });
                }
                res(response.data);
            })
            .catch((err) => {
                rej("Tài khoản hoặc mật khẩu không đúng")
            })
    })
}

export function check_url_phan_quyen(vm) {
    var path = vm.$route.path;
    var arr_path_chuc_nang_user_dang_co = vm.$store.state.currentUser.chuc_nang;
    var arr = [];
    var arr_cn = null;
    for(let i = 0; i < arr_path_chuc_nang_user_dang_co.length; i++){
        for(let j = 0; j < arr_path_chuc_nang_user_dang_co[i].chuc_nang.length; j++){
            arr.push(arr_path_chuc_nang_user_dang_co[i].chuc_nang[j].link);
            arr_cn = arr_path_chuc_nang_user_dang_co[i].chuc_nang;
        }
    }

    if(arr.length <= 0){
        vm.$router.push({path: '/'});
    }
    else{
        var check_path = arr.find(function (item) {
            return (item == path);
        })
        if(typeof check_path == "undefined"){
            vm.$router.push({path: '/'});
        }
        // else{
        //     (arr_cn[0].xem)  ? vm.flag_cn.add    = true : vm.flag_cn.add    = false;
        //     (arr_cn[0].them) ? vm.flag_cn.edit   = true : vm.flag_cn.edit   = false;
        //     (arr_cn[0].sua)  ? vm.flag_cn.delete = true : vm.flag_cn.delete = false;
        // }
    }
}

export function check_quyen_chuc_nang(vm) {
    var path = vm.$route.path;

    var arr_path_chuc_nang_user_dang_co = vm.$store.state.currentUser.chuc_nang;
    var arr_cn = [];
    for(let i = 0; i < arr_path_chuc_nang_user_dang_co.length; i++){
        for(let j = 0; j < arr_path_chuc_nang_user_dang_co[i].chuc_nang.length; j++){
            if(arr_path_chuc_nang_user_dang_co[i].chuc_nang[j].link == path){
                (arr_path_chuc_nang_user_dang_co[i].chuc_nang[j].them)  ? vm.flag_cn.add    = true : vm.flag_cn.add    = false;
                (arr_path_chuc_nang_user_dang_co[i].chuc_nang[j].sua)   ? vm.flag_cn.edit   = true : vm.flag_cn.edit   = false;
                (arr_path_chuc_nang_user_dang_co[i].chuc_nang[j].xoa)   ? vm.flag_cn.delete = true : vm.flag_cn.delete = false;
            }
        }
    }
}

export function getLocalUser() {
    const userStr = localStorage.getItem("user");

    if(!userStr) return null;

    return JSON.parse(userStr);
}

export function get_chuc_nang() {

}