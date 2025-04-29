CREATE TABLE `services` (
`serviceId` INT  PRIMARY KEY NOT NULL AUTO_INCREMENT,
`title` VARCHAR(100)  UNIQUE NOT NULL,
`category` ENUM('corporate', 'entertainment', 'social', 'technical', 'creative')  NOT NULL,
`description` TEXT  NOT NULL,
`icon` VARCHAR(150)  NULL,
`status` ENUM('active', 'inactive')  NOT NULL,
`serviceCreatedAt` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,
`serviceUpdatedAt` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`serviceIdentify` VARCHAR(50)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;