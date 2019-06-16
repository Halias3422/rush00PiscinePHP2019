<?php
$mysqli = mysqli_connect('10.3.6.2', 'root', 'rootpass');
if (!$mysqli){
	die("Connection failed: ".mysqli_connect_error());
}
mysqli_query($mysqli, "CREATE DATABASE IF NOT EXISTS rush");
mysqli_close($mysqli);
$mysqli = mysqli_connect('10.3.6.2', 'root', 'rootpass', 'rush');



mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS user (user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, modo ENUM('Y', 'N'), first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL)");
mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS basket (product_name VARCHAR(255) NOT NULL, price INT NOT NULL, amount INT NOT NULL, user_id VARCHAR(255), user_tmp_id INT NOT NULL)");
mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS products (product_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, product_name VARCHAR(255) NOT NULL, path VARCHAR(4096) NOT NULL, price INT NOT NULL, `left` INT, category VARCHAR(255))");
mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS command (user_id VARCHAR(255), price INT NOT NULL, date DATETIME NOT NULL)");

	$login = "admin";
	$result = mysqli_query($mysqli, "SELECT * FROM users WHERE login LIKE '$login'");
	$adminpasswd = hash('whirlpool', "admin");
	mysqli_query($mysqli, "INSERT INTO user (login, password, modo, first_name, last_name, email) VALUES ('$login', '$adminpasswd', 'Y', 'admin', 'admin', 'admin@admin.admin')");


	$result = mysqli_query($mysqli, "SELECT * FROM products");
	mysqli_query($mysqli, "INSERT INTO products (product_name, price, `left`, category, path) VALUES ('kinder counter', '5', '180', 'kinder', 'https://image.noelshack.com/fichiers/2018/49/7/1544370009-kinder-country.jpg')");
	mysqli_query($mysqli, "INSERT INTO products (product_name, price, `left`, category, path) VALUES ('ferrero rocher', '89', '5200', 'ferero', 'https://images-na.ssl-images-amazon.com/images/I/81YJg8aofjL._SX679_.jpg')");
	mysqli_query($mysqli, "INSERT INTO products (product_name, price, `left`, category, path) VALUES ('nutella', '1', '1', 'ferero', 'https://www.nutella.com/image/journal/article?img_id=7310145&t=1438596312284')");
	mysqli_close($mysqli);
?>
