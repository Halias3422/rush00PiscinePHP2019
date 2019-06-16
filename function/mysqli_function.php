<?PHP

function mysqli_shutdown($stmt, $mysqli)
{
	mysqli_stmt_close($stmt);
	if (mysqli_errno($mysqli))
		die("Error4 : " . mysqli_stmt_error($stmt));
	mysqli_close($mysqli);
}

function mysqli_open()
{
	$mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
	if (!$mysqli)
	{
		echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
		echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
		echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	return $mysqli;
}

/////////////////////////////////// ADMIN

function create_product()
{
	$mysqli = mysqli_open();
	$query = "SELECT `product_name` FROM `products` WHERE `product_name` = ?  ";
	$product = $_POST['name_product'];
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
		die("Error1 : " . mysqli_error($mysqli));
	if (mysqli_stmt_bind_param($stmt, "s", $product) === FALSE)
		die("Error2 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_execute($stmt) === FALSE)
		die("Error3 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_bind_result($stmt, $sql_name_product) === FALSE)
		die("Error4 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_fetch($stmt))
	{
		echo "<br>Product already exists";
		mysqli_shutdown($stmt, $mysqli);
	}
	else
	{
		mysqli_shutdown($stmt, $mysqli);
		$mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");
		$query = "INSERT INTO `products`(`product_name`, `path`, `price`, `left`, `category`) VALUE(?, ?, ?, ?, ?)";
		if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
			die("Error1 : " . mysqli_error($mysqli));
		}
		if (mysqli_stmt_bind_param($stmt, "ssdds", $_POST['name_product'], $_POST['photo'], $_POST['price'], $_POST['stock'], $_POST['company']) === false) {
			die("Error2 : " . mysqli_stmt_error($stmt));
		}
		if (mysqli_stmt_execute($stmt) === false) {
			die("Error3 : " . mysqli_stmt_error($stmt));
		}
		mysqli_shutdown($stmt, $mysqli);
		echo "<br/>Product successfully added to database";
	}
}

function delete_product()
{
	$mysqli = mysqli_open();
	$query = "SELECT `product_name` FROM `products` WHERE `product_name` = ? ";
	$product = $_POST['name_product'];
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
		die("Error1 : " . mysqli_error($mysqli));
	if (mysqli_stmt_bind_param($stmt, "s", $product) === FALSE)
		die("Error2 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_execute($stmt) === FALSE)
		die("Error3 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_bind_result($stmt, $sql_del_product) === FALSE)
		die("Error4 : " . mysqli_stmt_error($stmt));
	if (!mysqli_stmt_fetch($stmt))
		echo "<br/>This product is not registered in the batabase";
	else
	{
		mysqli_shutdown($stmt, $mysqli);
		if ($product == $sql_del_product)
		{
			$mysqli= mysqli_open();
			$query = "DELETE FROM `products` WHERE `product_name` = ? ";
			if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
				die("Error1 : " . mysqli_error($mysqli));
			if (mysqli_stmt_bind_param($stmt, "s", $product) === FALSE)
				die("Error2 : " . mysqli_stmt_error($stmt));
			if (mysqli_stmt_execute($stmt) === FALSE)
				die("Error 3 : " . mysqli_stmt_error($stmt));
			mysqli_stmt_close($stmt);
			if (mysqli_errno($mysqli))
				die("Error4 : " . mysqli_stmt_error($stmt));
			mysqli_close($mysqli);
			echo "<br/>Product successfully deleted from the database";
		}
	}
}
?>
