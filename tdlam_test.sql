/*
 Navicat Premium Data Transfer

 Source Server         : khaihuytest
 Source Server Type    : MySQL
 Source Server Version : 100136
 Source Host           : 35.240.248.119:3306
 Source Schema         : tdlam_test

 Target Server Type    : MySQL
 Target Server Version : 100136
 File Encoding         : 65001

 Date: 18/09/2018 23:55:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bo_phan
-- ----------------------------
DROP TABLE IF EXISTS `bo_phan`;
CREATE TABLE `bo_phan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_bo_phan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_bo_phan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dien_giai` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `an_hien` int(1) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of bo_phan
-- ----------------------------
INSERT INTO `bo_phan` VALUES (15, 'BP000001', 'Bộ phận hành chánh', 'Bộ phận hành chánh', 1, '2018-09-18 00:00:00', '2018-09-18 00:00:00');
INSERT INTO `bo_phan` VALUES (16, 'BP000002', 'Bộ phận nhân sự', 'Bộ phận nhân sự', 1, '2018-09-18 00:00:00', '2018-09-18 08:06:14');
INSERT INTO `bo_phan` VALUES (17, 'BP000003', 'Bộ phận kỹ thuật', 'Bộ phận kỹ thuật', 1, '2018-09-18 00:00:00', '2018-09-18 00:00:00');

-- ----------------------------
-- Table structure for chuc_nang
-- ----------------------------
DROP TABLE IF EXISTS `chuc_nang`;
CREATE TABLE `chuc_nang`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ten_chuc_nang` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `thu_tu` int(10) NULL DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `id_nhom_chuc_nang` int(10) NULL DEFAULT NULL,
  `id_nhom_phan_quyen` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of chuc_nang
-- ----------------------------
INSERT INTO `chuc_nang` VALUES (1, 'Phòng ban', 2, '/phongban', 3, 1);
INSERT INTO `chuc_nang` VALUES (2, 'Bộ phận', 1, '/bophan', 3, NULL);
INSERT INTO `chuc_nang` VALUES (3, 'Bảng lương', 4, '/bangluong', 3, 1);
INSERT INTO `chuc_nang` VALUES (4, 'Bảng thưởng', 5, '/bangthuong', 3, 1);
INSERT INTO `chuc_nang` VALUES (5, 'DS nhân viên', 6, '/danhsachnhanvien', 3, 1);
INSERT INTO `chuc_nang` VALUES (6, 'Sản phẩm', 1, '/thongtinsanpham', 7, 1);
INSERT INTO `chuc_nang` VALUES (7, 'Kho vận', 1, '/khovan', 1, 1);
INSERT INTO `chuc_nang` VALUES (8, 'Kế toán', 1, '/ketoan', 2, 1);
INSERT INTO `chuc_nang` VALUES (9, 'Kỹ thuật', 1, '/kythuat', 4, NULL);
INSERT INTO `chuc_nang` VALUES (10, 'Kinh doanh', 1, '/kinhdoanh', 5, NULL);
INSERT INTO `chuc_nang` VALUES (11, 'Hành chánh', 1, '/hanhchanh', 6, NULL);
INSERT INTO `chuc_nang` VALUES (12, 'Quản lí người dùng', 2, '/quanlynguoidung', 8, NULL);
INSERT INTO `chuc_nang` VALUES (13, 'Quản lý nhóm', 1, '/quanlynhom', 8, NULL);
INSERT INTO `chuc_nang` VALUES (14, 'Vị trí', 3, '/vitri', 3, NULL);
INSERT INTO `chuc_nang` VALUES (15, 'Hợp đồng lao động', 7, '/hopdonglaodong', 3, NULL);
INSERT INTO `chuc_nang` VALUES (16, 'Thông tin công việc', 8, '/thongtincongviec', 3, NULL);
INSERT INTO `chuc_nang` VALUES (17, 'Bảo hiểm y tế', 9, '/baohiemyte', 3, NULL);
INSERT INTO `chuc_nang` VALUES (18, 'Người phụ thuộc', 10, '/nguoiphuthuoc', 3, NULL);

-- ----------------------------
-- Table structure for hop_dong_lao_dong
-- ----------------------------
DROP TABLE IF EXISTS `hop_dong_lao_dong`;
CREATE TABLE `hop_dong_lao_dong`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `so_hdld` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `thoi_han_hd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ngay_ky` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ngay_kt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ghi_chu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `nv_ma` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of hop_dong_lao_dong
-- ----------------------------
INSERT INTO `hop_dong_lao_dong` VALUES (1, '1', '1 nam', '22/03/2018', '22/12/2018', NULL, NULL, NULL, 'KH00002');
INSERT INTO `hop_dong_lao_dong` VALUES (6, '2', '10 năm', '2018-09-05', '2018-09-11', 'aaaaaaa', '2018-09-17 03:44:46', '2018-09-17 04:05:23', 'KH00003');
INSERT INTO `hop_dong_lao_dong` VALUES (19, 'HD009', '3 năm', '2018-09-19', '2018-09-30', 'dsadadad', '2018-09-17 13:16:04', '2018-09-17 16:11:07', 'KH00002');
INSERT INTO `hop_dong_lao_dong` VALUES (21, 'HD00993', '4', '2018-09-03', '2018-09-27', 'fdsfdfdsf', '2018-09-18 15:12:46', '2018-09-18 15:12:46', 'KH00034');

-- ----------------------------
-- Table structure for nhan_vien
-- ----------------------------
DROP TABLE IF EXISTS `nhan_vien`;
CREATE TABLE `nhan_vien`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_nv` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ho_ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gioi_tinh` int(10) NULL DEFAULT NULL,
  `so_cmnd` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `scmnd_noi_cap` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `scmnd_ngay_cap` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `thuong_tru` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `tam_tru` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `di_dong_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `di_dong_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `dt_ban` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `id_phong` int(10) NULL DEFAULT NULL,
  `id_vi_tri` int(10) NULL DEFAULT NULL,
  `mst_cn` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `mst_cn_noi_cap` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `cc_thue_cap` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `ngay_sinh` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `noi_sinh` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `quoc_tich` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `trang_thai` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ma_nv`(`ma_nv`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 135 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nhan_vien
-- ----------------------------
INSERT INTO `nhan_vien` VALUES (126, 'KH00003', 'Bành Văn Bốn', 1, '363982821', 'An Giang', '2018-01-14', 'Cần Thơ', 'Cần Thơ', '0938434384', '0938434343', '0122848484', NULL, NULL, 'MSTCN03', 'Cần Thơ', 'Cần Thơ', '2018-09-10 14:33:27', '2018-09-14 10:36:30', '1992-01-01', 'ádasdasd', 'áda', '', NULL);
INSERT INTO `nhan_vien` VALUES (127, 'KH00002', 'Nguyễn Thị Bự', 0, '363959589', 'Cần Thơ', '2018-05-01', 'Cần Thơ', 'Hậu Giang', '0939845838', '0939845843', '0122494944', NULL, NULL, 'MSTCN02', 'Cần Thơ', 'Cần Thơ', '2018-09-10 14:33:55', '2018-09-15 04:19:53', '1993-05-03', 'Cần Thơ', 'Việt Nam', '1536917380.jpeg', NULL);
INSERT INTO `nhan_vien` VALUES (129, 'KH00005', 'Lò Văn Ún', 1, '394838727', 'Cần Thơ', '2018-09-11', 'dsadadd', 'adadasdsadsadad', '456546456546456', '65464654646', '64646456546', NULL, NULL, '645646546', 'Cần Thơ', 'fsfsdfsdsd', '2018-09-17 11:41:31', '2018-09-17 11:41:31', '1999-05-11', NULL, 'Việt Nam', '', NULL);
INSERT INTO `nhan_vien` VALUES (130, 'KH00034', 'Phang Văn Tới', 1, '4564656', NULL, '2018-09-10', 'DSFSFSFDSFS', 'FDFDFFSDF', '7657765', '65676765', '75767576', NULL, NULL, '76576576', 'Hậu Giang', 'RỶYY', '2018-09-17 11:43:21', '2018-09-18 07:42:38', '2018-09-05', NULL, 'Cam Pu Chia', '', NULL);
INSERT INTO `nhan_vien` VALUES (131, 'KH00023', 'Lò Văn Sậy', 1, '646465464564', 'Bạc Liêu', '2018-09-11', '646656456546', '46646546546', '6456546456', '654654646', '645664', NULL, NULL, '656464', 'Bạc Liêu', '6465546546', '2018-09-17 11:46:12', '2018-09-18 01:40:42', '2018-09-12', NULL, 'Việt Nam', '1537234842.jpeg', NULL);
INSERT INTO `nhan_vien` VALUES (132, 'KH00025', 'Trần Thị Bé', 1, '646465464564', 'Bạc Liêu', '2018-09-11', '646656456546', '46646546546', '6456546456', '654654646', '645664', NULL, NULL, '656464', 'Bạc Liêu', '6465546546', '2018-09-17 11:47:10', '2018-09-18 01:40:31', '2018-09-12', NULL, 'Việt Nam', '1537234831.jpeg', NULL);
INSERT INTO `nhan_vien` VALUES (133, 'KH00345', 'Bành Văn Tới', 0, '0980908908', 'Bến Tre', '2018-09-12', NULL, NULL, '0989053554', '0989053554', '0989053554', NULL, NULL, '0980854545', 'Bến Tre', '56', '2018-09-18 01:40:16', '2018-09-18 01:40:16', '2018-09-04', NULL, 'Việt Nam', '1537234815.jpeg', NULL);
INSERT INTO `nhan_vien` VALUES (134, 'KH000 3', 'Trần Văn Ơn', 1, '012458658787', 'Đồng Tháp', '2018-02-09', NULL, NULL, '1654565464', '465465465', '1849654654', NULL, NULL, '464654164654', 'Đồng Tháp', 'Đồng Tháp', '2018-09-18 13:11:51', '2018-09-18 13:11:51', '1980-12-01', NULL, NULL, '1537276310.jpeg', NULL);

-- ----------------------------
-- Table structure for nhan_vien_bhyt
-- ----------------------------
DROP TABLE IF EXISTS `nhan_vien_bhyt`;
CREATE TABLE `nhan_vien_bhyt`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nv_id` int(10) NULL DEFAULT NULL,
  `so_bhyt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `so_bhxh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `noi_kham` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `dia_chi_kham` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ghi_chu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `phuong_xa_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `nv_id`(`nv_id`) USING BTREE,
  CONSTRAINT `nv_id` FOREIGN KEY (`nv_id`) REFERENCES `nhan_vien` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nhan_vien_bhyt
-- ----------------------------
INSERT INTO `nhan_vien_bhyt` VALUES (5, 127, '12', '123', 'ưqeqeqe', 'Bến Tre', 'rưerwe', '2018-09-17 07:56:46', '2018-09-18 07:25:09', 'undefined,8769,9061');
INSERT INTO `nhan_vien_bhyt` VALUES (7, 126, '12', '12', 'dád', 'Bạc Liêu', 'dấdadadasdsad', '2018-09-17 08:06:21', '2018-09-18 07:24:18', 'undefined,18618,10940');
INSERT INTO `nhan_vien_bhyt` VALUES (8, 127, '345', '5435', 'An Giang', 'Bệnh Viện A', 'sdaddsa', '2018-09-17 12:41:21', '2018-09-18 04:59:04', '5320,10917,24970');
INSERT INTO `nhan_vien_bhyt` VALUES (11, 131, 'BHD987', 'BDH342', 'Bến Tre', 'Bệnh viện F', 'ádadasdsadsad', '2018-09-18 04:33:11', '2018-09-18 04:33:11', '5334,3837,19355');
INSERT INTO `nhan_vien_bhyt` VALUES (12, 133, 'BVB001', 'BVH002', 'Thốt nốt', 'Bệnh viện ED', 'adsadaasa', '2018-09-18 07:31:25', '2018-09-18 07:31:25', '5330,15867,19355');

-- ----------------------------
-- Table structure for nhan_vien_cong_viec
-- ----------------------------
DROP TABLE IF EXISTS `nhan_vien_cong_viec`;
CREATE TABLE `nhan_vien_cong_viec`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nv_id` int(10) NULL DEFAULT NULL,
  `ngay` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tinh_trang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bo_phan_ma` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phong_ma` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `vi_tri_ma` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `he_so_luong` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `luong_co_ban` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `htcv` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cham_cong` int(1) NULL DEFAULT NULL,
  `thoi_gian_lv_bd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `thoi_gian_lv_kt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ghi_chu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nhan_vien_cong_viec
-- ----------------------------
INSERT INTO `nhan_vien_cong_viec` VALUES (5, 127, '2018-08-27', '1', 'BP000001', 'PH000001', 'VT000001', '3.4', '5000000', 'hfsjgfhsgfgfsgh', 0, '07:00', '17:00', 'dádaasd', '2018-09-17 10:34:29', '2018-09-17 12:00:44');
INSERT INTO `nhan_vien_cong_viec` VALUES (6, 126, '2018-09-03', '1', 'BP000002', 'PH000023', 'VT000001', '3.4', '4000000', 'hfsjgfhsgfgfsgh', 1, '07:00', '17:00', 'hhhhhhhh', '2018-09-17 10:35:12', '2018-09-17 12:36:17');
INSERT INTO `nhan_vien_cong_viec` VALUES (7, 129, '2018-09-04', '2', 'BP000001', 'PH000001', 'VT000001', '3.4', '5000000', '10000000', 0, '07:00', '17:00', 'dfsfsdfsdf fsdf sdf sfs dfdsfsfsfsdfsdsd', '2018-09-17 11:48:57', '2018-09-17 12:34:53');
INSERT INTO `nhan_vien_cong_viec` VALUES (8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 0, '08:01', NULL, NULL, '2018-09-18 13:58:06', '2018-09-18 13:58:06');

-- ----------------------------
-- Table structure for nhan_vien_lao_dong
-- ----------------------------
DROP TABLE IF EXISTS `nhan_vien_lao_dong`;
CREATE TABLE `nhan_vien_lao_dong`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nv_id` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `vao_cty` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `thoi_viec` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nam` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `thang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ngay` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `so_hdld` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ngay_ky` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `thoi_han` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `het_han` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `so_bhxh` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `so_bhyt` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `noi_kham` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dia_chi_kham` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ghi_chu` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nhan_vien_lao_dong
-- ----------------------------
INSERT INTO `nhan_vien_lao_dong` VALUES (7, '126', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-10 14:33:28', '2018-09-10 14:33:28');
INSERT INTO `nhan_vien_lao_dong` VALUES (8, '127', '33333333333333333', '333333333333333333', '3333333', '22222222222', '33333333333333333', '3333333333', '2222222222', '22222222222222', '22222222222', '2222222222222222', '22222222222', '2222222222', '22222222222222', '22222222222222', '2018-09-10 14:33:56', '2018-09-10 14:56:29');
INSERT INTO `nhan_vien_lao_dong` VALUES (10, '129', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-17 11:41:31', '2018-09-17 11:41:31');
INSERT INTO `nhan_vien_lao_dong` VALUES (11, '130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-17 11:43:21', '2018-09-17 11:43:21');
INSERT INTO `nhan_vien_lao_dong` VALUES (12, '131', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-17 11:46:13', '2018-09-17 11:46:13');

-- ----------------------------
-- Table structure for nhan_vien_npt
-- ----------------------------
DROP TABLE IF EXISTS `nhan_vien_npt`;
CREATE TABLE `nhan_vien_npt`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ho_ten_npt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ngay_sinh_npt` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `so_cmnd_npt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mst_npt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ma_quoc_tich_npt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quoc_tich_npt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ma_quan_he_nnt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `quan_he_nnt` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tg_giam_tru_tu` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tg_giam_tru_den` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ma_nv` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ghi_chu` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nhan_vien_npt
-- ----------------------------
INSERT INTO `nhan_vien_npt` VALUES (2, 'Trần Văn A', '2018-09-05', 'fdsfd', 'sfsfsf', 'sfsdf', 'fdsfsd', 'fsfffsdfdf', 'fsdfssdfsfs', '2018-08-28', '2018-09-30', 'KH00034', NULL, '2018-09-17 17:20:56', '2018-09-17 17:47:06');
INSERT INTO `nhan_vien_npt` VALUES (3, 'rtetrete', '2018-09-05', 'fdsfd', 'sfsfsf', 'sfsdf', 'fdsfsd', 'fsfffsdfdf', NULL, '2018-08-28', '2018-09-30', 'KH00003', NULL, '2018-09-17 17:21:05', '2018-09-17 17:21:05');

-- ----------------------------
-- Table structure for nhan_vien_thong_tin_cong_viec
-- ----------------------------
DROP TABLE IF EXISTS `nhan_vien_thong_tin_cong_viec`;
CREATE TABLE `nhan_vien_thong_tin_cong_viec`  (
  `id` int(10) NOT NULL,
  `nv_id` int(11) NOT NULL,
  `id_bplv` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_phong` int(10) NULL DEFAULT NULL,
  `id_vi_tri` int(10) NULL DEFAULT NULL,
  `he_so` float(255, 0) NULL DEFAULT NULL,
  `luong_co_ban` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `luong_htcv` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `thoi_gian_lam_viec` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tinh_trang` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cham_cong` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ghi_chu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nhan_vien_thong_tin_cong_viec
-- ----------------------------
INSERT INTO `nhan_vien_thong_tin_cong_viec` VALUES (3, 126, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-10 14:33:29', '2018-09-10 14:33:29');
INSERT INTO `nhan_vien_thong_tin_cong_viec` VALUES (4, 127, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-10 14:33:57', '2018-09-10 14:33:57');

-- ----------------------------
-- Table structure for nhom_chuc_nang
-- ----------------------------
DROP TABLE IF EXISTS `nhom_chuc_nang`;
CREATE TABLE `nhom_chuc_nang`  (
  `id` int(10) NOT NULL,
  `ten_nhom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `thu_tu` int(10) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nhom_chuc_nang
-- ----------------------------
INSERT INTO `nhom_chuc_nang` VALUES (1, 'Kho vận', 'fa fa-tasks', 1);
INSERT INTO `nhom_chuc_nang` VALUES (2, 'Kế toán', 'fa fa-bank', 2);
INSERT INTO `nhom_chuc_nang` VALUES (3, 'Nhân sự', 'fa fa-user-circle-o', 3);
INSERT INTO `nhom_chuc_nang` VALUES (4, 'Kỹ thuật', 'fa fa-gavel', 4);
INSERT INTO `nhom_chuc_nang` VALUES (5, 'Kinh doanh', 'fa fa-handshake-o', 5);
INSERT INTO `nhom_chuc_nang` VALUES (6, 'Hành chánh', 'mdi mdi-widgets', 6);
INSERT INTO `nhom_chuc_nang` VALUES (7, 'Sản phẩm', 'fa fa-bookmark-o', 7);
INSERT INTO `nhom_chuc_nang` VALUES (8, 'Hệ thống', 'fa fa-gears', 8);

-- ----------------------------
-- Table structure for nhom_nguoi_dung
-- ----------------------------
DROP TABLE IF EXISTS `nhom_nguoi_dung`;
CREATE TABLE `nhom_nguoi_dung`  (
  `id` int(10) NOT NULL,
  `ma_nhom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ten_nhom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ghi_chu` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nhom_nguoi_dung
-- ----------------------------
INSERT INTO `nhom_nguoi_dung` VALUES (1, 'QT', 'Quản trị', NULL, NULL, NULL);
INSERT INTO `nhom_nguoi_dung` VALUES (4, 'TP', 'dasdasdad', NULL, '2018-09-04 09:44:27', '2018-09-04 09:44:27');
INSERT INTO `nhom_nguoi_dung` VALUES (10, 'HT', 'đasadsa', NULL, '2018-09-04 09:50:29', '2018-09-04 09:50:29');
INSERT INTO `nhom_nguoi_dung` VALUES (11, 'PP', 'Phó phòng', NULL, '2018-09-04 10:23:49', '2018-09-04 10:23:49');
INSERT INTO `nhom_nguoi_dung` VALUES (31, 'LDT', 'dasdasd', NULL, '2018-09-05 04:05:06', '2018-09-05 04:05:06');
INSERT INTO `nhom_nguoi_dung` VALUES (35, 'HTC', 'Hội Tâm', NULL, '2018-09-05 04:11:54', '2018-09-05 04:17:24');

-- ----------------------------
-- Table structure for nhom_phan_quyen
-- ----------------------------
DROP TABLE IF EXISTS `nhom_phan_quyen`;
CREATE TABLE `nhom_phan_quyen`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_nhom_nguoi_dung` int(10) NULL DEFAULT NULL,
  `id_chuc_nang` int(10) NULL DEFAULT NULL,
  `allaction` bit(1) NULL DEFAULT NULL,
  `xem` bit(1) NULL DEFAULT NULL,
  `them` bit(1) NULL DEFAULT NULL,
  `sua` bit(1) NULL DEFAULT NULL,
  `xoa` bit(1) NULL DEFAULT NULL,
  `ghi_chu` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nhom_phan_quyen
-- ----------------------------
INSERT INTO `nhom_phan_quyen` VALUES (1, 1, 1, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (2, 1, 2, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (3, 1, 3, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (4, 1, 4, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (5, 1, 5, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (6, 1, 6, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (7, 1, 7, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (8, 1, 8, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (9, 1, 9, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (10, 1, 10, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (11, 1, 12, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (12, 1, 13, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (13, 1, 14, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (14, 1, 15, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (15, 1, 16, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (16, 1, 17, b'1', b'0', b'0', b'0', b'0', '0');
INSERT INTO `nhom_phan_quyen` VALUES (17, 1, 18, b'1', b'0', b'0', b'0', b'0', '0');

-- ----------------------------
-- Table structure for phong_ban
-- ----------------------------
DROP TABLE IF EXISTS `phong_ban`;
CREATE TABLE `phong_ban`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_phong` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ten_phong` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `dien_giai` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `id_bo_phan` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `an_hien` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of phong_ban
-- ----------------------------
INSERT INTO `phong_ban` VALUES (39, 'PH000002', 'Kỹ thuật', 'Kỹ thuật', 'BP000001', '2018-09-14 09:23:00', '2018-09-14 09:23:00', NULL);
INSERT INTO `phong_ban` VALUES (41, 'PH000004', 'Phòng bán hàng', 'Phòng bán hàng', 'BP000001', '2018-09-14 09:24:16', '2018-09-14 09:24:16', NULL);
INSERT INTO `phong_ban` VALUES (42, 'PH000079', 'Kỹ thuật 2', 'Kỹ thuật 2', 'BP000002', '2018-09-17 10:15:30', '2018-09-17 12:37:40', NULL);
INSERT INTO `phong_ban` VALUES (43, 'PH000023', 'Kỹ thuật 1', 'Kỹ thuật 1', 'BP000002', '2018-09-17 10:18:58', '2018-09-17 12:37:31', NULL);
INSERT INTO `phong_ban` VALUES (44, 'PH000056', 'AAAAAAA', 'AAAAA', 'BP000003', '2018-09-17 10:19:44', '2018-09-17 10:19:44', NULL);
INSERT INTO `phong_ban` VALUES (47, 'PH000010', 'Phòng giám đốc', 'Phòng giám đốc', 'BP000001', '2018-09-18 08:13:18', '2018-09-18 08:19:43', NULL);

-- ----------------------------
-- Table structure for phuong_xa
-- ----------------------------
DROP TABLE IF EXISTS `phuong_xa`;
CREATE TABLE `phuong_xa`  (
  `phuongxa_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã phường xã',
  `quanhuyen_id` int(11) NULL DEFAULT NULL COMMENT 'mã quận huyện',
  `ten_phuong_xa_url` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'định danh hiển thị trên url',
  `ten_phuong_xa` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'tên phường xã',
  `trang_thai` int(11) NULL DEFAULT NULL COMMENT 'trạng thái',
  `sap_xep` int(11) NULL DEFAULT NULL COMMENT 'sắp xếp',
  PRIMARY KEY (`phuongxa_id`) USING BTREE,
  INDEX `FK_Reference_15`(`quanhuyen_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5410 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of phuong_xa
-- ----------------------------
INSERT INTO `phuong_xa` VALUES (5192, 7033, 'xa-vinh-te', 'Xã Vĩnh Tế', 1, 1);
INSERT INTO `phuong_xa` VALUES (5193, 7033, 'xa-vinh-chau', 'Xã Vĩnh Châu', 1, 2);
INSERT INTO `phuong_xa` VALUES (5194, 7033, 'phuong-nui-sam', 'Phường Núi Sam', 1, 3);
INSERT INTO `phuong_xa` VALUES (5195, 7033, 'phuong-chau-phu-a', 'Phường Châu Phú A', 1, 4);
INSERT INTO `phuong_xa` VALUES (5196, 14809, 'xa-my-khanh', 'Xã Mỹ Khánh', 1, 5);
INSERT INTO `phuong_xa` VALUES (5197, 14809, 'phuong-my-xuyen', 'Phường Mỹ Xuyên', 1, 6);
INSERT INTO `phuong_xa` VALUES (5198, 14809, 'phuong-my-thanh', 'Phường Mỹ Thạnh', 1, 7);
INSERT INTO `phuong_xa` VALUES (5199, 14809, 'phuong-my-phuoc', 'Phường Mỹ Phước', 1, 8);
INSERT INTO `phuong_xa` VALUES (5200, 14809, 'phuong-my-hoa', 'Phường Mỹ Hòa', 1, 9);
INSERT INTO `phuong_xa` VALUES (5201, 14809, 'phuong-dong-xuyen', 'Phường Đông Xuyên', 1, 10);
INSERT INTO `phuong_xa` VALUES (5202, 14809, 'phuong-binh-duc', 'Phường Bình Đức', 1, 11);
INSERT INTO `phuong_xa` VALUES (5203, 8163, 'xa-vinh-trach-dong', 'Xã Vĩnh Trạch Đông', 1, 12);
INSERT INTO `phuong_xa` VALUES (5204, 8163, 'xa-vinh-trach', 'Xã Vĩnh Trạch', 1, 13);
INSERT INTO `phuong_xa` VALUES (5205, 8163, 'xa-hiep-thanh', 'Xã Hiệp Thành', 1, 14);
INSERT INTO `phuong_xa` VALUES (5206, 8163, 'phuong-nha-mat', 'Phường Nhà Mát', 1, 15);
INSERT INTO `phuong_xa` VALUES (5207, 8163, 'phuong-8', 'Phường 8', 1, 16);
INSERT INTO `phuong_xa` VALUES (5208, 8163, 'phuong-5', 'Phường 5', 1, 17);
INSERT INTO `phuong_xa` VALUES (5209, 8163, 'phuong-2', 'Phường 2', 1, 18);
INSERT INTO `phuong_xa` VALUES (5210, 21964, 'xa-son-dong', 'Xã Sơn Đông', 1, 19);
INSERT INTO `phuong_xa` VALUES (5211, 21964, 'xa-phu-hung', 'Xã Phú Hưng', 1, 20);
INSERT INTO `phuong_xa` VALUES (5212, 21964, 'xa-my-thanh-an', 'Xã Mỹ Thạnh An', 1, 21);
INSERT INTO `phuong_xa` VALUES (5213, 21964, 'phuong-phu-tan', 'Phường Phú Tân', 1, 22);
INSERT INTO `phuong_xa` VALUES (5214, 21964, 'phuong-8', 'Phường 8', 1, 23);
INSERT INTO `phuong_xa` VALUES (5215, 21964, 'phuong-6', 'Phường 6', 1, 24);
INSERT INTO `phuong_xa` VALUES (5216, 21964, 'phuong-4', 'Phường 4', 1, 25);
INSERT INTO `phuong_xa` VALUES (5217, 21964, 'phuong-2', 'Phường 2', 1, 26);
INSERT INTO `phuong_xa` VALUES (5218, 21543, 'xa-tan-thanh', 'Xã Tân Thành', 1, 27);
INSERT INTO `phuong_xa` VALUES (5219, 21543, 'xa-tac-van', 'Xã Tắc Vân', 1, 28);
INSERT INTO `phuong_xa` VALUES (5220, 21543, 'xa-ly-van-lam', 'Xã Lý Văn Lâm', 1, 29);
INSERT INTO `phuong_xa` VALUES (5221, 21543, 'xa-hoa-thanh', 'Xã Hòa Thành', 1, 30);
INSERT INTO `phuong_xa` VALUES (5222, 21543, 'xa-hoa-tan', 'Xã Hòa Tân', 1, 31);
INSERT INTO `phuong_xa` VALUES (5223, 21543, 'xa-dinh-binh', 'Xã Định Bình', 1, 32);
INSERT INTO `phuong_xa` VALUES (5224, 21543, 'xa-an-xuyen', 'Xã An Xuyên', 1, 33);
INSERT INTO `phuong_xa` VALUES (5225, 21543, 'phuong-tan-xuyen', 'Phường Tân Xuyên', 1, 34);
INSERT INTO `phuong_xa` VALUES (5226, 21543, 'phuong-tan-thanh', 'Phường Tân Thành', 1, 35);
INSERT INTO `phuong_xa` VALUES (5227, 21543, 'phuong-9', 'Phường 9', 1, 36);
INSERT INTO `phuong_xa` VALUES (5228, 21543, 'phuong-7', 'Phường 7', 1, 37);
INSERT INTO `phuong_xa` VALUES (5229, 21543, 'phuong-5', 'Phường 5', 1, 38);
INSERT INTO `phuong_xa` VALUES (5230, 21543, 'phuong-2', 'Phường 2', 1, 39);
INSERT INTO `phuong_xa` VALUES (5231, 18877, 'xa-tan-thanh', 'Xã Tân Thành', 1, 40);
INSERT INTO `phuong_xa` VALUES (5232, 18877, 'xa-hiep-loi', 'Xã Hiệp Lợi', 1, 41);
INSERT INTO `phuong_xa` VALUES (5233, 18877, 'xa-dai-thanh', 'Xã Đại Thành', 1, 42);
INSERT INTO `phuong_xa` VALUES (5234, 18877, 'phuong-nga-bay', 'Phường Ngã Bảy', 1, 43);
INSERT INTO `phuong_xa` VALUES (5235, 18877, 'phuong-lai-hieu', 'Phường Lái Hiếu', 1, 44);
INSERT INTO `phuong_xa` VALUES (5236, 18877, 'phuong-hiep-thanh', 'Phường Hiệp Thành', 1, 45);
INSERT INTO `phuong_xa` VALUES (5237, 31274, 'xa-vi-tan', 'Xã Vị Tân', 1, 46);
INSERT INTO `phuong_xa` VALUES (5238, 31274, 'xa-tan-tien', 'Xã Tân Tiến', 1, 47);
INSERT INTO `phuong_xa` VALUES (5239, 31274, 'xa-hoa-tien', 'Xã Hoả Tiến', 1, 48);
INSERT INTO `phuong_xa` VALUES (5240, 31274, 'xa-hoa-luu', 'Xã Hoả Lựu', 1, 49);
INSERT INTO `phuong_xa` VALUES (5241, 31274, 'phuong-vii', 'Phường Vii', 1, 50);
INSERT INTO `phuong_xa` VALUES (5242, 31274, 'phuong-iv', 'Phường Iv', 1, 51);
INSERT INTO `phuong_xa` VALUES (5243, 31274, 'phuong-i', 'Phường I', 1, 52);
INSERT INTO `phuong_xa` VALUES (5244, 1217, 'xa-phi-thong', 'Xã Phi Thông', 1, 53);
INSERT INTO `phuong_xa` VALUES (5245, 1217, 'phuong-vinh-thong', 'Phường Vĩnh Thông', 1, 54);
INSERT INTO `phuong_xa` VALUES (5246, 1217, 'phuong-vinh-thanh-van', 'Phường Vĩnh Thanh Vân', 1, 55);
INSERT INTO `phuong_xa` VALUES (5247, 1217, 'phuong-vinh-thanh', 'Phường Vĩnh Thanh', 1, 56);
INSERT INTO `phuong_xa` VALUES (5248, 1217, 'phuong-vinh-quang', 'Phường Vĩnh Quang', 1, 57);
INSERT INTO `phuong_xa` VALUES (5249, 1217, 'phuong-vinh-loi', 'Phường Vĩnh Lợi', 1, 58);
INSERT INTO `phuong_xa` VALUES (5250, 1217, 'phuong-vinh-lac', 'Phường Vĩnh Lạc', 1, 59);
INSERT INTO `phuong_xa` VALUES (5251, 1217, 'phuong-vinh-hiep', 'Phường Vĩnh Hiệp', 1, 60);
INSERT INTO `phuong_xa` VALUES (5252, 1217, 'phuong-vinh-bao', 'Phường Vĩnh Bảo', 1, 61);
INSERT INTO `phuong_xa` VALUES (5253, 1217, 'phuong-rach-soi', 'Phường Rạch Sỏi', 1, 62);
INSERT INTO `phuong_xa` VALUES (5254, 1217, 'phuong-an-hoa', 'Phường An Hòa', 1, 63);
INSERT INTO `phuong_xa` VALUES (5255, 1217, 'phuong-an-binh', 'Phường An Bình', 1, 64);
INSERT INTO `phuong_xa` VALUES (5256, 28450, 'xa-tien-hai', 'Xã Tiên Hải', 1, 65);
INSERT INTO `phuong_xa` VALUES (5257, 28450, 'xa-thuan-yen', 'Xã Thuận Yên', 1, 66);
INSERT INTO `phuong_xa` VALUES (5258, 28450, 'xa-my-duc', 'Xã Mỹ Đức', 1, 67);
INSERT INTO `phuong_xa` VALUES (5259, 28450, 'phuong-to-chau', 'Phường Tô Châu', 1, 68);
INSERT INTO `phuong_xa` VALUES (5260, 28450, 'phuong-phao-dai', 'Phường Pháo Đài', 1, 69);
INSERT INTO `phuong_xa` VALUES (5261, 28450, 'phuong-dong-ho', 'Phường Đông Hồ', 1, 70);
INSERT INTO `phuong_xa` VALUES (5262, 28450, 'phuong-binh-san', 'Phường Bình San', 1, 71);
INSERT INTO `phuong_xa` VALUES (5263, 13717, 'xa-tho-chau', 'Xã Thổ Châu', 1, 72);
INSERT INTO `phuong_xa` VALUES (5264, 13717, 'xa-hon-thom', 'Xã Hòn Thơm', 1, 73);
INSERT INTO `phuong_xa` VALUES (5265, 13717, 'xa-ham-ninh', 'Xã Hàm Ninh', 1, 74);
INSERT INTO `phuong_xa` VALUES (5266, 13717, 'xa-ganh-dau', 'Xã Gành Dầu', 1, 75);
INSERT INTO `phuong_xa` VALUES (5267, 13717, 'xa-duong-to', 'Xã Dương Tơ', 1, 76);
INSERT INTO `phuong_xa` VALUES (5268, 13717, 'xa-cua-duong', 'Xã Cửa Dương', 1, 77);
INSERT INTO `phuong_xa` VALUES (5269, 13717, 'xa-cua-can', 'Xã Cửa Cạn', 1, 78);
INSERT INTO `phuong_xa` VALUES (5270, 13717, 'xa-bai-thom', 'Xã Bãi Thơm', 1, 79);
INSERT INTO `phuong_xa` VALUES (5271, 13717, 'thi-tran-duong-dong', 'Thị trấn Dương Đông', 1, 80);
INSERT INTO `phuong_xa` VALUES (5272, 13717, 'thi-tran-an-thoi', 'Thị trấn An Thới', 1, 81);
INSERT INTO `phuong_xa` VALUES (5273, 12809, 'phuong-9', 'Phường 9', 1, 82);
INSERT INTO `phuong_xa` VALUES (5274, 12809, 'phuong-7', 'Phường 7', 1, 83);
INSERT INTO `phuong_xa` VALUES (5275, 12809, 'phuong-5', 'Phường 5', 1, 84);
INSERT INTO `phuong_xa` VALUES (5276, 12809, 'phuong-3', 'Phường 3', 1, 85);
INSERT INTO `phuong_xa` VALUES (5277, 12809, 'phuong-10', 'Phường 10', 1, 86);
INSERT INTO `phuong_xa` VALUES (5278, 3111, 'xa-trung-an', 'Xã Trung An', 1, 87);
INSERT INTO `phuong_xa` VALUES (5279, 3111, 'xa-tan-my-chanh', 'Xã Tân Mỹ Chánh', 1, 88);
INSERT INTO `phuong_xa` VALUES (5280, 3111, 'xa-my-phong', 'Xã Mỹ Phong', 1, 89);
INSERT INTO `phuong_xa` VALUES (5281, 3111, 'phuong-tan-long', 'Phường Tân Long', 1, 90);
INSERT INTO `phuong_xa` VALUES (5282, 3111, 'phuong-8', 'Phường 8', 1, 91);
INSERT INTO `phuong_xa` VALUES (5283, 3111, 'phuong-6', 'Phường 6', 1, 92);
INSERT INTO `phuong_xa` VALUES (5284, 3111, 'phuong-4', 'Phường 4', 1, 93);
INSERT INTO `phuong_xa` VALUES (5285, 3111, 'phuong-2', 'Phường 2', 1, 94);
INSERT INTO `phuong_xa` VALUES (5286, 3111, 'phuong-1', 'Phường 1', 1, 95);
INSERT INTO `phuong_xa` VALUES (5287, 16102, 'xa-tan-trung', 'Xã Tân Trung', 1, 96);
INSERT INTO `phuong_xa` VALUES (5288, 16102, 'xa-long-hung', 'Xã Long Hưng', 1, 97);
INSERT INTO `phuong_xa` VALUES (5289, 16102, 'xa-long-chanh', 'Xã Long Chánh', 1, 98);
INSERT INTO `phuong_xa` VALUES (5290, 16102, 'xa-binh-dong', 'Xã Bình Đông', 1, 99);
INSERT INTO `phuong_xa` VALUES (5291, 16102, 'phuong-4', 'Phường 4', 1, 100);
INSERT INTO `phuong_xa` VALUES (5292, 16102, 'phuong-2', 'Phường 2', 1, 101);
INSERT INTO `phuong_xa` VALUES (5293, 22815, 'xa-long-duc', 'Xã Long Đức', 1, 102);
INSERT INTO `phuong_xa` VALUES (5294, 22815, 'phuong-8', 'Phường 8', 1, 103);
INSERT INTO `phuong_xa` VALUES (5295, 22815, 'phuong-6', 'Phường 6', 1, 104);
INSERT INTO `phuong_xa` VALUES (5296, 22815, 'phuong-4', 'Phường 4', 1, 105);
INSERT INTO `phuong_xa` VALUES (5297, 22815, 'phuong-2', 'Phường 2', 1, 106);
INSERT INTO `phuong_xa` VALUES (5298, 19735, 'xa-truong-an', 'Xã Trường An', 1, 107);
INSERT INTO `phuong_xa` VALUES (5299, 19735, 'xa-tan-hoi', 'Xã Tân Hội', 1, 108);
INSERT INTO `phuong_xa` VALUES (5300, 19735, 'phuong-9', 'Phường 9', 1, 109);
INSERT INTO `phuong_xa` VALUES (5301, 19735, 'phuong-5', 'Phường 5', 1, 110);
INSERT INTO `phuong_xa` VALUES (5302, 19735, 'phuong-3', 'Phường 3', 1, 111);
INSERT INTO `phuong_xa` VALUES (5303, 19735, 'phuong-1', 'Phường 1', 1, 112);
INSERT INTO `phuong_xa` VALUES (5304, 11670, 'xa-thuan-an', 'Xã Thuận An', 1, 113);
INSERT INTO `phuong_xa` VALUES (5305, 11670, 'xa-dong-thanh', 'Xã Đông Thành', 1, 114);
INSERT INTO `phuong_xa` VALUES (5306, 11670, 'xa-dong-binh', 'Xã Đông Bình', 1, 115);
INSERT INTO `phuong_xa` VALUES (5307, 22059, 'xa-tinh-thoi', 'Xã Tịnh Thới', 1, 116);
INSERT INTO `phuong_xa` VALUES (5308, 22059, 'xa-tan-thuan-dong', 'Xã Tân Thuận Đông', 1, 117);
INSERT INTO `phuong_xa` VALUES (5309, 22059, 'xa-my-tan', 'Xã Mỹ Tân', 1, 118);
INSERT INTO `phuong_xa` VALUES (5310, 22059, 'xa-hoa-an', 'Xã Hòa An', 1, 119);
INSERT INTO `phuong_xa` VALUES (5311, 22059, 'phuong-hoa-thuan', 'Phường Hoà Thuận', 1, 120);
INSERT INTO `phuong_xa` VALUES (5312, 22059, 'phuong-4', 'Phường 4', 1, 121);
INSERT INTO `phuong_xa` VALUES (5313, 22059, 'phuong-2', 'Phường 2', 1, 122);
INSERT INTO `phuong_xa` VALUES (5314, 22059, 'phuong-1', 'Phường 1', 1, 123);
INSERT INTO `phuong_xa` VALUES (5315, 7802, 'xa-tan-hoi', 'Xã Tân Hội', 1, 124);
INSERT INTO `phuong_xa` VALUES (5316, 7802, 'xa-an-binh-b', 'Xã An Bình B', 1, 125);
INSERT INTO `phuong_xa` VALUES (5317, 7802, 'phuong-an-thanh', 'Phường An Thạnh', 1, 126);
INSERT INTO `phuong_xa` VALUES (5318, 7802, 'phuong-an-lac', 'Phường An Lạc', 1, 127);
INSERT INTO `phuong_xa` VALUES (5319, 10917, 'xa-tan-quy-tay', 'Xã Tân Quy Tây', 1, 128);
INSERT INTO `phuong_xa` VALUES (5320, 10917, 'xa-tan-khanh-dong', 'Xã Tân Khánh Đông', 1, 129);
INSERT INTO `phuong_xa` VALUES (5321, 10917, 'phuong-an-hoa', 'Phường An Hoà', 1, 130);
INSERT INTO `phuong_xa` VALUES (5322, 10917, 'phuong-3', 'Phường 3', 1, 131);
INSERT INTO `phuong_xa` VALUES (5323, 10917, 'phuong-1', 'Phường 1', 1, 132);
INSERT INTO `phuong_xa` VALUES (5324, 15867, 'phuong-tra-noc', 'Phường Trà Nóc', 1, 133);
INSERT INTO `phuong_xa` VALUES (5325, 15867, 'phuong-tra-an', 'Phường Trà An', 1, 134);
INSERT INTO `phuong_xa` VALUES (5326, 15867, 'phuong-thoi-an-dong', 'Phường Thới An Đông', 1, 135);
INSERT INTO `phuong_xa` VALUES (5327, 15867, 'phuong-long-tuyen', 'Phường Long Tuyền', 1, 136);
INSERT INTO `phuong_xa` VALUES (5328, 15867, 'phuong-long-hoa', 'Phường Long Hòa', 1, 137);
INSERT INTO `phuong_xa` VALUES (5329, 15867, 'phuong-bui-huu-nghia', 'Phường Bùi Hữu Nghĩa', 1, 138);
INSERT INTO `phuong_xa` VALUES (5330, 15867, 'phuong-binh-thuy', 'Phường Bình Thủy', 1, 139);
INSERT INTO `phuong_xa` VALUES (5331, 15867, 'phuong-an-thoi', 'Phường An Thới', 1, 140);
INSERT INTO `phuong_xa` VALUES (5332, 3837, 'phuong-thuong-thanh', 'Phường Thường Thạnh', 1, 141);
INSERT INTO `phuong_xa` VALUES (5333, 3837, 'phuong-tan-phu', 'Phường Tân Phú', 1, 142);
INSERT INTO `phuong_xa` VALUES (5334, 3837, 'phuong-phu-thu', 'Phường Phú Thứ', 1, 143);
INSERT INTO `phuong_xa` VALUES (5335, 3837, 'phuong-le-binh', 'Phường Lê Bình', 1, 144);
INSERT INTO `phuong_xa` VALUES (5336, 3837, 'phuong-hung-thanh', 'Phường Hưng Thạnh', 1, 145);
INSERT INTO `phuong_xa` VALUES (5337, 3837, 'phuong-hung-phu', 'Phường Hưng Phú', 1, 146);
INSERT INTO `phuong_xa` VALUES (5338, 3837, 'phuong-ba-lang', 'Phường Ba Láng', 1, 147);
INSERT INTO `phuong_xa` VALUES (5339, 24866, 'phuong-xuan-khanh', 'Phường Xuân Khánh', 1, 148);
INSERT INTO `phuong_xa` VALUES (5340, 24866, 'phuong-thoi-binh', 'Phường Thới Bình', 1, 149);
INSERT INTO `phuong_xa` VALUES (5341, 24866, 'phuong-tan-an', 'Phường Tân An', 1, 150);
INSERT INTO `phuong_xa` VALUES (5342, 24866, 'phuong-hung-loi', 'Phường Hưng Lợi', 1, 151);
INSERT INTO `phuong_xa` VALUES (5343, 24866, 'phuong-cai-khe', 'Phường Cái Khế', 1, 152);
INSERT INTO `phuong_xa` VALUES (5344, 24866, 'phuong-an-phu', 'Phường An Phú', 1, 153);
INSERT INTO `phuong_xa` VALUES (5345, 24866, 'phuong-an-nghiep', 'Phường An Nghiệp', 1, 154);
INSERT INTO `phuong_xa` VALUES (5346, 24866, 'phuong-an-lac', 'Phường An Lạc', 1, 155);
INSERT INTO `phuong_xa` VALUES (5347, 24866, 'phuong-an-khanh', 'Phường An Khánh', 1, 156);
INSERT INTO `phuong_xa` VALUES (5348, 24866, 'phuong-an-hoi', 'Phường An Hội', 1, 157);
INSERT INTO `phuong_xa` VALUES (5349, 24866, 'phuong-an-hoa', 'Phường An Hòa', 1, 158);
INSERT INTO `phuong_xa` VALUES (5350, 24866, 'phuong-an-cu', 'Phường An Cư', 1, 159);
INSERT INTO `phuong_xa` VALUES (5351, 24866, 'phuong-an-binh', 'Phường An Bình', 1, 160);
INSERT INTO `phuong_xa` VALUES (5352, 23787, 'xa-thanh-quoi', 'Xã Thạnh Quới', 1, 161);
INSERT INTO `phuong_xa` VALUES (5353, 23787, 'xa-tan-hanh', 'Xã Tân Hạnh', 1, 162);
INSERT INTO `phuong_xa` VALUES (5354, 23787, 'xa-phu-quoi', 'Xã Phú Quới', 1, 163);
INSERT INTO `phuong_xa` VALUES (5355, 23787, 'xa-long-phuoc', 'Xã Long Phước', 1, 164);
INSERT INTO `phuong_xa` VALUES (5356, 23787, 'xa-loc-hoa', 'Xã Lộc Hòa', 1, 165);
INSERT INTO `phuong_xa` VALUES (5357, 23787, 'xa-hoa-ninh', 'Xã Hòa Ninh', 1, 166);
INSERT INTO `phuong_xa` VALUES (5358, 23787, 'xa-binh-hoa-phuoc', 'Xã Bình Hòa Phước', 1, 167);
INSERT INTO `phuong_xa` VALUES (5359, 23787, 'thi-tran-long-ho', 'Thị trấn Long Hồ', 1, 168);
INSERT INTO `phuong_xa` VALUES (5360, 6968, 'phuong-trung-nhat', 'Phường Trung Nhất', 1, 169);
INSERT INTO `phuong_xa` VALUES (5361, 6968, 'phuong-trung-kien', 'Phường Trung Kiên', 1, 170);
INSERT INTO `phuong_xa` VALUES (5362, 6968, 'phuong-thuan-hung', 'Phường Thuận Hưng', 1, 171);
INSERT INTO `phuong_xa` VALUES (5363, 6968, 'phuong-thuan-an', 'Phường Thuận An', 1, 172);
INSERT INTO `phuong_xa` VALUES (5364, 6968, 'phuong-thot-not', 'Phường Thốt Nốt', 1, 173);
INSERT INTO `phuong_xa` VALUES (5365, 6968, 'phuong-thoi-thuan', 'Phường Thới Thuận', 1, 174);
INSERT INTO `phuong_xa` VALUES (5366, 6968, 'phuong-thanh-hoa', 'Phường Thạnh Hoà', 1, 175);
INSERT INTO `phuong_xa` VALUES (5367, 6968, 'phuong-tan-loc', 'Phường Tân Lộc', 1, 176);
INSERT INTO `phuong_xa` VALUES (5368, 6968, 'phuong-tan-hung', 'Phường Tân Hưng', 1, 177);
INSERT INTO `phuong_xa` VALUES (5369, 28128, 'xa-trung-thanh', 'Xã Trung Thạnh', 1, 178);
INSERT INTO `phuong_xa` VALUES (5370, 28128, 'xa-trung-hung', 'Xã Trung Hưng', 1, 179);
INSERT INTO `phuong_xa` VALUES (5371, 28128, 'xa-trung-an', 'Xã Trung An', 1, 180);
INSERT INTO `phuong_xa` VALUES (5372, 28128, 'xa-thoi-xuan', 'Xã Thới Xuân', 1, 181);
INSERT INTO `phuong_xa` VALUES (5373, 28128, 'xa-thoi-hung', 'Xã Thới Hưng', 1, 182);
INSERT INTO `phuong_xa` VALUES (5374, 28128, 'xa-thoi-dong', 'Xã Thới Đông', 1, 183);
INSERT INTO `phuong_xa` VALUES (5375, 28128, 'xa-thanh-phu', 'Xã Thạnh Phú', 1, 184);
INSERT INTO `phuong_xa` VALUES (5376, 28128, 'xa-dong-thang', 'Xã Đông Thắng', 1, 185);
INSERT INTO `phuong_xa` VALUES (5377, 28128, 'xa-dong-hiep', 'Xã Đông Hiệp', 1, 186);
INSERT INTO `phuong_xa` VALUES (5378, 28128, 'thi-tran-co-do', 'Thị trấn Cờ Đỏ', 1, 187);
INSERT INTO `phuong_xa` VALUES (5379, 17403, 'xa-truong-long', 'Xã Trường Long', 1, 188);
INSERT INTO `phuong_xa` VALUES (5380, 17403, 'xa-tan-thoi', 'Xã Tân Thới', 1, 189);
INSERT INTO `phuong_xa` VALUES (5381, 17403, 'xa-nhon-nghia', 'Xã Nhơn Nghĩa', 1, 190);
INSERT INTO `phuong_xa` VALUES (5382, 17403, 'xa-nhon-ai', 'Xã Nhơn Ái', 1, 191);
INSERT INTO `phuong_xa` VALUES (5383, 17403, 'xa-my-khanh', 'Xã Mỹ Khánh', 1, 192);
INSERT INTO `phuong_xa` VALUES (5384, 17403, 'xa-giai-xuan', 'Xã Giai Xuân', 1, 193);
INSERT INTO `phuong_xa` VALUES (5385, 17403, 'thi-tran-phong-dien', 'Thị trấn Phong Điền', 1, 194);
INSERT INTO `phuong_xa` VALUES (5386, 10700, 'xa-xuan-thang', 'Xã Xuân Thắng', 1, 195);
INSERT INTO `phuong_xa` VALUES (5387, 10700, 'xa-truong-xuan-b', 'Xã Trường Xuân B', 1, 196);
INSERT INTO `phuong_xa` VALUES (5388, 10700, 'xa-truong-xuan-a', 'Xã Trường Xuân A', 1, 197);
INSERT INTO `phuong_xa` VALUES (5389, 10700, 'xa-truong-xuan', 'Xã Trường Xuân', 1, 198);
INSERT INTO `phuong_xa` VALUES (5390, 10700, 'xa-truong-thanh', 'Xã Trường Thành', 1, 199);
INSERT INTO `phuong_xa` VALUES (5391, 10700, 'xa-truong-thang', 'Xã Trường Thắng', 1, 200);
INSERT INTO `phuong_xa` VALUES (5392, 10700, 'xa-thoi-thanh', 'Xã Thới Thạnh', 1, 201);
INSERT INTO `phuong_xa` VALUES (5393, 10700, 'xa-thoi-tan', 'Xã Thới Tân', 1, 202);
INSERT INTO `phuong_xa` VALUES (5394, 10700, 'xa-tan-thanh', 'Xã Tân Thạnh', 1, 203);
INSERT INTO `phuong_xa` VALUES (5395, 10700, 'xa-dong-thuan', 'Xã Đông Thuận', 1, 204);
INSERT INTO `phuong_xa` VALUES (5396, 10700, 'xa-dong-binh', 'Xã Đông Bình', 1, 205);
INSERT INTO `phuong_xa` VALUES (5397, 10700, 'xa-dinh-mon', 'Xã Định Môn', 1, 206);
INSERT INTO `phuong_xa` VALUES (5398, 10700, 'thi-tran-thoi-lai', 'Thị trấn Thới Lai', 1, 207);
INSERT INTO `phuong_xa` VALUES (5399, 13722, 'xa-vinh-trinh', 'Xã Vĩnh Trinh', 1, 208);
INSERT INTO `phuong_xa` VALUES (5400, 13722, 'xa-vinh-binh', 'Xã Vĩnh Bình', 1, 209);
INSERT INTO `phuong_xa` VALUES (5401, 13722, 'xa-thanh-tien', 'Xã Thạnh Tiến', 1, 210);
INSERT INTO `phuong_xa` VALUES (5402, 13722, 'xa-thanh-thang', 'Xã Thạnh Thắng', 1, 211);
INSERT INTO `phuong_xa` VALUES (5403, 13722, 'xa-thanh-quoi', 'Xã Thạnh Qưới', 1, 212);
INSERT INTO `phuong_xa` VALUES (5404, 13722, 'xa-thanh-my', 'Xã Thạnh Mỹ', 1, 213);
INSERT INTO `phuong_xa` VALUES (5405, 13722, 'xa-thanh-loi', 'Xã Thạnh Lợi', 1, 214);
INSERT INTO `phuong_xa` VALUES (5406, 13722, 'xa-thanh-loc', 'Xã Thạnh Lộc', 1, 215);
INSERT INTO `phuong_xa` VALUES (5407, 13722, 'xa-thanh-an', 'Xã Thạnh An', 1, 216);
INSERT INTO `phuong_xa` VALUES (5408, 13722, 'thi-tran-vinh-thanh', 'Thị trấn Vĩnh Thạnh', 1, 217);
INSERT INTO `phuong_xa` VALUES (5409, 13722, 'thi-tran-thanh-an', 'Thị trấn Thạnh An', 1, 218);

-- ----------------------------
-- Table structure for quan_huyen
-- ----------------------------
DROP TABLE IF EXISTS `quan_huyen`;
CREATE TABLE `quan_huyen`  (
  `ma_quan_huyen` int(11) NOT NULL COMMENT 'mã quận huyện',
  `ma_tinh` int(11) NULL DEFAULT NULL COMMENT 'mã tỉnh',
  `ten_quan_huyen_url` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'định danh hiển thị trên url',
  `ten_quan_huyen` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'tên quận huyện',
  `trang_thai` int(11) NULL DEFAULT NULL COMMENT 'trạng thái',
  `sap_xep` int(11) NULL DEFAULT NULL COMMENT 'sắp xếp',
  PRIMARY KEY (`ma_quan_huyen`) USING BTREE,
  INDEX `FK_Reference_15`(`ma_tinh`) USING BTREE,
  CONSTRAINT `FK_Reference_15` FOREIGN KEY (`ma_tinh`) REFERENCES `tinh_thanh` (`ma_tinh`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of quan_huyen
-- ----------------------------
INSERT INTO `quan_huyen` VALUES (525, 7015, 'huyen-long-phu', 'Huyện Long Phú', 0, 73);
INSERT INTO `quan_huyen` VALUES (906, 4608, 'huyen-tan-chau', 'Huyện Tân Châu', 0, 57);
INSERT INTO `quan_huyen` VALUES (1217, 17182, 'thanh-pho-rach-gia', 'Thành Phố Rạch Giá', 1, 15);
INSERT INTO `quan_huyen` VALUES (1284, 24970, 'huyen-thap-muoi', 'Huyện Tháp Mười', 0, 104);
INSERT INTO `quan_huyen` VALUES (1474, 7015, 'huyen-ke-sach', 'Huyện Kế Sách', 0, 74);
INSERT INTO `quan_huyen` VALUES (1583, 220, 'huyen-tan-phu-dong', 'Huyện Tân Phú Đông', 0, 79);
INSERT INTO `quan_huyen` VALUES (1750, 17322, 'huyen-u-minh', 'Huyện U Minh', 0, 35);
INSERT INTO `quan_huyen` VALUES (2106, 4608, 'huyen-an-phu', 'Huyện An Phú', 0, 56);
INSERT INTO `quan_huyen` VALUES (2173, 6036, 'huyen-tieu-can', 'Huyện Tiểu Cần', 0, 89);
INSERT INTO `quan_huyen` VALUES (2797, 24970, 'huyen-thanh-binh', 'Huyện Thanh Bình', 0, 105);
INSERT INTO `quan_huyen` VALUES (2842, 220, 'huyen-cho-gao', 'Huyện Chợ Gạo', 0, 82);
INSERT INTO `quan_huyen` VALUES (2904, 30327, 'huyen-long-ho', 'Huyện Long Hồ', 0, 100);
INSERT INTO `quan_huyen` VALUES (3111, 220, 'thanh-pho-my-tho', 'Thành phố Mỹ Tho', 1, 87);
INSERT INTO `quan_huyen` VALUES (3362, 24970, 'huyen-tan-hong', 'Huyện Tân Hồng', 0, 106);
INSERT INTO `quan_huyen` VALUES (3837, 19355, 'quan-cai-rang', 'Quận Cái Răng', 1, 30);
INSERT INTO `quan_huyen` VALUES (4428, 17322, 'huyen-thoi-binh', 'Huyện Thới Bình', 0, 34);
INSERT INTO `quan_huyen` VALUES (5094, 17182, 'huyen-an-minh', 'Huyện An Minh', 0, 12);
INSERT INTO `quan_huyen` VALUES (5228, 30327, 'huyen-vung-liem', 'Huyện Vũng Liêm', 0, 96);
INSERT INTO `quan_huyen` VALUES (5605, 14837, 'huyen-vinh-loi', 'Huyện Vĩnh Lợi', 0, 50);
INSERT INTO `quan_huyen` VALUES (6119, 4608, 'huyen-cho-moi', 'Huyện Chợ Mới', 0, 59);
INSERT INTO `quan_huyen` VALUES (6465, 220, 'huyen-cai-be', 'Huyện Cái Bè', 0, 85);
INSERT INTO `quan_huyen` VALUES (6968, 19355, 'quan-thot-not', 'Quận Thốt Nốt', 1, 27);
INSERT INTO `quan_huyen` VALUES (6975, 17322, 'huyen-cai-nuoc', 'Huyện Cái Nước', 0, 37);
INSERT INTO `quan_huyen` VALUES (7033, 4608, 'thi-xa-chau-doc', 'Thị Xã Châu Đốc', 1, 65);
INSERT INTO `quan_huyen` VALUES (7802, 24970, 'thi-xa-hong-ngu', 'Thị xã Hồng Ngự', 1, 114);
INSERT INTO `quan_huyen` VALUES (8084, 9061, 'huyen-ba-tri', 'Huyện Ba Tri', 0, 42);
INSERT INTO `quan_huyen` VALUES (8163, 14837, 'thanh-pho-bac-lieu', 'Thành Phố Bạc Liêu', 1, 55);
INSERT INTO `quan_huyen` VALUES (8674, 7015, 'huyen-thanh-tri', 'Huyện Thạnh Trị', 0, 69);
INSERT INTO `quan_huyen` VALUES (8769, 9061, 'huyen-giong-trom', 'Huyện Giồng Trôm', 0, 43);
INSERT INTO `quan_huyen` VALUES (9139, 24970, 'huyen-tam-nong', 'Huyện Tam Nông', 0, 107);
INSERT INTO `quan_huyen` VALUES (9276, 220, 'huyen-go-cong-tay', 'Huyện Gò Công Tây', 0, 80);
INSERT INTO `quan_huyen` VALUES (9326, 9061, 'huyen-thanh-phu', 'Huyện Thạnh Phú', 0, 44);
INSERT INTO `quan_huyen` VALUES (9503, 17182, 'huyen-kien-hai', 'Huyện Kiên Hải', 0, 7);
INSERT INTO `quan_huyen` VALUES (10000, 7015, 'huyen-chau-thanh', 'Huyện Châu Thành', 0, 76);
INSERT INTO `quan_huyen` VALUES (10700, 19355, 'huyen-thoi-lai', 'Huyện Thới Lai', 1, 23);
INSERT INTO `quan_huyen` VALUES (10821, 14837, 'huyen-hong-dan', 'Huyện Hồng Dân', 0, 54);
INSERT INTO `quan_huyen` VALUES (10917, 24970, 'thi-xa-sa-dec', 'Thị xã Sa Đéc', 1, 113);
INSERT INTO `quan_huyen` VALUES (11545, 10940, 'huyen-phung-hiep', 'Huyện Phụng Hiệp', 0, 16);
INSERT INTO `quan_huyen` VALUES (11670, 30327, 'huyen-binh-minh', 'Huyện Bình Minh', 1, 102);
INSERT INTO `quan_huyen` VALUES (12013, 4608, 'huyen-thoai-son', 'Huyện Thoại Sơn', 0, 60);
INSERT INTO `quan_huyen` VALUES (12153, 6036, 'huyen-cau-ke', 'Huyện Cầu Kè', 0, 93);
INSERT INTO `quan_huyen` VALUES (12712, 9061, 'huyen-binh-dai', 'Huyện Bình Đại', 0, 46);
INSERT INTO `quan_huyen` VALUES (12809, 7015, 'thanh-pho-soc-trang', 'Thành phố Sóc Trăng', 1, 77);
INSERT INTO `quan_huyen` VALUES (13549, 9061, 'huyen-cho-lach', 'Huyện Chợ Lách', 0, 45);
INSERT INTO `quan_huyen` VALUES (13717, 17182, 'huyen-phu-quoc', 'Huyện Phú Quốc', 1, 5);
INSERT INTO `quan_huyen` VALUES (13722, 19355, 'huyen-vinh-thanh', 'Huyện Vĩnh Thạnh', 1, 24);
INSERT INTO `quan_huyen` VALUES (14005, 17182, 'huyen-tan-hiep', 'Huyện Tân Hiệp', 0, 4);
INSERT INTO `quan_huyen` VALUES (14095, 17182, 'huyen-an-bien', 'Huyện An Biên', 0, 13);
INSERT INTO `quan_huyen` VALUES (14809, 4608, 'thanh-pho-long-xuyen', 'Thành Phố Long Xuyên', 1, 66);
INSERT INTO `quan_huyen` VALUES (14909, 17182, 'huyen-chau-thanh', 'Huyện Châu Thành', 0, 11);
INSERT INTO `quan_huyen` VALUES (15374, 220, 'huyen-tan-phuoc', 'Huyện Tân Phước', 0, 78);
INSERT INTO `quan_huyen` VALUES (15636, 14837, 'huyen-phuoc-long', 'Huyện Phước Long', 0, 51);
INSERT INTO `quan_huyen` VALUES (15743, 4608, 'huyen-chau-phu', 'Huyện Châu Phú', 0, 63);
INSERT INTO `quan_huyen` VALUES (15867, 19355, 'quan-binh-thuy', 'Quận Bình Thủy', 1, 29);
INSERT INTO `quan_huyen` VALUES (16084, 6036, 'huyen-tra-cu', 'Huyện Trà Cú', 0, 88);
INSERT INTO `quan_huyen` VALUES (16102, 220, 'thi-xa-go-cong', 'Thị xã Gò Công', 1, 86);
INSERT INTO `quan_huyen` VALUES (16276, 17182, 'huyen-giang-thanh', 'Huyện Giang Thành', 0, 1);
INSERT INTO `quan_huyen` VALUES (16339, 7015, 'huyen-cu-lao-dung', 'Huyện Cù Lao Dung', 0, 75);
INSERT INTO `quan_huyen` VALUES (16574, 17322, 'huyen-tran-van-thoi', 'Huyện Trần Văn Thời', 0, 36);
INSERT INTO `quan_huyen` VALUES (17347, 6036, 'huyen-chau-thanh', 'Huyện Châu Thành', 0, 91);
INSERT INTO `quan_huyen` VALUES (17403, 19355, 'huyen-phong-dien', 'Huyện Phong Điền', 1, 25);
INSERT INTO `quan_huyen` VALUES (17598, 6036, 'huyen-cang-long', 'Huyện Càng Long', 0, 94);
INSERT INTO `quan_huyen` VALUES (18447, 24970, 'huyen-chau-thanh', 'Huyện Châu Thành', 0, 111);
INSERT INTO `quan_huyen` VALUES (18472, 220, 'huyen-cai-lay', 'Huyện Cai Lậy', 0, 84);
INSERT INTO `quan_huyen` VALUES (18618, 10940, 'huyen-long-my', 'Huyện Long Mỹ', 0, 20);
INSERT INTO `quan_huyen` VALUES (18877, 10940, 'thi-xa-nga-bay', 'Thị Xã Ngã Bảy', 1, 21);
INSERT INTO `quan_huyen` VALUES (18994, 10940, 'huyen-chau-thanh', 'Huyện Châu Thành', 0, 19);
INSERT INTO `quan_huyen` VALUES (18997, 30327, 'huyen-tra-on', 'Huyện Trà Ôn', 0, 97);
INSERT INTO `quan_huyen` VALUES (19185, 4608, 'huyen-chau-thanh', 'Huyện Châu Thành', 0, 64);
INSERT INTO `quan_huyen` VALUES (19735, 30327, 'thanh-pho-vinh-long', 'Thành phố Vĩnh Long', 1, 103);
INSERT INTO `quan_huyen` VALUES (19799, 17182, 'huyen-kien-luong', 'Huyện Kiên Lương', 0, 6);
INSERT INTO `quan_huyen` VALUES (20308, 4608, 'huyen-phu-tan', 'Huyện Phú Tân', 0, 58);
INSERT INTO `quan_huyen` VALUES (20634, 17322, 'huyen-phu-tan', 'Huyện Phú Tân', 0, 32);
INSERT INTO `quan_huyen` VALUES (20805, 4608, 'huyen-tri-ton', 'Huyện Tri Tôn', 0, 61);
INSERT INTO `quan_huyen` VALUES (20895, 4608, 'huyen-tinh-bien', 'Huyện Tịnh Biên', 0, 62);
INSERT INTO `quan_huyen` VALUES (21053, 14837, 'huyen-dong-hai', 'Huyện Đông Hải', 0, 49);
INSERT INTO `quan_huyen` VALUES (21543, 17322, 'thanh-pho-ca-mau', 'Thành Phố Cà Mau', 1, 40);
INSERT INTO `quan_huyen` VALUES (21681, 30327, 'huyen-binh-tan', 'Huyện Bình Tân', 0, 101);
INSERT INTO `quan_huyen` VALUES (21964, 9061, 'thanh-pho-ben-tre', 'Thành Phố Bến Tre', 1, 48);
INSERT INTO `quan_huyen` VALUES (22059, 24970, 'thanh-pho-cao-lanh', 'Thành phố Cao Lãnh', 1, 115);
INSERT INTO `quan_huyen` VALUES (22091, 220, 'huyen-chau-thanh', 'Huyện Châu Thành', 0, 83);
INSERT INTO `quan_huyen` VALUES (22815, 6036, 'thi-xa-tra-vinh', 'Thị xã Trà Vinh', 1, 95);
INSERT INTO `quan_huyen` VALUES (22894, 24970, 'huyen-hong-ngu', 'Huyện Hồng Ngự', 0, 110);
INSERT INTO `quan_huyen` VALUES (23097, 17322, 'huyen-dam-doi', 'Huyện Đầm Dơi', 0, 39);
INSERT INTO `quan_huyen` VALUES (23167, 17182, 'huyen-hon-dat', 'Huyện Hòn Đất', 0, 8);
INSERT INTO `quan_huyen` VALUES (23492, 7015, 'huyen-vinh-chau', 'Huyện Vĩnh Châu', 0, 67);
INSERT INTO `quan_huyen` VALUES (23606, 7015, 'huyen-nga-nam', 'Huyện Ngã Năm', 0, 70);
INSERT INTO `quan_huyen` VALUES (23787, 19355, 'quan-o-mon', 'Quận Ô Môn', 1, 28);
INSERT INTO `quan_huyen` VALUES (24597, 10940, 'huyen-vi-thuy', 'Huyện Vị Thủy', 0, 17);
INSERT INTO `quan_huyen` VALUES (24866, 19355, 'quan-ninh-kieu', 'Quận Ninh Kiều', 1, 31);
INSERT INTO `quan_huyen` VALUES (25316, 10940, 'huyen-chau-thanh-a', 'Huyện Châu Thành A', 0, 18);
INSERT INTO `quan_huyen` VALUES (25324, 17322, 'huyen-nam-can', 'Huyện Năm Căn', 0, 33);
INSERT INTO `quan_huyen` VALUES (25458, 6036, 'huyen-duyen-hai', 'Huyện Duyên Hải', 0, 90);
INSERT INTO `quan_huyen` VALUES (25696, 9061, 'huyen-chau-thanh', 'Huyện Châu Thành', 0, 47);
INSERT INTO `quan_huyen` VALUES (25764, 7015, 'huyen-my-tu', 'Huyện Mỹ Tú', 0, 72);
INSERT INTO `quan_huyen` VALUES (26053, 220, 'huyen-go-cong-dong', 'Huyện Gò Công Đông', 0, 81);
INSERT INTO `quan_huyen` VALUES (26324, 17182, 'huyen-giong-rieng', 'Huyện Giồng Riềng', 0, 10);
INSERT INTO `quan_huyen` VALUES (26389, 14837, 'huyen-gia-rai', 'Huyện Giá Rai', 0, 52);
INSERT INTO `quan_huyen` VALUES (26423, 7015, 'huyen-my-xuyen', 'Huyện Mỹ Xuyên', 0, 71);
INSERT INTO `quan_huyen` VALUES (26547, 17182, 'huyen-vinh-thuan', 'Huyện Vĩnh Thuận', 0, 2);
INSERT INTO `quan_huyen` VALUES (26623, 14837, 'huyen-hoa-binh', 'Huyện Hòa Bình', 0, 53);
INSERT INTO `quan_huyen` VALUES (26683, 30327, 'huyen-mang-thit', 'Huyện Mang Thít', 0, 99);
INSERT INTO `quan_huyen` VALUES (26857, 24970, 'huyen-lai-vung', 'Huyện Lai Vung', 0, 109);
INSERT INTO `quan_huyen` VALUES (27546, 9061, 'huyen-mo-cay-bac', 'Huyện Mỏ Cày Bắc', 0, NULL);
INSERT INTO `quan_huyen` VALUES (28016, 24970, 'huyen-lap-vo', 'Huyện Lấp Vò', 0, 108);
INSERT INTO `quan_huyen` VALUES (28107, 17182, 'huyen-u-minh-thuong', 'Huyện U Minh Thượng', 0, 3);
INSERT INTO `quan_huyen` VALUES (28128, 19355, 'huyen-co-do', 'Huyện Cờ Đỏ', 1, 26);
INSERT INTO `quan_huyen` VALUES (28362, 30327, 'huyen-tam-binh', 'Huyện Tam Bình', 0, 98);
INSERT INTO `quan_huyen` VALUES (28450, 17182, 'thi-xa-ha-tien', 'Thị Xã Hà Tiên', 1, 14);
INSERT INTO `quan_huyen` VALUES (28574, 17322, 'huyen-ngoc-hien', 'Huyện Ngọc Hiển', 0, 38);
INSERT INTO `quan_huyen` VALUES (29760, 6036, 'huyen-cau-ngang', 'Huyện Cầu Ngang', 0, 92);
INSERT INTO `quan_huyen` VALUES (30846, 17182, 'huyen-go-quao', 'Huyện Gò Quao', 0, 9);
INSERT INTO `quan_huyen` VALUES (31274, 10940, 'thanh-pho-vi-thanh', 'Thành Phố Vị Thanh', 1, 22);
INSERT INTO `quan_huyen` VALUES (31405, 7015, 'huyen-tran-de', 'Huyện Trần Đề', 0, 68);

-- ----------------------------
-- Table structure for tinh_thanh
-- ----------------------------
DROP TABLE IF EXISTS `tinh_thanh`;
CREATE TABLE `tinh_thanh`  (
  `ma_tinh` int(11) NOT NULL COMMENT 'mã tỉnh',
  `ten_tinh_url` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'tên tinh hiển thị trên url',
  `ten_tinh` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'tên tỉnh',
  `trang_thai` int(11) NULL DEFAULT NULL COMMENT 'trạng thái',
  `sap_xep` int(11) NULL DEFAULT NULL COMMENT 'sắp xếp',
  PRIMARY KEY (`ma_tinh`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tinh_thanh
-- ----------------------------
INSERT INTO `tinh_thanh` VALUES (220, 'tien-giang', 'Tiền Giang', 1, 3);
INSERT INTO `tinh_thanh` VALUES (4608, 'an-giang', 'An Giang', 1, 13);
INSERT INTO `tinh_thanh` VALUES (6036, 'tra-vinh', 'Trà Vinh', 1, 2);
INSERT INTO `tinh_thanh` VALUES (7015, 'soc-trang', 'Sóc Trăng', 1, 4);
INSERT INTO `tinh_thanh` VALUES (9061, 'ben-tre', 'Bến Tre', 1, 11);
INSERT INTO `tinh_thanh` VALUES (10940, 'hau-giang', 'Hậu Giang', 1, 7);
INSERT INTO `tinh_thanh` VALUES (14837, 'bac-lieu', 'Bạc Liêu', 1, 12);
INSERT INTO `tinh_thanh` VALUES (17182, 'kien-giang', 'Kiên Giang', 1, 6);
INSERT INTO `tinh_thanh` VALUES (17322, 'ca-mau', 'Cà Mau', 1, 10);
INSERT INTO `tinh_thanh` VALUES (19355, 'can-tho', 'Cần Thơ', 1, 9);
INSERT INTO `tinh_thanh` VALUES (24970, 'dong-thap', 'Đồng Tháp', 1, 8);
INSERT INTO `tinh_thanh` VALUES (30327, 'vinh-long', 'Vĩnh Long', 1, 1);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `active` int(10) NOT NULL,
  `id_nhan_vien` int(10) NULL DEFAULT NULL,
  `id_nhom_nguoi_dung` int(10) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (2, 'admin@gmail.com', 'admin@gmail.com', '$2y$10$fpLc15f/TxvLSOKq8pOMs.MLPc0BHkUXfqoHzpgVp6UJXAszDpnP6', 1, 1, 1, '2018-09-06 16:26:09', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for vi_tri
-- ----------------------------
DROP TABLE IF EXISTS `vi_tri`;
CREATE TABLE `vi_tri`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ma_vi_tri` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `ten_vi_tri` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `dien_giai` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `id_phong_ban` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of vi_tri
-- ----------------------------
INSERT INTO `vi_tri` VALUES (24, 'VT000001', 'Nhân viên bán hàng', 'Nhân viên bán hàng', '2018-09-18 08:42:41', '2018-09-18 08:42:41', 'PH000004');
INSERT INTO `vi_tri` VALUES (25, 'VT000005', 'Phó phòng bán hàng', 'Phó phòng bán hàng', '2018-09-18 08:45:25', '2018-09-18 08:45:25', 'PH000004');

-- ----------------------------
-- View structure for phan_quyen
-- ----------------------------
DROP VIEW IF EXISTS `phan_quyen`;
CREATE ALGORITHM = UNDEFINED DEFINER = `tdlam_test`@`%` SQL SECURITY DEFINER VIEW `phan_quyen` AS select `pq`.`id` AS `id_nhom_phan_quyen`,`pq`.`id_nhom_nguoi_dung` AS `id_nhom_nguoi_dung`,`mcn`.`id` AS `id_nhom_chuc_nang`,`mcn`.`ten_nhom` AS `ten_nhom`,`cn`.`id` AS `id_chuc_nang`,`cn`.`ten_chuc_nang` AS `ten_chuc_nang`,`cn`.`link` AS `link`,`pq`.`allaction` AS `allaction`,`pq`.`xem` AS `xem`,`pq`.`them` AS `them`,`pq`.`sua` AS `sua`,`pq`.`xoa` AS `xoa`,`mcn`.`icon` AS `icon`,`mcn`.`thu_tu` AS `thu_tu_nhom`,`cn`.`thu_tu` AS `thu_tu_chuc_nang` from ((`nhom_phan_quyen` `pq` join `chuc_nang` `cn` on((`pq`.`id_chuc_nang` = `cn`.`id`))) join `nhom_chuc_nang` `mcn` on((`mcn`.`id` = `cn`.`id_nhom_chuc_nang`)));

SET FOREIGN_KEY_CHECKS = 1;
