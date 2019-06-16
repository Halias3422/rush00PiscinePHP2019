<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="menu.css">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Camagru</title>


</head>

<body>


<header>
<h1 class="deco">Chocolatte</h1>
<nav>
    <ul>
        <li><a href="~/index.php">vitrine</li>
        <?php //if (session visiteur) ?>
        <li><a href="./loginSystem/login.php">Log in</a></li>
        <li><a href="./loginSystem/signUp.php">Sign in</a></li>

        <li><a href="./userSession/lpanier.php">panier</a></li>
        <?php //if (user/admin log) ?>
        <li><a href="./userSession/settings.php">Setting</a></li>
        <li><a href="~/index.php">disconnect</a></li>
    </ul>
</nav>


</header>
</html>