<?php
session_start();
?>
<!DOCTYPE html>
<html xmlns="https://www.w3schools.com/php" xml:lang="en" lang="en">
<head>
  <meta charset="UTF-8" />
  <title>UPDATE_BOOK</title>
</head>
<body>
<?php
if($_SESSION["name"]) {
$name=$_SESSION["username"];
?>
  Welcome <?php echo $_SESSION["name"]; ?>. Click here to <a href="logout.php" title="Logout">Logout.</a>
  <h1>Public Library: Update a book record</h1>
  <form method="post" action="">
    <p><label>ISBN: <input name="isbn" readonly="readonly" value="<?php echo $_GET['isbn']; ?>" /></label></p>
    <p><label>Title: <input name="title" value="<?php echo $_GET['title']; ?>" /></label></p>
    <p><label>Year: <input name="year" value="<?php echo $_GET['year']; ?>" /></label></p>
    <p><button type="submit" name="updbook" value="submit">Save Changes</button></p>
  </form>



<?php

include 'loadenv.php';
$dotenv = new DotEnv('.env');
$loadvars = $dotenv->load();

if(isset($_POST['updbook'])){
    $link = mysql_connect($_ENV['DB_URL'], $_ENV['DB_NAME'], $_ENV['DB_PASS']);
if (!$link) {
    die('<br>Connexion database impossible : <br>' . mysql_error());
}

$db_selected = mysql_select_db($_ENV['DB_NAME'], $link);
if (!$db_selected) {
   die ('Impossible de sélectionner la base de données : <br>' . mysql_error());
}

$isbn = $_POST['isbn'];
$title = $_POST['title'];
$year = $_POST['year'];


$sql=mysql_query("UPDATE $name SET title='$title', year='$year' WHERE isbn='$isbn'") or die("Erreur SQL : $sql<br/>".mysql_error());


echo "book updated<br>";

mysql_close($link);
}
?>

  <nav><a href="index.php">Back to main menu</a></nav>
<?php
}else echo '<h1>Please <a href="login.php">click here</a> to login</h1>';
?>
</body>
</html>
