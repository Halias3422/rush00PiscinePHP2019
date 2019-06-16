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

function create_user($mode)
{
	$mysqli = mysqli_open();
	$query = "SELECT `login` FROM `user` WHERE `login` = ? ";
	$login = $_POST['login'];
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
		die("Error1 : " . mysqli_error($mysqli));
	if (mysqli_stmt_bind_param($stmt, "s", $login) === FALSE)
		die("Error2 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_execute($stmt) === FALSE)
		die("Error3 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_bind_result($stmt, $sql_login) === FALSE)
		die("Error4 : " . mysqli_stmt_error($stmt));
	mysqli_stmt_fetch($stmt);
	mysqli_shutdown($stmt, $mysqli);
	if ($sql_login == $login)
		echo '<script> alert("this Username is already taken") </script>';
	else
	{
		$mysqli = mysqli_open();
		$query = "INSERT INTO `user`(`login`, `password`, `modo`, `first_name`, `last_name`, `email`) VALUE(?, ?, ?, ?, ?, ?)";
		$modo = $_POST['modo'];
		if ($mode == 0)
			$modo = "N";
		$passwd = hash("whirlpool", $_POST['passwd']);
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
			die("Error1 : " . mysqli_error($mysqli));
		if (mysqli_stmt_bind_param($stmt, "ssssss", $login, $passwd, $modo, $first_name, $last_name, $email) === false)
			die("Error2 : " . mysqli_stmt_error($stmt));
		if (mysqli_stmt_execute($stmt) === false)
			die("Error3 : " . mysqli_stmt_error($stmt));
		mysqli_shutdown($stmt, $mysqli);
	}
}

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

function modify_product()
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
	if (mysqli_stmt_bind_result($stmt, $sql_modif_product) === FALSE)
		die("Error4 : " . mysqli_stmt_error($stmt));
	if (!mysqli_stmt_fetch($stmt))
		echo "<br/>This product is not registered in the batabase";
	else
	{
		mysqli_shutdown($stmt, $mysqli);
		if ($product == $sql_modif_product)
		{
			$path = $_POST['photo'];
			$price = $_POST['price'];
			$left = $_POST['stock'];
			$category = $_POST['company'];
			$product_name = $_POST['name_product'];
			$mysqli = mysqli_open();
			$query = 'UPDATE `products` SET `path` = ? , `price` = ?, `left` = ?, `category` = ?  WHERE `product_name` = ? ';
			if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
				die("Error1 : " . mysqli_error($mysqli));
			if (mysqli_stmt_bind_param($stmt, "sddss", $path, $price, $left, $category, $product_name) === FALSE)
				die("Error2 : " . mysqli_stmt_error($stmt));
			if (mysqli_stmt_execute($stmt) === FALSE)
				die("Error3 : " . mysqli_stmt_error($stmt));
			echo "<br/> Product informations successfully updated";
			mysqli_shutdown($stmt, $mysqli);
		}
	}
}

function modify_user_non_admin()
{
	$mysqli = mysqli_open();
	$query = "SELECT `login` FROM `user` WHERE `login` = ? ";
	$login = $_SESSION['login'];
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
		die("Error1 : " . mysqli_error($mysqli));
	if (mysqli_stmt_bind_param($stmt, "s", $login) === FALSE)
		die("Error2 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_execute($stmt) === FALSE)
		die("Error3 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_bind_result($stmt, $sql_modif_user) === FALSE)
		die("Error4 : " . mysqli_stmt_error($stmt));
	if (!mysqli_stmt_fetch($stmt))
		echo "<br/>This user is not registered in the batabase";
	else
	{
		$password = hash('whirlpool', $_POST['passwd']);
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		mysqli_shutdown($stmt, $mysqli);
		if ($login == $sql_modif_user)
		{
			$mysqli = mysqli_open();
			$query = 'UPDATE `user` SET `password` = ? , `first_name` = ?, `last_name` = ?, `email` = ? WHERE `login` = ? ';
			if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
				die("Error1 : " . mysqli_error($mysqli));
			if (mysqli_stmt_bind_param($stmt, "sssss", $password, $first_name, $last_name, $email, $login) === FALSE)
				die("Error2 : " . mysqli_stmt_error($stmt));
			if (mysqli_stmt_execute($stmt) === FALSE)
				die("Error3 : " . mysqli_stmt_error($stmt));
			echo "<br/> User informations successfully updated";
			mysqli_shutdown($stmt, $mysqli);
		}
	}
}


function modify_user($mode)
{
	$mysqli = mysqli_open();
	$query = "SELECT `login` FROM `user` WHERE `login` = ? ";
	if ($mode == 1)
		$login = $_POST['login'];
	else
		$login = $_SESSION['login'];
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
		die("Error1 : " . mysqli_error($mysqli));
	if (mysqli_stmt_bind_param($stmt, "s", $login) === FALSE)
		die("Error2 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_execute($stmt) === FALSE)
		die("Error3 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_bind_result($stmt, $sql_modif_user) === FALSE)
		die("Error4 : " . mysqli_stmt_error($stmt));
	if (!mysqli_stmt_fetch($stmt))
		echo "<br/>This user is not registered in the batabase";
	else
	{
		$login = $_POST['login'];
		$password = hash('whirlpool', $_POST['passwd']);
		$modo = $_POST['modo'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		mysqli_shutdown($stmt, $mysqli);
		if ($login == $sql_modif_user && $password == hash('whirlpool', $_POST['conf_passwd']))
		{
			$mysqli = mysqli_open();
			$query = 'UPDATE `user` SET `password` = ? , `modo` = ?, `first_name` = ?, `last_name` = ?, `email` = ? WHERE `login` = ? ';
			if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
				die("Error1 : " . mysqli_error($mysqli));
			if (mysqli_stmt_bind_param($stmt, "ssssss", $password, $modo, $first_name, $last_name, $email, $login) === FALSE)
				die("Error2 : " . mysqli_stmt_error($stmt));
			if (mysqli_stmt_execute($stmt) === FALSE)
				die("Error3 : " . mysqli_stmt_error($stmt));
			echo "<br/> User informations successfully updated";
			mysqli_shutdown($stmt, $mysqli);
		}
		else if ($password != $_POST['conf_passwd'])
			echo "<br>The two passwords entered are differents, please try again";
	}
}

function delete_user($mode)
{
	$mysqli = mysqli_open();
	$query = 'SELECT `login`,`password` FROM `user` WHERE `login` = ? ';
	$login = $_POST['login'];
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
		die("Error1caca : " . mysqli_error($mysqli));
	if (mysqli_stmt_bind_param($stmt, "s", $login) === FALSE)
		die("Error2 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_execute($stmt) === FALSE)
		die("Error3 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_bind_result($stmt, $sql_login, $sql_passwd) === FALSE)
		die("Error4 : " . mysqli_stmt_error($stmt));
	if (!mysqli_stmt_fetch($stmt))
		echo "<br/>This user is not registered in the batabase";
	else
	{
		mysqli_shutdown($stmt, $mysqli);
		if ($mode != 1 && (($mode == 0 && !isset($_SESSION)) || (isset($_SESSION) && isset($_SESSION['login']) && $login != $_SESSION['login'])))
		{
			echo "You don't have the right to remove other user's account";
			exit;
		}
		if ($login == $sql_login && ($mode || hash('whirlpool', ($_POST['passwd'])) == $sql_passwd))
		{
			$mysqli= mysqli_open();
			$query = "DELETE FROM `user` WHERE `login` = ? ";
			if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
				die("Error1 : " . mysqli_error($mysqli));
			if (mysqli_stmt_bind_param($stmt, "s", $login) === FALSE)
				die("Error2 : " . mysqli_stmt_error($stmt));
			if (mysqli_stmt_execute($stmt) === FALSE)
				die("Error 3 : " . mysqli_stmt_error($stmt));
			mysqli_stmt_close($stmt);
			if (mysqli_errno($mysqli))
				die("Error4 : " . mysqli_stmt_error($stmt));
			mysqli_close($mysqli);
			echo "<br/>User successfully deleted from the database";
			header("Location: ../userSession/logout.php");
		}
	}
}

function print_command_history()
{
	if (isset($_GET) && isset($_GET['page']) && $_GET['page'] == "command_hist")
{
	$mysqli = mysqli_open();
	$query="SELECT * FROM `commande`";
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
		die("Error1 : " . mysqli_error($mysqli));
	if (mysqli_stmt_execute($stmt) === false)
		die("Error3 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_bind_result($stmt, $col1, $col2, $col3) === FALSE)
		die("Error4 : " . mysqli_stmt_error($stmt));
	echo '<table style="border: 1px solid black;"><tr><td>Login ID</td><td>Total Paid</td><td>Date</td>';
	while (mysqli_stmt_fetch($stmt))
	{
		echo "<tr><td>$col1</td><td>$col2</td><td>$col3</td>";
	}
	echo "</table><br>";

}
}

?>
