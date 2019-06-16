<?php
session_start();
include("../function/mysqli_function.php");
include("../function/mysqli_function2.php");

$product_id = [];
$path = [];
$category = [];
$left = [];
$price = [];
$product_name = [];

$row = 0;
$i = 0;
$cat = 0;

 $mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
 $query = "SELECT * FROM `products`";
 if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
     die("Error1 : " . mysqli_error($mysqli));
 }
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
}
mysqli_stmt_close($stmt);

if (mysqli_errno($mysqli)) {
    die("Error4 : " . mysqli_stmt_error($stmt));
}
mysqli_close($mysqli);

if (isset($_POST['action']) && $_POST['action'] == "addInBasket") {
    $j = 0;
    $user_tmp = 1;
    $items = 1;
    $validProducts = 0;
    $singleProduct = [];
    $product = count($_POST) - 1;
    foreach ($_POST as $key=>$value) {
        if ($j < 3) {
            if ($value == "0") {
                $validProducts = 1;
            }
            array_push($singleProduct, $value);
            $j++;
        }
        if ($j == 3 && $validProducts == 0 && checkUserBasket($singleProduct) == TRUE) {
            addInBasket($singleProduct);
            updateProductAmount($singleProduct);
            $j = 0;
            $items++;
            $singleProduct = [];
        }
        if ($j == 3 && $validProducts == 0 && checkUserBasket($singleProduct) == FALSE) {
            updateBasket($singleProduct);
            updateProductAmount($singleProduct);
            $j = 0;
            $items++;
            $singleProduct = [];
        }
        if ($j == 3 && $validProducts == 1) {
            $j = 0;
            $items++;
            $singleProducts = [];
            $validProducts = 0;
        }
    }
}


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
        <li><a href="./panier.php?user=log">Panier</a></li>
        <input type="hidden" name="logout" value="">
        <li><a href="./logout.php">Logout</a></li>
    </ul>

</div>

</header>
    <form method="post" action="#">
    <div>
    <?php while($i < $row) { ?>
        <?php if ($category[$i] == "kinder" && $left[$i] > 0) { if ($cat == 0) { echo "<p>" . $category[$i] . "</p>";} $cat = 1; ?>
        <div>
            <img width="150" height="150" src="<?php echo $path[$i]; ?>">
            <p> <?php echo $price[$i]; ?> $</p>
            <input type="number" min="0"max="<?php echo $left[$i] ?>" name="quantityOf<?php echo $product_id[$i]; ?>" value="0"/>
            <input type="hidden" name="<?php echo $product_id[$i]; ?>" value="<?php echo $product_name[$i]?>">
            <input type="hidden" name="<?php echo "price" . $i; ?>" value="<?php echo $price[$i]; ?>">
        </div>
        <?php } $i++; } $i = 0; $cat = 0;?>
    </div>
    <div>
    <?php while($i < $row) { ?>
        <?php if ($category[$i] == "ferero" && $left[$i] > 0) { if ($cat == 0) { echo "<p>" . $category[$i] . "</p>";} $cat = 1; ?>
        <div>
            <img width="150" height="150" src="<?php echo $path[$i]; ?>">
            <p> <?php echo $price[$i]; ?> $</p>
            <input type="number" min="0" max="<?php echo $left[$i] ?>" name="quantityOf<?php echo $product_id[$i]; ?>" value="0"/>
            <input type="hidden" name="<?php echo $product_id[$i]; ?>" value="<?php echo $product_name[$i]?>">
            <input type="hidden" name="<?php echo "price" . $i; ?>" value="<?php echo $price[$i]; ?>">
        </div>
        <?php } $i++; } $i = 0; $cat = 0;?>
    </div>
    <div>
    <?php while($i < $row) { ?>
        <?php if ($category[$i] == "milka" && $left[$i] > 0) { if ($cat == 0) { echo "<p>" . $category[$i] . "</p>";} $cat = 1;?>
        <div>
            <img width="150" height="150" src="<?php echo $path[$i]; ?>">
            <p> <?php echo $price[$i]; ?> $</p>
            <input type="number" min="0" max="<?php echo $left[$i] ?>" name="quantityOf<?php echo $product_id[$i]; ?>" value="0"/>
            <input type="hidden" name="<?php echo $product_id[$i]; ?>" value="<?php echo $product_name[$i]?>">
            <input type="hidden" name="<?php echo "price" . $i; ?>" value="<?php echo $price[$i]; ?>">
        </div>
        <?php } $i++; } $i = 0; $cat = 0;?>
    </div>
    <?php while($i < $row) { ?>
        <?php if ($category[$i] == "cote d'or" && $left[$i] > 0) { if ($cat == 0) { echo "<p>" . $category[$i] . "</p>";} $cat = 1; ?>
        <div>
            <img width="150" height="150" src="<?php echo $path[$i]; ?>">
            <p> <?php echo $price[$i]; ?> $</p>
            <input type="number" min="0" max="<?php echo $left[$i] ?>" name="quantityOf<?php echo $product_id[$i]; ?>" value="0"/>
            <input type="hidden" name="<?php echo $product_id[$i]; ?>" value="<?php echo $product_name[$i]?>">
            <input type="hidden" name="<?php echo "price" . $i; ?>" value="<?php echo $price[$i]; ?>">
        </div>
        <?php } $i++; } $i = 0; $cat = 0;?>
    </div>
<button type="submit" name="action" value="addInBasket">Add items in basket </button>
<form>


</body>

</html>