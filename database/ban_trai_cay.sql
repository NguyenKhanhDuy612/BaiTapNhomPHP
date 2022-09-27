-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2021 at 07:44 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ban_trai_cay`
--

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_phieu_dat`
--

CREATE TABLE `chi_tiet_phieu_dat` (
  `ma_phieu_dat` varchar(10) NOT NULL,
  `ma_mh` varchar(10) NOT NULL,
  `so_luong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chuc_vu`
--

CREATE TABLE `chuc_vu` (
  `ma_chuc_vu` varchar(10) NOT NULL,
  `ten_chuc_vu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chuc_vu`
--

INSERT INTO `chuc_vu` (`ma_chuc_vu`, `ten_chuc_vu`) VALUES
('CV0000001', 'Giám đốc');

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

CREATE TABLE `gio_hang` (
  `user_id` int(11) NOT NULL,
  `ma_mh` varchar(10) NOT NULL,
  `so_luong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don`
--

CREATE TABLE `hoa_don` (
  `ma_hoa_don` varchar(10) NOT NULL,
  `ma_phieu_dat` varchar(10) NOT NULL,
  `ma_nv` varchar(10) NOT NULL,
  `tong_tien` int(11) NOT NULL,
  `ngay_thanh_toan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `khach_hang`
--

CREATE TABLE `khach_hang` (
  `ma_kh` varchar(10) NOT NULL,
  `ten_kh` varchar(100) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `gioi_tinh` tinyint(1) NOT NULL,
  `dia_chi` varchar(100) NOT NULL,
  `cmnd` varchar(20) NOT NULL,
  `so_dien_thoai` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khach_hang`
--

INSERT INTO `khach_hang` (`ma_kh`, `ten_kh`, `ngay_sinh`, `gioi_tinh`, `dia_chi`, `cmnd`, `so_dien_thoai`, `user_id`) VALUES
('KH0000002', 'test', '1996-01-01', 1, 'test', 'test', 'test', 5),
('KH0000003', 'My name is test', '1994-02-22', 0, 'Nhà ở kia kìa', '52526262525', '41252541415', 6),
('KH0000004', 'Nguyễn', '1995-02-02', 1, '5', '2525255252', '2522626266', 9),
('KH0000005', 'Nguyễn Thị A', '1995-10-10', 0, 'dad', '1324253262', '1425252622', 15),
('KH0000006', 'Trần Văn Test', '1995-05-25', 1, '123 Lê Lợi', '525226261', '526262677', 16),
('KH0000007', 'Trần Văn test', '2021-10-26', 1, 'agag', '5267373625', '15262637252', 18);

-- --------------------------------------------------------

--
-- Table structure for table `loai_mat_hang`
--

CREATE TABLE `loai_mat_hang` (
  `ma_lmh` varchar(10) NOT NULL,
  `ten_lmh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mat_hang`
--

CREATE TABLE `mat_hang` (
  `ma_mh` varchar(10) NOT NULL,
  `ten_mh` varchar(100) NOT NULL,
  `don_gia` int(11) NOT NULL,
  `chi_tiet_mh` text NOT NULL,
  `anh_mh` varchar(255) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `ma_ncc` varchar(10) NOT NULL,
  `ma_lmh` varchar(10) NOT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nhan_vien`
--

CREATE TABLE `nhan_vien` (
  `ma_nv` varchar(10) NOT NULL,
  `ten_nv` varchar(100) NOT NULL,
  `ngay_sinh` date NOT NULL,
  `gioi_tinh` tinyint(1) NOT NULL,
  `dia_chi` varchar(100) NOT NULL,
  `so_dien_thoai` varchar(20) NOT NULL,
  `anh_nv` varchar(255) NOT NULL,
  `cmnd` varchar(20) NOT NULL,
  `ma_chuc_vu` varchar(10) NOT NULL,
  `luong` varchar(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nhan_vien`
--

INSERT INTO `nhan_vien` (`ma_nv`, `ten_nv`, `ngay_sinh`, `gioi_tinh`, `dia_chi`, `so_dien_thoai`, `anh_nv`, `cmnd`, `ma_chuc_vu`, `luong`, `user_id`) VALUES
('NV0000001', 'Admin', '2021-10-22', 1, '123 Cửa hàng bán trái cây', '0969420425', 'employee.png', '2345678912', 'CV0000001', '100000000', 14),
('NV0000002', 'Hồ Hiểu Lực', '2000-11-26', 1, 'afafaf', '0695845362', 'employee.jpg', '521616162', 'CV0000001', '100000000', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nha_cung_cap`
--

CREATE TABLE `nha_cung_cap` (
  `ma_ncc` varchar(10) NOT NULL,
  `ten_ncc` varchar(100) NOT NULL,
  `so_dien_thoai` varchar(20) NOT NULL,
  `dia_chi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `phieu_dat_hang`
--

CREATE TABLE `phieu_dat_hang` (
  `ma_phieu_dat` varchar(10) NOT NULL,
  `ma_kh` varchar(10) NOT NULL,
  `ngay_dat` date NOT NULL,
  `tien_coc` int(11) NOT NULL,
  `ghi_chu` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quyen`
--

CREATE TABLE `quyen` (
  `ma_quyen` varchar(10) NOT NULL,
  `ten_quyen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quyen`
--

INSERT INTO `quyen` (`ma_quyen`, `ten_quyen`) VALUES
('admin', 'Quản trị viên'),
('staff', 'Nhân viên'),
('user', 'Người dùng thường');

-- --------------------------------------------------------

--
-- Table structure for table `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ma_quyen` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tai_khoan`
--

INSERT INTO `tai_khoan` (`user_id`, `username`, `password`, `ma_quyen`, `email`) VALUES
(2, 'provjpzz', '$2y$10$2SGNFk8OEh3MpR7T22SIq.YvcbyHsDzCc68eazhVHtSAILXMXbrpy', 'admin', 'kingofika123@gmail.com'),
(5, 'test123456', '$2y$10$bX4XVGeNxnjfvO1F2wA/teIxriQ7uJytXdrZgTcsRbFoOyXEDwT6q', 'user', 'test@gmail.com'),
(6, 'laitestlannua', '$2y$10$C/wTLPzlGSnwC7.mBuO6Q.d8zNM.0FnTkKAq1Vv5KQBdBUMwa3DdG', 'user', 'laitest@gmail.com'),
(9, 'nguyenvantu', '$2y$10$7c2iyy89fb2XKPQGcvzjLewyacin.ZzdwyYpAPCDQI5YjUHXqo.ca', 'user', 'test1452@gmail.com'),
(14, 'tonggiamdoc', '$2y$10$T4w.a.rTc.sY3EpxlCmguOL.Nkv.Xm.YyNJ8FZpdwanjke4h4KpOq', 'admin', 'tonggiamdoc222111@gmail.com'),
(15, 'nguyenthia', '$2y$10$Y5rQ42F8N0Zx.PaWV9Yri.1kUp8yIoWvhyiFDw6eeO.iWdJxD4nny', 'user', 'nguyenthia@example.com'),
(16, 'tranvantest', '$2y$10$ZL247uqnx6p0JbiWXz28NeJFXNtAl2zVhiUOT6T1SiMAL2v0wP94i', 'user', 'tranvantest@gmail.test.com'),
(18, 'tranvantest123', '$2y$10$Njl4g8SbUOrP.E5l.GmRMOv.Uz0kHLLczkM9G/J7B035.3gBQthB.', 'user', 'tranvantest123@webbantraicay60cntt.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chi_tiet_phieu_dat`
--
ALTER TABLE `chi_tiet_phieu_dat`
  ADD PRIMARY KEY (`ma_phieu_dat`,`ma_mh`),
  ADD KEY `ctpd_ibfk_2` (`ma_mh`);

--
-- Indexes for table `chuc_vu`
--
ALTER TABLE `chuc_vu`
  ADD PRIMARY KEY (`ma_chuc_vu`);

--
-- Indexes for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD KEY `gio_hang_ibfk_1` (`user_id`),
  ADD KEY `gio_hang_ibfk_2` (`ma_mh`);

--
-- Indexes for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`ma_hoa_don`),
  ADD KEY `hoa_don_ibfk_1` (`ma_phieu_dat`),
  ADD KEY `hoa_don_ibfk_2` (`ma_nv`);

--
-- Indexes for table `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD PRIMARY KEY (`ma_kh`),
  ADD KEY `khach_hang_ibfk_1` (`user_id`);

--
-- Indexes for table `loai_mat_hang`
--
ALTER TABLE `loai_mat_hang`
  ADD PRIMARY KEY (`ma_lmh`);

--
-- Indexes for table `mat_hang`
--
ALTER TABLE `mat_hang`
  ADD PRIMARY KEY (`ma_mh`),
  ADD KEY `mat_hang_ibfk_1` (`ma_lmh`),
  ADD KEY `mat_hang_ibfk_2` (`ma_ncc`);

--
-- Indexes for table `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD PRIMARY KEY (`ma_nv`),
  ADD KEY `nhan_vien_ibfk_1` (`ma_chuc_vu`),
  ADD KEY `nhan_vien_ibfk_2` (`user_id`);

--
-- Indexes for table `nha_cung_cap`
--
ALTER TABLE `nha_cung_cap`
  ADD PRIMARY KEY (`ma_ncc`);

--
-- Indexes for table `phieu_dat_hang`
--
ALTER TABLE `phieu_dat_hang`
  ADD PRIMARY KEY (`ma_phieu_dat`),
  ADD KEY `phieu_dat_hang_ibfk_1` (`ma_kh`);

--
-- Indexes for table `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`ma_quyen`);

--
-- Indexes for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `tai_khoan_ibfk_1` (`ma_quyen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chi_tiet_phieu_dat`
--
ALTER TABLE `chi_tiet_phieu_dat`
  ADD CONSTRAINT `ctpd_ibfk_1` FOREIGN KEY (`ma_phieu_dat`) REFERENCES `phieu_dat_hang` (`ma_phieu_dat`),
  ADD CONSTRAINT `ctpd_ibfk_2` FOREIGN KEY (`ma_mh`) REFERENCES `mat_hang` (`ma_mh`);

--
-- Constraints for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gio_hang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tai_khoan` (`user_id`),
  ADD CONSTRAINT `gio_hang_ibfk_2` FOREIGN KEY (`ma_mh`) REFERENCES `mat_hang` (`ma_mh`);

--
-- Constraints for table `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD CONSTRAINT `hoa_don_ibfk_1` FOREIGN KEY (`ma_phieu_dat`) REFERENCES `phieu_dat_hang` (`ma_phieu_dat`),
  ADD CONSTRAINT `hoa_don_ibfk_2` FOREIGN KEY (`ma_nv`) REFERENCES `nhan_vien` (`ma_nv`);

--
-- Constraints for table `khach_hang`
--
ALTER TABLE `khach_hang`
  ADD CONSTRAINT `khach_hang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tai_khoan` (`user_id`);

--
-- Constraints for table `mat_hang`
--
ALTER TABLE `mat_hang`
  ADD CONSTRAINT `mat_hang_ibfk_1` FOREIGN KEY (`ma_lmh`) REFERENCES `loai_mat_hang` (`ma_lmh`),
  ADD CONSTRAINT `mat_hang_ibfk_2` FOREIGN KEY (`ma_ncc`) REFERENCES `nha_cung_cap` (`ma_ncc`);

--
-- Constraints for table `nhan_vien`
--
ALTER TABLE `nhan_vien`
  ADD CONSTRAINT `nhan_vien_ibfk_1` FOREIGN KEY (`ma_chuc_vu`) REFERENCES `chuc_vu` (`ma_chuc_vu`),
  ADD CONSTRAINT `nhan_vien_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tai_khoan` (`user_id`);

--
-- Constraints for table `phieu_dat_hang`
--
ALTER TABLE `phieu_dat_hang`
  ADD CONSTRAINT `phieu_dat_hang_ibfk_1` FOREIGN KEY (`ma_kh`) REFERENCES `khach_hang` (`ma_kh`);

--
-- Constraints for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD CONSTRAINT `tai_khoan_ibfk_1` FOREIGN KEY (`ma_quyen`) REFERENCES `quyen` (`ma_quyen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
