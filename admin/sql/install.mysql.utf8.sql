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
    
INSERT INTO `#__townoffical` (`name`, `termends`, `swornindate`, 
                                `ethicsexpires`, `iselected`, `email`, 
                                `telephone`, `notes`, `published` ) VALUES
('Anna Seeger',      '2022-05-05', '2019-06-07', '2021-01-01', 1, '', '978-544-6751', '', 1),
('Chris Wings',      '2023-05-05', '2017-05-03', '2022-11-01', 1, 'horsecwings@gmail.com', '', '', 1),
('Martha Senn',      '2024-05-01', '1960-01-05', '1960-01-05', 1, '', '', '', 1),
('Barbara Craddock', '2024-05-01', '2019-18-05', '2023-01-01', 1, 'craddock416@hughes.net', '978-544-8710', '', 1),
('Shay Cooper',      '2022-05-01', '2020-10-02', '2022-06-01', 1, '', '', '', 1),
('Judith Bailey',    '2023-05-05', '2020-06-14', '2022-06-01', 1, '', '978-544-0029', '', 1);


