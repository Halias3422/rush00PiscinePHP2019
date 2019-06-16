<?php
session_start();
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
		<li><a href="./index.php">vitrine</li>
		<li><a href="./panier.php?user=log">panier</a></li>
		<li><a href="./settings.php">Setting</a></li>
		<input type="hidden" name="logout" value="">
		<li><a href="./logout.php">disconnect</a></li>
		</ul>
	</nav>
</header>
</i><form method="post" enctype="multipart/form-data">
	<input type='submit' name='modify_account' value='Modify My Settings'/>
	<input type='submit' name='delete_account' value='Delete My Account'/>
</form>
<?php
if (isset($_POST) && isset($_POST['modify_account']))
	header("Location: ./settings.php?page=modify_account");
if (isset($_POST) && isset($_POST['delete_account']))
	header("Location: ./settings.php?page=delete_account");
?>

<?PHP
if (isset($_GET) && isset($_GET['page']) && $_GET['page'] == "delete_account")
{
?>
	<div class="login">
		<form method="POST">
			<label for="titre">Login</label><br>
			<input type="text" name="login" required> <br><br>
			<label for="titre">Password</label><br>
			<input type="password" name="passwd" required> <br><br>
			<input type="submit" name="action" value="DEFINITIVELY DELETE MY ACCOUNT" />
		</form>
	</div>
<?PHP
}
else if (isset($_GET) && isset($_GET['page']) && $_GET['page'] == "modify_account")
{
?>
	<div class="login">
		<form method="POST">
			<label for="titre">First Name</label><br>
			<input type="text" name="first_name" required> <br><br>
			<label for="titre">Last Name</label><br>
			<input type="text" name="last_name" required> <br><br>
			<label for="titre">Email</label><br>
			<input type="email" name="email" required> <br><br>
			<label for="titre">Password</label><br>
			<input type="password" name="passwd" required> <br><br>
			<input type="submit" name="action" value="Modify My Data" />
		</form>
	</div>
<?php
}
if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['action']) && isset($_SESSION['login']))
{
	if (isset($_GET))
	{
		if (isset($_GET['page']) && $_GET['page'] == "modify_account")
			modify_user();
		if (isset($_GET['page']) && $_GET['page'] == "delete_account")
			delete_user(0);
	}
}
?>

<!DOCTYPE html>

	</body>
	</html>
