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
			<li><a href="./login.php">Login</a></li>
			<li><a href="./signUp.php">Sign up</a></li>
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
	$mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
	$query = "SELECT * FROM `user` WHERE `login` = ? ";
	$login = $_POST['login'];
	$password = $_POST['passwd'];
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
		die("Error1 : " . mysqli_error($connect));
	}
	if (mysqli_stmt_bind_param($stmt, "s",$login) === false) {
		die("Error2 : " . mysqli_stmt_error($stmt));
	}
	if (mysqli_stmt_execute($stmt) === false) {
		die("Error3 : " . mysqli_stmt_error($stmt));
	}
	if (mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4) === FALSE) {
		die("Error4 : " . mysqli_stmt_error($stmt));
	}
	/* Récupération des valeurs */
	mysqli_stmt_fetch($stmt);
	/* Fermeture du traitement */
	mysqli_stmt_close($stmt);

	if (mysqli_errno($mysqli)) {
    	die("Error4 : " . mysqli_stmt_error($stmt));
	}
	mysqli_close($mysqli);
	echo $login;
	if ($col2 == $login) {
		echo '<script> alert("this Username is already taken") </script>';
	}
	else {


	//envoyer post data a la base de donnee et verifier si check;
	$login = $_POST['login'];
	$passwd = hash("md5", $_POST['passwd']);
		//envoyer post data a la base de donnee et verifier si check;
		$mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
		if (!$mysqli) {
			echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
			echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
			echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
		$query = "INSERT INTO `user`(`login`, `password`, `modo`) VALUE(?, ?, ?)";
		$modo = 'N';
		if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
			die("Error1 : " . mysqli_error($mysqli));
		}
		if (mysqli_stmt_bind_param($stmt, "sss", $login, $passwd, $modo) === false) {
			die("Error2 : " . mysqli_stmt_error($stmt));
		}
		if (mysqli_stmt_execute($stmt) === false) {
			die("Error3 : " . mysqli_stmt_error($stmt));
		}
		/* Fermeture du traitement */
		mysqli_stmt_close($stmt);	
		if (mysqli_errno($mysqli)) {
			die("Error4 : " . mysqli_stmt_error($stmt));
		}
		mysqli_close($mysqli);
		header("Location: ./login.php");
	}
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
