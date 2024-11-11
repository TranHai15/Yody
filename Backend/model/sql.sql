
CREATE DATABASE IF NOT EXISTS `duanyody`
USE `duanyody`;


CREATE TABLE IF NOT EXISTS `categorys` (
  `categoryd` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `past` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_vietnamese_ci,
  PRIMARY KEY (`categoryd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bảng chứa các danh mục cha cấp 1';


CREATE TABLE IF NOT EXISTS `childcategorys` (
  `childId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `past` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `categoryId` int DEFAULT NULL,
  PRIMARY KEY (`childId`),
  KEY `FK__categorys` (`categoryId`),
  CONSTRAINT `FK__categorys` FOREIGN KEY (`categoryId`) REFERENCES `categorys` (`categoryd`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bảng danh mục con cấp 2';


CREATE TABLE IF NOT EXISTS `commoncategorys` (
  `commonId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `past` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `childId` int DEFAULT NULL,
  PRIMARY KEY (`commonId`),
  KEY `FK_commoncategorys_childcategorys` (`childId`),
  CONSTRAINT `FK_commoncategorys_childcategorys` FOREIGN KEY (`childId`) REFERENCES `childcategorys` (`childId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bảng danh mục cáp 3';


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


CREATE TABLE IF NOT EXISTS `slides` (
  `sildeId` int NOT NULL AUTO_INCREMENT,
  `url` varchar(555) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `title` varchar(555) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `past` varchar(555) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  PRIMARY KEY (`sildeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='Bangr chuaws cacs banner slide';


CREATE TABLE IF NOT EXISTS `products` (
  `productId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `productCode` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `createAt` datetime DEFAULT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bangr chuaws sanr pham';


CREATE TABLE IF NOT EXISTS `variatinos` (
  `variationId` int NOT NULL AUTO_INCREMENT,
  `variationCode` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `color` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `descripe` text COLLATE utf8mb4_vietnamese_ci,
  `productId` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`variationId`),
  KEY `FK__products` (`productId`),
  CONSTRAINT `FK__products` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bangr chuaws cac bien the san pham';


CREATE TABLE IF NOT EXISTS `sizevariations` (
  `sizeId` int NOT NULL AUTO_INCREMENT,
  `sizeCode` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `size` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `variationId` int DEFAULT NULL,
  PRIMARY KEY (`sizeId`),
  KEY `FK__variatinos` (`variationId`),
  CONSTRAINT `FK__variatinos` FOREIGN KEY (`variationId`) REFERENCES `variatinos` (`variationId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bangr chuas size va so luong moi buien the';


CREATE TABLE IF NOT EXISTS `variationimages` (
  `variationimageId` int NOT NULL AUTO_INCREMENT,
  `image` varchar(555) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `variationId` int DEFAULT NULL,
  PRIMARY KEY (`variationimageId`),
  KEY `FK_variationimages_variatinos` (`variationId`),
  CONSTRAINT `FK_variationimages_variatinos` FOREIGN KEY (`variationId`) REFERENCES `variatinos` (`variationId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bang chua cac anh bien the san pham';


CREATE TABLE IF NOT EXISTS `carts` (
  `cartId` int NOT NULL,
  `userId` int DEFAULT NULL,
  `createAt` datetime DEFAULT NULL,
  PRIMARY KEY (`cartId`),
  KEY `FK__users` (`userId`),
  CONSTRAINT `FK__users` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bangr gior hangf mooix nguoiwf sex co mot gio hang';


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
  CONSTRAINT `FK_cartitems_variatinos` FOREIGN KEY (`variationId`) REFERENCES `variatinos` (`variationId`) ON DELETE CASCADE ON UPDATE CASCADE
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
  CONSTRAINT `FK_orderitems_variatinos` FOREIGN KEY (`variationId`) REFERENCES `variatinos` (`variationId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci COMMENT='bang chua cac don hang chi tiet';


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
