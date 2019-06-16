
<?php
session_start();
$_SESSION['pageStore'] = "index.php";
var_dump($_POST);
require_once ("../function/mysqli_function.php");
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Camagru</title>


</head>

<body>
<header style="background-color: grey;">

<div>
	<h1><a href="#">Camagru</a></h1>

	<ul>
		<li><a href="../loginSystem/login.php">Login</a></li>
		<li><a href="../userSession/panier.php">Panier</a></li>
	</ul>

</div>
<div>
</header>
<form method="post" enctype="multipart/form-data" action="./index_admin.php">
	<input type='submit' name='create_product' value='Register Product'/>
	<input type='submit' name='delete_product' value='Delete Product'/>
	<input type='submit' name='modify_product' value='Modify Product'/>
	<input type='submit' name='create_user' value='Create User'/>
	<input type='submit' name='delete_user' value='Delete User'/>
	<input type='submit' name='modify_user' value='Modify User'/>
	<input type='submit' name='add_category' value='Add Category'/>
	<input type='submit' name='delete_category' value='Delete Category'/>
</form>
<?php
if (isset($_POST) && isset($_POST['create_product']))
	header("Location: ./index_admin.php?page=create_product");
if (isset($_POST) && isset($_POST['delete_product']))
	header("Location: ./index_admin.php?page=delete_product");
if (isset($_POST) && isset($_POST['modify_product']))
	header("Location: ./index_admin.php?page=modify_product");

if (isset($_GET) && isset($_GET['page']) && ($_GET['page'] == "create_product" || $_GET['page'] == "delete_product" || $_GET['page'] == "modify_product"))
{
	if ($_GET['page'] == "create_product")
		echo "<h1> Register Product </h1>";
	else if ($_GET['page'] == "modify_product")
		echo "<h1> Modify Product </h1>";
	if ($_GET['page'] == "create_product" || $_GET['page'] == "modify_product")
	{
?>
<form method="post" enctype="multipart/form-data" action="./index_admin.php?page=create_product">
	<label for="name_product">Name Product</label><br>
	<input type="text" name="name_product" required> <br><br>
	<label for="photo">Picture (use link)</label><br>
	<input type="text" name="photo" required><br><br>
	<label for="company">Company</label><br>
	<select name="company">
		<option value="choose">Choose</option>
		<option value="kinder">Kinder</option>
		<option value="ferero">Ferero</option>
		<option value="milka">Milka</option>
		<option value="cote dor">Cote D'Or</option>
	</select><br/><br/>
	<label for="price">Price</label><br>
	<input type="number" name="price" required><br><br>
	<label for="stock">Stock</label><br>
	<input type="number" name="stock" required><br><br>
<?php
	}
	else if ($_GET['page'] == "delete_product")
	{
?>
		<h1> Delete Product </h1>
		<form method="post" action="./index_admin.php?page=delete_product">
		<label for="name_product">Name Product</label><br>
		<input type="text" name="name_product" required> <br><br>
		<input type="submit" name="action_del" value="Delete Product"><br>
<?PHP
	}
}
if (isset($_POST['action']) && isset($_GET['page']) && $_GET['page'] == "create_product")
{
?>
	<input type="submit" name="action" value="Register Product">
	</form>
<?php
	create_product();
}
else if (isset($_POST['action']) && isset($_GET['page']) && $_GET['page'] == "modify_product")
{
?>
	<input type="submit" name="action_modif" value="Modify Product">
	</form>
<?php
	//	modify_product();
	$mysqli = mysqli_open();
	$query = "SELECT `product_name` FROM `products` WHERE `product_name` = ? ";
	$product = $_POST['name_product'];
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
		die("Error1 : " . mysqli_error($mysqli));
	if (mysqli_stmt_bind_param($stmt, "s", $product) === FALSE)
		die("Error2 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_execute($stmt) === FALSE)
		die("Error3 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_bind_result($stmt, $sql_modif_product) === FALSE)
		die("Error4 : " . mysqli_stmt_error($stmt));
	if (!mysqli_stmt_fetch($stmt))
		echo "<br/>This product is not registered in the batabase";
	else
	{
		mysqli_shutdown($stmt, $mysqli);
		if ($product == $sql_modif_product)
		{
			$path = $_POST['photo'];
			$price = $_POST['price'];
			$left = $_POST['stock'];
			$category = $_POST['company'];
			$mysqli = mysqli_open();
			$query = "UPDATE `products` SET (`path`, `price`, `left`, `category`) WHERE `product_name` = ? ";
			if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
				die("Error1 : " . mysqli_error($mysqli));
			if (mysqli_stmt_bind_param($stmt, "sdds", $path, $price, $left, $category) === FALSE)
				die("Error2 : " . mysqli_stmt_error($stmt));
			if (mysqli_stmt_execute($stmt) === FALSE)
				die("Error3 : " . mysqli_stmt_error($stmt));
				die("Error4 : " . mysqli_stmt_error($stmt));
				echo "<br/> Product informations successfully updated";
		}
	}
}
else if (isset($_POST['action_del']) && isset($_GET['page']) && $_GET['page'] == "delete_product")
	delete_product();
?>

</html>
