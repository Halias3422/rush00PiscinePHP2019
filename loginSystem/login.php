<?php

session_start();
include ("../function/mysqli_function.php");
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
			<li><a href="./login.php">Login</a></li>
			<li><a href="./signUp.php">Sign up</a></li>
		</ul>

	</div>
	<div class="login">
		<form action="./login.php" method="POST">
			<label for="titre">Login:</label><br>
			<input type="text" name="login" required> <br><br>
			<label for="titre">Password</label><br>
			<input type="password" name="passwd" required> <br><br>
			<input type="submit" name="action" value="Log In" />
		</form>
	</div>

<?php

if (isset($_POST['login']))
{
	$mysqli = mysqli_open();
	$query = "SELECT `login`,`password`,`modo` FROM `user` WHERE `login` = ? ";
	$login = $_POST['login'];
	$password = $_POST['passwd'];
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
		die("Error1 : " . mysqli_error($mysqli));
	if (mysqli_stmt_bind_param($stmt, "s",$login) === false)
		die("Error2 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_execute($stmt) === false)
		die("Error3 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_bind_result($stmt, $sql_login, $sql_passwd, $sql_modo) === FALSE)
		die("Error4 : " . mysqli_stmt_error($stmt));
	mysqli_stmt_fetch($stmt);
	mysqli_shutdown($stmt, $mysqli);
	if (hash("whirlpool", $password) == $sql_passwd)
	{
		$_SESSION['login'] = $sql_login;
		$_SESSION['modo'] = $sql_modo;
		if ($_SESSION['login'] === "admin")
			header("Location: ../admin/index_admin.php");
		else
			header("Location: ../userSession/index.php");
	}
	else if (isset($_POST['action']))
		echo '<p class="login">Please enter a valid Login and Password<br /></pb>';
}
?>

<!DOCTYPE html>
</body>
</html>
