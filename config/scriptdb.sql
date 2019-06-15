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
    `path` VARCHAR(300) NOT NULL,
    `price` INT NOT NULL,
    `left` INT,
    `category` VARCHAR(80)
);

INSERT INTO `user`(`login`, `password`, `modo`) VALUE (
    "admin", MD5("admin"), 'Y'
);


////////////////////////////////////////////////////////////////////


INSERT INTO `products`(`product_name`, `price`, `left`, `category`, `path`) VALUES(
"kinder bueno", 2, 15, "kinder", "https://www.kinder.com/fr/s3fs-media/kinder_fr/public/styles/explore_products/public/2019-05/kinder_bueno_white_x2.png");

INSERT INTO `products`(`product_name`, `price`, `left`, `category`, `path`) VALUES(
"kinder country", 5, 180, "kinder", "https://image.noelshack.com/fichiers/2018/49/7/1544370009-kinder-country.jpg");

INSERT INTO `products`(`product_name`, `price`, `left`, `category`, `path`) VALUES ("ferrero rocher", 89, 5200, "ferero", "https://images-na.ssl-images-amazon.com/images/I/81YJg8aofjL._SX679_.jpg");

INSERT INTO `products`(`product_name`, `price`, `left`, `category`, `path`) VALUES ("nutella", 1, 1, "ferero", "https://www.nutella.com/image/journal/article?img_id=7310145&t=1438596312284");
