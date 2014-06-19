DROP TABLE IF EXISTS `Test`;
CREATE TABLE `Test` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NULL,
  `isTest` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `testId` int(11) UNSIGNED NULL,
  `testClass` varchar(255) NULL,
  `deletedAt` TIMESTAMP NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Test` (`id`, `name`, `isTest`, `testId`, `testClass`, `deletedAt`)
VALUES
  (1, 'Test', 1, 100, 'Harp\\Transfer\\Init', NULL);
