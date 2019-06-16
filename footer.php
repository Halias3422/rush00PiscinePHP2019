<footer>
<?php

if (isset($_SESSION['login']))
	echo "<p>You are logged as ".$_SESSION['login']."</p>";
else
	echo '<p>You are not logged in</p>';
?>
</footer>
</body>
</html>
