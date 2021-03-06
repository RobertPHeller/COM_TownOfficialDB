DROP TABLE IF EXISTS `#__townoffical`;

CREATE TABLE `#__townoffical` (
    `id`       INT(11)     NOT NULL AUTO_INCREMENT,
    `office`   VARCHAR(25) NOT NULL,
    `auxoffice` VARCHAR(25),
    `name`     VARCHAR(50) NOT NULL,
    `termends` DATE NOT NULL DEFAULT '1969-01-01',
    `swornindate` DATE NOT NULL DEFAULT '1969-01-01',
    `ethicsexpires` DATE NOT NULL DEFAULT '1969-01-01',
    `iselected` tinyint(4) NOT NULL DEFAULT '0',
    `email`     VARCHAR(25),
    `telephone` VARCHAR(15),
    `notes`     TEXT,
    `published` tinyint(4) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
)
    ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;
    
INSERT INTO `#__townoffical` (`office`, `name`, `termends`, `swornindate`, 
                                `ethicsexpires`, `iselected`, `email`, 
                                `telephone`, `notes`, `published` ) VALUES
('Assessor', 'Anna Seeger',             '2022-05-05', '2019-06-07', '2021-01-01', 1, '', '978-544-6751', '', 1),
('Assessor', 'Chris Wings',             '2023-05-05', '2017-05-03', '2022-11-01', 1, 'horsecwings@gmail.com', '', '', 1),
('Assessor', 'Martha Senn',             '2024-05-01', '1960-01-05', '1960-01-05', 1, '', '', '', 1),
('Board of Health', 'Barbara Craddock', '2024-05-01', '2019-18-05', '2023-01-01', 1, 'craddock416@hughes.net', '978-544-8710', '', 1),
('Board of Health', 'Shay Cooper',      '2022-05-01', '2020-10-02', '2022-06-01', 1, '', '', '', 1),
('Board of Health', 'Judith Bailey',    '2023-05-05', '2020-06-14', '2022-06-01', 1, '', '978-544-0029', '', 1);


