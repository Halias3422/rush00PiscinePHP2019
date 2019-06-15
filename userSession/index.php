<?php
session_start();

var_dump($_POST);
$product_id = [];
$path = [];
$category = [];
$left = [];
$price = [];
$product_name = [];

$row = 0;
$i = 0;

$mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
if (!$mysqli) {
    echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
    echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
    echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
    exit;
}
$query = "SELECT * FROM `products`";
if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
    die("Error1 : " . mysqli_error($mysqli));
}
if (mysqli_stmt_execute($stmt) === false) {
    die("Error3 : " . mysqli_stmt_error($stmt));
}
if (mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4, $col5, $col6) === FALSE) {
    die("Error4 : " . mysqli_stmt_error($stmt));
}
/* Récupération des valeurs */
while (mysqli_stmt_fetch($stmt)) {
    $row += 1;
    array_push($product_id, $col1);
    array_push($product_name, $col2);
    array_push($price, $col3);
    array_push($left, $col4);
    array_push($category, $col5);
    array_push($path, $col6);
    //var_dump($col6);
}
// var_dump($product_id); echo "<br>";
// var_dump($product_name); echo "<br>";
// var_dump($price); echo "<br>";
// var_dump($left); echo "<br>";
// var_dump($category); echo "<br>";
// var_dump($path); echo "<br> <br>";

// echo $row . "<br>";


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
<head>

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
<?php while($i < $row) { ?>
    <form method="post" action="#">
    <div>
        <?php if ($category[$i] == "kinder") { ?>
        <div>
            <img width="150" height="150" src="<?php echo $path[$i]; ?>">
            <p> <?php echo $price[$i]; ?> $</p>
            <input type="number" min="0"max="<?php echo $left[$i] ?>" name="quantityOf<?php echo $product_id[$i]; ?>" value="0"/>
            <input type="hidden" name="<?php echo $product_id[$i]; ?>" value="<?php echo $product_name[$i]?>">

        </div>
        <?php } ?>

        <?php if ($category[$i] == "ferero") { ?>
        <div>
            <img width="150" height="150" src="<?php echo $path[$i]; ?>">
            <p> <?php echo $price[$i]; ?> $</p>
            <input type="number" min="0" max="<?php echo $left[$i] ?>" name="quantityOf<?php echo $product_id[$i]; ?>" value="0"/>
            <input type="hidden" name="<?php echo $product_id[$i]; ?>" value="<?php echo $product_name[$i]?>">
        </div>
        <?php } ?>

        <?php if ($category[$i] == "milka") { ?>
        <div>
            <img width="150" height="150" src="<?php echo $path[$i]; ?>">
            <p> <?php echo $price[$i]; ?> $</p>
            <input type="number" min="0" max="<?php echo $left[$i] ?>" name="quantityOf<?php echo $product_id[$i]; ?>" value="0"/>
            <input type="hidden" name="<?php echo $product_id[$i]; ?>" value="<?php echo $product_name[$i]?>">
        </div>
        <?php } ?>

        <?php if ($category[$i] == "cote d'or") { ?>
        <div>
            <img width="150" height="150" src="<?php echo $path[$i]; ?>">
            <p> <?php echo $price[$i]; ?> $</p>
            <input type="number" min="0" max="<?php echo $left[$i] ?>" name="quantityOf<?php echo $product_id[$i]; ?>" value="0"/>
            <input type="hidden" name="<?php echo $product_id[$i]; ?>" value="<?php echo $product_name[$i]?>">
        </div>
        <?php } ?>
    </div>
<?php $i++; } ?>
<button type="submit" name="action" value="addInBasket">Add items in basket </button>
<form>


</body>

</html>