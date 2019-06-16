<?php
session_start();
var_dump($_SESSION);
include("../function/mysqli_function.php");
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
        <li><a href="./index.php">Market</a></li>
        <li><a href="./settings.php">Settings</a></li>
        <input type="hidden" name="logout" value="">
        <li><a href="./logout.php">Logout</a></li>
    </ul>

</div>

</header>
<?php if (isset($_GET['user']) && $_GET['user'] == "log") { 
    $mysqli = mysqli_open();
    $query = "SELECT * FROM `basket` WHERE `user_id` = ?";
    if (($stmt = mysqli_prepare($mysqli, $query)) === FALSE) {
        die("Error1 : " . mysqli_error($mysqli));
    }
    if (mysqli_stmt_bind_param($stmt, "s", $_SESSION['login']) === false) {
		die("Error2 : " . mysqli_stmt_error($stmt));
	}
    if (mysqli_stmt_execute($stmt) === false) {
        die("Error3 : " . mysqli_stmt_error($stmt));
    }
    if (mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4, $col5) === FALSE) {
        die("Error4 : " . mysqli_stmt_error($stmt));
    }
    /* Récupération des valeurs */
    while (mysqli_stmt_fetch($stmt)) {
        echo '<p' . $col1 . "   quantity : " . $col3 . "   price = " . $col2 * $col3 . "</p>";
    }

    mysqli_shutdown($stmt, $mysqli);
?>

<?php } else {?>

<?php } ?>
</body>
</html>