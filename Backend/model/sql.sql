-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for duanyody
CREATE DATABASE IF NOT EXISTS `duanyody` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `duanyody`;

CREATE TABLE IF NOT EXISTS `categorys` (
  `categoryId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `past` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_vietnamese_ci,
  PRIMARY KEY (`categoryId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bảng chứa các danh mục cha cấp 1';

-- Dumping data for table duanyody.categorys: ~0 rows (approximately)
INSERT INTO `categorys` (`categoryId`, `name`, `past`, `image`) VALUES
	(1, 'SALE', 'sale', NULL),
	(2, 'Mới về', 'new', NULL),
	(3, 'Nam', 'Nam', 'https://m.yodycdn.com/fit-in/filters:format(webp)/products/media/categories/menu_man.webp'),
	(4, 'Nữ', 'Nu', 'https://m.yodycdn.com/fit-in/filters:format(webp)/products/media/categories/menu_woman.webp'),
	(5, 'Trẻ em', 'child', 'https://m.yodycdn.com/fit-in/filters:format(webp)/products/media/categories/2023-06-12-08-48-19_a5b00606-d7c0-4ba0-9611-33867680f45b.jpg'),
	(6, 'Bộ sưu tập', 'Abum', NULL);

-- Dumping structure for table duanyody.childcategorys
CREATE TABLE IF NOT EXISTS `childcategorys` (
  `childId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `past` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `categoryId` int DEFAULT NULL,
  PRIMARY KEY (`childId`),
  KEY `FK__categorys` (`categoryId`),
  CONSTRAINT `FK__categorys` FOREIGN KEY (`categoryId`) REFERENCES `categorys` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bảng danh mục con cấp 2';

-- Dumping data for table duanyody.childcategorys: ~0 rows (approximately)
INSERT INTO `childcategorys` (`childId`, `name`, `past`, `categoryId`) VALUES
	(1, 'Áo nam', NULL, 3),
	(2, 'Quần nam', NULL, 3),
	(4, 'Đồ mặc trong nam', NULL, 3),
	(5, 'Đồ thể thao nam', NULL, 3),
	(6, 'Phụ kiện nam', NULL, 3),
	(7, 'Áo nữ', 'Example', 4),
	(8, 'Quần nữ', 'Example', 4),
	(10, 'Đồ mặc trong nữ', 'Example', 4),
	(11, 'Đồ thể thao nữ', 'Example', 4),
	(13, 'Phụ kiện nữ', 'Example', 4),
	(14, 'Áo trẻ em', 'Example', 5),
	(15, 'Quần trẻ em', 'Example', 5),
	(17, 'Đồ mặc trong trẻ em', 'Example', 5),
	(18, 'Đầm và chân váy bé gái', 'Example', 5),
	(19, 'Phụ kiện trẻ em', 'Example', 5);
    -- Dumping structure for table duanyody.commoncategorys
CREATE TABLE IF NOT EXISTS `commoncategorys` (
  `commonId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `past` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `childId` int DEFAULT NULL,
  PRIMARY KEY (`commonId`),
  KEY `FK_commoncategorys_childcategorys` (`childId`),
  CONSTRAINT `FK_commoncategorys_childcategorys` FOREIGN KEY (`childId`) REFERENCES `childcategorys` (`childId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bảng danh mục cáp 3';

-- Dumping data for table duanyody.commoncategorys: ~0 rows (approximately)
INSERT INTO `commoncategorys` (`commonId`, `name`, `past`, `childId`) VALUES
	(1, 'Áo polo nam', 'Example', 1),
	(2, 'Áo sơ mi nam', 'Example', 1),
	(3, 'Áo thun nam', 'Example', 1),
	(4, 'Áo len nam', 'Example', 1),
	(5, 'Áo Hoodie - Áo nỉ nam', 'Example', 1),
	(6, 'Áo chống nắng nam', 'Example', 1),
	(7, 'Áo gió nam', 'Example', 1),
	(8, 'Áo phao nam', 'Example', 1),
	(9, 'Áo vest nam', 'Example', 1),
	(10, 'Quần dài nam', 'Example', 2),
	(11, 'Quần nỉ nam', 'Example', 2),
	(12, 'Quần kaki nam', 'Example', 2),
	(13, 'Quần short nam', 'Example', 2),
	(14, 'Quần jeans nam', 'Example', 2),
	(15, 'Quần âu nam', 'Example', 2),
	(18, 'Quần lót nam', 'Example', 4),
	(19, 'Áo ba lỗ nam', 'Example', 4),
	(20, 'Áo giữ nhiệt nam', 'Example', 4),
	(21, 'Quần thể thao nam', 'Example', 5),
	(22, 'Áo polo thể thao nam', 'Example', 5),
	(23, 'Áo thun thể thao nam', 'Example', 5),
	(24, 'Bộ thể thao nam', 'Example', 5),
	(25, 'Tất nam', 'Example', 6),
	(26, 'Phụ kiện khác nam', 'Example', 6),
	(27, 'Túi xách nam', 'Example', 6),
	(28, 'Ví nam', 'Example', 6),
	(29, 'Mũ nam', 'Example', 6),
	(30, 'Thắt lưng nam', 'Example', 6),
	(31, 'Giày nam', 'Example', 6),
	(32, 'Áo Vest nữ', 'Example', 7),
	(33, 'Áo khoác nữ', 'Example', 7),
	(34, 'Áo măng tô nữ', 'Example', 7),
	(35, 'Áo phao nữ', 'Example', 7),
	(36, 'Áo gió nữ', 'Example', 7),
	(37, 'Áo chống nắng nữ', 'Example', 7),
	(38, 'Áo hoodie - Áo nỉ nữ', 'Example', 7),
	(39, 'Áo len nữ', 'Example', 7),
	(40, 'Áo polo nữ', 'Example', 7),
	(41, 'Áo sơ mi nữ', 'Example', 7),
	(42, 'Áo thun nữ', 'Example', 7),
	(43, 'Quần dài nữ', 'Example', 8),
	(44, 'Quần nỉ nữ', 'Example', 8),
	(45, 'Quần kaki nữ', 'Example', 8),
	(46, 'Quần short nữ', 'Example', 8),
	(47, 'Quần jeans nữ', 'Example', 8),
	(48, 'Quần âu nữ', 'Example', 8),
	(51, 'Áo Bra nữ', 'Example', 10),
	(52, 'Quần lót nữ', 'Example', 10),
	(53, 'Áo ba lỗ - Áo hai dây nữ', 'Example', 10),
	(54, 'Áo giữ nhiệt nữ', 'Example', 10),
	(55, 'Quần thể thao nữ', 'Example', 11),
	(56, 'Áo polo thể thao nữ', 'Example', 11),
	(57, 'Áo thun thể thao nữ', 'Example', 11),
	(58, 'Bộ thể thao nữ', 'Example', 11),
	(61, 'Tất nữ', 'Example', 13),
	(62, 'Phụ kiện khác nữ', 'Example', 13),
	(63, 'Túi xách nữ', 'Example', 13),
	(64, 'Mũ nữ', 'Example', 13),
	(65, 'Thắt lưng nữ', 'Example', 13),
	(66, 'Giày nữ', 'Example', 13),
	(67, 'Áo khoác trẻ em', 'Example', 14),
	(68, 'Áo phao trẻ em', 'Example', 14),
	(69, 'Áo gió trẻ em', 'Example', 14),
	(70, 'Áo chống nắng trẻ em', 'Example', 14),
	(71, 'Áo hoodie - áo nỉ trẻ em', 'Example', 14),
	(72, 'Áo len trẻ em', 'Example', 14),
	(73, 'Áo thun trẻ em', 'Example', 14),
	(74, 'Áo polo trẻ em', 'Example', 14),
	(75, 'Áo sơ mi trẻ em', 'Example', 14),
	(76, 'Quần dài trẻ em', 'Example', 15),
	(77, 'Quần kaki trẻ em', 'Example', 15),
	(78, 'Quần nỉ trẻ em', 'Example', 15),
	(79, 'Quần short trẻ em', 'Example', 15),
	(80, 'Quần jeans trẻ em', 'Example', 15),
	(83, 'Áo ba lỗ trẻ em', 'Example', 17),
	(84, 'Quần lót trẻ em', 'Example', 17),
	(85, 'Áo giữ nhiệt trẻ em', 'Example', 17),
	(86, 'Đầm bé gái', 'Example', 18),
	(87, 'Chân váy bé gái', 'Example', 18),
	(88, 'Mũ trẻ em', 'Example', 19),
	(89, 'Phụ kiện trẻ em khác', 'Example', 19),
	(90, 'Tất trẻ em', 'Example', 19),
	(91, 'Giày dép trẻ em', 'Example', 19);

CREATE TABLE IF NOT EXISTS `slides` (
  `sildeId` int NOT NULL AUTO_INCREMENT,
  `url` varchar(555) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `title` varchar(555) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `past` varchar(555) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  PRIMARY KEY (`sildeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bangr chuaws cacs banner slide';

-- Dumping data for table duanyody.slides: ~0 rows (approximately)

-- Dumping structure for table duanyody.users
CREATE TABLE IF NOT EXISTS `users` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `password` varchar(500) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `avata` varchar(500) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `active` int DEFAULT NULL,
  `createAt` datetime DEFAULT NULL,
  `role` int DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bảng người dùng';


CREATE TABLE IF NOT EXISTS `products` (
  `productId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `productCode` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `createAt` datetime DEFAULT NULL,
  `categoryId` int DEFAULT NULL,
  `childId` int DEFAULT NULL,
  PRIMARY KEY (`productId`),
  KEY `FK_products_categorys` (`categoryId`),
  KEY `FK_products_childcategorys` (`childId`),
  CONSTRAINT `FK_products_categorys` FOREIGN KEY (`categoryId`) REFERENCES `categorys` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_products_childcategorys` FOREIGN KEY (`childId`) REFERENCES `childcategorys` (`childId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bangr chuaws sanr pham';

-- Dumping data for table duanyody.products: ~0 rows (approximately)
INSERT INTO `products` (`productId`, `name`, `productCode`, `createAt`, `categoryId`, `childId`) VALUES
	(1, 'Áo thun nam', 'P001', '2024-11-11 00:00:00', 3, 1),
	(2, 'Quần kaki nam', 'P002', '2024-11-11 00:00:00', 3, 2),
	(3, 'Áo khoác nữ', 'P003', '2024-11-10 00:00:00', 4, 7),
	(4, 'Quần jeans trẻ em', 'P004', '2024-11-09 00:00:00', 5, 5),
	(5, 'Áo len trẻ em', 'P005', '2024-11-08 00:00:00', 5, 5);


CREATE TABLE IF NOT EXISTS `variations` (
  `variationId` int NOT NULL AUTO_INCREMENT,
  `variationCode` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `image` varchar(5055) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `color` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `anhColor` varchar(555) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT '0',
  `price` decimal(10,0) DEFAULT NULL,
  `sale` decimal(10,0) DEFAULT NULL,
  `descripe` text COLLATE utf8mb4_vietnamese_ci,
  `productId` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`variationId`),
  KEY `FK__products` (`productId`),
  CONSTRAINT `FK__products` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bangr chuaws cac bien the san pham';

-- Dumping data for table duanyody.variations: ~5 rows (approximately)
INSERT INTO `variations` (`variationId`, `variationCode`, `image`, `color`, `anhColor`, `price`, `sale`, `descripe`, `productId`) VALUES
	(1, 'V001', 'https://m.yodycdn.com/fit-in/filters:format(webp)/100/438/408/products/ao-so-mi-nam-smm6017-hog-10-yody.jpg?v=1681180688647', 'Trắng', '0', 150000, NULL, 'Áo thun cotton cao cấp', 1),
	(2, 'V002', 'https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-thun-nu-TSN7301-DEN%20(10).JPG', 'Xám', '0', 300000, 10, 'Quần kaki nam thoải mái', 2),
	(3, 'V003', 'https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-thun-yoguu-sticker-gut7010-xah-cvn6224-xag-14.jpg', 'Đen', '0', 450000, 20, 'Áo khoác nữ ấm áp', 2),
	(4, 'V004', 'https://m.yodycdn.com/fit-in/filters:format(webp)/products/chan-vay-tre-em-cvk7016-hog-2.jpg', 'Xanh', '0', 250000, NULL, 'Quần jeans trẻ em cá tính', 4),
	(5, 'V005', 'https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-thu-dong-tre-em-ATK7035-TRA%20(10).JPG', 'Đỏ', '0', 200000, NULL, 'Áo len trẻ em dễ thương', 5);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;






-- Dumping structure for table duanyody.sizevariations
CREATE TABLE IF NOT EXISTS `sizevariations` (
  `sizeId` int NOT NULL AUTO_INCREMENT,
  `sizeCode` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `size` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `variationId` int DEFAULT NULL,
  PRIMARY KEY (`sizeId`),
  KEY `FK_sizevariations_variations` (`variationId`),
  CONSTRAINT `FK_sizevariations_variations` FOREIGN KEY (`variationId`) REFERENCES `variations` (`variationId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bangr chuas size va so luong moi buien the';

-- Dumping data for table duanyody.sizevariations: ~0 rows (approximately)
INSERT INTO `sizevariations` (`sizeId`, `sizeCode`, `size`, `quantity`, `variationId`) VALUES
	(1, 'S001', 'S', 50, 1),
	(2, 'S002', 'M', 40, 1),
	(3, 'L', 'L', 30, 2),
	(4, 'M', 'M', 20, 2),
	(5, 'S005', 'L', 25, 4),
	(6, 'XL', 'XL', 15, 2);






CREATE TABLE IF NOT EXISTS `variationimages` (
  `variationimageId` int NOT NULL AUTO_INCREMENT,
  `image` varchar(555) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `variationId` int DEFAULT NULL,
  PRIMARY KEY (`variationimageId`),
  KEY `FK_variationimages_variations` (`variationId`),
  CONSTRAINT `FK_variationimages_variations` FOREIGN KEY (`variationId`) REFERENCES `variations` (`variationId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bang chua cac anh bien the san pham';

-- Dumping data for table duanyody.variationimages: ~0 rows (approximately)
INSERT INTO `variationimages` (`variationimageId`, `image`, `variationId`) VALUES
	(1, 'img/ao-thun-nam-s.jpg', 1),
	(2, 'https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-thun-nu-TSN7301-DEN%20(12).JPG', 2),
	(3, 'https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-thun-nu-TSN7301-DEN%20(16).JPG', 2),
	(4, 'https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-thun-nu-TSN7301-DEN%20(11).JPG', 2),
	(5, 'https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-thun-nu-TSN7301-DEN%20(14).JPG', 2),
	(6, 'img/quan-jeans-tre-em-xanh.jpg', 4),
	(7, 'img/ao-len-tre-em-do.jpg', 5);

-- Dumping structure for table duanyody.variations

CREATE TABLE IF NOT EXISTS `carts` (
  `cartId` int NOT NULL,
  `userId` int DEFAULT NULL,
  `createAt` datetime DEFAULT NULL,
  PRIMARY KEY (`cartId`),
  KEY `FK__users` (`userId`),
  CONSTRAINT `FK__users` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bangr gior hangf mooix nguoiwf sex co mot gio hang';

-- Dumping data for table duanyody.carts: ~0 rows (approximately)










-- Dumping structure for table duanyody.cartitems
CREATE TABLE IF NOT EXISTS `cartitems` (
  `cartitemId` int NOT NULL AUTO_INCREMENT,
  `cartId` int DEFAULT NULL,
  `variationId` int DEFAULT NULL,
  `sizeId` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`cartitemId`),
  KEY `FK__carts` (`cartId`),
  KEY `FK_cartitems_variatinos` (`variationId`),
  KEY `FK_cartitems_sizevariations` (`sizeId`),
  CONSTRAINT `FK__carts` FOREIGN KEY (`cartId`) REFERENCES `carts` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cartitems_sizevariations` FOREIGN KEY (`sizeId`) REFERENCES `sizevariations` (`sizeId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_cartitems_variatinos` FOREIGN KEY (`variationId`) REFERENCES `variations` (`variationId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bang chi tiet san pham trong gio hang';

CREATE TABLE IF NOT EXISTS `orderstatus` (
  `statusId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_vietnamese_ci,
  PRIMARY KEY (`statusId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='luu cac trang thai don hang';



CREATE TABLE IF NOT EXISTS `orders` (
  `orderId` int NOT NULL AUTO_INCREMENT,
  `statusId` int DEFAULT NULL,
  `userId` int DEFAULT NULL,
  `sumPrice` decimal(10,0) DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `paySelect` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL COMMENT 'phuong thucws thanh toan',
  `updateAt` datetime DEFAULT NULL,
  `createAt` datetime DEFAULT NULL,
  PRIMARY KEY (`orderId`),
  KEY `FK_orders_orderstatus` (`statusId`),
  KEY `FK_orders_users` (`userId`),
  CONSTRAINT `FK_orders_orderstatus` FOREIGN KEY (`statusId`) REFERENCES `orderstatus` (`statusId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_orders_users` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bangr hoa don cua tung san pham khi mua';



CREATE TABLE IF NOT EXISTS `orderitems` (
  `orderitemId` int NOT NULL AUTO_INCREMENT,
  `orderId` int DEFAULT NULL,
  `variationId` int DEFAULT NULL,
  `sizeId` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`orderitemId`),
  KEY `FK__orders` (`orderId`),
  KEY `FK__sizevariations` (`sizeId`),
  KEY `FK_orderitems_variatinos` (`variationId`),
  CONSTRAINT `FK__orders` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__sizevariations` FOREIGN KEY (`sizeId`) REFERENCES `sizevariations` (`sizeId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_orderitems_variatinos` FOREIGN KEY (`variationId`) REFERENCES `variations` (`variationId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bang chua cac don hang chi tiet';

-- Dumping data for table duanyody.orderitems: ~0 rows (approximately)

CREATE TABLE IF NOT EXISTS `productrivews` (
  `reviewsId` int NOT NULL AUTO_INCREMENT,
  `productId` int DEFAULT NULL,
  `userId` int DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `reviewText` text COLLATE utf8mb4_vietnamese_ci,
  `createAt` datetime DEFAULT NULL,
  PRIMARY KEY (`reviewsId`),
  KEY `FK_productrivews_products` (`productId`),
  KEY `FK_productrivews_users` (`userId`),
  CONSTRAINT `FK_productrivews_products` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_productrivews_users` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bang danh gia sao khi mua san pham';



















-- Dumping structure for table duanyody.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `commentId` int NOT NULL AUTO_INCREMENT,
  `productId` int DEFAULT NULL,
  `userId` int DEFAULT NULL,
  `content` text COLLATE utf8mb4_vietnamese_ci,
  `image` varchar(500) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `createAt` datetime DEFAULT NULL,
  PRIMARY KEY (`commentId`),
  KEY `FK_comments_products` (`productId`),
  KEY `FK_comments_users` (`userId`),
  CONSTRAINT `FK_comments_products` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_comments_users` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bang chua cac comment nguoi dung ve san pham';


CREATE TABLE IF NOT EXISTS `replies` (
  `repliesId` int NOT NULL AUTO_INCREMENT,
  `commentId` int DEFAULT NULL,
  `userId` int DEFAULT NULL,
  `content` text COLLATE utf8mb4_vietnamese_ci,
  `image` varchar(555) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `createAt` datetime DEFAULT NULL,
  PRIMARY KEY (`repliesId`),
  KEY `FK_replies_comments` (`commentId`),
  KEY `FK_replies_users` (`userId`),
  CONSTRAINT `FK_replies_comments` FOREIGN KEY (`commentId`) REFERENCES `comments` (`commentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_replies_users` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bang tra loi cac comment';

-- Dumping data for table duanyody.replies: ~0 rows (approximately)


-- Dumping structure for table duanyody.slides

-- Dumping data for table duanyody.users: ~0 rows (approximately)

-- Dumping structure for table duanyody.variationimages

