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
  die('<script>console.log("Impossible to connect to the database : ")' . mysql_error() . '</script>');
}

$db_selected = mysql_select_db($_ENV['DB_NAME'], $link);
if (!$db_selected) {
 die('<script>console.log("Impossible to choose the table : ")' . mysql_error() . '</script>');
}

#search and delete all books
$result = mysql_query("SELECT isbn,title,year FROM $name") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
while ($row = mysql_fetch_assoc($result)) {
  $isbn=$row["isbn"];
  $sql = mysql_query('DELETE FROM '.$name.' WHERE isbn="'.$isbn.'"') or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
}


echo '<script>alert("All books deleted");</script>';
echo '<script>console.log("All books deleted")</script>';
echo '<script type="text/javascript">setTimeout(function(){window.top.location="../pages/listBooks.php"} , 0);</script>';
?>



<?php
}else{
?>
<a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>
<h1>Please <a href="../pages/login.php">click here</a> to login</h1>
<?php
} 
?>
