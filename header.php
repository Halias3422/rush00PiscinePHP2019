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


<header style="background-color: grey; width:100%;">

<!-- <div>
    <h1><a href="~/index.php">Camagru</a></h1>

    <?php //if () Personne de log dans index ?>
    <nav>
        <a href="./loginSystem/login.php">Login</a>
        <a href="./loginSystem/signUp.php">Sign up</a>
    </nav>
    
     <?php //if () Users dans index ?>
        <a href="./userSession/lpanier.php">Basket</a>
        <a href="./loginSystem/signUp.php">Disconnect</a>
    <?php //if () Admin log ?>
        <a href="./userSession/lpanier.php">Basket</a>
        <a href="./loginSystem/signUp.php">Disconnect</a>
        <a href="./admin/index_admin.php">Gestion</a> 

</div> -->
<div>
    <h1><a href="~/index.php">Camagru</a></h1>
                <div>
                <ul class="menu">
                    <li style="text-align: center;">shop</li>
                    <li><a href="~/index.php">vitrine</a></li>
                    <li><a href="./userSession/lpanier.php">panier</a></li>
                </ul>
                <ul class="menu">
                    <li style="text-align: center;">Utilisateur</li>
                    <?php //if () user pas connecter  ?>
                        <li><a href="./loginSystem/login.php">Log in</a></li>
                        <li><a href="./loginSystem/signUp.php">Sign in</a></li>
                        <?php //else ?>
                        <li><a href="./userSession/settings.php">Setting</a></li>
                        <li><a href="~/index.php">disconnect</a></li> <?php // deconnecter user?>
                    
                </ul>
                <?php  //if () admin co ?>
                <ul class="menu">
                    <li style="text-align: center;">Gestion Admin</li>
                    <li><a href="./admin/index_admin.php">gestion</a></li>
                </ul>
                </div>
</div>

</header>
</html>