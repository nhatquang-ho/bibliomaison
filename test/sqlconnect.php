<?php
#test database connection

include '../modules/loadenv.php';
$dotenv = new DotEnv('../.env');
$loadvars = $dotenv->load();

$link = mysql_connect($_ENV['DB_URL'], $_ENV['DB_NAME'], $_ENV['DB_PASS']);
if($link) echo 'OK';
if (!$link) {
    die('Connexion impossible : ' . mysql_error());
}
echo 'Connecte correctement';

$db_selected = mysql_select_db($_ENV['DB_NAME'], $link);
if (!$db_selected) {
   die ('Impossible de sélectionner la base de données : ' . mysql_error());
}
echo 'good';

mysql_close($link);
