<?php
session_start();
include("../function/mysqli_function.php");
include("../function/mysqli_function2.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../menu.css">
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
		<li><a href="./index.php">vitrine</a></li>
		<li><a href="./panier.php?user=log">panier</a></li>
		<li><a href="./settings.php">Setting</a></li>
		<input type="hidden" name="logout" value="">
		<li><a href="./logout.php">disconnect</a></li>
		</ul>
	</nav>
</header>
<?php
if (isset($_POST['action']) && isset($_POST['product'])) {
	if ($_POST['action'] == "deleteProduct") {
		updateProductsLeft();
		deleteItemBasket();
	}
}
if (isset($_POST['action'])) {
	if ($_POST['action'] == "Buy") {
		insertCommande();
		deleteBasket();
	}
}
if (isset($_GET['user']) && $_GET['user'] == "log") {
	$totalPrice = 0;
	$mysqli = mysqli_open();
	$query = "SELECT * FROM `basket` WHERE `user_id` = ?";
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
		die("Error1 : " . mysqli_error($mysqli));
	}
	if (mysqli_stmt_bind_param($stmt, "s", $_SESSION['login']) === false) {
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

		echo '<form method="post" action="./panier.php?user=log">';
		echo '<input type="submit" name="action" value="deleteProduct">';
		echo '<input type="hidden" name="product" value="' . $col1 .'">';
		echo '</form>';
		$totalPrice += $col2 * $col3;
	}
	echo '<p> Total Price = ' . $totalPrice . ' $</p>';
	echo '<form method="post" action="./panier.php?user=log">';
	echo '<input type="submit"  name="action" value="Buy">';
	echo '<input type="hidden" name="totalPrice" value="'. $totalPrice .'">';
	echo '</form>';
	mysqli_shutdown($stmt, $mysqli);
?>

<?php } else {?>

<?php } ?>
</body>
</html>
