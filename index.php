<?php
session_start();
$_SESSION['pageStore'] = "index.php";
var_dump($_POST);
require_once("./header_index.php");
?>

<div>
	<h1><a href="#">Camagru</a></h1>

	<ul>
		<li><a href="./loginSystem/login.php">Login</a></li>
		<li><a href="./userSession/panier.php">Panier</a></li>
	</ul>

</div>

</header>
<figure>
	<figcaption><form action="index.php" method="POST">
		<input type="number" min="0" name="quantite" value="0"/>
		<button><input type="submit" name="kinder" value="Ajouter au panier"/></button></figcaption>

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

</html>
