<?php
require_once("../header.php");
include("../function/mysqli_function3.php");
include ("../function/mysqli_function.php");
?>
<div class="outer">
	<div class="login, center">
		<form action="./login.php" method="POST">
			<label for="titre">Login</label><br>
			<input type="text" name="login" class="input_sz" required> <br><br>
			<label for="titre" class="label_sz">Password</label><br>
			<input type="password" name="passwd" class="input_sz" required> <br><br>
			<input type="submit" name="action" class="submit_bt" value="Log In" />
		</form>
	</div>
</div>
<?php

if (isset($_POST['login']))
{
	$mysqli = mysqli_open();
	$query = "SELECT `login`,`password`,`modo` FROM `user` WHERE `login` = ? ";
	$login = $_POST['login'];
	$password = $_POST['passwd'];
	if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE)
		die("Error1 : " . mysqli_error($mysqli));
	if (mysqli_stmt_bind_param($stmt, "s",$login) === false)
		die("Error2 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_execute($stmt) === false)
		die("Error3 : " . mysqli_stmt_error($stmt));
	if (mysqli_stmt_bind_result($stmt, $sql_login, $sql_passwd, $sql_modo) === FALSE)
		die("Error4 : " . mysqli_stmt_error($stmt));
	mysqli_stmt_fetch($stmt);
	mysqli_shutdown($stmt, $mysqli);
	if (hash("whirlpool", $password) == $sql_passwd)
	{
		$_SESSION['login'] = $sql_login;
		$_SESSION['modo'] = $sql_modo;
		selectBasketNotLog();
		$_SESSION['notlog'] = "";
		if ($_SESSION['login'] === "admin")
			header("Location: ../admin/index_admin.php");
		else
			header("Location: ../userSession/index.php");
	}
	else if (isset($_POST['action']))
		echo '<p class="login">Please enter a valid Login and Password<br /></pb>';
}
?>
</div>
</body>
</html>
