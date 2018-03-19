CREATE DATABASE IF NOT EXISTS `i@d_tchat` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `i@d_tchat`;

CREATE TABLE `i@d_tchat`.`user` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(10) NOT NULL , `password` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`), UNIQUE `UNIQUE` (`name`)) ENGINE = InnoDB;

CREATE TABLE `i@d_tchat`.`message` ( `id` INT NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL , `content` TEXT NOT NULL , PRIMARY KEY (`id`), INDEX `user_id` (`user_id`)) ENGINE = InnoDB;

ALTER TABLE `message` ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
