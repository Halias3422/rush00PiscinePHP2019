
<?php
session_start();
$_SESSION['pageStore'] = "index.php";
var_dump($_POST);
require_once ("../function/mysqli_function.php");
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
<?php
if (isset($_SESSION))
{
	if (isset($_SESSION['modo']) && $_SESSION['modo'] == 'Y')
	{

?>
		<li><a href="../userSession/settings.php">Setting</a></li>
		<li><a href="../index.php">disconnect</a></li>
<?php
	}
?>
		<li><a href="../index.php">vitrine</li>
		<li><a href="../loginSystem/login.php">Log in</a></li>
		<li><a href="../loginSystem/signUp.php">Sign in</a></li>
		<li><a href="../userSession/panier.php">panier</a></li>
<?php
}
?>
		</ul>
	</nav>
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
if (isset($_POST) && isset($_POST['create_user']))
	header("Location: ./index_admin.php?page=create_user");
if (isset($_POST) && isset($_POST['modify_user']))
	header("Location: ./index_admin.php?page=modify_user");
if (isset($_POST) && isset($_POST['delete_user']))
	header("Location: ./index_admin.php?page=delete_user");

if (isset($_GET) && isset($_GET['page']) && ($_GET['page'] == "create_product" || $_GET['page'] == "delete_product" || $_GET['page'] == "modify_product"))
{
	if ($_GET['page'] == "create_product")
		echo "<h1> Register Product </h1>";
	else if ($_GET['page'] == "modify_product")
		echo "<h1> Modify Product </h1>";
	if ($_GET['page'] == "create_product" || $_GET['page'] == "modify_product")
	{
?>
<form method="post" enctype="multipart/form-data">
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
	if ($_GET['page'] == "create_product")
	{
		echo '<input type="submit" name="action" value="Register Product">';
		echo '</form>';
	}
	else if ($_GET['page'] == "modify_product")
	{
		echo '<input type="submit" name="action_mod" value="Modify Product">';
		echo '</form>';
	}
	if ($_GET['page'] == "create_product" && isset($_POST['action']))
		create_product();
	else if (isset($_POST['action_mod']) && isset($_GET['page']) && $_GET['page'] == "modify_product")
		modify_product();
	else if (isset($_POST['action_del']) && isset($_GET['page']) && $_GET['page'] == "delete_product")
		delete_product();
}
else if (isset($_GET) && isset($_GET['page']) && ($_GET['page'] == "create_user" || $_GET['page'] == "modify_user" || $_GET['page'] == "delete_user"))
{
	if ($_GET['page'] == "create_user")
		echo "<h1> Create User</h1>";
	else if ($_GET['page'] == "modify_user")
		echo "<h1> Modify User </h1>";
	if ($_GET['page'] == "create_user" || $_GET['page'] == "modify_user")
	{
?>
		<form method="POST">
			<label for="titre">Login:</label><br>
			<input type="text" name="login" required> <br><br>
			<label for="titre">First Name</label><br>
			<input type="text" name="first_name" required> <br><br>
			<label for="titre">Last Name</label><br>
			<input type="text" name="last_name" required> <br><br>
			<label for="titre">Email</label><br>
			<input type="email" name="email" required> <br><br>
			<label for="modo">Administrateur</label><br>
			<select name="modo">
				<option value="N">No</option>
				<option value="Y">Yes</option>
			</select><br/><br/>
			<label for="titre">Password</label><br>
			<input type="password" name="passwd" required> <br><br>
			<label for="titre">Confirm Password</label><br>
			<input type="password" name="conf_passwd" required> <br><br>
<?php
		if ($_GET['page'] == "create_user")
		{
			echo '<input type="submit" name="action" value="Create Account" />';
			echo '</form>';
		}
		else if ($_GET['page'] == "modify_user")
		{
			echo '<input type="submit" name="action_mod" value="Modify Account" />';
			echo '</form>';
		}
	}
	else if ($_GET['page'] == "delete_user")
	{
?>
	<h1> Delete User </h1>
	<form method="post">
	<label for="login">Login</label><br>
	<input type="text" name="login" required> <br><br>
	<input type="submit" name="action_del" value="Delete User"><br>
<?php
	}
	if ($_GET['page'] == "create_user" && isset($_POST['action']))
		create_user();
	else if ($_GET['page'] == "modify_user" && isset($_POST['action_mod']))
		modify_user();
	else if ($_GET['page'] == "delete_user" && isset($_POST['action_del']))
		delete_user(1);
}

?>
</body>
</html>
