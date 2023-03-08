-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 05, 2023 lúc 07:21 AM
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
(1, 'Kiệt', 'kiet@gmail.com', 'kietchushop', 'e10adc3949ba59abbe56e057f20f883e', 0),
(2, 'Trần Anh Kiệt', 'bibiheo18@gmail.com', 'bibiheo18', '02586535b652ae3b11d6e4aa78efe62c', 0),
(3, 'Trần Văn Kiệt', 'trananhkiet3004@gmail.com', 'phuong09090919', 'Kiet2158241', 0),
(4, 'Phương', 'phuong@gmail.com', 'phuong123', 'Kiet2158241', 0),
(5, 'tu', 'tu@gmail.com', 'tu', '123456', 0),
(6, 'cúc', 'cuc@gmail.com', 'cuc', 'e10adc3949ba59abbe56e057f20f883e', 0);

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
  `image` varchar(255) NOT NULL,
  `code_cart` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart_details`
--

CREATE TABLE `tbl_cart_details` (
  `id_cartdetails` int(11) NOT NULL,
  `id_sanpham` varchar(50) NOT NULL,
  `soluongmua` varchar(50) NOT NULL,
  `giatien` varchar(200) NOT NULL,
  `code_cart` varchar(50) NOT NULL,
  `hoten` varchar(255) NOT NULL,
  `sodienthoai` int(20) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `sId` varchar(255) NOT NULL,
  `status` int(5) NOT NULL DEFAULT 0,
  `paid_type` varchar(255) NOT NULL,
  `paid_date` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart_details`
--

INSERT INTO `tbl_cart_details` (`id_cartdetails`, `id_sanpham`, `soluongmua`, `giatien`, `code_cart`, `hoten`, `sodienthoai`, `diachi`, `sId`, `status`, `paid_type`, `paid_date`) VALUES
(121, '3', '2', '11000000', '6796', 'Trần Anh Kiệt', 905428889, '96ql 1A,kp2,p.hbp', 'g4c6gkfgosq91ar24pe8ogeupp', 1, 'VNPAY', '2023-01-08 22:01:43'),
(122, '2', '2', '400000', '3845', 'Trần Anh Kiệt', 905428889, '96ql 1A,kp2,p.hbp', 'g4c6gkfgosq91ar24pe8ogeupp', 1, 'VNPAY', '2023-01-08 22:01:43'),
(123, '15', '3', '135000000', '9104', 'Lưu Sa Đệ', 905428889, '96ql 1A,kp2,p.hbp', '7vt85b85847831209726428vs6', 3, 'VNPAY', '2023-01-10 07:25:09'),
(124, '17', '3', '1500000', '1690', 'Lưu Sa Đệ', 905428889, '96ql 1A,kp2,p.hbp', '7vt85b85847831209726428vs6', 2, 'VNPAY', '2023-01-10 07:25:09'),
(125, '3', '1', '5500000', '7104', 'Lưu Sa Đệ', 905428889, '96ql 1A,kp2,p.hbp', '7vt85b85847831209726428vs6', 1, 'VNPAY', '2023-01-10 07:30:29'),
(126, '12', '1', '2800000', '4044', 'Lưu Sa Đệ', 905428889, '96ql 1A,kp2,p.hbp', '7vt85b85847831209726428vs6', 1, 'VNPAY', '2023-01-10 07:32:39'),
(128, '12', '2', '5600000', '4294', 'Nguyễn Minh Tú', 902040191, '169ql 1A,kp2,p.hbp', 'qnkkcc14c29i5es7u0jcqq4kd0', 0, 'VNPAY', '2023-01-11 23:55:13'),
(129, '17', '3', '1500000', '5516', 'Nguyễn Minh Tú', 902040191, '169ql 1A,kp2,p.hbp', 'qnkkcc14c29i5es7u0jcqq4kd0', 0, 'VNPAY', '2023-01-11 23:55:13'),
(130, '28', '3', '450000', '1715', 'Nguyễn Minh Tú', 902040191, '169ql 1A,kp2,p.hbp', 'qnkkcc14c29i5es7u0jcqq4kd0', 1, 'VNPAY', '2023-01-12 00:16:44'),
(131, '2', '3', '600000', '5933', 'Nguyễn Minh Tú', 902040191, '169ql 1A,kp2,p.hbp', 'qnkkcc14c29i5es7u0jcqq4kd0', 0, 'VNPAY', '2023-01-12 00:27:46'),
(132, '18', '1', '8500000', '6236', 'Nguyễn Minh Tú', 902040191, '169ql 1A,kp2,p.hbp', 'qnkkcc14c29i5es7u0jcqq4kd0', 0, 'VNPAY', '2023-01-12 01:35:53'),
(133, '12', '2', '5600000', '5586', 'Nguyễn Minh Tú', 902040191, '169ql 1A,kp2,p.hbp', 'tshu0n15a2lrn4hifih2r3h5eu', 1, 'VNPAY', '2023-01-12 05:40:48'),
(134, '3', '2', '11000000', '8144', 'Nguyễn Minh Tú', 902040191, '169ql 1A,kp2,p.hbp', 'tshu0n15a2lrn4hifih2r3h5eu', 1, 'VNPAY', '2023-01-12 05:40:48'),
(135, '2', '1', '200000', '8248', 'Nguyễn Minh Tú', 902040191, '169ql 1A,kp2,p.hbp', 'tshu0n15a2lrn4hifih2r3h5eu', 1, 'VNPAY', '2023-01-12 05:40:48'),
(138, '16', '2', '60000000', '6437', 'Nguyễn Minh Tú', 902040191, '169ql 1A,kp2,p.hbp', 'tshu0n15a2lrn4hifih2r3h5eu', 0, 'VNPAY', '2023-01-12 06:26:20'),
(139, '17', '1', '500000', '3767', 'Nguyễn Minh Tú', 902040191, '169ql 1A,kp2,p.hbp', 'tshu0n15a2lrn4hifih2r3h5eu', 1, 'VNPAY', '2023-01-12 06:26:20'),
(140, '28', '3', '450000', '5630', 'trần anh kiệt', 90301091, '96ql 1A,kp2,p.hbp', 'ous2ugobeo18dgdq22rat550e4', 1, 'VNPAY', '2023-01-12 07:18:42'),
(141, '28', '1', '150000', '289', 'trần anh kiệt', 90301091, '96ql 1A,kp2,p.hbp', 'ous2ugobeo18dgdq22rat550e4', 3, 'VNPAY', '2023-01-12 10:44:42');

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
(51, 'Máy câu'),
(59, 'Dây câu'),
(67, 'Lưỡi câu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_giohang`
--

CREATE TABLE `tbl_giohang` (
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `code_cart` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_giohang`
--

INSERT INTO `tbl_giohang` (`cartId`, `productId`, `sId`, `productName`, `price`, `quantity`, `image`, `code_cart`) VALUES
(83, 3, 'g4c6gkfgosq91ar24pe8ogeupp', 'Máy câu Shimano', '11000000', 2, '6924abe623.jpg', '6796'),
(84, 2, 'g4c6gkfgosq91ar24pe8ogeupp', 'Mồi câu ếch giả ', '400000', 2, '3a58d1c91c.jpg', '3845'),
(85, 15, '7vt85b85847831209726428vs6', 'Cần câu Tomahawk', '135000000', 3, '55c8b3c895.jpg', '9104'),
(86, 17, '7vt85b85847831209726428vs6', 'Dù che nắng', '1500000', 3, 'ed03b577d5.jpg', '1690'),
(87, 3, '7vt85b85847831209726428vs6', 'Máy câu Shimano', '5500000', 1, '6924abe623.jpg', '7104'),
(88, 12, '7vt85b85847831209726428vs6', 'Máy câu Daiwaa', '2800000', 1, 'f1c5f82230.jpg', '4044'),
(89, 12, '7vt85b85847831209726428vs6', 'Máy câu Daiwaa', '2800000', 1, 'f1c5f82230.jpg', '9602'),
(90, 12, 'qnkkcc14c29i5es7u0jcqq4kd0', 'Máy câu Daiwaa', '5600000', 2, 'f1c5f82230.jpg', '4294'),
(91, 17, 'qnkkcc14c29i5es7u0jcqq4kd0', 'Dù che nắng', '1500000', 3, 'ed03b577d5.jpg', '5516'),
(92, 28, 'qnkkcc14c29i5es7u0jcqq4kd0', 'Dây câu RYUKI', '450000', 3, '7f622fc483.png', '1715'),
(93, 2, 'qnkkcc14c29i5es7u0jcqq4kd0', 'Mồi câu ếch giả ', '600000', 3, '3a58d1c91c.jpg', '5933'),
(94, 18, 'qnkkcc14c29i5es7u0jcqq4kd0', 'Máy câu Abu Garcia', '8500000', 1, 'b86e8d4835.jpg', '6236'),
(95, 12, 'tshu0n15a2lrn4hifih2r3h5eu', 'Máy câu Daiwaa', '5600000', 2, 'f1c5f82230.jpg', '5586'),
(96, 3, 'tshu0n15a2lrn4hifih2r3h5eu', 'Máy câu Shimano', '11000000', 2, '6924abe623.jpg', '8144'),
(97, 2, 'tshu0n15a2lrn4hifih2r3h5eu', 'Mồi câu ếch giả ', '200000', 1, '3a58d1c91c.jpg', '8248'),
(98, 15, 'tshu0n15a2lrn4hifih2r3h5eu', 'Cần câu Tomahawk', '135000000', 3, '55c8b3c895.jpg', '7125'),
(99, 16, 'tshu0n15a2lrn4hifih2r3h5eu', 'Ashino Jaw', '270000000', 9, '3914562389.jpg', '1657'),
(100, 16, 'tshu0n15a2lrn4hifih2r3h5eu', 'Ashino Jaw', '60000000', 2, '3914562389.jpg', '6437'),
(101, 17, 'tshu0n15a2lrn4hifih2r3h5eu', 'Dù che nắng', '500000', 1, 'ed03b577d5.jpg', '3767'),
(102, 28, 'ous2ugobeo18dgdq22rat550e4', 'Dây câu RYUKI', '450000', 3, '7f622fc483.png', '5630'),
(103, 28, 'ous2ugobeo18dgdq22rat550e4', 'Dây câu RYUKI', '150000', 1, '7f622fc483.png', '289');

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
  `image` varchar(255) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0,
  `paid_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`orderId`, `hotenkhach`, `sdt`, `diachi`, `thanhpho`, `productId`, `productName`, `quantity`, `price`, `image`, `status`, `paid_date`) VALUES
(103, 'trần văn gà', 905428889, '72 quốc lộ 1A , kp 2 , p.hbp', 'hồ chí minh', 3, 'Máy câu Shimano', 2, '11000000', '6924abe623.jpg', 2, '2023-01-07 19:46:43'),
(104, 'trần văn gà', 905428889, '72 quốc lộ 1A , kp 2 , p.hbp', 'hồ chí minh', 12, 'Máy câu Daiwaa', 2, '5600000', 'f1c5f82230.jpg', 2, '2023-01-07 19:46:43'),
(105, 'hoàng minh trí', 908715553, '72 quốc lộ 1A , kp 2 , p.hbp', 'hồ chí minh', 18, 'Máy câu Abu Garcia', 1, '8500000', 'b86e8d4835.jpg', 0, '2023-01-11 13:16:08'),
(106, 'hoàng minh trí', 908715553, '72 quốc lộ 1A , kp 2 , p.hbp', 'hồ chí minh', 20, 'Kìm khóa cá bự', 2, '600000', '89ccc7f262.jpg', 3, '2023-01-11 13:16:08'),
(107, 'Trần Trung Kiên', 905428889, '86ql 1A,kp2,p.hbp', 'tp.hcm', 29, 'Mồi câu cá giả', 2, '40000', 'd49b2b0a8a.jpg', 2, '2023-01-11 23:53:47'),
(108, 'Trần Trung Kiên', 905428889, '86ql 1A,kp2,p.hbp', 'tp.hcm', 2, 'Mồi câu ếch giả ', 3, '600000', '3a58d1c91c.jpg', 2, '2023-01-11 23:53:47'),
(109, 'trần văn ri', 905418889, '72 quốc lộ 1A , kp 2 , p.hbp', 'tp hcm', 17, 'Dù che nắng', 2, '1000000', 'ed03b577d5.jpg', 2, '2023-01-12 00:41:00'),
(110, 'trần văn kiên', 905428889, '72 quốc lộ 1A , kp 2 , p.hbp', 'tp.hcm', 12, 'Máy câu Daiwaa', 2, '5600000', 'f1c5f82230.jpg', 2, '2023-01-12 06:14:21'),
(111, 'trần văn kiên', 905428889, '72 quốc lộ 1A , kp 2 , p.hbp', 'tp.hcm', 2, 'Mồi câu ếch giả ', 2, '400000', '3a58d1c91c.jpg', 3, '2023-01-12 06:14:21'),
(112, 'Đỗ Văn Linh', 903070172, '96ql 1A,kp2,p.hbp', 'tp hcm', 17, 'Dù che nắng', 3, '1500000', 'ed03b577d5.jpg', 2, '2023-01-12 07:35:58'),
(113, 'Đỗ Văn Linh', 903070172, '96ql 1A,kp2,p.hbp', 'tp hcm', 28, 'Dây câu RYUKI', 2, '300000', '7f622fc483.png', 2, '2023-01-12 07:35:58'),
(114, 'trần anh kiệt', 909415553, '72 quốc lộ 1A , kp 2 , p.hbp', 'hồ chí minh', 2, 'Mồi câu ếch giả ', 4, '800000', '3a58d1c91c.jpg', 2, '2023-01-12 10:41:25');

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
(16, 'Ashino Jaw', 48, 'Loại này câu cá tốt , kéo cả khoảng 40-50kg là chuyện bình thường . Sẽ là 1 trang bị tốt cho cần thủ', 1, '30000000', '3914562389.jpg'),
(17, 'Dù che nắng', 42, 'Loại dù này được làm từ chất liệu cacbon nên khả năng chống nắng phải nói cực kỳ tốt', 0, '500000', 'ed03b577d5.jpg'),
(18, 'Máy câu Abu Garcia', 51, 'Máy này chất lượng tuyệt vời có thể chịu được sức nặng với lực kéo dưới 60kg .Nếu muốn săn thủy quái chiếc máy câu này sẽ đáp ứng được bạn.', 1, '8500000', 'b86e8d4835.jpg'),
(20, 'Kìm khóa cá bự', 42, 'Kìm này xịn đấy, chắc chắn phải ngon hơn các loại giả rồi. Nhớ ghé mua của shop để nhận nhiều ưu đãi', 1, '300000', '89ccc7f262.jpg'),
(24, 'Cần câu ShyuxCarbon', 48, 'Cần này tuyệt vời, không cần phải bàn cãi về chất lượng tuyệt vời của em nó', 1, '7000000', 'f5a8fce085.jpg'),
(26, 'Máy câu Penn', 51, 'Chất lượng thì khỏi phải bàn cãi , đây là sản phẩm tốt nhất trong tầm giá.', 1, '1890000', '8871ed74d2.jpg'),
(28, 'Dây câu RYUKI', 59, 'Dây câu chất lượng tuyệt vời có thể chịu lực kéo từ 10-15kg. Là sản phẩm được nhiều khách hàng tin dùng.', 1, '150000', '7f622fc483.png'),
(29, 'Mồi câu cá giả', 43, 'Đây là 1 loại mồi đặc biệt được thiết kế với hình dạng ếch cao su cực bền .Đặc biệt mồi này cá lóc rất ưa chuộng.', 1, '20000', 'd49b2b0a8a.jpg');

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
(13, 'Trần Văn Phúc', 'tranvanphuc', '123456789'),
(14, 'Trần Anh Kiệt', 'bibiheo18', 'Kiet2158241'),
(15, 'Trần Minh Khôi', 'khoi', '123456789'),
(16, 'Trần Anh Khoa', 'kietvippro130', 'Kiet2158241'),
(17, 'Trần Anh Kiệt', 'kiet', '123456789'),
(18, 'Trần Văn Cường', 'cuong', '123'),
(19, 'Doremi', 'niko', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_thongke`
--

CREATE TABLE `tbl_thongke` (
  `id` int(11) NOT NULL,
  `paid_date` varchar(60) NOT NULL,
  `tong_soluongdonhang` int(11) NOT NULL,
  `tong_soluongban` int(11) NOT NULL,
  `doanhthu` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_thongke`
--

INSERT INTO `tbl_thongke` (`id`, `paid_date`, `tong_soluongdonhang`, `tong_soluongban`, `doanhthu`) VALUES
(26, '2023-01-05', 30, 40, '400000000'),
(27, '2023-01-06', 40, 50, '600000000'),
(28, '2023-01-07', 50, 60, '700000000'),
(29, '2023-01-08', 20, 30, '4000000'),
(30, '2023-01-09', 5, 5, '200000'),
(31, '2023-01-10', 8, 16, '473800000'),
(32, '2023-01-11', 2, 5, '1880000'),
(33, '2023-01-12', 15, 33, '42850002');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_vnpay`
--

CREATE TABLE `tbl_vnpay` (
  `id_vnpay` int(11) NOT NULL,
  `vnp_amount` varchar(50) NOT NULL,
  `vnp_bankcode` varchar(50) NOT NULL,
  `vnp_banktranno` varchar(50) NOT NULL,
  `vnp_cardtype` varchar(50) NOT NULL,
  `vnp_orderinfo` varchar(100) NOT NULL,
  `vnp_paydate` varchar(50) NOT NULL,
  `vnp_tmncode` varchar(50) NOT NULL,
  `vnp_transactionno` varchar(50) NOT NULL,
  `code_cart` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_vnpay`
--

INSERT INTO `tbl_vnpay` (`id_vnpay`, `vnp_amount`, `vnp_bankcode`, `vnp_banktranno`, `vnp_cardtype`, `vnp_orderinfo`, `vnp_paydate`, `vnp_tmncode`, `vnp_transactionno`, `code_cart`) VALUES
(123, '1254000000', 'NCB', 'VNP13922828', 'thanh toán đơn hàng vnpay', '20230108220202', 'N7AHH6MP', '13922828', 'ATM', '3845'),
(124, '1254000000', 'NCB', 'VNP13922828', 'thanh toán đơn hàng vnpay', '20230108220202', 'N7AHH6MP', '13922828', 'ATM', '3845'),
(125, '15015000000', 'NCB', 'VNP13923648', 'thanh toán đơn hàng vnpay', '20230110072524', 'N7AHH6MP', '13923648', 'ATM', '1690'),
(126, '15015000000', 'NCB', 'VNP13923648', 'thanh toán đơn hàng vnpay', '20230110072524', 'N7AHH6MP', '13923648', 'ATM', '1690'),
(127, '605000000', 'NCB', 'VNP13923649', 'thanh toán đơn hàng vnpay', '20230110073049', 'N7AHH6MP', '13923649', 'ATM', '7104'),
(128, '605000000', 'NCB', 'VNP13923649', 'thanh toán đơn hàng vnpay', '20230110073049', 'N7AHH6MP', '13923649', 'ATM', ''),
(129, '308000000', 'NCB', 'VNP13923650', 'thanh toán đơn hàng vnpay', '20230110073300', 'N7AHH6MP', '13923650', 'ATM', '4044'),
(130, '308000000', 'NCB', 'VNP13923650', 'thanh toán đơn hàng vnpay', '20230110073300', 'N7AHH6MP', '13923650', 'ATM', ''),
(131, '781000000', 'NCB', 'VNP13925190', 'thanh toán đơn hàng vnpay', '20230111235541', 'N7AHH6MP', '13925190', 'ATM', '5516'),
(132, '781000000', 'NCB', 'VNP13925190', 'thanh toán đơn hàng vnpay', '20230111235541', 'N7AHH6MP', '13925190', 'ATM', ''),
(133, '49500000', 'NCB', 'VNP13925193', 'thanh toán đơn hàng vnpay', '20230112001706', 'N7AHH6MP', '13925193', 'ATM', '1715'),
(134, '49500000', 'NCB', 'VNP13925193', 'thanh toán đơn hàng vnpay', '20230112001706', 'N7AHH6MP', '13925193', 'ATM', ''),
(135, '66000000', 'NCB', 'VNP13925194', 'thanh toán đơn hàng vnpay', '20230112002819', 'N7AHH6MP', '13925194', 'ATM', '5933'),
(136, '66000000', 'NCB', 'VNP13925194', 'thanh toán đơn hàng vnpay', '20230112002819', 'N7AHH6MP', '13925194', 'ATM', ''),
(137, '935000000', 'NCB', 'VNP13925202', 'thanh toán đơn hàng vnpay', '20230112013626', 'N7AHH6MP', '13925202', 'ATM', '6236'),
(138, '935000000', 'NCB', 'VNP13925202', 'thanh toán đơn hàng vnpay', '20230112013626', 'N7AHH6MP', '13925202', 'ATM', ''),
(139, '1848000000', 'NCB', 'VNP13925208', 'thanh toán đơn hàng vnpay', '20230112054110', 'N7AHH6MP', '13925208', 'ATM', '8248'),
(140, '1848000000', 'NCB', 'VNP13925208', 'thanh toán đơn hàng vnpay', '20230112054110', 'N7AHH6MP', '13925208', 'ATM', ''),
(141, '6050000000', 'NCB', 'VNP13925210', 'thanh toán đơn hàng vnpay', '20230112062602', 'N7AHH6MP', '13925210', 'ATM', '3767'),
(142, '6050000000', 'NCB', 'VNP13925210', 'thanh toán đơn hàng vnpay', '20230112062602', 'N7AHH6MP', '13925210', 'ATM', ''),
(143, '45000000', 'NCB', 'VNP13925213', 'thanh toán đơn hàng vnpay', '20230112071832', 'N7AHH6MP', '13925213', 'ATM', '5630'),
(144, '45000000', 'NCB', 'VNP13925213', 'thanh toán đơn hàng vnpay', '20230112071832', 'N7AHH6MP', '13925213', 'ATM', ''),
(145, '15000000', 'NCB', 'VNP13925314', 'thanh toán đơn hàng vnpay', '20230112104436', 'N7AHH6MP', '13925314', 'ATM', '289'),
(146, '15000000', 'NCB', 'VNP13925314', 'thanh toán đơn hàng vnpay', '20230112104436', 'N7AHH6MP', '13925314', 'ATM', '');

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
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `productId` (`productId`);

--
-- Chỉ mục cho bảng `tbl_cart_details`
--
ALTER TABLE `tbl_cart_details`
  ADD PRIMARY KEY (`id_cartdetails`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Chỉ mục cho bảng `tbl_giohang`
--
ALTER TABLE `tbl_giohang`
  ADD PRIMARY KEY (`cartId`);

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
  ADD PRIMARY KEY (`regisId`),
  ADD KEY `username` (`username`);

--
-- Chỉ mục cho bảng `tbl_thongke`
--
ALTER TABLE `tbl_thongke`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_vnpay`
--
ALTER TABLE `tbl_vnpay`
  ADD PRIMARY KEY (`id_vnpay`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=427;

--
-- AUTO_INCREMENT cho bảng `tbl_cart_details`
--
ALTER TABLE `tbl_cart_details`
  MODIFY `id_cartdetails` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT cho bảng `tbl_giohang`
--
ALTER TABLE `tbl_giohang`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `tbl_regis`
--
ALTER TABLE `tbl_regis`
  MODIFY `regisId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `tbl_thongke`
--
ALTER TABLE `tbl_thongke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `tbl_vnpay`
--
ALTER TABLE `tbl_vnpay`
  MODIFY `id_vnpay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`productId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
