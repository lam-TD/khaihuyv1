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

export function getLocalUser() {
    const userStr = localStorage.getItem("user");

    if(!userStr) return null;

    return JSON.parse(userStr);
}

export function get_chuc_nang() {

}