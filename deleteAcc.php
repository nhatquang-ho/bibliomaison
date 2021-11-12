<?php
session_start();
?>
<?php
if($_SESSION["name"]) {
$name=$_SESSION["username"];
?>

<?php

include 'loadenv.php';
$dotenv = new DotEnv('.env');
$loadvars = $dotenv->load();

$link = mysql_connect($_ENV['DB_URL'], $_ENV['DB_NAME'], $_ENV['DB_PASS']);
if (!$link) {
    die('<br>Connexion database impossible : <br>' . mysql_error());
}

$db_selected = mysql_select_db($_ENV['DB_NAME'], $link);
if (!$db_selected) {
   die ('Impossible de sélectionner la base de données : <br>' . mysql_error());
}

if ($name == 'tipou'){
    echo "you can not delete the default account<br>";
}
else{
    $deltab= mysql_query("DROP TABLE $name") or die("Erreur SQL : $sql<br/>".mysql_error());
    $dellogin=mysql_query("DELETE FROM login_user WHERE user_name='$name'") or die("Erreur SQL : $sql<br/>".mysql_error());

    echo "your account is succesfully deleted<br>";
    echo '<nav><a href="index.php">Back to main menu</a></nav>';
    echo '<script type="text/javascript">setTimeout(function(){window.top.location="logout.php"} , 3000);</script>';
}

?>


<?php
}else echo '<h1>Please <a href="login.php">click here</a> to login</h1>';
?>