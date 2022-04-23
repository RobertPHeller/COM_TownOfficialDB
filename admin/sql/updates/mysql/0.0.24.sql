ALTER TABLE `#__townoffical` ADD COLUMN `checked_out` INT(10) NOT NULL DEFAULT '0' AFTER `created_by`;
ALTER TABLE `#__townoffical` ADD COLUMN `checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `checked_out`;
ALTER TABLE `#__townoffical` ADD COLUMN `modified`  DATETIME    NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `created_by`; 
ALTER TABLE `#__townoffical` ADD COLUMN `modified_by`  INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `modified`;
