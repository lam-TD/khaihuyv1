import login from './components/login_register/Login.vue';
import dashboard from './components/dashboard/Dashboard';

//======= NHAN SU =======
import phongban from './components/nhan_su/phongban/PhongBan.vue';
import bophan from './components/nhan_su/bophan/BoPhan.vue';
import vitri from './components/nhan_su/vitri/ViTri';
import bangluong from './components/nhan_su/bangluong/BangLuong.vue';
import bangthuong from './components/nhan_su/bangthuong/BangThuong.vue';
import mainnhanvien from './components/nhan_su/danhsachnhanvien/MainNhanVien';
import danhsachnhanvien from './components/nhan_su/danhsachnhanvien/DanhSachNhanVien.vue';
import thongtinnhanvien from './components/nhan_su/danhsachnhanvien/ThongTinNhanVien.vue';

//======= SAN PHAM =======
import thongtinsanpham from './components/san_pham/ThongTinSanPham';

//======= HE THONG =======
import quanlynhom from './components/he_thong/quan_ly_nhom/QuanLyNhom.vue';
import quanlynguoidung from './components/he_thong/quan_ly_nguoi_dung/QuanLyNguoiDung';

export const routes = [
    {
        path: '/',
        name: 'login',
        component: login
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: dashboard
    },
    {
        path: '/phongban',
        component: phongban
    },
    {
        path: '/bophan',
        component: bophan
    },
    {
        path: '/vitri',
        component: vitri
    },
    {
        path: '/bangluong',
        component: bangluong
    },
    {
        path: '/bangthuong',
        component: bangthuong
    },
    {
        path: '/danhsachnhanvien',
        component: mainnhanvien,
        children: [
            {
                path: '/',
                component: danhsachnhanvien
            },
            {
                path: '/themmoi',
                component: thongtinnhanvien
            },
            {
                path: ':id',
                component: thongtinnhanvien
            }
        ]
    },
    {
        path: '/thongtinsanpham',
        component: thongtinsanpham
    },
    {
        path: '/quanlynhom',
        component: quanlynhom
    },
    {
        path: '/quanlynguoidung',
        component: quanlynguoidung
    }
]