<?php
session_start();
$_SESSION['pageStore'] = "index.php";
var_dump($_SESSION);
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="./menu.css">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Chocolatte</title>
	</head>
	<body>
	<header>
	<h1 class="deco">Chocolatte</h1>
	<nav>
		<ul>
<?php
if (isset($_SESSION['login']))
	echo '<li><a href="./userSession/index.php">Home</li>';
else
	echo '<li><a href="./index.php">Home</li>';
if (isset($_SESSION) && !isset($_SESSION['login']))
{
	echo '<li><a href="./loginSystem/signUp.php">Sign in</a></li>';
	echo '<li><a href="./loginSystem/login.php">Log in</a></li>';
	echo '<li><a href="./userSession/settings.php">Setting</a></li>';
}
?>
			<li><a href="./userSession/panier.php">Basket</a></li>
<?php
if (isset($_SESSION))
{
	if (isset($_SESSION['modo']) && $_SESSION['modo'] == 'Y')
		echo '<li><a href="./admin/index_admin.php">Management</a></li>';
	if (isset($_SESSION['login']))
	{
		echo '<li><a href="./userSession/panier.php">'.$_SESSION['login'].'</a></li>';
		echo '<li><a href="./userSession/logout.php">Log out</a></li>';
	}
}
?>
		</ul>
	</nav>
	</header>
<!-- <h1> Formulaire Produits </h1>
<form method="post" enctype="multipart/form-data" action="">
	<label for="reference">reference</label><br>
	<input type="text" id="reference" name="reference" placeholder="la référence de produit"> <br><br>

	<label for="categorie">categorie</label><br>
	<input type="text" id="categorie" name="categorie" placeholder="la categorie de produit"><br><br>

	<label for="titre">titre</label><br>
	<input type="text" id="titre" name="titre" placeholder="le titre du produit"> <br><br>

	<label for="description">description</label><br>
	<textarea name="description" id="description" placeholder="la description du produit"></textarea><br><br>

	<label for="couleur">couleur</label><br>
	<input type="text" id="couleur" name="couleur" placeholder="la couleur du produit"> <br><br>

	<label for="photo">photo</label><br>
	<input type="file" id="photo" name="photo"><br><br>

	<label for="prix">prix</label><br>
	<input type="text" id="prix" name="prix" placeholder="le prix du produit"><br><br>

	<label for="stock">stock</label><br>
	<input type="text" id="stock" name="stock" placeholder="le stock du produit"><br><br>

	<input type="submit" value="enregistrement du produit">
</form>
</form>
</figure> -->
</body>
</html>
