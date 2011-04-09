DJSEAMT is using the following MySQL database and tables.

-- --------------------------------------------------------

CREATE DATABASE `djseamt_test` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE `djseamt_test`;

CREATE TABLE IF NOT EXISTS `client_list` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `last_change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `first_contact` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recent_contact` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recent_hostname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `recent_version` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

