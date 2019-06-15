<?php

session_start();

?>

	<html>
	<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Camagru</title>

	</head>

	<body>
		<header>

	<div style="background-color: grey">
		<h1><a href="#">Camagru</a></h1>

		<ul>
			<li><a href="./loginSystem/login.php">Login</a></li>
			<li><a href="./loginSystem/register.php">Sign up</a></li>
		</ul>

	</div>
	<div class="login">
		<form action="./signUp.php" method="POST">
		<p>Register as a new User :</p>
		Login : <input name="login" value="" required />
		<br />
		Password : <input type="password" name="passwd" value="" required />
		Confirm password : <input type="password" name="conf_passwd" value="" required />
		<input type="submit" name="action" value="Create Account" />
		</form>

<?php

if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['action']) && isset($_POST['conf_passwd']) && $_POST['passwd'] === $_POST['conf_passwd'])
{
	//envoyer post data a la base de donnee et verifier si check;
	$login = $_POST['login'];
	$passwd = $_POST['passwd'];
	header("Location: ../index.php");
}
else if (isset($_POST['passwd']) && isset($_POST['conf_passwd']) && $_POST['passwd'] !== $_POST['conf_passwd'])
	echo "<p>The confirmation password doesn't match the previous one</p>";
else if (isset($_POST['action']))
	echo '<p>Please enter a valid Login and Password<br /></pb>';

?>

<!DOCTYPE html>
	</div>
	</body></html>
	</body>
	</html>
