-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 19, 2022 lúc 07:47 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webcauca`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminid` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminid`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'Kiệt', 'kiet@gmail.com', 'kietchushop', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `productId`, `sId`, `productName`, `price`, `quantity`, `image`) VALUES
(64, 2, 'c0gslikh67gtmvtq4uthr9pcg4', 'Mồi câu ếch giả ', '200000', 1, '3a58d1c91c.jpg'),
(65, 3, 'c0gslikh67gtmvtq4uthr9pcg4', 'Máy câu Shimano', '5500000', 1, '6924abe623.jpg'),
(66, 17, 'sjlutombkbjicf4fhkk9ssidrk', 'Dù che nắng khi đi câu', '500000', 1, 'ed03b577d5.jpg'),
(67, 12, '9nqgkm1pqsjqn78kghk8f18del', 'Máy câu Daiwaa', '2800000', 1, 'f1c5f82230.jpg'),
(68, 3, 'uri4qp9f0a2ullir344c512ces', 'Máy câu Shimano', '5500000', 2, '6924abe623.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(42, 'Phụ kiện câu cá'),
(43, 'Mồi câu'),
(48, 'Cần câu'),
(51, 'Máy câu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderId` int(11) NOT NULL,
  `hotenkhach` varchar(255) NOT NULL,
  `sdt` int(20) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `thanhpho` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `product_desc` text NOT NULL,
  `type` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `product_desc`, `type`, `price`, `image`) VALUES
(2, 'Mồi câu ếch giả ', 43, 'Đây là 1 loại mồi đặc biệt được thiết kế với hình dạng ếch cao su cực bền .Đặc biệt mồi này cá lóc rất ưa chuộng.', 1, '200000', '3a58d1c91c.jpg'),
(3, 'Máy câu Shimano', 51, 'Với máy câu thương hiệu uy tín đến từ Shimano thì việc sở hữu những con cá siêu to quá đơn giản.Quá chất lượng đến từ thương hiệu Shimano', 1, '5500000', '6924abe623.jpg'),
(12, 'Máy câu Daiwaa', 51, 'Với máy câu thương hiệu uy tín đến từ Daiwaa thì việc sở hữu những con cá siêu to quá đơn giản.Quá chất lượng đến từ thương hiệu Daiwaa', 1, '2800000', 'f1c5f82230.jpg'),
(13, 'Cần câu Shimano', 48, 'Đồ này quá ngon , ngon hơn cả crush của bạn , không còn gì phải bàn cãi , \r\n                nếu không tin cứ bỏ tiền ra mua , bên tui cho vay nóng luôn lấy bạc 50 dễ chịu thoải mái\r\n                nhưng quên nợ là không bảo toàn tính mạng bạn nhé, có gì liên hệ với đại ca tui Kiệt senpai . \r\n                Đã nghiện rồi còn ngại , chốt đơn nhanh đi bạn , cơ hội thành công chỉ đến với \r\n                người có bản lĩnh !', 1, '20000000', '283317765c.jpg'),
(15, 'Cần câu Tomahawk', 48, 'Cần này được mệnh danh là tử thần sông Mekong .Lý do đơn giản là khả năng sức bền của nó là vô hạn', 1, '45000000', '55c8b3c895.jpg'),
(16, 'Ashino Jaw', 48, 'Loại này câu cá tốt , kéo cả khoảng 40-50kg là chuyện bình thường . Sẽ là 1 trang bị tốt cho cần thủ', 0, '30000000', '3914562389.jpg'),
(17, 'Dù che nắng khi đi câu', 42, 'Loại dù này được làm từ chất liệu cacbon nên khả năng chống nắng phải nói cực kỳ tốt', 0, '500000', 'ed03b577d5.jpg'),
(18, 'Máy câu Abu Garcia', 51, 'Máy này chất lượng tuyệt vời có thể chịu được sức nặng với lực kéo dưới 60kg .Nếu muốn săn thủy quái chiếc máy câu này sẽ đáp ứng được bạn.', 0, '8500000', 'b86e8d4835.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_regis`
--

CREATE TABLE `tbl_regis` (
  `regisId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `useracc` varchar(255) NOT NULL,
  `userpass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_regis`
--

INSERT INTO `tbl_regis` (`regisId`, `username`, `useracc`, `userpass`) VALUES
(1, 'Trần Anh Kiệt', 'trananhkiet', '123456789'),
(13, 'Trần Văn Phúc', 'tranvanphuc', '123456789');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderId`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- Chỉ mục cho bảng `tbl_regis`
--
ALTER TABLE `tbl_regis`
  ADD PRIMARY KEY (`regisId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `tbl_regis`
--
ALTER TABLE `tbl_regis`
  MODIFY `regisId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
