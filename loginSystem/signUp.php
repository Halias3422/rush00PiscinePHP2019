<?php

session_start();
include ("../function/mysqli_function.php");
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
var_dump($_SESSION);
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
	<div class="login">
		<form action="./signUp.php" method="POST">
			<label for="titre">Login:</label><br>
			<input type="text" name="login" required> <br><br>
			<label for="titre">First Name</label><br>
			<input type="text" name="first_name" required> <br><br>
			<label for="titre">Last Name</label><br>
			<input type="text" name="last_name" required> <br><br>
			<label for="titre">Email</label><br>
			<input type="email" name="email" required> <br><br>
			<label for="titre">Password</label><br>
			<input type="password" name="passwd" required> <br><br>
			<label for="titre">Confirm Password</label><br>
			<input type="password" name="conf_passwd" required> <br><br>
			<input type="submit" name="action" value="Create Account" />
		</form>
	</div>
	</body></html>
<?php

if (isset($_POST['login']))
{
	if ($_POST['passwd'] == $_POST['conf_passwd'])
	{
		create_user();
		header("Location: ./login.php");
	}
	else if (isset($_POST['passwd']) && isset($_POST['conf_passwd']) && $_POST['passwd'] !== $_POST['conf_passwd'])
		echo "<p>The confirmation password doesn't match the previous one</p>";
	else if (isset($_POST['action']))
		echo '<p>Please enter a valid Login and Password<br /></pb>';
}

?>

<!DOCTYPE html>

