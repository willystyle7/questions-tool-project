--
-- Database: `c527willys`
--
CREATE DATABASE IF NOT EXISTS `c527willys` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `c527willys`;

--
-- Table structure for table `users`
--
CREATE TABLE `users` (
	`user_id` INT(11) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(50) NOT NULL,
	`password` VARCHAR(32) NOT NULL,
	`email` VARCHAR(100) NOT NULL,
	`full_name` VARCHAR(100) NULL DEFAULT NULL,
	`date_registered` INT(11) NOT NULL,
	`type` TINYINT(4) NOT NULL DEFAULT '1',
	`active` TINYINT(4) NOT NULL DEFAULT '1',
	PRIMARY KEY (`user_id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;

--
-- Table structure for table `questions`
--
CREATE TABLE `questions` (
	`question_id` INT(11) NOT NULL AUTO_INCREMENT,
	`asked_by` INT(11) NOT NULL,
	`title` VARCHAR(250) NOT NULL,
	`question` TEXT NOT NULL,
	`date_asked` INT(11) NOT NULL,
	`answered` TINYINT(4) NOT NULL DEFAULT '0',
	PRIMARY KEY (`question_id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;


--
-- Table structure for table `answers`
--
CREATE TABLE `answers` (
	`answer_id` INT(11) NOT NULL AUTO_INCREMENT,
	`answered_by` INT(11) NOT NULL,
	`answer` TEXT NOT NULL,
	`date_asnswered` INT(11) NOT NULL,
	`approved` TINYINT(4) NOT NULL DEFAULT '0',
	PRIMARY KEY (`answer_id`)
) COLLATE='utf8_general_ci' ENGINE=InnoDB;