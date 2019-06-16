<?php
require_once("./install.php");
session_start();
$_SESSION['pageStore'] = "index.php";
$_SESSION['notlog'] = 2;

include("./function/mysqli_function.php");
include("./function/mysqli_function2.php");
include("./function/mysqli_function3.php");
if (isset($_POST['action']) && $_POST['action'] == "addInBasket") {
	$j = 0;
	$user_tmp = 1;
	$items = 1;
	$validProducts = 0;
	$singleProduct = [];
	$product = count($_POST) - 1;
	foreach ($_POST as $key=>$value) {
		if ($j < 3) {
			if ($value == "0") {
				$validProducts = 1;
			}
			array_push($singleProduct, $value);
			$j++;
		}
		if ($j == 3 && $validProducts == 0 && checkUserBasketNotLog($singleProduct) == TRUE) {
			addInBasketNotLog($singleProduct);
			updateProductAmount($singleProduct);
			$j = 0;
			$items++;
			$singleProduct = [];
		}
		if ($j == 3 && $validProducts == 0 && checkUserBasketNotLog($singleProduct) == FALSE) {
			updateBasketNotLog($singleProduct);
			updateProductAmount($singleProduct);
			$j = 0;
			$items++;
			$singleProduct = [];
		}
		if ($j == 3 && $validProducts == 1) {
			$j = 0;
			$items++;
			$singleProducts = [];
			$validProducts = 0;
		}
	}
}

$product_id = [];
$path = [];
$category = [];
$left = [];
$price = [];
$product_name = [];

$row = 0;
$i = 0;
$cat = 0;

$mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
$query = "SELECT * FROM `products`";
if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
	die("Error1 : " . mysqli_error($mysqli));
}
if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
	die("Error1 : " . mysqli_error($mysqli));
}
if (mysqli_stmt_execute($stmt) === false) {
	die("Error3 : " . mysqli_stmt_error($stmt));
}
if (mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4, $col5, $col6) === FALSE) {
	die("Error4 : " . mysqli_stmt_error($stmt));
}
/* Récupération des valeurs */
while (mysqli_stmt_fetch($stmt)) {
	$row += 1;
	array_push($product_id, $col1);
	array_push($product_name, $col2);
	array_push($price, $col4);
	array_push($left, $col5);
	array_push($category, $col6);
	array_push($path, $col3);
}
mysqli_stmt_close($stmt);

if (mysqli_errno($mysqli)) {
	die("Error4 : " . mysqli_stmt_error($stmt));
}
mysqli_close($mysqli);
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
	<form method="post" action="./index.php">
	<div class="row">
	<?php while($i < $row) { ?>
		<?php if ($category[$i] == "kinder" && $left[$i] > 0) { if ($cat == 0) { ?>
			<?php echo "<h3>&nbsp&nbsp&nbsp". $category[$i] . "</h3>";} $cat = 1; ?>
			<div class="w33">
			<img width="150" height="150" src="<?php echo $path[$i]; ?>">
			<p> <?php echo $price[$i]; ?> $</p>
			<input type="number" min="0"max="<?php echo $left[$i] ?>" name="quantityOf<?php echo $product_id[$i]; ?>" value="0"/>
			<input type="hidden" name="<?php echo $product_id[$i]; ?>" value="<?php echo $product_name[$i]?>">
			<input type="hidden" name="<?php echo "price" . $i; ?>" value="<?php echo $price[$i]; ?>">
		</div>
		<?php } $i++; } $i = 0; $cat = 0;?>
	</div>
	<div class="row">
	<?php while($i < $row) { ?>
		<?php if ($category[$i] == "ferero" && $left[$i] > 0) { if ($cat == 0) { ?>
			<?php echo "<h3>&nbsp&nbsp&nbsp". $category[$i] . "</h3>";} $cat = 1; ?>
			<div class="w33">
			<img width="150" height="150" src="<?php echo $path[$i]; ?>">
			<p> <?php echo $price[$i]; ?> $</p>
			<input type="number" min="0" max="<?php echo $left[$i] ?>" name="quantityOf<?php echo $product_id[$i]; ?>" value="0"/>
			<input type="hidden" name="<?php echo $product_id[$i]; ?>" value="<?php echo $product_name[$i]?>">
			<input type="hidden" name="<?php echo "price" . $i; ?>" value="<?php echo $price[$i]; ?>">
		</div>
		<?php } $i++; } $i = 0; $cat = 0;?>
	</div>
	<div class="row">
	<?php while($i < $row) { ?>
		<?php if ($category[$i] == "milka" && $left[$i] > 0) { if ($cat == 0) { ?>
			<?php echo "<h3>&nbsp&nbsp&nbsp". $category[$i] . "</h3>";} $cat = 1; ?>
			<div class="w33">
			<img width="150" height="150" src="<?php echo $path[$i]; ?>">
			<p> <?php echo $price[$i]; ?> $</p>
			<input type="number" min="0" max="<?php echo $left[$i] ?>" name="quantityOf<?php echo $product_id[$i]; ?>" value="0"/>
			<input type="hidden" name="<?php echo $product_id[$i]; ?>" value="<?php echo $product_name[$i]?>">
			<input type="hidden" name="<?php echo "price" . $i; ?>" value="<?php echo $price[$i]; ?>">
		</div>
		<?php } $i++; } $i = 0; $cat = 0;?>
	</div>
	<?php while($i < $row) { ?>
		<?php if ($category[$i] == "cote d'or" && $left[$i] > 0) { if ($cat == 0) { ?>
			<?php echo "<h3>&nbsp&nbsp&nbsp". $category[$i] . "</h3>";} $cat = 1; ?>
			<div class="w33">
			<img width="150" height="150" src="<?php echo $path[$i]; ?>">
			<p> <?php echo $price[$i]; ?> $</p>
			<input type="number" min="0" max="<?php echo $left[$i] ?>" name="quantityOf<?php echo $product_id[$i]; ?>" value="0"/>
			<input type="hidden" name="<?php echo $product_id[$i]; ?>" value="<?php echo $product_name[$i]?>">
			<input type="hidden" name="<?php echo "price" . $i; ?>" value="<?php echo $price[$i]; ?>">
		</div>
		<?php } $i++; } $i = 0; $cat = 0;?>
	</div>
<div class="row">
<input type="submit" name="action" value="addInBasket">
</div>
<form>

	<input type="submit" value="enregistrement du produit">
</form>
</form>
<?php
require_once("./footer.php");
?>
