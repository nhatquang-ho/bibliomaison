<?php
#test database connection

#load .env
include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

$connect = mysql_connect($_ENV['DB_URL'], $_ENV['DB_NAME'], $_ENV['DB_PASS']);
if (!$connect) {
    die('<script>console.log("Impossible to connect to the database : ")' . mysql_error() . '</script>');
}

$db_selected = mysql_select_db($_ENV['DB_NAME'], $connect);
if (!$db_selected) {
    die('<script>console.log("Impossible to choose the table : ")' . mysql_error() . '</script>');
}

echo "OK";

mysql_close($connect);
