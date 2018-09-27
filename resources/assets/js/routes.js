import login from './components/login_register/Login.vue';
import dashboard from './components/dashboard/Dashboard';

//======= NHAN SU =======
import phongban from './components/nhan_su/phongban/PhongBan.vue';
import bophan from './components/nhan_su/bophan/BoPhan.vue';
import vitri from './components/nhan_su/vitri/ViTri.vue';
import bangluong from './components/nhan_su/bangluong/BangLuong.vue';
import bangthuong from './components/nhan_su/bangthuong/BangThuong.vue';
import mainnhanvien from './components/nhan_su/danhsachnhanvien/MainNhanVien';
import danhsachnhanvien from './components/nhan_su/danhsachnhanvien/DanhSachNhanVien.vue';
import thongtinnhanvien from './components/nhan_su/danhsachnhanvien/ThongTinNhanVien.vue';
import thongtincongviec from './components/nhan_su/thongtincongviec/ThongTinCongViec';
import thongtinlaodong from './components/nhan_su/thongtinlaodong/ThongTinLaoDong';
import baohiemyte from './components/nhan_su/baohiemyte/BaoHiemYTe';
import nguoiphuthuoc from './components/nhan_su/nguoiphuthuoc/NguoiPhuThuoc';

//======= SAN PHAM =======
import danhmucsanpham from './components/san_pham/DanhMucSanPham';
import thongtinsanpham from './components/san_pham/ThongTinSanPham';
import danhsachsanpham from './components/san_pham/DanhSachSanPham';

//======= HE THONG =======
import quanlynhom from './components/he_thong/quan_ly_nhom/QuanLyNhom.vue';
import quanlynguoidung from './components/he_thong/quan_ly_nguoi_dung/QuanLyNguoiDung';

export const routes = [
    {
        path: '/',
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
            }
        ]
    },
    {
        path: '/hopdonglaodong',
        component: thongtinlaodong
    },
    {
        path: '/baohiemyte',
        component: baohiemyte
    },
    {
        path: '/thongtincongviec',
        component: thongtincongviec
    },
    {
        path: '/nguoiphuthuoc',
        component: nguoiphuthuoc
    },
    {
        path: '/thongtinsanpham',
        component: thongtinsanpham
    },
    {
        path: '/danhsachsanpham',
        component: danhsachsanpham
    },
    {
        path: '/danhmucsanpham',
        component: danhmucsanpham
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