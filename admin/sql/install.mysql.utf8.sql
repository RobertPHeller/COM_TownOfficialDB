DROP TABLE IF EXISTS `#__townoffical`;

CREATE TABLE `#__townoffical` (
    `id`       INT(11)     NOT NULL AUTO_INCREMENT,
    `asset_id` INT(10)     NOT NULL DEFAULT '0',
    `created`  DATETIME    NOT NULL DEFAULT '0000-00-00 00:00:00',
    `created_by`  INT(10) UNSIGNED NOT NULL DEFAULT '0',
    `modified`  DATETIME    NOT NULL DEFAULT '0000-00-00 00:00:00',
    `modified_by`  INT(10) UNSIGNED NOT NULL DEFAULT '0',
    `checked_out` INT(10) NOT NULL DEFAULT '0',
    `checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
    `auxoffice` VARCHAR(25),
    `name`     VARCHAR(400) NOT NULL,
    `termends` DATE NOT NULL DEFAULT '1969-01-01',
    `swornindate` DATE NOT NULL DEFAULT '1969-01-01',
    `ethicsexpires` DATE NOT NULL DEFAULT '1969-01-01',
    `iselected` tinyint(4) NOT NULL DEFAULT '0',
    `email`     VARCHAR(100),
    `telephone` VARCHAR(15),
    `notes`     TEXT,
    `published` tinyint(4) NOT NULL DEFAULT '0',
    `catid` int(11) NOT NULL DEFAULT '0',
    `params`   VARCHAR(1024) NOT NULL DEFAULT '',
    PRIMARY KEY (`id`)
)
    ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;
    


