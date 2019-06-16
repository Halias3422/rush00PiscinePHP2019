<?php
session_start();
$_SESSION['pageStore'] = "index.php";
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Camagru</title>


</head>

<body>
<header style="background-color: grey;">

<div>
    <h1><a href="#">Camagru</a></h1>

    <ul>
        <li><a href="./loginSystem/login.php">Login</a></li>
        <li><a href="./userSession/panier.php">Panier</a></li>
    </ul>

</div>

</header>
</html>
