CREATE DATABASE IF NOT EXISTS rush;
USE rush;

CREATE TABLE IF NOT EXISTS `user` (
    `user_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `login` VARCHAR(80) NOT NULL,
    `password` VARCHAR(80) NOT NULL
);

CREATE TABLE IF NOT EXISTS `basket` (
    `product_id` INT NOT NULL,
    `price` INT,
    `amount` INT NOT NULL,
    `user_id` INT NOT NULL,
    `user_tmp_id` INT NOT NULL
);

CREATE TABLE IF NOT EXISTS `products` (
    `product_id` INT NOT NULL  PRIMARY KEY AUTO_INCREMENT,
    `price` INT NOT NULL,
    `left` INT,
    `category` VARCHAR(80)
);

INSERT INTO `user`(`login`, `password`) VALUE (
    "admin", "admin"
);