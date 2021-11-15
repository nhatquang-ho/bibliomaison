<?php
session_start();
?>

<?php
if($_SESSION["name"]) {
$name=$_SESSION["username"];
?>

<?php

include 'loadenv.php';
$dotenv = new DotEnv('../.env');
$loadvars = $dotenv->load();

$link = mysql_connect($_ENV['DB_URL'], $_ENV['DB_NAME'], $_ENV['DB_PASS']);
if (!$link) {
    die('<br>Connexion database impossible : <br>' . mysql_error());
}

$db_selected = mysql_select_db($_ENV['DB_NAME'], $link);
if (!$db_selected) {
   die ('Impossible de sélectionner la base de données : <br>' . mysql_error());
}

#get the book via isbn and delete it
$isbn=$_GET['isbn'];
$sql = mysql_query('DELETE FROM '.$name.' WHERE isbn="'.$isbn.'"') or die("Erreur SQL : $sql<br/>".mysql_error());

echo "book deleted<br>";
echo '<a href="../pages/listBooks.php">return</a><br>';

echo '<nav><a href="../index.php">Back to main menu</a></nav>';

?>

<?php
}else{
?>
<a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>
<h1>Please <a href="../pages/login.php">click here</a> to login</h1>
<?php
} 
?>

