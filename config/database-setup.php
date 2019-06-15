<?php
$DB_DSN = 'mysql:dbname=Camagru;host=mysql';
$DB_USER = 'root';
$DB_PASSWORD = 'rootpass';
$URL = 'localhost:8080';

$mysqli = mysqli_connect("mysql", "root", "rootpass", "rush");

if (!$mysqli) {
    echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
    echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
    echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Succès : Une connexion correcte à MySQL a été faite! La base de donnée my_db est génial." . PHP_EOL;
echo "Information d'hôte : " . mysqli_get_host_info($mysqli) . PHP_EOL;

mysqli_close($mysqli);
?>