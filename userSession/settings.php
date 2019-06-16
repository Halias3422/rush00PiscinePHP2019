<?php
require_once("../header.php");
require_once ("../function/mysqli_function.php");
?>
</i><form method="post" enctype="multipart/form-data">
	<input type='submit' name='modify_account' class="option_bt" value='Modify My Settings'/>
	<input type='submit' name='delete_account'  class="option_bt" value='Delete My Account'/>
</form>
<?php
if (isset($_POST) && isset($_POST['modify_account']))
	header("Location: ./settings.php?page=modify_account");
if (isset($_POST) && isset($_POST['delete_account']))
	header("Location: ./settings.php?page=delete_account");
?>

<?PHP
if (isset($_GET) && isset($_GET['page']) && $_GET['page'] == "delete_account")
{
?>
	<div class="outer">
	<div class="login, center">
		<form method="POST">
			<label for="titre">Login</label><br>
			<input type="text" name="login" class="input_sz"required> <br><br>
			<label for="titre">Password</label><br>
			<input type="password" name="passwd"class="input_sz" required> <br><br>
			<input type="submit" name="action" class="submit_bt"value="DELETE" />
		</form>
	</div></div>
<?PHP
}
else if (isset($_GET) && isset($_GET['page']) && $_GET['page'] == "modify_account")
{
?>
	<div class="outer">
	<div class="login, center">
		<form method="POST">
			<label for="titre" class="label_sz">First Name</label><br>
			<input type="text" class="input_sz" name="first_name" required> <br><br>
			<label for="titre" class="label_sz">Last Name</label><br>
			<input type="text"class="input_sz"  name="last_name" required> <br><br>
			<label for="titre" class="label_sz">Email</label><br>
			<input type="email" class="input_sz"name="email" required> <br><br>
			<label for="titre" class="label_sz">Password</label><br>
			<input type="password" class="input_sz" name="passwd" required> <br><br>
			<input type="submit" name="action" class="submit_bt" value="Modify My Data" />
		</form>
	</div></div>
<?php
}
if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['action']) && isset($_SESSION['login']))
{
	if (isset($_GET))
	{
		if (isset($_GET['page']) && $_GET['page'] == "modify_account")
			modify_user();
		if (isset($_GET['page']) && $_GET['page'] == "delete_account")
			delete_user(0);
	}
}
?>

<!DOCTYPE html>

	</body>
	</html>
