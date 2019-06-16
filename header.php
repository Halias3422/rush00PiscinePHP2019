<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../menu.css">
		<link rel="stylesheet" href="../userSession/box.css">
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
	echo '<li><a href="../userSession/index.php">Home</li>';
else
	echo '<li><a href="../index.php">Home</li>';
if (isset($_SESSION) && !isset($_SESSION['login']))
{
	echo '<li><a href="../loginSystem/signUp.php">Sign in</a></li>';
	echo '<li><a href="../loginSystem/login.php">Log in</a></li>';
	echo '<li><a href="../panier.php">Basket</a></li>';
}

if (isset($_SESSION))
{
	if (isset($_SESSION['modo']) && $_SESSION['modo'] == 'Y')
		echo '<li><a href="../admin/index_admin.php">Management</a></li>';
	if (isset($_SESSION['login']))
	{
		echo '<li><a href="../userSession/panier.php?user=log">Basket</a></li>';
		echo '<li><a href="../userSession/settings.php">Setting</a></li>';
		echo '<li><a href="../userSession/logout.php">Log out</a></li>';
	}
}
?>
		</ul>
	</nav>
	</header>