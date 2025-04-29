CREATE TABLE `product` (
`productId` INT  PRIMARY KEY NOT NULL AUTO_INCREMENT,
`productName` VARCHAR(100)  UNIQUE NOT NULL,
`price` INT  NOT NULL CHECK (`price` >= 1),
`stockQuantity` INT  NOT NULL CHECK (`stockQuantity` >= 0),
`productType` ENUM('physical', 'digital', 'service')  NOT NULL,
`status` ENUM('active', 'inactive')  NOT NULL,
`categoryId` INT  NOT NULL,
`productImage` VARCHAR(255)  NULL,
`productCreatedAt` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,
`productUpdatedAt` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`productIdentify` VARCHAR(50)  NOT NULL,
FOREIGN KEY (`categoryId`) REFERENCES `categories`(`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;