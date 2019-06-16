<?php
session_start();
include("./function/mysqli_function.php");
include("./function/mysqli_function2.php");
include("./function/mysqli_function3.php");

if (isset($_POST['action']) && isset($_POST['product'])) {
	if ($_POST['action'] == "deleteProduct") {
		updateProductsLeftNotLog();
		deleteItemBasketNotLog();
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="./menu.css">
		<link rel="stylesheet" href="./userSession/box.css">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Chocolatte</title>
	</head>
	<body>
	<header>
	<h1 class="deco">Chocolatte</h1>
	<nav>
		<ul>
<?php
if (isset($_SESSION['login']))
	echo '<li><a href="./userSession/index.php">Home</li>';
else
	echo '<li><a href="./index.php">Home</li>';
if (isset($_SESSION) && !isset($_SESSION['login']))
{
	echo '<li><a href="./loginSystem/signUp.php">Sign in</a></li>';
	echo '<li><a href="./loginSystem/login.php">Log in</a></li>';
	echo '<li><a href="./panier.php">Basket</a></li>';
}

if (isset($_SESSION))
{
	if (isset($_SESSION['modo']) && $_SESSION['modo'] == 'Y')
		echo '<li><a href="./admin/index_admin.php">Management</a></li>';
	if (isset($_SESSION['login']))
	{
		echo '<li><a href="./userSession/panier.php?user=log">Basket</a></li>';	
		echo '<li><a href="./userSession/settings.php">Setting</a></li>';
		echo '<li><a href="./userSession/logout.php">Log out</a></li>';
	}
}
?>
		</ul>
	</nav>
    </header>
<?php
	$totalPrice = 0;
	$mysqli = mysqli_open();
	$query = "SELECT * FROM `basket` WHERE `user_tmp_id` = ?";
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
		die("Error1 : " . mysqli_error($mysqli));
	}
	if (mysqli_stmt_bind_param($stmt, "s", $_SESSION['notlog']) === false) {
		die("Error2 : " . mysqli_stmt_error($stmt));
	}
	if (mysqli_stmt_execute($stmt) === false) {
		die("Error3 : " . mysqli_stmt_error($stmt));
	}
	if (mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4, $col5) === FALSE) {
		die("Error4 : " . mysqli_stmt_error($stmt));
	}
	/* Récupération des valeurs */
	while (mysqli_stmt_fetch($stmt)) {
		echo '<p>' . $col1 . "   quantity : " . $col3 . "   / price = " . $col2 * $col3 . " $</p>";

		echo '<form method="post" action="./panier.php">';
		echo '<input type="submit" name="action" value="deleteProduct">';
		echo '<input type="hidden" name="product" value="' . $col1 .'">';
		echo '</form>';
		$totalPrice += $col2 * $col3;
	}
	echo '<p> Total Price = ' . $totalPrice . ' $</p>';
	mysqli_shutdown($stmt, $mysqli);
    require_once("./footer.php");   
?>