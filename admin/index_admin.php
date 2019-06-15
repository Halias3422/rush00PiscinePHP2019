
<?php
session_start();
$_SESSION['pageStore'] = "index.php";
var_dump($_POST);
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
		<li><a href="../loginSystem/login.php">Login</a></li>
		<li><a href="../userSession/panier.php">Panier</a></li>
	</ul>

</div>

</header>
<h1> Formulaire Produits </h1>
<form method="post" enctype="multipart/form-data" action="./index_admin.php">
	<label for="titre">name_product</label><br>
	<input type="text" id="nom" name="name_product" placeholder="le titre du produit"required> <br><br>

	<label for="photo">photo</label><br>
	<input type="file" id="photo" name="photo"required><br><br>

    <label for="marque">marque</label><br>
    <select name="marque">
		<option value="choose">Choose</option>
        <option value="kinder">Kinder</option>
        <option value="ferero">Ferero</option>
        <option value="milka">Milka</option>
        <option value="cote dor">Cote D'Or</option>
    </select><br/><br/>

	<label for="prix">prix</label><br>
	<input type="text" id="prix" name="prix" placeholder="le prix du produit"required><br><br>

	<label for="stock">stock</label><br>
	<input type="text" id="stock" name="stock" placeholder="le stock du produit"required><br><br>

	<input type="submit" name="action" value="enregistrement du produit">
<?php
	if (isset($_POST['action']))
	{
		$mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
		if (!$mysqli) {
		echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
		echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
		echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	$query = "SELECT `product_name` FROM `products` WHERE `product_name` = ?  ";
	$product = $_POST['name_product'];
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
		die("Error1 : " . mysqli_error($mysqli));
	if (mysqli_stmt_bind_param($stmt, "s", $login) === FALSE)
		die("Error2 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_execute($stmt) === FALSE)
		die("Error3 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_bind_result($stmt, $sql_name_product) === FALSE)
		die("Error4 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_fetch($stmt))
	{
		echo "Product already exists\n";
		exit;
	}
	else if ($sql_name_product == $product)
	{
		echo "Product already exists";
		exit;
	}
	else
	{
		mysqli_stmt_close($stmt);
		if (mysqli_errno($mysqli))
			die("Error4 : " . mysqli_stmt_error($stmt));
		mysqli_close($mysqli);
	}

}

?>
</form>
</form>

</html>
