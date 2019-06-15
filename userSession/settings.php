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
		<form action="./settings.php" method="POST">
		<p>Delete your account :</p>
		Login : <input name="login" value="" required />
		<br />
		Password : <input type="password" name="passwd" value="" required />
		<input type="submit" name="action" value="Delete Account" />
		</form>

<?php

if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['action']))
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
		die("Error1 : " . mysqli_error($connect));
	if (mysqli_stmt_bind_param($stmt, "s", $login) === FALSE)
		die("Error2 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_execute($stmt) === FALSE)
		die("Error3 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_bind_result($stmt, $col2, $col3) === FALSE)
		die("Error4 : " . mysqli_stmt_error($stmt));
	if (!mysqli_stmt_fetch($stmt))
	{
		echo "2 = $col2 3 = $col3\n";
		echo "Bad Login or password\n";
	}
	else
	{
		//refaire une requete pour suprimer le compte
		header("Location: ../index.php");
	}
}
//if (check == 0) --> Login ou password pas trouve dans la database
//echo '<p>Please enter a valid Login and Password<br /></pb>';
//else if (check == 1) --> Compte existant
{
//	echo '<p> Are you sure you want to Delete your account ?<br />';
//	echo '<p> This action is not reversible <br />';
//	echo '<input type="submit" name="action2" value="Confirm Delete" />';
//	echo '<input type ="submit" name="action3" value="Cancel" />';
//	if (isset($_POST['action2']))
	{
		//supprimer compte utilisateur
	}
//	else if (isset($_POST['action3']))
//		header("Location: ../index.php");
}

?>

<!DOCTYPE html>
	</div>
	</body></html>
	</body>
	</html>
