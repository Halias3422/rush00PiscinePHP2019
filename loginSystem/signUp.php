<?php
require_once("../header.php");
include ("../function/mysqli_function.php");
?>

	<div class="login">
		<form action="./signUp.php" method="POST">
			<label for="titre">Login:</label><br/>
			<input type="text" name="login" required> <br/><br/>
			<label for="titre">First Name</label><br/>
			<input type="text" name="first_name" required> <br/><br/>
			<label for="titre">Last Name</label><br/>
			<input type="text" name="last_name" required> <br/><br/>
			<label for="titre">Email</label><br/>
			<input type="email" name="email" required> <br/><br/>
			<label for="titre">Password</label><br/>
			<input type="password" name="passwd" required> <br/><br/>
			<label for="titre">Confirm Password</label><br/>
			<input type="password" name="conf_passwd" required> <br/><br/>
			<input type="submit" name="action" value="Create Account">
		</form>
	</div>
<?php
if (isset($_POST['login']))
{
	if ($_POST['passwd'] == $_POST['conf_passwd'])
	{
		create_user(0);
		header("Location: ./login.php");
	}
	else if (isset($_POST['passwd']) && isset($_POST['conf_passwd']) && $_POST['passwd'] !== $_POST['conf_passwd'])
		echo "<p>The confirmation password doesn't match the previous one</p>";
	else if (isset($_POST['action']))
		echo '<p>Please enter a valid Login and Password<br /></p>';
}
require_once("../footer.php");
?>
