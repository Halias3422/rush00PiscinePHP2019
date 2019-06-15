CREATE DATABASE IF NOT EXISTS `rush`;
USE `rush`;

CREATE TABLE IF NOT EXISTS `user` (
    `user_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `login` VARCHAR(80) NOT NULL,
    `password` VARCHAR(32) NOT NULL,
    `modo` ENUM('Y', 'N')
);

CREATE TABLE IF NOT EXISTS `basket` (
    `product_name` VARCHAR(80) NOT NULL,
    `price` INT,
    `amount` INT NOT NULL,
    `user_id` INT NOT NULL,
    `user_tmp_id` INT NOT NULL
);

CREATE TABLE IF NOT EXISTS `products` (
    `product_id` INT NOT NULL  PRIMARY KEY AUTO_INCREMENT,
    `product_name` VARCHAR(80) NOT NULL,
    `path` VARCHAR(100) NOT NULL,
    `price` INT NOT NULL,
    `left` INT,
    `category` VARCHAR(80)
);

INSERT INTO `user`(`login`, `password`, `modo`) VALUE (
    "admin", MD5("admin"), 'Y'
);
