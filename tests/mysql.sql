DROP TABLE IF EXISTS `Item`;
CREATE TABLE `Item` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `class` varchar(255) NULL,
  `isFrozen` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `transferId` int(11) UNSIGNED NULL,
  `refId` int(11) UNSIGNED NULL,
  `value` int(11) UNSIGNED NULL,
  `quantity` int(3) UNSIGNED NULL,
  `deletedAt` TIMESTAMP NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `Product`;
CREATE TABLE `Product` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NULL,
  `currency` varchar(3) NULL,
  `value` int(11) UNSIGNED NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `Basket`;
CREATE TABLE `Basket` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NULL,
  `isSuccessful` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `completedAt` TIMESTAMP NULL,
  `deletedAt` TIMESTAMP NULL,
  `responseData` TEXT,
  `currency` varchar(3) NULL,
  `value` int(11) UNSIGNED NULL,
  `isFrozen` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Product` (`id`, `name`, `currency`, `value`)
VALUES
  (1, 'Product 1', 'GBP', 10000),
  (2, 'Product 2', 'EUR', 20000);
