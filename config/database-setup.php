<?php
$DB_DSN = 'mysql:dbname=Camagru;host=mysql';
$DB_USER = 'root';
$DB_PASSWORD = 'rootpass';
$URL = 'localhost:8080';

$mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");

if (!$mysqli) {
    echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
    echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
    echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Succès : Une connexion correcte à MySQL a été faite! La base de donnée my_db est génial." . PHP_EOL;
echo "Information d'hôte : " . mysqli_get_host_info($mysqli) . PHP_EOL;

mysqli_close($mysqli);

//envoyer post data a la base de donnee et verifier si check;
	$mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
	if (!$mysqli) {
		echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
		echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
		echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	$query = "SELECT * FROM `user` WHERE `login` = ? ";
	$login = $_POST['login'];
	$password = $_POST['passwd'];
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
		die("Error1 : " . mysqli_error($connect));
	}
	if (mysqli_stmt_bind_param($stmt, "s", $login) === false) {
		die("Error2 : " . mysqli_stmt_error($stmt));
	}
	if (mysqli_stmt_execute($stmt) === false) {
		die("Error3 : " . mysqli_stmt_error($stmt));
	}
	if (mysqli_stmt_bind_result($stmt, $col1, $col2, $col3) === FALSE) {
		die("Error4 : " . mysqli_stmt_error($stmt));
	}
	/* Récupération des valeurs */
	while (mysqli_stmt_fetch($stmt)) {
		printf("%d %s %s\n", $col1, $col2, $col3);
	}
	/* Fermeture du traitement */
	mysqli_stmt_close($stmt);

	if (mysqli_errno($mysqli)) {
    	die("Error4 : " . mysqli_stmt_error($stmt));
	}
	echo "Succès : Une connexion correcte à MySQL a été faite! La base de donnée my_db est génial." . PHP_EOL;
	echo "Information d'hôte : " . mysqli_get_host_info($mysqli) . PHP_EOL;	
	mysqli_close($mysqli);
	if (password_verify($col2, $password)) {
		header("Location: ../userSession/index.php");
    }
    // ?>