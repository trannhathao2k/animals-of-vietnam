-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 30, 2022 lúc 05:30 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `animalsofvietnam`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `addanimal`
--

CREATE TABLE `addanimal` (
  `ma_ctv` int(11) NOT NULL,
  `ma_dv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `animals`
--

CREATE TABLE `animals` (
  `ma_dv` int(11) NOT NULL,
  `ten_dv` varchar(100) NOT NULL,
  `ten_eng` varchar(100) NOT NULL,
  `mota` varchar(5000) NOT NULL,
  `dacdiem` varchar(1000) NOT NULL,
  `ma_bt_sachdovn` int(11) NOT NULL,
  `ma_bt_iucn` int(11) NOT NULL,
  `sinhcanh` varchar(100) NOT NULL,
  `diadiem` varchar(100) NOT NULL,
  `ma_gioi` int(11) NOT NULL,
  `ma_nganh` int(11) NOT NULL,
  `ma_lop` int(11) NOT NULL,
  `ma_ho` int(11) NOT NULL,
  `ma_bo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baoton_iucn`
--

CREATE TABLE `baoton_iucn` (
  `ma_bt_iucn` int(11) NOT NULL,
  `ten_bt_iucn` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baoton_sachdovn`
--

CREATE TABLE `baoton_sachdovn` (
  `ma_bt_sachdovn` int(11) NOT NULL,
  `ten_bt_sachdovn` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bo`
--

CREATE TABLE `bo` (
  `ma_bo` int(11) NOT NULL,
  `ten_bo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gioi`
--

CREATE TABLE `gioi` (
  `ma_gioi` int(11) NOT NULL,
  `ten_gioi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ho`
--

CREATE TABLE `ho` (
  `ma_ho` int(11) NOT NULL,
  `ten_ho` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `ma_image` int(11) NOT NULL,
  `ten_image` varchar(100) NOT NULL,
  `ma_dv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

CREATE TABLE `lop` (
  `ma_lop` int(11) NOT NULL,
  `ten_lop` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nganh`
--

CREATE TABLE `nganh` (
  `ma_nganh` int(11) NOT NULL,
  `ten_nganh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `obvervation`
--

CREATE TABLE `obvervation` (
  `ma_ctv` int(11) NOT NULL,
  `hoten_ctv` varchar(50) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `passwd` varchar(20) NOT NULL,
  `email_ctv` varchar(50) NOT NULL,
  `sdt` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `obvervation`
--

INSERT INTO `obvervation` (`ma_ctv`, `hoten_ctv`, `uname`, `passwd`, `email_ctv`, `sdt`) VALUES
(1, 'Phạm Hồng Linh', 'linh', '54321', 'linhb1805885@student.ctu.edu.vn', '0986611387'),
(2, 'Võ Tấn Hậu', '$hau', '123', 'htttdn02@gmail.com', '957315951');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phanbo`
--

CREATE TABLE `phanbo` (
  `ma_pb` int(11) NOT NULL,
  `noiphanbo` varchar(100) NOT NULL,
  `ma_dv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `addanimal`
--
ALTER TABLE `addanimal`
  ADD PRIMARY KEY (`ma_ctv`,`ma_dv`),
  ADD KEY `ma_dv` (`ma_dv`);

--
-- Chỉ mục cho bảng `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`ma_dv`),
  ADD KEY `ma_gioi` (`ma_gioi`),
  ADD KEY `ma_nganh` (`ma_nganh`),
  ADD KEY `ma_lop` (`ma_lop`),
  ADD KEY `ma_ho` (`ma_ho`),
  ADD KEY `ma_bo` (`ma_bo`),
  ADD KEY `ma_bt_sachdovn` (`ma_bt_sachdovn`),
  ADD KEY `ma_bt_iucn` (`ma_bt_iucn`);

--
-- Chỉ mục cho bảng `baoton_iucn`
--
ALTER TABLE `baoton_iucn`
  ADD PRIMARY KEY (`ma_bt_iucn`);

--
-- Chỉ mục cho bảng `baoton_sachdovn`
--
ALTER TABLE `baoton_sachdovn`
  ADD PRIMARY KEY (`ma_bt_sachdovn`);

--
-- Chỉ mục cho bảng `bo`
--
ALTER TABLE `bo`
  ADD PRIMARY KEY (`ma_bo`);

--
-- Chỉ mục cho bảng `gioi`
--
ALTER TABLE `gioi`
  ADD PRIMARY KEY (`ma_gioi`);

--
-- Chỉ mục cho bảng `ho`
--
ALTER TABLE `ho`
  ADD PRIMARY KEY (`ma_ho`);

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`ma_image`),
  ADD KEY `ma_dv` (`ma_dv`);

--
-- Chỉ mục cho bảng `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`ma_lop`);

--
-- Chỉ mục cho bảng `nganh`
--
ALTER TABLE `nganh`
  ADD PRIMARY KEY (`ma_nganh`);

--
-- Chỉ mục cho bảng `obvervation`
--
ALTER TABLE `obvervation`
  ADD PRIMARY KEY (`ma_ctv`);

--
-- Chỉ mục cho bảng `phanbo`
--
ALTER TABLE `phanbo`
  ADD PRIMARY KEY (`ma_pb`),
  ADD KEY `ma_dv` (`ma_dv`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `animals`
--
ALTER TABLE `animals`
  MODIFY `ma_dv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `baoton_iucn`
--
ALTER TABLE `baoton_iucn`
  MODIFY `ma_bt_iucn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `baoton_sachdovn`
--
ALTER TABLE `baoton_sachdovn`
  MODIFY `ma_bt_sachdovn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `bo`
--
ALTER TABLE `bo`
  MODIFY `ma_bo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `gioi`
--
ALTER TABLE `gioi`
  MODIFY `ma_gioi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ho`
--
ALTER TABLE `ho`
  MODIFY `ma_ho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `ma_image` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lop`
--
ALTER TABLE `lop`
  MODIFY `ma_lop` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `nganh`
--
ALTER TABLE `nganh`
  MODIFY `ma_nganh` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `obvervation`
--
ALTER TABLE `obvervation`
  MODIFY `ma_ctv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `phanbo`
--
ALTER TABLE `phanbo`
  MODIFY `ma_pb` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `addanimal`
--
ALTER TABLE `addanimal`
  ADD CONSTRAINT `addanimal_ibfk_1` FOREIGN KEY (`ma_ctv`) REFERENCES `obvervation` (`ma_ctv`),
  ADD CONSTRAINT `addanimal_ibfk_2` FOREIGN KEY (`ma_dv`) REFERENCES `animals` (`ma_dv`),
  ADD CONSTRAINT `addanimal_ibfk_3` FOREIGN KEY (`ma_ctv`) REFERENCES `obvervation` (`ma_ctv`);

--
-- Các ràng buộc cho bảng `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`ma_gioi`) REFERENCES `gioi` (`ma_gioi`),
  ADD CONSTRAINT `animals_ibfk_2` FOREIGN KEY (`ma_nganh`) REFERENCES `nganh` (`ma_nganh`),
  ADD CONSTRAINT `animals_ibfk_3` FOREIGN KEY (`ma_lop`) REFERENCES `lop` (`ma_lop`),
  ADD CONSTRAINT `animals_ibfk_4` FOREIGN KEY (`ma_ho`) REFERENCES `ho` (`ma_ho`),
  ADD CONSTRAINT `animals_ibfk_5` FOREIGN KEY (`ma_bo`) REFERENCES `bo` (`ma_bo`),
  ADD CONSTRAINT `animals_ibfk_6` FOREIGN KEY (`ma_bt_sachdovn`) REFERENCES `baoton_sachdovn` (`ma_bt_sachdovn`),
  ADD CONSTRAINT `animals_ibfk_7` FOREIGN KEY (`ma_bt_iucn`) REFERENCES `baoton_iucn` (`ma_bt_iucn`);

--
-- Các ràng buộc cho bảng `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`ma_dv`) REFERENCES `animals` (`ma_dv`);

--
-- Các ràng buộc cho bảng `phanbo`
--
ALTER TABLE `phanbo`
  ADD CONSTRAINT `phanbo_ibfk_1` FOREIGN KEY (`ma_dv`) REFERENCES `animals` (`ma_dv`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
