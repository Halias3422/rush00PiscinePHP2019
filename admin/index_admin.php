
<?php
require_once("../header.php");
$_SESSION['pageStore'] = "index.php";
require_once ("../function/mysqli_function.php");
if (!isset($_SESSION) || !isset($_SESSION['modo']) || $_SESSION['modo'] == "N")
	header("Location: ../index.php");

?>
<form method="post" enctype="multipart/form-data" action="./index_admin.php">
	<input type='submit' name='create_product' value='Register Product'/>
	<input type='submit' name='delete_product' value='Delete Product'/>
	<input type='submit' name='modify_product' value='Modify Product'/>
	<input type='submit' name='create_user' value='Create User'/>
	<input type='submit' name='delete_user' value='Delete User'/>
	<input type='submit' name='modify_user' value='Modify User'/>
	<input type='submit' name='add_category' value='Add Category'/>
	<input type='submit' name='delete_category' value='Delete Category'/>
	<input type='submit' name="command_hist" value="Commands History"/>
</form>
<?php
if (isset($_POST) && isset($_POST['create_product']))
	header("Location: ./index_admin.php?page=create_product");
else if (isset($_POST) && isset($_POST['delete_product']))
	header("Location: ./index_admin.php?page=delete_product");
else if (isset($_POST) && isset($_POST['modify_product']))
	header("Location: ./index_admin.php?page=modify_product");
else if (isset($_POST) && isset($_POST['create_user']))
	header("Location: ./index_admin.php?page=create_user");
else if (isset($_POST) && isset($_POST['modify_user']))
	header("Location: ./index_admin.php?page=modify_user");
else if (isset($_POST) && isset($_POST['delete_user']))
	header("Location: ./index_admin.php?page=delete_user");
else if (isset($_POST) && isset($_POST['command_hist']))
	header("location: ./index_admin.php?page=command_hist");

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
		create_user(1);
	else if ($_GET['page'] == "modify_user" && isset($_POST['action_mod']))
		modify_user();
	else if ($_GET['page'] == "delete_user" && isset($_POST['action_del']))
		delete_user(1);
}
if (isset($_GET) && isset($_GET['page']) && $_GET['page'] == "command_hist")
{
	print_command_history();
}

?>
</body>
</html>
