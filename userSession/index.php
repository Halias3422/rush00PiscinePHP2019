<?php
session_start();

$mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
if (!$mysqli) {
    echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
    echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
    echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
    exit;
}
$query = "SELECT * FROM `user` WHERE `login` = ? ";
if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
    die("Error1 : " . mysqli_error($mysqli));
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
while (mysqli_stmt_fetch($stmt)) {
    printf("%d %s %s\n", $col1, $col2, $col3, $col4);
}
/* Fermeture du traitement */
mysqli_stmt_close($stmt);

if (mysqli_errno($mysqli)) {
    die("Error4 : " . mysqli_stmt_error($stmt));
}
echo "Succès : Une connexion correcte à MySQL a été faite! La base de donnée my_db est génial." . PHP_EOL;
echo "Information d'hôte : " . mysqli_get_host_info($mysqli) . PHP_EOL;	
mysqli_close($mysqli);


?>

<!DOCTYPE html>
<html>
head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Camagru</title>


</head>

<body>
<header style="background-color: grey;">

<div>
    <h1><a href="#">Rush</a></h1>

    <ul>
        <li><a href="./panier.php">Panier</a></li>
        <input type="hidden" name="logout" value="">
        <li><a href="./logout.php">Logout</a></li>
    </ul>

</div>

</header>

</html>
