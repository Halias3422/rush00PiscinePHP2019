<?php

session_start();
var_dump($_SESSION);
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
	if (hash("MD5", $password) == $sql_passwd)
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
