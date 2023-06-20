-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 19, 2023 lúc 05:30 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `website_mvc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietcart`
--

CREATE TABLE `chitietcart` (
  `id` int(11) NOT NULL,
  `MaCart` int(11) UNSIGNED NOT NULL,
  `MaSP` int(11) UNSIGNED NOT NULL,
  `SoLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietcart`
--

INSERT INTO `chitietcart` (`id`, `MaCart`, `MaSP`, `SoLuong`) VALUES
(22, 4, 27, 2),
(23, 4, 18, 3),
(25, 6, 18, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietorder`
--

CREATE TABLE `chitietorder` (
  `id` int(11) NOT NULL,
  `MaSP` int(11) UNSIGNED NOT NULL,
  `MaHD` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` int(11) NOT NULL,
  `ThanhTien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietorder`
--

INSERT INTO `chitietorder` (`id`, `MaSP`, `MaHD`, `SoLuong`, `DonGia`, `ThanhTien`) VALUES
(1, 17, 1, 500000, 500, 250000000),
(2, 19, 1, 1, 2000, 2000),
(3, 13, 7, 5, 4000000, 20000000),
(4, 14, 7, 1, 4000, 4000),
(5, 17, 8, 6, 500, 3000),
(6, 16, 8, 30, 4, 120),
(7, 19, 8, 1, 2000, 2000),
(8, 20, 9, 1, 80000, 80000),
(9, 22, 10, 1, 1500, 1500),
(10, 25, 11, 2, 25000, 50000),
(11, 24, 11, 2, 25000, 50000),
(12, 19, 11, 1, 2000, 2000),
(13, 30, 12, 2, 50000, 100000),
(14, 29, 12, 3, 25000, 75000),
(15, 13, 12, 5, 4000000, 20000000),
(16, 18, 13, 3, 1, 3),
(17, 30, 13, 1, 50000, 50000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'hieu', 'hieum7239@gmail.com', 'hieu', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) UNSIGNED NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(1, 'Dell'),
(3, 'Samsung'),
(4, 'Macbook'),
(6, 'Oppo'),
(7, 'Canon'),
(8, 'iphone'),
(9, 'Nokia'),
(10, 'ASUS');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) UNSIGNED NOT NULL,
  `customerId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `customerId`) VALUES
(1, 1),
(4, 2),
(5, 3),
(6, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) UNSIGNED NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(7, 'Desktop'),
(14, 'phone'),
(15, 'screen'),
(16, 'PC'),
(17, 'ScreenCard'),
(18, 'test'),
(19, 'Camera');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zipcode`, `phone`, `email`, `password`) VALUES
(1, 'hieu', 'BINH DINH', 'QUY NHON', 'VN', '28', '0342746867', 'hieum7239@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'quang', 'BINH DINH', 'HO CHI MINH', 'VN', '28', '0342746867', 'hieum723@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'hieu', 'BINH DINH', 'HO', 'VN', '28', '0342746867', 'hieu123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'hieu', 'BINH DINH', 'QUY NHON', 'VIET NAM', '28', '0342746867', 'hieum@gmail.com', '123456'),
(5, 'hieu', 'BINH DINH', 'HA NOI', 'VN', '1', '0342746867', 'hieum23@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `customerId` int(11) UNSIGNED NOT NULL,
  `createDate` date NOT NULL,
  `tongTien` int(11) NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `customerId`, `createDate`, `tongTien`, `state`) VALUES
(1, 1, '2023-05-13', 2500, 1),
(7, 1, '2023-05-15', 20004000, 2),
(8, 1, '2023-05-15', 5120, -1),
(9, 1, '2023-05-16', 80000, -1),
(10, 1, '2023-05-16', 1500, 2),
(11, 1, '2023-05-16', 102000, 1),
(12, 1, '2023-05-16', 20175000, 1),
(13, 2, '2023-05-16', 50003, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) UNSIGNED NOT NULL,
  `productName` tinytext NOT NULL,
  `catId` int(11) UNSIGNED NOT NULL,
  `brandId` int(11) UNSIGNED NOT NULL,
  `productDesc` text NOT NULL,
  `type` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `state` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `productDesc`, `type`, `price`, `image`, `state`, `SoLuong`) VALUES
(13, 'Cannon 5DHS', 19, 3, '<p>Cameracannonnonon mofras fjusaf</p>', 0, '4000000', '171e8a1875.jpg', 1, 15),
(14, 'Macbook M1 pro', 16, 4, '<p><span>The MacBook family was initially housed in designs similar to the iBook and PowerBook lines which preceded them, now making use of a unibody&nbsp;</span><a title=\"Aluminium\" href=\"https://en.wikipedia.org/wiki/Aluminium\">aluminum</a><span>&nbsp;construction first introduced with the MacBook Air. This new construction also has a black plastic keyboard that was first used on the MacBook Air, which itself was inspired by the sunken keyboard of the original polycarbonate MacBooks. The now standardized keyboard brings congruity to the MacBook line, with black keys on a metallic aluminum body.</span></p>', 1, '4000', 'd3d08bb439.jpg', 1, 15),
(16, 'Galaxy S23 Ultra', 14, 3, '<p><span>Samsung Galaxy S23&nbsp;</span><span>l&agrave; phi&ecirc;n bản tiếp theo sắp được Samsung cho ra mắt thị trường. Sở hữu diện mạo tinh tế mới mẻ đi đầu xu hướng, b&ecirc;n cạnh đ&oacute; l&agrave; m&agrave;n h&igrave;nh chất lượng, hiệu năng mạnh mẽ v&agrave; cụm camera si&ecirc;u chất sẽ mang tới những trải nghiệm ấn tượng cho người d&ugrave;ng ngay từ lần chạm đầu ti&ecirc;n.</span></p>\r\n<div class=\"ddict_btn\" style=\"top: 10px; left: 529.318px;\"><img src=\"chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png\" alt=\"\" /></div>', 1, '4', '6fd9ac0f3c.png', 1, 10),
(17, 'Camera', 19, 7, '<p>Camera canon B650 full xlm white B extra</p>', 1, '500', 'db76baa730.jpg', 1, 155),
(18, 'Macbook M10 pro', 16, 4, '<p>macbook m10 pro macbook m10 pro macbook m10 promacbook m10 pro</p>', 1, '1', 'a46dfec5f6.jpg', 1, 0),
(19, 'camera hidden', 19, 7, '<p>camera hiddencamera hiddencamera hiddencamera hiddencamera hiddencamera hidden</p>', 1, '2000', '58c71baba8.jpg', 1, 155),
(20, 'Iphone 8 Plus', 14, 8, '<p>kh&aacute; th&ocirc;ng minh, với c&aacute;c t&iacute;nh năng mới</p>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 1, '80000', 'a3993ef2b7.jpg', 1, 15),
(22, 'iphone fake', 14, 8, '<p>&nbsp;</p>\r\n<div id=\"eJOY__extension_root\" class=\"eJOY__extension_root_class\" style=\"all: unset;\">&nbsp;</div>', 0, '1500', 'ab5c7b89f8.png', 1, 14),
(23, 'samsum galaxy u15', 14, 3, 'Khá thông minh', 1, '50000', '75803bddf1.png', 1, 15),
(24, 'Nokia', 14, 9, 'Khá thông minh', 0, '25000', 'bf15f8d712.jpg', 1, 13),
(25, 'Asus VivoBook', 16, 10, 'Khá thông minh', 1, '25000', '084f0b54df.jpg', 1, 13),
(27, 'iphone 13pro max', 14, 8, 'Khá thông minh', 1, '25000', '08dcde52ba.png', 1, 15),
(28, 'Desktop Utraihan 12', 7, 10, 'Khá thông minh', 1, '25000', 'ef75529505.jpg', 1, 15),
(29, 'Camera Utraihan 1S', 19, 7, 'Khá thông minh', 1, '25000', 'd3cdd00478.jpg', 1, 12),
(30, 'DSLR (Digital Single-Lens Reflex)', 19, 7, 'Khá thông minh', 1, '50000', 'dc848397a9.jpg', 1, 13),
(31, 'SAMSUM UTRAIHAN PRO', 14, 3, 'Khá thông minh', 1, '25000', 'f2f5bbfbbb.jpg', 1, 155),
(32, ' Samsung Galaxy M33 5G', 14, 3, 'Khá thông minh', 1, '25000', '7da54bbb97.jpg', 1, 155);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `title`, `image`, `type`) VALUES
(6, 'test 1', 'e2fc13a250.jpg', 0),
(8, 'nak market', '8b3f7b32bf.png', 0),
(9, 'Nak', 'b110ad2426.png', 1),
(10, 'Nak', '8958dc6d98.jpg', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietcart`
--
ALTER TABLE `chitietcart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1` (`MaCart`),
  ADD KEY `fk2` (`MaSP`);

--
-- Chỉ mục cho bảng `chitietorder`
--
ALTER TABLE `chitietorder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk3` (`MaHD`),
  ADD KEY `fk4` (`MaSP`);

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `fk5` (`customerId`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk6` (`customerId`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `fk8` (`brandId`),
  ADD KEY `fk9` (`catId`);

--
-- Chỉ mục cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitietcart`
--
ALTER TABLE `chitietcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `chitietorder`
--
ALTER TABLE `chitietorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietcart`
--
ALTER TABLE `chitietcart`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`MaCart`) REFERENCES `tbl_cart` (`cartId`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`MaSP`) REFERENCES `tbl_product` (`productId`);

--
-- Các ràng buộc cho bảng `chitietorder`
--
ALTER TABLE `chitietorder`
  ADD CONSTRAINT `fk3` FOREIGN KEY (`MaHD`) REFERENCES `tbl_order` (`id`),
  ADD CONSTRAINT `fk4` FOREIGN KEY (`MaSP`) REFERENCES `tbl_product` (`productId`);

--
-- Các ràng buộc cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `fk5` FOREIGN KEY (`customerId`) REFERENCES `tbl_customer` (`id`);

--
-- Các ràng buộc cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `fk6` FOREIGN KEY (`customerId`) REFERENCES `tbl_customer` (`id`);

--
-- Các ràng buộc cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `fk8` FOREIGN KEY (`brandId`) REFERENCES `tbl_brand` (`brandId`),
  ADD CONSTRAINT `fk9` FOREIGN KEY (`catId`) REFERENCES `tbl_category` (`catId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
