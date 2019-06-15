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
<header background-color="black">

<div>
    <h1><a href="#">Camagru</a></h1>

    <ul>
        <li><a href="./loginSystem/login.php">Login</a></li>
        <li><a href="./loginSystem/register.php">Sign up</a></li>
    </ul>

</div>

</header>
<figure>
    <IMG width="100" SRC="data:image/jpeg;base64,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">
    <figcaption><form action="index.php" method="POST">
        <input type="number" name="quantite" value="POST"/>
        <button><input type="submit" name="kinder" value="Ajouter au panier"/></button></figcaption>
</form>
</figure>

<?php var_dump($_POST) ?>

</html>