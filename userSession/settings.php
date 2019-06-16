<?php

session_start();
var_dump($_SESSION);

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
			<li><a href="./panier.php?user=log">Basket</a></li>
			<li><a href="./index.php">Market</a></li>
			<input type="hidden" name="logout" value="">
			<li><a href="./logout.php">Logout</a></li>	
		</ul>

	</div>
	<div class="login">
		<form action="./settings.php" method="POST">
		<p>Delete your account :</p>
		Login : <input name="login" value="" required />
		<br />
		Password : <input type="password" name="passwd" value="" required />
		<input type="submit" name="action" value="Delete Account" />
		</form>

<?php

if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['action']) && isset($_SESSION['login']))
{
	//envoyer post data a la base de donnee et verifier si check;
	$mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
	if (!$mysqli) {
		echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
		echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
		echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	$query = "SELECT `login`,`password` FROM `user` WHERE `login` = ?  ";
	$login = $_POST['login'];
	$passwd = $_POST['passwd'];
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
		die("Error1 : " . mysqli_error($mysqli));
	if (mysqli_stmt_bind_param($stmt, "s", $login) === FALSE)
		die("Error2 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_execute($stmt) === FALSE)
		die("Error3 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_bind_result($stmt, $sql_login, $sql_passwd) === FALSE)
		die("Error4 : " . mysqli_stmt_error($stmt));
	if (!mysqli_stmt_fetch($stmt))
		echo "Login or Password invalid, Please try again\n";
	else
	{
		mysqli_stmt_close($stmt);
		if (mysqli_errno($mysqli))
			die("Error4 : " . mysqli_stmt_error($stmt));
		mysqli_close($mysqli);
		if (hash("md5", $passwd) == $sql_passwd && $login == $_SESSION['login'])
		{
			$mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
			if (!$mysqli) 
			{
				echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
				echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
				echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
				exit;
			}
			$query = "DELETE FROM `user` WHERE `login` = ? ";
			if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
				die("Error1 : " . mysqli_error($mysqli));
			if (mysqli_stmt_bind_param($stmt, "s", $login) === FALSE)
				die("Error2 : " . mysqli_stmt_error($stmt));
			if (mysqli_stmt_execute($stmt) === FALSE)
				die("Error 3 : " . mysqli_stmt_error($stmt));
			mysqli_stmt_close($stmt);
			if (mysqli_errno($mysqli))
				die("Error4 : " . mysqli_stmt_error($stmt));
			mysqli_close($mysqli);
			if(session_destroy())
				header("location: ../index.php");
		}
		else
			echo "ELSE DE ROGER\n";
	}
}


?>

<!DOCTYPE html>
	</div>
	</body></html>
	</body>
	</html>
