export function login(credentials) {
    return new Promise((res, rej) => {
        axios.post('api/auth/login', credentials)
            .then((response) => {
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
    for(let i = 0; i < arr_path_chuc_nang_user_dang_co.length; i++){
        for(let j = 0; j < arr_path_chuc_nang_user_dang_co[i].chuc_nang.length; j++){
            arr.push(arr_path_chuc_nang_user_dang_co[i].chuc_nang[j].link);
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
    }
}

export function getLocalUser() {
    const userStr = localStorage.getItem("user");

    if(!userStr) return null;

    return JSON.parse(userStr);
}

export function get_chuc_nang() {

}