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
	        <li><a href="./loginSystem/index.php">Login</a></li>
	        <li><a href="./loginSystes/register.php">Sign up</a></li>
	    </ul>

	</div>
	<div class="login">
		<form action="./login.php" method="POST">
		<p>Login with existing account : </p>
		Login : <input name="login" value="" required/>
		<br />
		Password : <input type="password" name="passwd" value="" required>
		<input type="submit" name="action" value="Log In" />
	
		</form>

<?php

if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['action']))
{
	//envoyer post data a la base de donnee et verifier si check;
	$login = $_POST['login'];
	$passwd = $_POST['passwd'];
	header("Location: ../index.php");
}
else if (isset($_POST['action']))
	echo '<p class="login">Please enter a valid Login and Password<br /></pb>';

//if ($check == 1)
//envoyer page index-user connecte 
//else if ($check == 0)
//echo "Identifiant et/ou Mot de passe invalide\n";

?>

<!DOCTYPE html>
</div>
</body></html>
</body>
</html>
